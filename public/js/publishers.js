document.addEventListener("DOMContentLoaded", function () {
  let elements = document.getElementsByClassName("media");
  for (let element of elements) {
    element.querySelector(".media-trigger").addEventListener("click", function () {
      if (element.querySelector(".media-result").innerHTML) {
        element.querySelector(".media-result").innerHTML = "";
        element.querySelector(".media-trigger").innerHTML = "Show media";
      } else {
        let media_array = getJSON(`${location.protocol}//${location.host}/ajax/get_json?__table__=media&fk_publisher_id=${element.dataset.publisher_id}`);
        element.querySelector(".media-result").innerHTML = "<ul class='list-group list-group-flush mt-3'></ul>";
        for (media of media_array) {
          element.querySelector(".media-result .list-group").innerHTML += `<li class='list-group-item'>${media.title} <small class="text-muted">${new Date(media.publish_date).getFullYear()}</small> <span class="badge badge-info">${media.type}</span></li>`;
        }
        element.querySelector(".media-trigger").innerHTML = "Hide media";
      }
    })
  }
});