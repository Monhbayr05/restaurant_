<!-- resources/views/checkout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
</head>
<body>
<form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
    @csrf





    <div class="address">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text">
                        Food Bazalt
                    </div>

                    <div class="form-row">
                        <div class="input-data">
                            <input type="text" name="name" required>
                            <div class="underline"></div>
                            <label for="">Нэр</label>
                        </div>
                        <br>
                        <div class="input-data">
                            <input type="number" name="phone" required>
                            <div class="underline"></div>
                            <label for="">Утасны дугаар</label>
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="input-data">
                            <input type="text" name="email" required>
                            <div class="underline"></div>
                            <label for="">И-мэйл хаяг</label>
                        </div>
                        <br>
                    </div>
                    <div class="form-row">
                        <div class="input-data textarea">
                            <textarea name="notes" rows="8" cols="80" required></textarea>
                            <div class="underline"></div>
                            <label for="">Харшилтай эсэх</label>
                        </div>
                    </div>
                    <input type="hidden" name="cart_items" id="cartItemsInput">

                </div>
            </div>
        </div>
    </div>
    <div class="orders">
        <div class="container">
            <div class="row">
                <div class="card">
                    <div class="cart-container">
                        <h2>My Cart</h2>
                        <div id="cartItems"></div>
                        <div class="total" id="totalAmount">Total: 0₮</div>
                    </div>

                    <script>
                        const cartItems = JSON.parse(localStorage.getItem("cart")) || [];
                        console.log(localStorage.getItem("cart"));

                        function displayCartItems() {
                            const cartContainer = document.getElementById("cartItems");
                            cartContainer.innerHTML = "";

                            let total = 0;

                            cartItems.forEach(item => {
                                const itemElement = document.createElement("div");
                                itemElement.className = "cart-item";

                                itemElement.innerHTML = `
                <h4>${item.name}</h4>
                <p>${item.price.toFixed(2)}₮ x ${item.quantity}</p>
            `;

                                total += item.price * item.quantity;

                                cartContainer.appendChild(itemElement);
                                document.getElementById("cartItemsInput").value = JSON.stringify(cartItems);
                            });

                            document.getElementById("totalAmount").textContent = `Total: ${total.toFixed(2)}₮`;
                        }



                        displayCartItems();
                    </script>

                    <button class="btn btn-primary" type="submit">
                        Захиалах
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>
