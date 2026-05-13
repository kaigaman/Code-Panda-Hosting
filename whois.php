<?php require_once "includes/config.php"; ?>
<?php $page_title = 'Whois | Code Panda Computers'; ?>

<?php
$whois_result = '';
$searched_domain = '';

if (isset($_GET['q']) && !empty(trim($_GET['q']))) {
    $searched_domain = trim($_GET['q']);
    $domain = strtolower($searched_domain);
    $domain = preg_replace('/^https?:\/\//', '', $domain);
    $domain = preg_replace('/^www\./', '', $domain);
    $domain = preg_replace('/\s/', '', $domain);

    if (preg_match('/^[a-z0-9]([a-z0-9\-]*[a-z0-9])?(\.[a-z]{2,})+$/', $domain)) {
        $whois_result = '<div class="alert alert-success">WHOIS data for <strong>' . htmlspecialchars($domain) . '</strong>:</div>';
        $whois_result .= '<div class="whois-data p-3 bg-light rounded"><pre style="white-space:pre-wrap;font-size:13px;max-height:400px;overflow-y:auto;">';

        $whois_output = @shell_exec('whois ' . escapeshellarg($domain) . ' 2>&1');
        if ($whois_output && strlen(trim($whois_output)) > 10) {
            $whois_result .= htmlspecialchars($whois_output);
        } else {
            $whois_result .= "Domain: " . htmlspecialchars($domain) . "\n";
            $whois_result .= "Status: " . (checkdnsrr($domain, 'ANY') ? "Registered" : "Available") . "\n";
            $whois_result .= "Note: Full WHOIS lookup requires the 'whois' command to be installed on the server.\n";
            $whois_result .= "For detailed WHOIS data, please use our contact form for assistance.\n";
        }

        $whois_result .= '</pre></div>';
        $whois_result .= '<div class="mt-3"><a href="https://core.code-panda.online/cart.php?a=add&domain=register&query=' . urlencode($domain) . '" class="btn btn-primary">Register This Domain</a></div>';
    } else {
        $whois_result = '<div class="alert alert-danger mt-3">Invalid domain format. Please enter a valid domain (e.g., example.com).</div>';
    }
}
?>

<?php include "includes/header.php"; ?>

<section class="sh-hero-section position-relative zindex-1 overflow-hidden page-header style-2">

        <div class="position-absolute h-100 w-100 top-0 bg-overlay"></div>

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-6 order-2 order-lg-1 ptb-50 position-relative" >

                    <div class="sh-hero-left mt-5 mt-lg-0">

                        <h4 class="text-primary-dark"></h4>

                        <h1>Whois</h1>

                        <p class="lead mt-4"></p>

                        <a href="contact.html" class="template-btn primary-btn rounded-pill">Get Started</a>

                    </div>

                </div>

                <div class="col-lg-6 order-2 order-lg-1"></div>

            </div>

        </div>

    </section>



    <!--hero section start-->

    <section class="dm-hero-section position-relative ptb-50 zindex-1 overflow-hidden">

        <img src="assets/img/shapes/sh-hero-bg.png" alt="shape" class="position-absolute left-bottom">

        <span class="dm-hero-circle position-absolute"></span>

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-7 order-2 order-lg-1">

                    <div class="dm-hero-left mt-5 mt-lg-0">

                        <h1>WHOIS Lookup</h1>

                        <p class="lead mt-4 mb-40">See data for a particular domain with our WHOIS Lookup tool. <br> <span class="text-warning">- always up-to date.</span></p>

                    </div>

                </div>

                <div class="col-lg-5 order-1 order-lg-2">

                    <div class="sh-hero-right text-end">

                        <img src="assets/img/domain/dm-hero.png" alt="image" style="max-width:300px">

                    </div>

                </div>

            </div>

        </div>

    </section>



    <section class="ptb-50 bg-white">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-12 col-lg-10">

                    <div class=" text-center">

                        <h2 class="text-primary">WHOIS Lookup</h2>

                        <p>See data for a particular domain with our WHOIS Lookup tool</p>

                        <div class="mb-5">

                            <form action="whois.php" method="GET">

                                <div class="mb-3">

                                    <div class="input-group">

                                        <input type="text" name="q" value="<?php echo htmlspecialchars($searched_domain); ?>" class="form-control" placeholder="enter your domain">

                                        <button class="btn btn-secondary">Search</button>

                                    </div>

                                </div>

                            </form>

                            <?php if ($whois_result): ?>
                            <div class="mt-4 text-start">
                                <?php echo $whois_result; ?>
                            </div>
                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            </div>

            <div class="row text-center">

                <div class="col-12">

                    <p>Registrant Data, Registrar Data and Contact Data</p>

                </div>

            </div>

        </div>

    </section>



    <section class="py-5 text-center">

        <div class="container">

            <div class="row">

                <div class="col-12">

                    <h2 class="text-primary">WHOIS Lookup In 4 Steps:</h2>

                    <p>Here are some tips on how to search for domain details</p>

                </div>

            </div>

            <div class="row text-center">

                <div class="col-12 col-md-6 col-lg-3">

                    <div class="p-3 p-md-4">

                        <h5 class=" text-primary">Go To The Tool Address.</h5>

                        <p>Go to the WHOIS Lookup tool address to proceed with your request.</p>

                    </div>

                </div>

                <div class="col-12 col-md-6 col-lg-3">

                    <div class="p-3 p-md-4">

                        <h5 class=" text-primary">Enter Your Domain.</h5>

                        <p>Enter the desired domain in the tool field and click WHOIS.</p>

                    </div>

                </div>

                <div class="col-12 col-md-6 col-lg-3">

                    <div class="p-3 p-md-4">

                        <h5 class=" text-primary">Wait For The Loading.</h5>

                        <p>Once clicked on WHOIS. Wait for the tool to load for WHOIS data display.</p>

                    </div>

                </div>

                <div class="col-12 col-md-6 col-lg-3">

                    <div class="p-3 p-md-4">

                        <h5 class=" text-primary">Data Has Been Received.</h5>

                        <p>Once the loading is complete. WHOIS Data will be displayed.</p>

                    </div>

                </div>

            </div>

        </div>

    </section>

<?php include "includes/footer.php"; ?>
