<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Invitations\InviteRequest;
use App\Http\Requests\Invitations\AcceptInvitationRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ColocationInvitation;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Token;

class InvitationController extends Controller
{
    public function invite(InviteRequest $request)
    {
        $user = Auth::user();
        $colocation = $user->colocations()->first();

        if (!$colocation || $user->colocations()->wherePivot('role', 'owner')->where('colocation_id', $colocation->id)->doesntExist()) {
            return redirect()->back()->withErrors(['error' => 'Only owners can send invitations']);
        }

        $payload = JWTFactory::customClaims([
            'sub' => config('app.key'),
            'colocation_id' => $colocation->id,
            'colocation_name' => $colocation->name,
            'email' => $request->email,
            'inviter_name' => $user->name,
        ])->make();

        $token = JWTAuth::encode($payload)->get();
        $url = route('invitations.show', ['token' => $token]);

        Mail::to($request->email)->send(new ColocationInvitation($user->name, $colocation->name, $url));

        return redirect()->back()->with('success', 'Invitation sent successfully to ' . $request->email);
    }

    public function show($token)
    {
        try {
            $jwtToken = new Token($token);
            $payload = JWTAuth::decode($jwtToken);

            $colocationName = $payload->get('colocation_name');
            $inviterName = $payload->get('inviter_name');
            $email = $payload->get('email');

            if (!Auth::check()) {
                session(['pending_invitation_token' => $token]);
                return redirect()->route('register', ['email' => $email])->with('info', "Please register to accept your invitation to $colocationName.");
            }

            return view('invitations.show', compact('colocationName', 'inviterName', 'token', 'email'));
        } catch (\Exception $e) {
            return redirect('/')->withErrors(['error' => 'Invalid or expired invitation link.']);
        }
    }

    public function accept(AcceptInvitationRequest $request)
    {
        try {
            $token = new Token($request->token);
            $payload = JWTAuth::decode($token);

            $colocationId = $payload->get('colocation_id');
            $colocationName = $payload->get('colocation_name');
            $invitedEmail = $payload->get('email');

            $user = Auth::user();

            if ($user->email !== $invitedEmail) {
                return redirect()->back()->withErrors(['error' => 'This invitation is not for you']);
            }

            if ($user->activeMemberships()) {
                return redirect()->back()->withErrors(['error' => 'You already have an active colocation']);
            }

            $user->colocations()->attach($colocationId, [
                'id' => (string) Str::uuid(),
                'role' => 'member'
            ]);

            session()->forget('pending_invitation_token');

            return redirect()->route('dashboard')->with('success', "You have successfully joined $colocationName!");
        } catch (TokenInvalidException $e) {
            return redirect()->back()->withErrors(['error' => 'Invalid invitation token']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to process invitation']);
        }
    }
}
