
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-md-5">
                <div class="card">
                    <div class="card-body p-4">

                        <div class="text-center w-75 mx-auto auth-logo mb-4">
                            <a class="logo-dark" href="/dashtrap/">
                                <span><img src="assets/images/logo-dark.png" alt="" height="22"></span>
                            </a>

                            <a class="logo-light" href="/dashtrap/">
                                <span><img src="assets/images/logo-light.png" alt="" height="22"></span>
                            </a>
                        </div>

                        <form method="post">

                            <div class="form-group mb-3">
                                <label class="form-label" for="username">Username</label>
                                <input class="form-control" type="text" name="usuario" id="username" required="" placeholder="Enter your username">
                            </div>

                            <div class="form-group mb-3">
                                <!-- <a class="text-muted float-end" href="/dashtrap/pages-recoverpw"><small></small></a> -->
                                <label class="form-label" for="password">Password</label>
                                <input class="form-control" type="password" required="" name="pasw" id="password" placeholder="Enter your password">
                            </div>

                            <div class="form-group mb-3">
                                <div class="">
                                    <input class="form-check-input" type="checkbox" id="checkbox-signin" checked="">
                                    <label class="form-check-label ms-2" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary w-100" type="submit"> Log In </button>
                            </div>

                        </form>
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-white-50"> <a class="text-white-50 ms-1" href="/admin/recover">Forgot your password?</a></p>
                        <p class="text-white-50">Don't have an account? <a class="text-white font-weight-medium ms-1" href="/admin/register">Sign Up</a></p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
