<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <!-- <link rel="stylesheet" crossorigin href="{{asset('chef/assets/css/app.css')}}"> -->

</head>

<body>

    <div class="container">

        <div class="form">
            <div class="contact-info">
                <h3 class="title">FoodBazalt</h3>
                <p class="text">
                    Манайхаар үйлчлүүлж байгаа таньд маш их баярлалаа.
                </p>
                <u class="hello">
                </u>

                <div class="card">
                    <div class="cart-container">
                        <h3 class="title">Миний сагс</h3>
                        <div id="cartItems"></div>
                        <div class="total" id="totalAmount">Нийт: 0₮</div>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <span class="circle one"></span>
                <span class="circle two"></span>
                <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-container textarea">
                        <textarea name="notes" rows="8" cols="80" required class="input" placeholder="Харшилтай эсэх"></textarea>
                    </div>

                    <!-- Hidden Inputs -->
                    <input type="hidden" name="cart_items" id="cartItemsInput">
                    <input type="hidden" name="table_id" id="tableIdInput">

                    <button type="submit" class="btn">
                        Захиалах
                    </button>
                </form>
            </div>
        </div>
    </div>



    <script>
        // LocalStorage-аас cart болон tableId-г унших
        const cartItems = JSON.parse(localStorage.getItem("cart")) || [];
        const tableId = localStorage.getItem("tableId");
        const restaurantId = localStorage.getItem("restaurantId");

        // Cart-ийг харагдуулах функц
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
            });

            // Total үнийн дүнг шинэчлэх
            document.getElementById("totalAmount").textContent = `Total: ${total.toFixed(2)}₮`;

            // Cart-ийг form руу дамжуулах
            document.getElementById("cartItemsInput").value = JSON.stringify(cartItems);
        }

        // Table ID-г form руу дамжуулах
        if (tableId) {
            document.getElementById("tableIdInput").value = tableId;
        } else {
            console.warn("No table ID found in localStorage!");
        }

        // Cart-ийг эхлэх үед харагдуулна
        displayCartItems();


        const inputs = document.querySelectorAll(".input");

        function focusFunc() {
            let parent = this.parentNode;
            parent.classList.add("focus");
        }

        function blurFunc() {
            let parent = this.parentNode;
            if (this.value == "") {
                parent.classList.remove("focus");
            }
        }

        inputs.forEach((input) => {
            input.addEventListener("focus", focusFunc);
            input.addEventListener("blur", blurFunc);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @section('alert')
    @if (Session::has('success'))
    <script>
        Swal.fire({
            title: " Амжилттай!",
            text: "Захиалга амжилттай үүслээ.",
            icon: "success"
        });
    </script>
    @endif
</body>

</html>