document.addEventListener('DOMContentLoaded', () => {
    const cart = [];
    
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    const cartItemsInput = document.getElementById('cart-items-input');
    const cartTotalInput = document.getElementById('cart-total-input');
    const clearCartButton = document.getElementById('clear-cart');
    const printCartButton = document.getElementById('print-cart');
    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            const name = button.getAttribute('data-name');
            const price = parseFloat(button.getAttribute('data-price'));
            addItemToCart(name, price);
        });
    });

    function addItemToCart(name, price) {
        const existingItem = cart.find(item => item.name === name);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            cart.push({ name, price, quantity: 1 });
        }
        updateCart();
    }

    function updateCart() {
        cartItems.innerHTML = '';
        let total = 0;
        const cartData = cart.map(item => `${item.name} - Rp${item.price} x ${item.quantity}`).join(', ');

        cart.forEach(item => {
            const li = document.createElement('li');
            li.textContent = `${item.name} - Rp${item.price} x ${item.quantity}`;
            cartItems.appendChild(li);
            total += item.price * item.quantity;
        });

        cartTotal.textContent = total.toFixed(2);
        cartItemsInput.value = cartData; 
        cartTotalInput.value = total.toFixed(2); 
    }

    clearCartButton.addEventListener('click', () => {
        cart.length = 0;
        updateCart();
    });
});

    
    const { jsPDF } = window.jspdf;
    
    let cart = [];
    
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    const clearCartButton = document.getElementById('clear-cart');
    const printCartButton = document.getElementById('print-cart');
    
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            const name = button.getAttribute('data-name');
            const price = parseFloat(button.getAttribute('data-price'));
            addItemToCart(name, price);
        });
    });

    function addItemToCart(name, price) {
        const existingItem = cart.find(item => item.name === name);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            const newItem = { name, price, quantity: 1 };
            cart.push(newItem);
        }
        updateCart();
    }

    function updateCart() {
        cartItems.innerHTML = '';
        let total = 0;

        cart.forEach(item => {
            const li = document.createElement('li');
            li.textContent = `${item.name} - Rp${item.price} x ${item.quantity}`;
            cartItems.appendChild(li);
            total += item.price * item.quantity;
        });

        cartTotal.textContent = total.toFixed(2);
    }

    clearCartButton.addEventListener('click', () => {
        cart = [];
        updateCart();
    });

    printCartButton.addEventListener('click', () => {
        const doc = new jsPDF();

        doc.setFontSize(18);
        doc.text("Toko Alat Kesehatan", doc.internal.pageSize.width / 2, 15, { align: 'center' });
        doc.setFontSize(14);
        doc.text("Laporan Belanja Anda", doc.internal.pageSize.width / 2, 25, { align: 'center' });
    
        const userId = document.getElementById('user-id').value;
        const userName = document.getElementById('user-name').value;
        const userAddress = document.getElementById('user-address').value;
        const userPhone = document.getElementById('user-phone').value;
        const userDate = document.getElementById('user-date').value;
        const userPayPal = document.getElementById('user-paypal').value;
        const userBank = document.getElementById('user-bank').value;
        const userPayment = document.getElementById('user-payment').value;
    
        doc.autoTable({
            startY: 40, 
            head: [['Atribut', 'Identitas']],
            body: [
                ['User ID', userId],
                ['Nama', userName],
                ['Alamat', userAddress],
                ['No HP', userPhone],
                ['Tanggal', userDate],
                ['ID PayPal', userPayPal],
                ['Nama Bank', userBank],
                ['Cara Bayar', userPayment],
            ]
        });

        const cartData = cart.map((item, index) => [
            index + 1, item.name, item.price, item.quantity, item.price * item.quantity
        ]);
    
        doc.autoTable({
            startY: doc.lastAutoTable.finalY + 10, 
            head: [['No', 'Product', 'Price', 'Quantity', 'Total']],
            body: cartData
        });
    
        const totalY = doc.lastAutoTable.finalY + 10;
        doc.text(`Total Belanja Anda : Rp${cartTotal.textContent}`, 10, totalY);
    
        const pageHeight = doc.internal.pageSize.height; 
        const signatureY = pageHeight - 130; 
    
        doc.setFontSize(14);
        doc.text("TANDA TANGAN TOKO", doc.internal.pageSize.width - 10, signatureY, { align: 'right' }); // Align right
    
        doc.save('Laporan_Belanja.pdf');
    });


