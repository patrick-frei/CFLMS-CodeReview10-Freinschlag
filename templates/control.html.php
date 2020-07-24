<?php require_once "../php/db_connect.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../templates/head.html.php"; ?>
  <script src="js/control.js"></script>
</head>

<body>
  <header>
    <?php include "../templates/header.html.php"; ?>
  </header>
  <div class="container mb-3">
    <form id="media-form">
      <input type="hidden" name="__table__" value="media">
      <input type="hidden" name="__delete_key__" value="media_id">
      <input type="hidden" name="__delete_value__" data-value="@__media_id__">
      <div class="form-group">
        <label>Media:</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <button class="btn btn-outline-info" type="button" id="media-update-add" data-state="update">Update</button>
          </div>
          <select class="custom-select" id="media-picker">
          </select>
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="media-save">Save</button>
            <button class="btn btn-outline-danger" type="button" id="media-delete">Delete</button>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label>media_id:</label>
        <input name="__media_id__" id="__media_id__" type="text" class="form-control" readonly></div>
      <div class="form-group">
        <label>title:</label>
        <input name="title" id="title" type="text" class="form-control" required></div>
      <div class="form-group">
        <label>image:</label>
        <div>
          <div class="input-group">
            <input id="__image_label__" type="text" readonly class="form-control">
            <div class="input-group-append">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="image" id="image">
                <label for="image" class="btn btn-outline-secondary">Browse</label>
              </div>
              <button class="btn btn-outline-danger" type="button" id="image-remove">Remove</button>
            </div>
          </div>
        </div>
        <div class="form-group mt-3">
          <img src="" id="image_thumbnail">
        </div>
      </div>
      <div class="form-group">
        <label>ISBN:</label>
        <input name="ISBN" id="ISBN" type="number" class="form-control">
      </div>
      <div class="form-group">
        <label>description:</label>
        <textarea name="description" id="description" type="number" class="form-control" rows="10" required></textarea>
      </div>
      <div class="form-group">
        <label>publish_date:</label>
        <input name="publish_date" id="publish_date" type="date" class="form-control" required>
      </div>
      <div class="form-group">
        <label>publisher</label>
        <div class="input-group">
          <select class="custom-select" name="fk_publisher_id" id="fk_publisher_id" required>
            <option disabled selected></option>

          </select>
          <div class="input-group-append">
            <!--<button class="btn btn-outline-info" type="button" data-toggle="modal" data-target="#exampleModalCenter">Update</button>-->
            <button class="btn btn-outline-success" type="button" data-toggle="modal" data-target="#exampleModalCenter">Add</button>
            <button class="btn btn-outline-danger" type="button" id="publisher-delete">Delete</button>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label>authors</label>
        <div class="input-group">
          <select class="custom-select" name="__fk_author_id__[]" id="__fk_author_id__" multiple required>
          </select>
          <div class="input-group-append">
            <!--<button class="btn btn-outline-info" type="button" data-toggle="modal" data-target="#exampleModalCenter2">Update</button>-->
            <button class="btn btn-outline-success" type="button" data-toggle="modal" data-target="#exampleModalCenter2">Add</button>
            <button class="btn btn-outline-danger" type="button" id="author-delete">Delete</button>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label>type:</label>
        <select class="custom-select" name="type" id="type" value="book" required>
          <option value="book">book</option>
          <option value="CD">CD</option>
          <option value="DVD">DVD</option>
        </select>
      </div>
      <div class="form-group">
        <label>status:</label>
        <select class="custom-select" name="status" id="status" required>
          <option value="available">available</option>
          <option value="reserved">reserved</option>
        </select>
      </div>
    </form>
  </div>
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add publisher</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="publishers-form">
            <input type="hidden" name="__table__" value="publishers">
            <input type="hidden" name="__delete_key__" value="publisher_id">
            <input type="hidden" name="__delete_value__" data-value="@fk_publisher_id">
            <div class="form-group">
              <label>Name:</label>
              <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
              <label>Street:</label>
              <input type="text" name="street" class="form-control">
            </div>
            <div class="form-group">
              <label>ZIP code:</label>
              <input type="text" name="ZIP_code" class="form-control">
            </div>
            <div class="form-group">
              <label>City:</label>
              <input type="text" name="city" class="form-control">
            </div>
            <div class="form-group">
              <label>City:</label>
              <select type="text" name="city" class="custom-select">
                <option value="small">small</option>
                <option value="small">medium</option>
                <option value="small">big</option>
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-outline-info" id="publisher-add">Save</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add auhtor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="authors-form">
            <input type="hidden" name="__table__" value="authors">
            <input type="hidden" name="__delete_key__" value="author_id">
            <input type="hidden" name="__delete_value__" data-value="@__fk_author_id__">
            <div class="form-group">
              <label>Fist name:</label>
              <input type="text" name="first_name" class="form-control">
            </div>
            <div class="form-group">
              <label>Last name:</label>
              <input type="text" name="last_name" class="form-control">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-outline-info" id="author-add">Save</button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>