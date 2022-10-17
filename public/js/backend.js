/******/ (() => {
    // webpackBootstrap
    var __webpack_exports__ = {};
    /*!*********************************!*\
  !*** ./resources/js/backend.js ***!
  \*********************************/
    $(document).ready(function () {
        toastr.options = {
            positionClass: "toast-top-right",
            progressBar: true,
        };
        window.addEventListener("hide-form", function (event) {
            $("#form").modal("hide");
            toastr.success(event.detail.message, "Success!");
        });
        $("#sidebarCollapse").on("click", function () {
            $("#sidebar").toggleClass("active");
            $("#content").toggleClass("active");
        });

        $(".more-button,.body-overlay").on("click", function () {
            $("#sidebar,.body-overlay").toggleClass("show-nav");
        });
    });

    window.addEventListener("show-form", function (event) {
        $("#form").modal("show");
    });
    window.addEventListener("show-delete-modal", function (event) {
        $("#confirmationModal").modal("show");
    });
    window.addEventListener("hide-delete-modal", function (event) {
        $("#confirmationModal").modal("hide");
        toastr.success(event.detail.message, "Success!");
    });
    window.addEventListener("alert", function (event) {
        toastr.success(event.detail.message, "Success!");
    });
    window.addEventListener("alert-danger", function (event) {
        toastr.success(event.detail.message, "Success!");
    });
    window.addEventListener("updated", function (event) {
        toastr.danger(event.detail.message, "Warning!");
    });
    $('[x-ref="profileLink"]').on("click", function () {
        localStorage.setItem("_x_currentTab", '"profile"');
    });
    $('[x-ref="changePasswordLink"]').on("click", function () {
        localStorage.setItem("_x_currentTab", '"changePassword"');
    });
    /******/
})();