function handleAddToCart(event, id) {
  event.preventDefault();

  const parent = document.querySelector(`[data-id="${id}"]`);
  let title = parent.querySelector('#item-title').innerText;
  let image = parent.querySelector('#item-image').getAttribute('src');
  let quantity = parseInt(parent.querySelector('#item-quantity').value);
  let price = parent.querySelector('#item-price').innerText;

  const item = { id, title, image, quantity, price };

  if (localStorage.getItem('cart')) {
    let data = JSON.parse(localStorage.getItem('cart'));

    const itemToUpdate = data.find((item) => item.id === id);

    if (itemToUpdate) {
      itemToUpdate.quantity += quantity;
    } else {
      data.push(item);
    }
    localStorage.setItem('cart', JSON.stringify(data));
  } else {
    localStorage.setItem('cart', JSON.stringify([item]));
  }

  updateCart();
}

function updateCart() {
  if (!localStorage.getItem('cart')) {
    return;
  }

  const data = JSON.parse(localStorage.getItem('cart'));

  const parent = document.querySelector('.cart-items');

  data.map((item) => {
    parent.insertAdjacentHTML(
      'afterbegin',
      `<div data-id="${item.id}">
              <img style="width:100px" id="cart-item-image" src="${item.image}" alt="${item.title}">
              <div>
                  <h3 id="cart-item-title">${item.title}</h3>
                  <p id="cart-item-price">${item.price}</p>
                  <span>${item.quantity}</span>
                  <input type="submit" value="Remove from cart" onclick="handleRemoveFromCart(event, ${item.id});">
              </div>
            </div>`
    );
  });
}

updateCart();

function handleRemoveFromCart(event, id) {
  event.preventDefault();

  if (localStorage.getItem('cart')) {
    let data = JSON.parse(localStorage.getItem('cart'));

    const itemToUpdate = data.find((item) => item.id === id);

    if (itemToUpdate) {
      if (itemToUpdate.quantity === 1) {
        const parent = document.querySelector(`[data-id="${id}"]`);
        parent.remove();

        data = data.filter((item) => item.id !== id);
      } else {
        itemToUpdate.quantity -= 1;

        const parent = document.querySelector(`[data-id="${id}"]`);
        let quantity = parent.querySelector('span').innerText;
        parent.querySelector('span').innerText = quantity - 1;
      }
    } else {
      data.push(item);
    }

    localStorage.setItem('cart', JSON.stringify(data));
  } else {
    localStorage.setItem('cart', JSON.stringify([item]));
  }
}

function handlePlaceOrder() {
  let data = JSON.parse(localStorage.getItem('cart'));
  const req = { data: data };

  fetch('place-order.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json; charset=utf-8',
    },
    body: JSON.stringify(req),
  }).then(function (res) {
    if (res.text() === 'Success') {
      console.log('Success');
    } else {
      console.log('Error occured');
    }
  });
}
