<?php require_once "includes/config.php"; ?>
<?php $page_title = 'Law Enforcement | Code Panda Computers'; ?>
<?php include "includes/header.php"; ?>

<!--hero section start-->

    <section class="sh-hero-section position-relative zindex-1 overflow-hidden page-header style-2">

        <div class="position-absolute h-100 w-100 top-0 bg-overlay"></div>

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-6 order-2 order-lg-1 ptb-50 text-primary-dark position-relative" >

                    <div class="sh-hero-left mt-5 mt-lg-0">

                        <h4></h4>

                        <h1>Law Enforcement</h1>

                        <p class="lead text-primary-dark"></p>

                    </div>

                </div>

                <div class="col-lg-6 order-2 order-lg-1"></div>

            </div>

        </div>

    </section>



    <section class="ptb-60 bg-white">

        <div class="container">

            <div class="row">

                <div class="col-12 col-lg-7">

                    <div>

                        <p>Law enforcement according to ICANN 2013 agreement</p>

                        <p>Law enforcement, consumer protection, quasi-governmental or other similar authorities can send reports of Illegal Activity to the dedicated point of contact below:</p>



                        <p>Well-founded reports of Illegal Activity concerning generic domain names will be reviewed within 24 hours to take necessary and appropriate action in response to the report. In responding to any such reports, we will not be required to take any action in contravention of an applicable law.</p>



                        <p>As a Service Provider, we are committed to contribute to the maintenance of a safe, secure online environment and to limiting the potential for significant harm to internet users. We also recognize that there are many online security organizations and other security organisations that are committed to preserving the integrity of the Internet, we are prepared to co-operate with these organizations.</p>



                        <p>A key component of this commitment is to investigate and respond appropriately to all substantiated reports of malicious, illegal or fraudulent use of our services.</p>



                        <p>Any other party can submit abuse reports through our regular complaint procedure.</p>

                    </div>

                </div>

                <div class="col-12 col-lg-5">

                    <div class="px-md-4">

                        <div class="" id="contact">

                            <div class="bg-primary-gradient p-3 text-center" style="border-radius:0.5rem 0.5rem 0 0;">

                                <h6 class="mb-0 text-white">Report Abuse</h6>

                            </div>

                            <div class="border p-4 bg-light">

                                <div class="pb-3 message-box d-none">

                                    <div class="alert alert-danger"></div>

                                </div>

                                <form id="contact.htmlForm" action="https://www.code-panda.online/mailer.php" method="post" class="contact.html-us-form">

                                    <div class="x-status"></div>

                                    <div class="x-content">

                                        <div class="mb-3">

                                            <label for="name" class="mb-0 form-label fw-semibold">Name</label>

                                            <input id="name" type="text" name="name" value="" class="form-control form-control-sm" minlength="6" maxlength="64" required>

                                        </div>

                                        <div class="mb-3">

                                            <label for="email" class="mb-0 form-label fw-semibold">Email</label>

                                            <input id="email" type="email" name="email" value="" class="form-control form-control-sm" maxlength="64" required>

                                        </div>

                                        <div class="mb-3">

                                            <label for="subject" class="mb-0 form-label fw-semibold">Subject</label>

                                            <select id="subject" name="subject" class="form-select form-select-sm" required>

                                                <optgroup label="Subject">

                                                    <option value="trademark" selected="">Infringing on Trademark</option>

                                                    <option value="copyright">Infringing on Copyright</option>

                                                    <option value="invalid">Invalid Contact Details on WHOIS</option>

                                                    <option value="malware">Malware/Phishing</option>

                                                    <option value="spam">Sending Unsolicited Email (SPAM)</option>

                                                    <option value="other">Other</option>

                                                </optgroup>

                                            </select>

                                        </div>

                                        <div class="mb-3">

                                            <label for="domain" class="mb-0 form-label fw-semibold">IP/Domain</label>

                                            <input id="domain" type="text" name="domain" value="" class="form-control form-control-sm" required>

                                        </div>

                                        <div class="mb-3">

                                            <label for="message" class="mb-0 form-label fw-semibold">Message</label>

                                            <textarea id="message" name="message" class="form-control form-control-sm" rows="5" minlength="12" maxlength="500" required></textarea>

                                        </div>

                                        <div id="gRecapture"></div>

                                        <div class="mt-4">

                                            <button id="submitBtn" type="submit" class="d-none btn btn-primary w-100" disabled>Submit Report</button>

                                        </div>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

<?php include "includes/footer.php"; ?>
