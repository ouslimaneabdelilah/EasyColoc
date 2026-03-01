$baseDate = "2026-02-23 "
$hashes = @("1dcefff", "b827238", "fb1da21", "858f06f", "831349b", "d24eab9", "2d69a3b", "51cf2a8", "61eceb4", "33f2dda", "46edf84")
$times = @("10:00:00", "11:00:00", "12:00:00", "13:00:00", "14:00:00", "15:00:00", "16:00:00", "17:00:00", "18:00:00", "19:00:00", "20:00:00")

git checkout -B dev 1dcefff~1

for ($i = 0; $i -lt $hashes.Count; $i++) {
    $fullDate = $baseDate + $times[$i] + " +0000"
    $env:GIT_COMMITTER_DATE = $fullDate
    $env:GIT_AUTHOR_DATE = $fullDate
    git cherry-pick $hashes[$i]
    git commit --amend --no-edit --date="$fullDate"
}

# Add latest user files
git add .
$finalDate = $baseDate + "21:30:00 +0000"
$env:GIT_COMMITTER_DATE = $finalDate
$env:GIT_AUTHOR_DATE = $finalDate
git commit -m "feat: refine profile UI and controller" --date="$finalDate"

git push origin dev --force
git log -n 15 --format="%h %ci %ai %s"
