document.addEventListener("DOMContentLoaded", function () {
  document.addEventListener("change", function () {
    setDataValues();
  });
});
function postFormData(form, request) {
  let obj = {};
  let xhr = new XMLHttpRequest();
  xhr.open("POST", request, false);
  xhr.onreadystatechange = function () {
    if (this.readyState == 4) {
      obj.success = this.status == 200 ? true : false;
      obj.responseText = this.responseText;
    }
  }
  xhr.send(new FormData(form));
  return obj;
}
function getJSON(request) {
  let obj = {};
  var xhr = new XMLHttpRequest();
  xhr.open("GET", request, false);
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      obj = JSON.parse(this.responseText);
    }
  }
  xhr.send();
  return obj;
}
function setDataValues() {
  let elements = document.querySelectorAll("[data-value^='@']");
  for (element of elements) {
    element.value = document.getElementById(element.dataset.value.substr(1)).value;
  }
}