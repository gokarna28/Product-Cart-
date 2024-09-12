let cart = [];
let total = 0;

//
window.onload = function () {
  loadCart();
  updateCart();
};
// addEventListner pass the function
var allButton = document.getElementsByClassName("AddtoCart_btn");
document.querySelectorAll(".AddtoCart_btn").forEach(function (btn) {
  btn.addEventListener("click", (event) => {
    const add = event.currentTarget;
    const title = add.getAttribute("data-name");
    const price = add.getAttribute("data-price");
    const img = add.getAttribute("data-image");
    const id = add.getAttribute("data-id");

    const ArrayIndex = cart.findIndex((item) => item.id === id);

    if (ArrayIndex > -1) {
      cart[ArrayIndex].quantity += 1;
    } else {
      cart.push({ title, price, img, id, quantity: 1 });
    }

    updateCart();

    //store the cart to localstorage;
    storeCart();
  });
});

function storeCart() {
  localStorage.setItem("cart", JSON.stringify(cart));
}

function loadCart() {
  const storedCart = localStorage.getItem("cart");
  if (storedCart) {
    cart = JSON.parse(storedCart);
  }
}

function updateCart() {
  const CartItems = document.getElementById("cart_items");
  const Total = document.getElementById("total");

  CartItems.innerHTML = "";

  total = 0;

  cart.forEach((item) => {
    const cartProduct = document.createElement("div");
    cartProduct.innerHTML = `
        <div class='flex items-center'>
          <span class="mt-4 w-16 h-16 items-stretch flex justify-center"><img src="${item.img}" class="w-full h-auto object-cover"/></span>
          <span class="mr-4">${item.title} (x${item.quantity})</span>
          <span>Rs.${item.price * item.quantity}</span>
        </div>
        `;
    CartItems.appendChild(cartProduct);

    total += item.price * item.quantity;
  });

  Total.textContent = total.toFixed(2);
}

//clear cart
function clearCart() {
  localStorage.clear();
  document.getElementById("cart_items").textContent = "";
  document.getElementById("total").textContent = 0;

  cart = [];
}
