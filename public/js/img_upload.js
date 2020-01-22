// for change user profile-photo
var images = document.querySelectorAll(".default_img");
var loadFile = function (event) {
    images[0].src = URL.createObjectURL(event.target.files[0]);
    images[1].src = URL.createObjectURL(event.target.files[0]);
};
// for clear btn to change default img
function resetimg() {
    var input_value = document.getElementById("nameid");
    input_value.innerText = "asdfd";
    images[0].src = "/image/default_img.png";
    images[1].src = "/image/default_img.png";
}
//for Post detail modal
$(function () {
    $('#favoritesModal').on("show.bs.modal", function (e) {
        $("#modal_title").val($(e.relatedTarget).data('title'));
        $("#modal_desc").html($(e.relatedTarget).data('desc'));
        $("#modal_status").val($(e.relatedTarget).data('status'));
        $("#modal_created_at").val($(e.relatedTarget).data('created_at'));
        $("#modal_created_user").val($(e.relatedTarget).data('created_user'));
        $("#modal_updated_at").val($(e.relatedTarget).data('created_at'));
        $("#modal_updated_user").val($(e.relatedTarget).data('updated_user'));
    });
});
//for user detail modal
$(function () {
    $('#userModal').on("show.bs.modal", function (e) {
        $("#modal_name").val($(e.relatedTarget).data('name'));
        $("#modal_email").val($(e.relatedTarget).data('email'));
        $("#modal_phone").val($(e.relatedTarget).data('phone'));
        $("#modal_dob").val($(e.relatedTarget).data('dob'));
        $("#modal_address").val($(e.relatedTarget).data('address'));
        $("#modal_created_at").val($(e.relatedTarget).data('created_at'));
        $("#modal_created_user").val($(e.relatedTarget).data('created_user'));
        $("#modal_updated_at").val($(e.relatedTarget).data('updated_at'));
        $("#modal_updated_user").val($(e.relatedTarget).data('updated_user'));
    });
});
