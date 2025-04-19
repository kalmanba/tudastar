document.addEventListener('DOMContentLoaded', function() {
    // Quantity buttons functionality
    const quantityInput = document.getElementById('quantity');
    const minusBtn = document.querySelector('.quantity-minus');
    const plusBtn = document.querySelector('.quantity-plus');
    
    minusBtn.addEventListener('click', function() {
        let value = parseInt(quantityInput.value);
        if (value > 1) {
            quantityInput.value = value - 1;
        }
    });
    
    plusBtn.addEventListener('click', function() {
        let value = parseInt(quantityInput.value);
        if (value < parseInt(quantityInput.max)) {
            quantityInput.value = value + 1;
        }
    });
    
    // Form submission
    const form = document.getElementById('add-to-cart-form');
    const cartMessage = document.getElementById('cart-message');
    
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        cartMessage.classList.add('d-none');
        
        try {
            const response = await fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json', // Add this
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({
                    item_id: document.querySelector('input[name="item_id"]').value,
                    quantity: document.getElementById('quantity').value
                })
            });
            
            const data = await response.json();
            
            if (!response.ok) {
                // Handle validation errors
                if (data.errors) {
                    let errorMessages = [];
                    for (let field in data.errors) {
                        errorMessages.push(data.errors[field][0]);
                    }
                    throw new Error(errorMessages.join('\n'));
                }
                throw new Error(data.message || 'A kosárba helyezés sikertelen!');
            }
            
            cartMessage.textContent = 'A termék sikeresen a kosárba helyezve!';
            cartMessage.classList.remove('alert-danger', 'd-none');
            cartMessage.classList.add('alert-success');
            
        } catch (error) {
            cartMessage.textContent = error.message;
            cartMessage.classList.remove('alert-success', 'd-none');
            cartMessage.classList.add('alert-danger');
        }
    });
});