document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("media-picker").addEventListener("change", function () {
    document.getElementById("media-table").innerHTML = "";
    loadContent();
  })
});
document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("option-picker").addEventListener("change", function () {
    document.getElementById("media-table").innerHTML = "";
    loadContent();
  })
});
function loadContent() {
  var mediaReq = new XMLHttpRequest();
  mediaReq.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let media = JSON.parse(this.responseText);
      for (key in media) {
        switch (document.getElementById("option-picker").value) {
          case "Show":
            switch (key) {
              case "publisher":
                document.getElementById("media-table").innerHTML += `<tr><td>${key}</td><td><ul class="list-group"><li class="list-group-item">${media[key].name}</li></ul></td></tr>`;
                break;
              case "authors":
                let authors = [];
                for (author of media[key]) {
                  authors.push(`${author.first_name} ${author.last_name}`)
                }
                document.getElementById("media-table").innerHTML += `<tr><td>${key}</td><td><ul class="list-group"><li class="list-group-item">${authors.join("</li><li class='list-group-item'>")}</li></ul></td></tr>`;
                break;
              default:
                document.getElementById("media-table").innerHTML += `<tr><td>${key}</td><td>${media[key]}</td></tr>`;
            }
            break;
          case "Update":
            switch (key) {
              case "media_id":
                document.getElementById("media-table").innerHTML += `<tr><td>${key}</td><td><input name="${key}" type="hidden" value="${media[key]}">${media[key]}</td></tr>`
                break;
              case "image":
                document.getElementById("media-table").innerHTML += `<tr><td>${key}</td><td><input name="${key}" type="file" class="form-control-file" value="img/${media[key]}"><img class="mt-2" src="img/${media[key]}" style="height: 4em;"></td></tr>`
                break;
              case "ISBN":
                document.getElementById("media-table").innerHTML += `<tr><td>${key}</td><td><input name="${key}" type="number" class="form-control" value="${media[key]}"></td></tr>`
                break;
              case "description":
                document.getElementById("media-table").innerHTML += `<tr><td>${key}</td><td><textarea name="${key}" type="number" class="form-control">${media[key]}</textarea></td></tr>`
                break;
              case "publish_date":
                document.getElementById("media-table").innerHTML += `<tr><td>${key}</td><td><input name="${key}" type="date" class="form-control" value="${media[key]}"></td></tr>`
                break;
              case "type":
                document.getElementById("media-table").innerHTML += `<tr><td>${key}</td><td><select name="${key}" class="form-control" value="${media[key]}"><option ${media[key] == "book" ? "selected" : ""}>book</option><option ${media[key] == "CD" ? "selected" : ""}>CD</option><option ${media[key] == "DVD" ? "selected" : ""}>DVD</option></select></td></tr>`
                break;
              case "status":
                document.getElementById("media-table").innerHTML += `<tr><td>${key}</td><td><select name="${key}" class="form-control"><option ${media[key] == "available" ? "selected" : ""}>available</option><option ${media[key] == "reserved" ? "selected" : ""}>reserved</option></select></td></tr>`
                break;
              case "publisher":
                var publishersReq = new XMLHttpRequest();
                publishersReq.onreadystatechange = function () {
                  if (this.readyState == 4 && this.status == 200) {
                    let publishers = JSON.parse(this.responseText);
                    let publishers_option_tags = [];
                    alert(JSON.stringify(media[key]));
                    for (publisher of publishers) {
                      publishers_option_tags.push(`<option value="${publisher.publisher_id}" ${media[key].publisher_id == publisher.publisher_id ? "selected" : ""}>${publisher.name}</option>`);
                    }
                    document.getElementById("media-table").innerHTML += `<tr><td>${key}</td><td><select name="${key}" class="form-control">${publishers_option_tags.join("")}</select></td></tr>`
                  }
                }
                publishersReq.open("GET", "php/ajax/get_publishers_json.php", true);
                publishersReq.send();
                break;
              case "authors":
                var authorsReq = new XMLHttpRequest();
                authorsReq.onreadystatechange = function () {
                  if (this.readyState == 4 && this.status == 200) {
                    let authors = JSON.parse(this.responseText);
                    let authors_option_tags = [];
                    for (author of authors) {
                      authors_option_tags.push(`<option value="${author.author_id}" ${media[key].find(media_author => media_author.author_id == author.author_id) != undefined ? "selected" : ""}>${(author.first_name)} ${author.last_name}</option>`);
                    }
                    document.getElementById("media-table").innerHTML += `<tr><td>${key}</td><td><select multiple name="${key}" class="form-control">${authors_option_tags.join("")}</select></td></tr>`
                  }
                }
                authorsReq.open("GET", "php/ajax/get_authors_json.php", true);
                authorsReq.send();
                break;
              default:
                document.getElementById("media-table").innerHTML += `<tr><td>${key}</td><td><input name="${key}" type="text" class="form-control" value="${media[key]}"></td></tr>`
            }
            break;
          case "Add":
            break;
          case "Delete":
            break;
        }
      }
    }
  }
  mediaReq.open("GET", `php/ajax/get_media_json.php?id=${document.getElementById("media-picker").value}`, true);
  mediaReq.send();
}