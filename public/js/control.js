document.addEventListener("DOMContentLoaded", function () {
  load_media();
  load_content();
  setDataValues();
  // media-update-add
  document.getElementById("media-update-add").addEventListener("click", function () {
    if (document.getElementById("media-update-add").dataset.state == "update") {
      document.getElementById("media-update-add").dataset.state = "add";
      document.getElementById("media-update-add").innerHTML = "Add";
      document.getElementById("media-update-add").classList.remove("btn-outline-info");
      document.getElementById("media-update-add").classList.add("btn-outline-success");
      document.getElementById("media-picker").innerHTML = "";
      document.getElementById("media-picker").setAttribute("disabled", "");
      document.getElementById("media-form").reset();
      document.getElementById("image_thumbnail").src = "";
    } else if (document.getElementById("media-update-add").dataset.state == "add") {
      document.getElementById("media-update-add").dataset.state = "update";
      document.getElementById("media-update-add").innerHTML = "Update";
      document.getElementById("media-update-add").classList.remove("btn-outline-success");
      document.getElementById("media-update-add").classList.add("btn-outline-info");
      document.getElementById("media-picker").removeAttribute("disabled");
      load_media()
    }
    load_content();
  });
  // media-save
  document.getElementById("media-save").addEventListener("click", function () {
    if (!document.getElementById("media-form").checkValidity()) {
      console.log("Invalid input");
      return;
    }
    if (document.getElementById("media-update-add").dataset.state == "update") {
      postRequest = postFormData(document.getElementById("media-form"), `${location.protocol}//${location.host}/ajax/db_update_media`);
      console.log(postRequest.responseText)
      if (postRequest.success) {
        load_media();
        load_content();
      }
    } else if (document.getElementById("media-update-add").dataset.state == "add") {
      postRequest = postFormData(document.getElementById("media-form"), `${location.protocol}//${location.host}/ajax/db_insert_media`);
      console.log(postRequest.responseText)
      if (postRequest.success) {
        load_content();
      }
    }
  });
  // media-delete
  document.getElementById("media-delete").addEventListener("click", function () {
    postRequest = postFormData(document.getElementById("media-form"), `${location.protocol}//${location.host}/ajax/db_delete_general`);
    console.log(postRequest.responseText)
    if (postRequest.success) {
      load_media();
      load_content();
    }
  });
  // publisher-add
  document.getElementById("publisher-add").addEventListener("click", function () {
    postRequest = postFormData(document.getElementById("publishers-form"), `${location.protocol}//${location.host}/ajax/db_insert_general`);
    console.log(postRequest.responseText)
    if (postRequest.success) {
      load_publishers();
    }
  });
  // publisher-delete
  document.getElementById("publisher-delete").addEventListener("click", function () {
    postRequest = postFormData(document.getElementById("publishers-form"), `${location.protocol}//${location.host}/ajax/db_delete_general`);
    console.log(postRequest.responseText)
    if (postRequest.success) {
      load_publishers();
    }
  });
  // author-add
  document.getElementById("author-add").addEventListener("click", function () {
    postRequest = postFormData(document.getElementById("authors-form"), `${location.protocol}//${location.host}/ajax/db_insert_general`);
    console.log(postRequest.responseText)
    if (postRequest.success) {
      load_authors();
    }
  });
  // author-delete
  document.getElementById("author-delete").addEventListener("click", function () {
    postRequest = postFormData(document.getElementById("authors-form"), `${location.protocol}//${location.host}/ajax/db_delete_general`);
    console.log(postRequest.responseText)
    if (postRequest.success) {
      load_authors();
    }
  });
  document.getElementById("media-picker").addEventListener("change", function () {
    load_content();
  });
  document.getElementById("image-remove").addEventListener("click", function () {
    document.getElementById("image_thumbnail").src = "";
    document.getElementById("image").value = "";
    document.getElementById("__image_label__").value = "No image choosen";
  });
  document.getElementById("image").addEventListener("change", function (event) {
    if (event.target.files.length == 1) {
      let file_reader = new FileReader();
      file_reader.onload = (function () {
        return function (e) {
          document.getElementById("image_thumbnail").src = e.target.result;
          document.getElementById("__image_label__").value = event.target.files[0].name;
        };
      })(event.target.files[0]);
      file_reader.readAsDataURL(event.target.files[0]);
    } else {
      document.getElementById("image_thumbnail").src = "";
      document.getElementById("__image_label__").value = "No image choosen";
    }
  });
});
function load_media() {
  let media_array = getJSON(`${location.protocol}//${location.host}/ajax/get_json?__table__=media`);
  document.getElementById("media-picker").innerHTML = "";
  for (media of media_array) {
    document.getElementById("media-picker").innerHTML += `<option value=${media.media_id}>${media.title}</option>`;
  }
}
function load_publishers() {
  let publishers = getJSON(`${location.protocol}//${location.host}/ajax/get_json?__table__=publishers`);
  let publishers_option_tags = document.getElementById("fk_publisher_id").querySelectorAll("option:not(:first-child)");
  for (publishers_option_tag of publishers_option_tags) {
    publishers_option_tag.parentNode.removeChild(publishers_option_tag);
  }
  for (publisher of publishers) {
    document.getElementById("fk_publisher_id").innerHTML += `<option value=${publisher.publisher_id}>${publisher.name}</option>`;
  }
}
function load_authors() {
  let authors = getJSON(`${location.protocol}//${location.host}/ajax/get_json?__table__=authors`);
  document.getElementById("__fk_author_id__").innerHTML = "";
  for (author of authors) {
    document.getElementById("__fk_author_id__").innerHTML += `<option value=${author.author_id}>${author.last_name} ${author.first_name}</option>`;
  }
}
function load_content() {
  load_publishers();
  load_authors();
  if (!document.getElementById("media-picker").disabled) {
    let media = getJSON(`${location.protocol}//${location.host}/ajax/get_json?__table__=media&media_id=${document.getElementById("media-picker").value}`)[0];
    for (key in media) {
      switch (key) {
        case "media_id":
          document.getElementById(`__${key}__`).value = media[key];
          break;
        case "image":
          if (media[key] != null) {
            document.getElementById("image_thumbnail").src = `img/${media[key]}`;
            document.getElementById("__image_label__").value = media[key];
          } else {
            document.getElementById("image_thumbnail").src = "";
          }
          break;
        case "type":
          document.querySelector(`#${key}>option[value='${media[key]}']`).selected = true;
          break;
        case "status":
          document.querySelector(`#${key}>option[value='${media[key]}']`).selected = true;
          break;
        case "fk_publisher_id":
          document.querySelector(`#${key}>option[value='${media[key]}']`).selected = true;
          break;
        default:
          document.getElementById(key).value = media[key];
          break;
      }
    }
    let media_has_authors = getJSON(`${location.protocol}//${location.host}/ajax/get_json?__table__=media_has_authors&fk_media_id=${media.media_id}`);
    for (media_has_author of media_has_authors) {
      document.querySelector(`#__fk_author_id__>option[value='${media_has_author.fk_author_id}']`).selected = true;
    }
  }
}
