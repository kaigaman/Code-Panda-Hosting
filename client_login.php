<?php require_once "includes/config.php"; ?>
<?php $page_title = 'Client Login | Code Panda Computers'; ?>
<?php include "includes/header.php"; ?>

<!--offcanvus area end-->

    <section class="signup-area ptb-100 position-relative zindex-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="signup-form border shadow-sm bg-white">
                            <div class="form-header text-center">
                                <h3 class="mt-3">Create Your Account</h3>
                            </div>
                            <div class="signup-form-wrapper mt-40">
                                <form method="post" action="/login" class="login-form" role="form">
                                    <input type="hidden" name="token" value="">
                                    <div class="inpput-group-item">
                                        <label for="email">Email Address</label>
                                        <div class="input-field">
                                            <span><i class="fa-solid fa-envelope"></i></span>
                                            <input type="email"  name="username" placeholder="name@address.com" id="email">
                                        </div>
                                    </div>

                                    <div class="inpput-group-item">
                                        <label for="password">Password</label>
                                        <div class="input-field">
                                            <span><i class="fa-solid fa-lock"></i></span>
                                            <input type="password" name="password" placeholder="Enter your password" id="password">
                                        </div>
                                    </div>
                                    <div class="checkbox-wraper d-flex align-items-center">
                                        <input type="checkbox" id="checkbox">
                                        <label for="checkbox" class="ms-2">Remember Me</label>
                                    </div>
                                    <input type="submit" class="submit-btn" value="Login">
                                </form>
                                <div class="signup-form-spacer overflow-hidden text-center mt-30">
                                    <h6 class="position-relative d-inline-block">Or Sign Up With</h6>
                                </div>
                                <div class="api-signup-btns d-flex align-items-center justify-content-center mt-3 flex-wrap">
                                    <a href="#" class="btn btn-facebook"><i class="fab fa-facebook-f"></i>Facebook</a>
                                    <a href="#" class="btn btn-linkedin"><i class="fab fa-linkedin"></i>Google</a>
                                    <a href="#" class="btn btn-twitter"><i class="fab fa-twitter"></i>Twitter</a>
                                </div>
                                <div class="page-redirect text-center mt-30">
                                    <p>Don't have an account? <a href="signup.html">Signup</a></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php include "includes/footer.php"; ?>
