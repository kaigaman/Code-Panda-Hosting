<?php
function WhatsAppOrderBtn($product_name, $price = "", $whmcs_url = "") {
    global $site_whatsapp;
    $message = "Hi Code Panda Computers, I'm interested in the " . $product_name;
    if ($price) {
        $message .= " at " . $price;
    }
    $message .= ". Please provide more information.";
    $wa_url = "https://wa.me/" . $site_whatsapp . "?text=" . urlencode($message);
    return ' <a href="' . $wa_url . '" class="whatsapp-order-btn" target="_blank" rel="noopener">Order via WhatsApp</a>';
}
