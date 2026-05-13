<?php require_once "includes/config.php"; ?>
<?php $page_title = 'Cart | Code Panda Computers'; ?>
<?php include "includes/header.php"; ?>

    <section class="bg-white pb-5">
        <div class="border-bottom py-4 mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <div>
                            <h3>Shopping Cart</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="bootstrap-iso">
					    <script type="text/javascript">
//<![CDATA[
function noenter() {
return !(window.event && window.event.keyCode == 13); } 
function AddToCart(form)
{
  form.dcaction.value="add"
  form.submit()
}
function AddOut(form)
{
  form.action=""
  form.dcaction.value="addout"
  form.submit()
}
function RemoveFromCart(form)
{
  form.dcaction.value="remove"
  form.submit()
}
function Checkout(form)
{
  form.action=""
  form.dcaction.value="checkout"
  form.submit()
}
//]]>
</script>
<div class="mb-4 border rounded p-3 text-center domainsearch"><form action="#" method="post"><input type="hidden" name="dcaction" value="check" /><input type="hidden" name="domainstatus" value="Register" /><h3>Choose a Domain...</h3><p>Enter the domain name you want to register, transfer or simply purchase hosting for below...</p><div class="form-group mb-3"><input class="input-md form-control" name="domain" id="domain" type="text" value="" placeholder="eg. yourdomain.com" data-error-msg="You must enter a Domain name" required>
</div>
<div class="form-group mb-4">
<div class="input-group-md col-xs-10 col-xs-offset-1">
<input type="submit" onclick="form.domainstatus.value='Register';" value="Register" class="btn btn-primary btn-md">
<input type="submit" onclick="form.domainstatus.value='Transfer';" value="Transfer" class="btn btn-success btn-md">
<input type="submit" onclick="form.domainstatus.value='Hosting';" value="Hosting Only" class="btn btn-md btn-secondary">
</div>
</div>
</form>
<div class="mt-3">
    <?php echo WhatsAppOrderBtn('Cart Order', ''); ?>
</div>
</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script src="assets/js/vendors/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#orderform').attrvalidate();
    $('#expandBtn').click(function() {
        var collapsible = $('#' + $(this).attr('aria-controls'));
        $(collapsible).attr('aria-hidden', ($(collapsible).attr('aria-hidden') === 'false'));
        $(this).attr('aria-expanded', ($(this).attr('aria-expanded') === 'false'));
    });
});
</script>

<?php include "includes/footer.php"; ?>
