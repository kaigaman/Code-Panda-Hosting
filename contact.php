<?php require_once "includes/config.php"; ?>
<?php $page_title = '24/7 Support For Our Valued Clients | Code Panda Computers'; ?>
<?php include "includes/header.php"; ?>

<!--offcanvus area end-->

    <!--hero section start-->
    <section class="sh-hero-section position-relative zindex-1 overflow-hidden page-header style-2">
        <div class="position-absolute h-100 w-100 top-0 bg-overlay"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-2 order-lg-1 ptb-50 text-primary-dark position-relative" >
                    <div class="sh-hero-left mt-5 mt-lg-0">
                        <h4></h4>
                        <h1 class="mb-3">Contact us</h1>
                        <p class="lead">Thank you for your interest in contacting Code Panda Computers, we shall endeavor to get back to you within the shortest time possible</p>
                        <a href="contact.html" class="template-btn primary-btn rounded-pill"><i class="fa fa-comment-sms"></i> Live Chat</a>
                    </div>
                </div>
                <div class="col-lg-6 order-2 order-lg-1"></div>
            </div>
        </div>
    </section>
    <!--hero section end-->

    <!--contact form -->
    <section class="hm-contact-area position-relative pt-60 pb-5 overflow-hidden bg-light zindex-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="py-5">
                        <div class="ct-section-title mb-4">
                            <h6 class="text-primary-light">Send us a message.</h6>
                            <h5>We're Ready To Help</h5>
                        </div>
                        <div class="hm-ct-info-wrapper">
                            <div class="position-relative ps-4">
                                 <span class="icon-wrapper rounded-circle position-absolute start-0">
                                      <i class="fa-solid fa-phone"></i>
                                 </span>
                                <h6 class="ms-2">Telephone</h6>
                            </div>
                            <div class="info-content">
                                <span>+256 701666661 <br> +256 752666661<br>+256 776166668</span>
                            </div>
                        </div>
                        <div class="hm-ct-info-wrapper">
                            <div class="position-relative ps-4">
                                 <span class="icon-wrapper rounded-circle position-absolute start-0">
                                     <i class="fa-solid fa-envelope"></i>
                                 </span>
                                <h6 class="ms-2">Email Us</h6>
                            </div>
                            <div class="info-content">
                                <span>support@code-panda.online<br>support@code-panda.online</span>
                            </div>
                        </div>
                        <div class="hm-ct-info-wrapper">
                            <div class="position-relative ps-4">
                               <span class="icon-wrapper rounded-circle position-absolute start-0">
                                   <i class="fa-solid fa-house"></i>
                               </span>
                                <h6 class="ms-2">Address</h6>
                            </div>
                            <div class="info-content">
                                <span>Muyenga Tank Hill Road<br>
                                     <br>
                                    </span>
                            </div>
                        </div>
                        <div class="hm-ct-info-wrapper">
                            <div class="position-relative ps-4 mb-3">
                               <span class="icon-wrapper rounded-circle position-absolute start-0">
                                   <i class="fa-solid fa-thumbs-up"></i>
                               </span>
                                <h6 class="ms-2">Follow us</h6>
                            </div>
                            <div class="social-icons">
                                <a class="icon facebook" target="_blank" href="https://www.#">
                                    <i class="fa-brands fa-facebook"></i> Facebook
                                </a>
                                <a class="icon twitter" target="_blank" href="https://www.#">
                                    <i class="fa-brands fa-twitter"></i> Twitter
                                </a>
                                <a class="icon linkedin" target="_blank" href="http://www.#">
                                    <i class="fa-brands fa-linkedin"></i> Linkedin
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="p-3 p-md-5 bg-white">
                        <div class="hm-contact-form pt-3 border-top border-3 border-primary" id="contact">
                            <div class="pb-3 message-box d-none">
                                <div class="alert alert-danger"></div>
                            </div>
                            <form action="https://www.code-panda.online/mailer.php" method="POST" id="contactForm" class="contact-us-form">
                                <div class="row g-4 mb-3">
                                    <div class="col-md-6">
                                        <div class="form-label">
                                            <label for="name" class="form-label fw-bold">Firstname</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="First name*" required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label">
                                            <label for="lastname" class="form-label fw-bold">Lastname</label>
                                            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last name*" required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <label for="email" class="form-label fw-bold">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email address*" required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field">
                                            <label for="phone" class="form-label fw-bold">Phone</label>
                                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone number*" required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-field">
                                            <label for="message" class="form-label fw-bold">Message</label>
                                            <textarea class="form-control" placeholder="Message" rows="5" name="message" id="message"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div id="gRecapture"></div>
                                <div class="submit-btn mt-4">
                                    <button id="submitBtn" type="submit" class="d-none template-btn primary-btn border-0" disabled>Send Message<i class="fa-solid fa-chevron-right ms-2"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include "includes/footer.php"; ?>
