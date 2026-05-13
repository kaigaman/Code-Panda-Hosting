<?php require_once "includes/config.php"; ?>
<?php
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $password   = $_POST['password'] ?? '';
    $confirm    = $_POST['confirm_password'] ?? '';

    if (!$first_name || !$email || !$password) {
        $error = 'Please fill in all required fields.';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters.';
    } else {
        $payload = json_encode([
            'first_name' => $first_name,
            'email'      => $email,
            'password'   => $password,
        ]);

        $ch = curl_init('https://core.code-panda.online/api/guest/client/create');
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 15,
        ]);
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code === 200 || $http_code === 201) {
            $success = 'Account created successfully! You can now log in.';
        } else {
            $data = json_decode($response, true);
            $error = $data['error']['message'] ?? 'Registration failed. Please try again.';
        }
    }
}
?>
<?php $page_title = 'Sign Up | Code Panda Computers'; ?>
<?php include "includes/header.php"; ?>

<section class="bg-white pb-5">
    <div class="border-bottom py-4 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>Create Your Account</h3>
                    <p class="text-muted">Register to manage your hosting, domains, and billing in one place.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="p-4 p-md-5 bg-white border rounded-3 shadow-sm">

                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>

                    <?php if ($success): ?>
                        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                        <div class="text-center mt-3">
                            <a href="https://core.code-panda.online/login" class="template-btn primary-btn btn-lg rounded-pill">Log In Now <i class="fa fa-arrow-right"></i></a>
                        </div>
                    <?php else: ?>
                        <form method="post" action="">
                            <div class="row g-4 mb-3">
                                <div class="col-12">
                                    <div class="input-field">
                                        <label for="first_name" class="form-label fw-bold">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Your full name" required value="<?php echo htmlspecialchars($_POST['first_name'] ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-field">
                                        <label for="email" class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-field">
                                        <label for="password" class="form-label fw-bold">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Min. 6 characters" required minlength="6">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-field">
                                        <label for="confirm_password" class="form-label fw-bold">Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Repeat password" required minlength="6">
                                    </div>
                                </div>
                            </div>
                            <div class="submit-btn mt-4 text-center">
                                <button type="submit" class="template-btn primary-btn border-0 btn-lg rounded-pill">Create Account <i class="fa fa-arrow-right"></i></button>
                            </div>
                            <div class="mt-3 text-center">
                                <p class="mb-0">Already have an account? <a href="https://core.code-panda.online/login" class="fw-bold">Log in</a></p>
                            </div>
                        </form>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</section>

<?php include "includes/footer.php"; ?>
