<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Dashtrap - Responsive Bootstrap 5 Admin Dashboard</title>
    <base href="<?= base_url() ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="assets/libs/morris.js/morris.css" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

    <!-- ION Slider -->
    <link href="assets/libs/ion-rangeslider/css/ion.rangeSlider.min.css" rel="stylesheet" type="text/css" />

    <!-- FORMS-ADVANCE -->
    <!-- Plugins css -->
    <link href="assets/libs/mohithg-switchery/switchery.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />

    <!-- Include stylesheet -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" /> -->

    <!-- Include the Quill library -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script> -->

    <!-- HASTA ACA FORMS ADVANCE -->

    <!-- third party css -->
    <link href="assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- FORMS-quills -->
    <!-- Plugins css -->
    <!-- <link href="assets/libs/quill/quill.core.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/quill/quill.bubble.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/quill/quill.snow.css" rel="stylesheet" type="text/css" /> -->
    <!-- HASTA ACA FORMS quills -->

    <!-- FORMS-Tiny -->
    <script src="tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- HASTA FORMS-Tiny -->


    <!-- App css -->
    <link href="assets/css/style.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="assets/js/config.js"></script>

    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">

    <!-- Bootstraps icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- mi css -->
    <link href="assets/css/styles.css" rel="stylesheet" type="text/css">

</head>

<body <?= (!$user) ? 'class="bg-primary d-flex justify-content-center align-items-center min-vh-100 p-5"' : ''; ?>>
    <div class="alert-content"></div>

    <!-- Begin page -->
    <div class="layout-wrapper">