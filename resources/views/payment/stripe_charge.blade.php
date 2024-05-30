<!DOCTYPE html>
<html lang="en">
<head>
    <title>Stripe Checkout</title>
</head>
<body>
    <script src="https://js.stripe.com/v3"></script>
    <script type="text/javascript">
    var session_id = '{{$session_id}}'; // Dấu chấm phẩy thay vì dấu phẩy
    var stripe = Stripe('{{$setPublicKey}}'); // Thêm dấu chấm phẩy

    stripe.redirectToCheckout({
        sessionId: session_id
    }).then(function(result) {
        // Xử lý lỗi hoặc kết quả tại đây
        if (result.error) {
            console.error(result.error.message);
        }
    });
    </script>
</body>
</html>
