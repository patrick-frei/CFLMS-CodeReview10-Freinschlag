document.addEventListener("DOMContentLoaded", function () {
  let elements = document.getElementsByClassName("media");
  for (let i = 0; i < elements.length; i++) {
    elements[i].querySelector(".media-trigger").addEventListener("click", function () {
      if (elements[i].querySelector(".media-result").innerHTML) {
        elements[i].querySelector(".media-result").innerHTML = "";
        elements[i].querySelector(".media-trigger").innerHTML = "Show media";
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            elements[i].querySelector(".media-result").innerHTML = this.responseText;
            elements[i].querySelector(".media-trigger").innerHTML = "Hide media";
          }
        }
        xmlhttp.open("GET", `php/ajax/publisher_media.php?id=${elements[i].dataset.media}`, true);
        xmlhttp.send();
      }
    })
  }
});