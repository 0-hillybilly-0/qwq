</div>

</div>

</div>

<div id="ad-container">
  <script>
    // JavaScript to display a randomized ad
    // List of ad files
    var adFiles = ["ads/enter.jpg", "ads/image.png", "ads/newest.gif", "ads/problems.gif", "ads/your_girl.gif"]; // Replace these with actual file paths

    // Randomly select an ad file
    var randomAdIndex = Math.floor(Math.random() * adFiles.length);
    var randomAdFile = adFiles[randomAdIndex];

    // Create an image element for the ad
    var adImage = document.createElement("img");
    adImage.src = randomAdFile;
    adImage.alt = "Advertisement";

    // Append the ad image to the ad container
    document.getElementById("ad-container").appendChild(adImage);
  </script>
</div>

</body>
</html>