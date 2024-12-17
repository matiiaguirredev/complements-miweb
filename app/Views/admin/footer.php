           <?php if ($user) : ?>
               <!-- Footer Start -->
               <footer class="footer">
                   <div class="container-fluid">
                       <div class="row">
                           <div class="col-md-6">
                               <div>
                                   <script>
                                       document.write(new Date().getFullYear())
                                   </script> © Shortae & MatiAguirre
                               </div>
                           </div>
                           <div class="col-md-6">
                               <div class="d-none d-md-flex gap-4 align-item-center justify-content-md-end">
                                   <p class="mb-0">Shortae & MatiAguirre <a href="https://www.linkedin.com/in/matiiaguirre/" target="_blank">LinkedIn</a> </p>
                               </div>
                           </div>
                       </div>
                   </div>
               </footer>
               <!-- end Footer -->
           <?php endif; ?>


           </div>

           <!-- ============================================================== -->
           <!-- End Page content -->
           <!-- ============================================================== -->

           </div>
           <!-- END wrapper -->

           <!-- jQuery Min JS -->
           <script src="web/js/jquery.min.js"></script>

           <!-- App js -->
           <script src="assets/js/vendor.min.js"></script>
           <script src="assets/js/app.js"></script>

           <!-- Knob charts js -->
           <script src="assets/libs/jquery-knob/jquery.knob.min.js"></script>

           <!-- Sparkline Js-->
           <script src="assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

           <script src="assets/libs/morris.js/morris.min.js"></script>

           <script src="assets/libs/raphael/raphael.min.js"></script>

           <!-- Dashboard init-->
           <script src="assets/js/pages/dashboard.js"></script>

           <!-- Sweet Alerts js -->
           <script src="assets/libs/sweetalert2/sweetalert2.all.min.js"></script>

           <!-- Sweet alert Demo js-->
           <script src="assets/js/pages/sweet-alerts.js"></script>


           <!-- desde aca agrego ahora desde el forms/advance a ver q sale. -->
           <!-- Plugins Js -->
           <script src="assets/libs/selectize/js/standalone/selectize.min.js"></script>
           <script src="assets/libs/mohithg-switchery/switchery.min.js"></script>
           <script src="assets/libs/multiselect/js/jquery.multi-select.js"></script>
           <script src="assets/libs/jquery.quicksearch/jquery.quicksearch.min.js"></script>
           <script src="assets/libs/select2/js/select2.min.js"></script>
           <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
           <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

           <!-- third party js -->
           <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
           <script src="assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
           <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
           <script src="assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
           <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
           <script src="assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
           <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
           <script src="assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
           <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
           <script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
           <script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
           <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
           <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
           <!-- third party js ends -->

           <!-- Datatables js -->
           <script src="assets/js/pages/datatables.js"></script>

           <!-- Demo js -->
           <script src="assets/js/pages/form-advanced.js"></script>
           <!-- HASTA! aca agrego ahora desde el forms/advance a ver q sale. -->

           <!-- forms file up -->
           <!-- Plugins js -->
           <script src="assets/libs/dropzone/min/dropzone.min.js"></script>
           <!-- Demo js-->
           <script src="assets/js/pages/form-fileuploads.js"></script>
           <!-- HASTA! aca agrego ahora desde el form file up a ver q sale. -->

           <!-- Ion Range Slider-->
           <script src="assets/libs/ion-rangeslider/js/ion.rangeSlider.min.js"></script>

           <!-- forms quill -->
           <!-- Plugins js -->
           <!-- <script src="assets/libs/quill/quill.min.js"></script> -->

           <!-- Demo js-->
           <!-- <script src="assets/js/pages/form-quilljs.js"></script> -->
           <!-- HASTA! aca form quill. -->

           <!-- Form Tiny -->

           <!-- HASTA ACA Form Tiny -->

           <script src="assets/js/pages/range-sliders.js"></script>
           <script src="assets/js/main.js?v=<?= time() ?>"></script> <!-- el time para que se actualice el archivo y la cache -->

           <?php if (isset($error)) :  ?>
               <script>
                   let $error = `<?= $error; ?>`;
                   showAlert("danger", $error);
               </script>
           <?php endif; ?>

           <?php if (isset($success)) :  ?>
               <script>
                   let $success = `<?= $success; ?>`;
                   showAlert("success", $success);
               </script>
           <?php endif; ?>


           <?php if (session()->getFlashdata('error') !== null) : ?>
               <script>
                   let $error = '<?= session()->getFlashdata('error') ?>';
                   showAlert("danger", $error);
               </script>
           <?php endif; ?>


           </body>

           </html>