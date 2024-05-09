<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Circle Progress Bar</title>
<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }

  .progress-container {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .progress-bar {
    position: relative;
    width: 200px;
    height: 200px;
    border: 5px solid #ffcc00; /* Yellow border */
    border-radius: 50%;
    background-color: #f9f9f9; /* Light gray background */
    overflow: hidden;
  }

  .progress-track {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 10px solid #00ff00; /* Green track */
  }

  .progress-fill {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 10px solid #ff3399; /* Pink fill */
    clip: rect(0, 100px, 100px, 50px);
    transform-origin: center;
    transition: transform 1s linear; /* Add smooth transition */
    transform: rotate(0deg); /* Initial rotation */
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

<div class="progress-container">
  <div class="progress-bar">
    <div class="progress-track">
      <div class="progress-fill" id="progressFill"></div>
    </div>
    <div class="progress-text" id="progressText">0%</div>
  </div>
</div>
<script>
function updateProgress(percentage) {
  var progressBar = document.getElementById("progressFill");
  var progressText = document.getElementById("progressText");

  var degrees = (percentage / 100) * 360;
  progressBar.style.transform = "rotate(" + degrees + "deg)";

  progressText.textContent = percentage + "%";
}

// Example usage:
// Update progress to 50%
updateProgress(50); // You can replace 50 with the actual progress percentage
</script>
</body>
</html>