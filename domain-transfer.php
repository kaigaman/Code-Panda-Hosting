<?php require_once "includes/config.php"; ?>
<?php $page_title = 'Domain Transfer | Code Panda Computers'; ?>
<?php include "includes/header.php"; ?>

<!--hero section start-->
    <section class="sh-hero-section position-relative zindex-1 overflow-hidden page-header style-2">
        <div class="position-absolute h-100 w-100 top-0 bg-overlay"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-2 order-lg-1 ptb-50 text-primary-dark position-relative" >
                    <div class="sh-hero-left mt-5 mt-lg-0">
                        <h4 class="text-primary-dark"></h4>
                        <h2 class="text-primary-dark">Domain Transfer</h2>
                        <p class="lead mt-4 mb-3">We can help you move your domain with little to no downtime.</p>
                        <form id="domainChecker" action="#" class="mb-3 dm-hero-domain-form d-flex align-items-center border border-primary rounded-pill">
                            <input type="hidden" name="action" value="transfer">
                            <label for="domainTransferSearchInput" class="d-none"></label>
                            <input id="domainTransferSearchInput" type="text" name="domain" value="" minlength="5" maxlength="100" placeholder="Search Domain Name">
                            <input type="submit" value="Transfer" class="template-btn primary-btn border-0 flex-shrink-0">
                        </form>
                        <div id="domainSearchResults"></div>
                        <div class="dm-hero-label mb-3">
                            <span class="me-4">.com .net .org at 40,000 Ugx /yr </span> <br>
                            <span>.co.ug .ug .ac.ug .org.ug at 100,000 Ugx /yr</span>
                        </div>
                        <a href="contact.html" class="template-btn primary-btn rounded-pill">Get Started Now</a>
                    </div>
                </div>
                <div class="col-lg-6 order-2 order-lg-1"></div>
            </div>
        </div>
    </section>
    <!--hero section end-->

    <section class="py-3 py-md-4 py-lg-5">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-12 col-lg-7">
                    <div class="text-center">
                        <h3>Transfer your domain in just <br> 4 easy steps</h3>
                        <p>Domain transfer thatâ€™s fast and easy. Experience enhanced support and service during the process.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="">
                        <div class="row g-4 steps justify-content-center">
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="tab text-center">
                                    <h5 class="tab-title">
                                        <span class="step-counter mb-3"><span>1</span></span>
                                        <span class="d-block">Enter the domain name <br> for transfer.</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="tab text-center">
                                    <h5 class="tab-title">
                                        <span class="step-counter mb-3"><span>2</span></span>
                                        <span class="d-block">Proceed with the <br> purchase.</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="tab text-center">
                                    <h5 class="tab-title">
                                        <span class="step-counter mb-3"><span>3</span></span>
                                        <span class="d-block">Enter the EPP or <br> transfer Code.</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="tab text-center">
                                    <h5 class="tab-title">
                                        <span class="step-counter mb-3"><span>4</span></span>
                                        <span class="d-block">Confirm your transfer <br> and payment.</span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   <!--about section start-->
    <section class="dm-about-section pb-5 position-relative zindex-1 overflow-hidden bg-white">
        <div class="container">
            <div class="row mt-5 align-items-center justify-content-between">
                <div class="col-12 text-center">
                    <h3>Before transferring your domain, <br> make sure of the following</h3>
                </div>
                <div class="col-lg-7">
                    <div class="dm-about-content mt-40 mt-lg-0">
                        <p>If you are not satisfied with the service and support of your current domain provider, time for change. We will ensure the process of domain transfer is simple, easy and fast.</p>
                        <ul class="list">
                            <li><i class="fa fa-check"></i> It's been more than 60 days since the domain registration or last transfer.</li>
                            <li><i class="fa fa-check"></i> Domain is not in Pending Delete or Redemption status.</li>
                            <li><i class="fa fa-check"></i> The authorisation code that proves your ownership of the domain.</li>
                            <li><i class="fa fa-check"></i> You can get the EPP code from the current domain provider.</li>
                            <li><i class="fa fa-check"></i> Whois privacy protection is disabled.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="dm-about-img text-center">
                        <img src="assets/img/icons/022-web-domain.png" alt="image" class="img-fluid" style="max-width:70%">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--about section end-->

    <!--faq section start-->
    <section class="dm-faq-section py-5 position-relative zindex-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="section-title text-center">
                        <h4 class="mb-4">Frequently Asked Questions.</h4>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="dm-faq-left">
                        <div class="accordion dm-accordion" id="dm_accordion">
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="#dm_item_one" class="text-primary-dark" data-bs-toggle="collapse">How long does a domain transfer take?</a>
                                </div>
                                <div class="accordion-collapse collapse show" id="dm_item_one" data-bs-parent="#dm_accordion">
                                    <div class="accordion-body">
                                        <p class="mb-0">This depends on how quickly your current domain registrar releases the domain. Given all the factors involved, the fair estimate to complete the transfer process is roughly 5-7 days.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="#dm_item_two" class="text-primary-dark" data-bs-toggle="collapse">How can I transfer my domain name to Code Panda Computers?</a>
                                </div>
                                <div class="accordion-collapse collapse" id="dm_item_two" data-bs-parent="#dm_accordion">
                                    <div class="accordion-body">
                                        <p class="mb-0">First, you have to unlock your domain name and acquire the transfer authorization code. Once your domain is ready to go, you can initiate the transfer process. We'll take care of the rest for you! For more details, you can check our domain transfer guideline.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="#dm_item_three" class="text-primary-dark" data-bs-toggle="collapse">Can I transfer an expired domain to Code Panda Computers?</a>
                                </div>
                                <div class="accordion-collapse collapse" id="dm_item_three" data-bs-parent="#dm_accordion">
                                    <div class="accordion-body">
                                        <p class="mb-0">You can still transfer expired domains! As long as it is in your account you can unlock the domain and grab the auth code to start the transfer process.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include "includes/footer.php"; ?>
