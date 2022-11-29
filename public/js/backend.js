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
            $("#Diambil").modal("hide");
            toastr.success(event.detail.message, "Success!");
        });
        window.addEventListener("hide-diambil", function (event) {
            $("#Diambil").modal("hide");
            toastr.success(event.detail.message, "Success!");
        });
        window.addEventListener("hide-importModal", function (event) {
            $("#importModal").modal("hide");
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
    window.addEventListener("importModal", function (event) {
        $("#importModal").modal("show");
    });
    window.addEventListener("ExportModal", function (event) {
        $("#ExportModal").modal("show");
    });
    window.addEventListener("show-diambil", function (event) {
        $("#Diambil").modal("show");
    });
    window.addEventListener("webcam", function (event) {
        $("#modal-webcam").modal("show");
        Webcam.set({
            width: 470,
            height: 350,
            image_format: "jpeg",
            jpeg_quality: 90,
        });
        Webcam.attach("#my_camera");
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
        toastr.error(event.detail.message, "danger!");
    });
    $('[x-ref="profileLink"]').on("click", function () {
        localStorage.setItem("_x_currentTab", '"profile"');
    });
    $('[x-ref="changePasswordLink"]').on("click", function () {
        localStorage.setItem("_x_currentTab", '"changePassword"');
    });
    /******/
})();
