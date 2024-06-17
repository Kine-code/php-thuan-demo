<!-- <php 
$total_cart_items = isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : getCartItemCount();
if (!isset($_SESSION['cart_count'])) {
	$_SESSION['cart_count'] = getCartItemCount();
 }
 
 $total_cart_items = $_SESSION['cart_count'];
 function getCartItemCount() {
    return isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
}
$_SESSION['cart_count'] = getCartItemCount(); -->