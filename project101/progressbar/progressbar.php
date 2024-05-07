<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Circle Progress Bar</title>
<style>
  .progress-bar {
    position: relative;
    width: 200px;
    height: 200px;
  }

  .progress-track {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 10px solid #f3f3f3;
  }

  .progress-fill {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 10px solid #3498db;
    clip: rect(0, 100px, 100px, 50px);
    transform-origin: center;
  }

  .progress-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 24px;
    color: #333;
  }
</style>
</head>
<body>

<div class="progress-bar">
  <div class="progress-track">
    <div class="progress-fill" id="progressFill" style="transform: rotate(0deg);"></div>
  </div>
  <div class="progress-text" id="progressText">0%</div>
</div>

</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $additionalTime = (int)$_POST["additionalTime"]; // Convert the string to an integer
    $totalTime = 1800; // Total time in seconds
    $currentProgress = min(100, ($additionalTime / $totalTime) * 100);
    echo "<script>
            document.getElementById('progressFill').style.transform = 'rotate(' + ($currentProgress * 1.8) + 'deg)';
            document.getElementById('progressText').innerText = '$currentProgress%';
          </script>";
}
?>