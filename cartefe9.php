<?php require_once "includes/config.php"; ?>
<?php $page_title = 'Order | Code Panda Computers'; ?>
<?php include "includes/header.php"; ?>

<section class="bg-white pb-5">
    <div class="border-bottom py-4 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>Place Your Order</h3>
                    <p class="text-muted">Select products, then send your order to us on WhatsApp.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <?php include "includes/order-form.php"; ?>
    </div>
</section>

<?php include "includes/footer.php"; ?>
