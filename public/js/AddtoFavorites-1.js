// Wishlist functionality handler
document.addEventListener('DOMContentLoaded', function() {
    // Initialize wishlist buttons
    initWishlistButtons();
    
    // Check initial wishlist status for all products
    checkWishlistStatus();
});

function initWishlistButtons() {
    const wishlistButtons = document.querySelectorAll('[data-wishlist-button-new]');
    wishlistButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            handleWishlistToggle(this);
        });
    });
}
// Updated toggleFavorite function
function toggleFavorite(button) {
    fetch('/check-auth', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (!data.authenticated) {
            window.location.href = '/login?redirect=' + encodeURIComponent(window.location.pathname);
            return;
        }
        
        const productId = button.getAttribute('data-product-id');
        const icon = button.querySelector("i");
        const isCurrentlyFavorited = icon.classList.contains("text-danger");
        const productCard = button.closest('.card');

        // Don't update UI optimistically - wait for server response
        const formData = new FormData();
        formData.append('product_id', productId); // Changed back to 'product_id' to match controller

        const endpoint = isCurrentlyFavorited ? '/wishlist/delete' : '/wishlist/store';

        fetch(endpoint, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Only update UI after successful server response
                if (isCurrentlyFavorited) {
                    icon.classList.remove("text-danger");
                    icon.classList.add("text-secondary");
                    if (productCard && window.location.pathname === '/wishlist') {
                        productCard.remove();
                    }
                    console.log('Product removed from wishlist');
                } else {
                    icon.classList.remove("text-secondary");
                    icon.classList.add("text-danger");
                    console.log('Product added to wishlist');
                }
            } else {
                console.error('Error:', data.message);
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(`Failed to update wishlist: ${error.message}`);
        });
    })
    .catch(error => {
        console.error('Auth check failed:', error);
        alert('Please login to manage your wishlist');
        window.location.href = '/login';
    });
}

function handleWishlistToggle(button) {
    // Get product ID
    const productId = button.getAttribute('data-product-id');
    const icon = button.querySelector('i');
    const isInWishlist = icon.classList.contains('text-danger');

    // Update UI optimistically
    toggleHeartIcon(icon);

    // Prepare form data
    const formData = new FormData();
    formData.append('product_id', productId);

    // Determine endpoint based on current state
    const endpoint = isInWishlist ? '/wishlist/delete' : '/wishlist/store';

    // Send request to server
    fetch(endpoint, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Show success message
            showMessage(isInWishlist ? 'Product removed from wishlist' : 'Product added to wishlist', 'success');
            
            // If we're on the wishlist page and removing an item, remove the product card
            if (isInWishlist && window.location.pathname === '/wishlist') {
                const productCard = button.closest('.product-card');
                if (productCard) {
                    productCard.remove();
                }
            }
        } else {
            // Revert UI change on failure
            toggleHeartIcon(icon);
            showMessage(data.message || 'Failed to update wishlist', 'error');
        }
    })
    .catch(error => {
        // إعادة تغيير واجهة المستخدم في حالة حدوث خطأ
        toggleHeartIcon(icon);
        
        // عرض رسالة الخطأ للمستخدم
        showMessage('Please login to manage your wishlist', 'error');
        
        // تسجيل الخطأ في وحدة التحكم لأغراض تصحيح الأخطاء
        console.error('خطأ:', error);
        
        // تحويل المستخدم إلى صفحة تسجيل الدخول بعد تأخير
        setTimeout(() => {
            window.location.href = '/login';
        }, 2000); // تأخير لمدة 3 ثوانٍ (3000 مللي ثانية)
    });
}

function toggleHeartIcon(icon) {
    icon.classList.toggle('text-danger');
    icon.classList.toggle('text-secondary');
}

function checkWishlistStatus() {
    const buttons = document.querySelectorAll('[data-wishlist-button-new]');
    buttons.forEach(button => {
        const productId = button.getAttribute('data-product-id');
        
        fetch(`/wishlist/check?product_id=${productId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.inWishlist) {
                    const icon = button.querySelector('i');
                    icon.classList.remove('text-secondary');
                    icon.classList.add('text-danger');
                }
            })
            .catch(error => console.error('Error checking wishlist status:', error));
    });
}

function showMessage(message, type) {
    // Create toast notification
    const toast = document.createElement('div');
    toast.className = `toast position-fixed bottom-0 end-0 m-3 ${type === 'error' ? 'bg-danger' : 'bg-success'}`;
    toast.style.zIndex = '1050';
    
    toast.innerHTML = `
        <div class="toast-body text-white">
            ${message}
        </div>
    `;
    
    document.body.appendChild(toast);
    
    // Show toast
    const bsToast = new bootstrap.Toast(toast, {
        autohide: true,
        delay: 3000
    });
    bsToast.show();
    
    // Remove toast after it's hidden
    toast.addEventListener('hidden.bs.toast', () => {
        toast.remove();
    });
}              
