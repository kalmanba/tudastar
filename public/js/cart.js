document.addEventListener('DOMContentLoaded', function() {
    // Initialize elements
    const cartButton = document.getElementById('cart-button');
    const cartModalElement = document.getElementById('cartModal');
    
    // Check if elements exist
    if (!cartButton || !cartModalElement) {
        console.error('Kosár nem található');
        return;
    }
    
    // Initialize Bootstrap modal
    const cartModal = new bootstrap.Modal(cartModalElement);
    
    // Click handler for cart button
    cartButton.addEventListener('click', function() {
        loadCartContent();
        cartModal.show();
    });
    
    // Normalize cart data format (handles both arrays and objects)
    function normalizeCartData(data) {
        if (!data) return [];
        
        if (Array.isArray(data)) {
            return data;
        }
        
        // Convert object format {itemId: quantity} to array
        if (typeof data === 'object' && data !== null) {
            return Object.entries(data).map(([id, quantity]) => ({
                id: id,
                quantity: quantity,
                // These will be fetched from the server in the controller
                name: `Termék ${id}`, // Fallback, should come from server
                price: 0, // Fallback, should come from server
                total: 0 // Fallback, should come from server
            }));
        }
        
        return [];
    }
    
    // Load cart content from server
    function loadCartContent() {
        const cartContent = document.getElementById('cart-content');
        if (!cartContent) return;
        
        // Show loading spinner
        cartContent.innerHTML = `
            <div class="text-center py-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Betöltés...</span>
                </div>
            </div>
        `;
        
        fetch('/cart')
            .then(response => {
                if (!response.ok) throw new Error('Hálózati hiba!');
                return response.json();
            })
            .then(data => {
                const cartItems = normalizeCartData(data);
                renderCartContent(cartItems);
            })
            .catch(error => {
                console.error('Hiba a kosár betöltésekor:', error);
                showCartError(error.message);
            });
    }
    
    // Render cart items in modal
    function renderCartContent(cartItems) {
        const cartContent = document.getElementById('cart-content');
        if (!cartContent) return;
        
        if (!cartItems || cartItems.length === 0) {
            showEmptyCart();
            return;
        }
        
        let html = '<ul class="list-group mb-3">';
        let grandTotal = 0;
        
        cartItems.forEach(item => {
            if (!item.price) item.price = 0;
            if (!item.quantity) item.quantity = 1;
            item.total = item.price * item.quantity;
            grandTotal += item.total;
            
            html += `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1">${item.name || `Termék ${item.id}`}</h6>
                        <small class="text-muted">${item.price}Ft × ${item.quantity}</small>
                    </div>
                    <div>
                        <span class="fw-bold">${item.total}Ft</span>
                        <button class="btn btn-sm btn-outline-danger ms-2 remove-item" data-id="${item.id}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </li>
            `;
        });
        
        html += `</ul>
            <div class="d-flex justify-content-between mt-3 fw-bold fs-5">
                <span>Összesen:</span>
                <span>${grandTotal}Ft</span>
            </div>
        `;
        
        cartContent.innerHTML = html;
        
        // Add event listeners to remove buttons
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-id');
                removeFromCart(itemId);
            });
        });
    }
    
    // Remove item from cart
    function removeFromCart(itemId) {
        fetch(`/cart/remove/${itemId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Elem eltávolítása sikeretelen');
            return response.json();
        })
        .then(data => {
            if (data.success) {
                loadCartContent(); // Refresh cart content
                updateCartBadge(); // Update badge count
                showToast('Elem eltávolítva a kosárból');
            }
        })
        .catch(error => {
            console.error('Elem eltávolítása sikertelen:', error);
            showCartError(error.message);
        });
    }
    
    // Update cart badge count
    function updateCartBadge() {
        const cartBadge = document.getElementById('cart-badge');
        if (!cartBadge) return;
        
        fetch('/cart')
            .then(response => response.json())
            .then(data => {
                const cartItems = normalizeCartData(data);
                const count = cartItems.length;
                cartBadge.textContent = count;
                cartBadge.style.display = count > 0 ? 'block' : 'none';
                
                // Add bounce animation when count changes
                cartBadge.classList.add('cart-bounce');
                setTimeout(() => {
                    cartBadge.classList.remove('cart-bounce');
                }, 500);
            })
            .catch(error => {
                console.error('Error updating cart badge:', error);
            });
    }
    
    // Show empty cart state
    function showEmptyCart() {
        const cartContent = document.getElementById('cart-content');
        cartContent.innerHTML = `
            <div class="text-center py-4">
                <i class="bi bi-cart-x fs-1 text-muted"></i>
                <p class="mt-3">A kosár üres</p>
            </div>
        `;
    }
    
    // Show error message
    function showCartError(message) {
        const cartContent = document.getElementById('cart-content');
        cartContent.innerHTML = `
            <div class="alert alert-danger">
                ${message}
            </div>
        `;
    }
    
    // Show toast notifications
    function showToast(message) {
        // Implement using your preferred toast library
        console.log('Toast:', message);
        // Example with Bootstrap Toasts:
        const toastElement = document.createElement('div');
        toastElement.className = 'toast align-items-center text-white bg-success';
        toastElement.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
        document.body.appendChild(toastElement);
        const toast = new bootstrap.Toast(toastElement);
        toast.show();
        setTimeout(() => toastElement.remove(), 3000);
    }
    
    // Initialize cart badge on page load
    updateCartBadge();
    
    // Listen for custom event when items are added to cart
    document.addEventListener('cartUpdated', function() {
        updateCartBadge();
        // Refresh cart content if modal is open
        if (document.querySelector('.modal.show')) {
            loadCartContent();
        }
    });
    
    // Add animation styles
    const style = document.createElement('style');
    style.innerHTML = `
        @keyframes bounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }
        .cart-bounce {
            animation: bounce 0.5s;
        }
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1100;
        }
    `;
    document.head.appendChild(style);
});