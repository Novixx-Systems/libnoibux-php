<?php
// NOiBux PHP library

/**
  * Redirect to NOiBux to pay
  *
  * @param string $account Account to pay to
  * @param string $product Product name
  * @param float $price Price
  * @param string $return_url Return URL
  */
function Pay($account, $product, $price, $return_url, $custom = '')
{
    echo '<form action="https://noibux.novixx.com/purc.php" method="post" id="redirect_form">
        <input type="hidden" name="receiver" value="' . $account . '">
        <input type="hidden" name="amount" value="' . $price . '">
        <input type="hidden" name="return_url" value="' . $return_url . '">
        <input type="hidden" name="product_name" value="' . $product . '">
        <input type="hidden" name="custom" value="' . $custom . '">
    </form>
    <script>
        document.getElementById("redirect_form").submit();
    </script>';
}

/**
 * Verify a transaction
 *
 * @param int $tid Transaction ID
 */
function VerifyTransaction($tid, $receiver, $amount)
{
    $url = 'https://noibux.novixx.com/purc.php';
    $data = array('verify' => 1, 'id' => $tid, 'receiver' => $receiver, 'amount' => $amount);
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return $result == 'success';
}
?>
