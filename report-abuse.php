<?php require_once "includes/config.php"; ?>
<?php $page_title = 'Report Abuse | Code Panda Computers'; ?>
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
                        <h1>Report Abuse</h1>
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
                <div class="col-12 col-lg-6">
                    <p>We do everything possible to keep our network safe and therefore we take abuse complaints seriously.
                        We have zero tolerance for spam or any accounts created/registered for deceptive use.</p>
                    <p>Please keep in mind that our Hosting Service is monitered by our upstream provider who uses the services of Netcraft an Internet Services Company that provides security services. Once we get a report regarding any form of malicious activity, spam, compromised accounts or phishing attacks, we will act within 12hrs.</p>
                    <p>Report any form of abuse activity on our network such as (malware, spam, phishing, etc.) compromised/hacked websites, domains registered for copyright infrigment and deceptive use. Please ensure to provide as much information as you can relating to the incident you are reporting to enable us investigate and act accordingly.</p>

                    <hr>
                    <h4 class="fw-bold">Infringing on Trademark</h4>
                    <p>If youâ€™re worried about trademark infringement, the best course of action is to contact a Uniform Domain-name Dispute Resolution Policy (UDRP) arbitration provider.</p>
                    <p>Want to know more? You can gen-up on the UDRP process on the ICANN website.</p>
                    <a href="https://www.icann.org/resources/pages/dndr-2012-02-25-en#udrp" target="_blank" class="btn btn-outline-primary">Read More</a>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="px-md-4">
                        <div class="border p-3 p-md-4 bg-light" id="contact">
                            <h3>Have you spotted something fishy, send us a message?</h3>
                            <div class="pb-3 message-box d-none">
                                <div class="alert alert-danger"></div>
                            </div>
                            <form id="contactForm" action="https://www.code-panda.online/mailer.php" method="post" class="contact-us-form">
                                <div class="x-status"></div>
                                <div class="x-content">
                                    <div class="mb-3">
                                        <label for="name" class="form-label fw-semibold">Name</label>
                                        <input id="name" type="text" name="name" value="" class="form-control" minlength="6" maxlength="64" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-semibold">Email</label>
                                        <input id="email" type="email" name="email" value="" class="form-control" maxlength="64" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="subject" class="form-label fw-semibold">Subject</label>
                                        <select id="subject" name="subject" class="form-select" required>
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
                                        <label for="domain" class="form-label fw-semibold">IP/Domain</label>
                                        <input id="domain" type="text" name="domain" value="" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="form-label fw-semibold">Message</label>
                                        <textarea id="message" name="message" class="form-control" rows="7" minlength="12" maxlength="500" required></textarea>
                                    </div>
                                    <div id="gRecapture"></div>
                                    <div class="mt-4">
                                        <button id="submitBtn" type="submit" class="d-none btn btn-primary" disabled>Submit Report</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include "includes/footer.php"; ?>
