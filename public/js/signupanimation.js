document.addEventListener('DOMContentLoaded', function() {
    // Floating Animation Setup
    const container = document.createElement('div');
    container.className = 'floating-images';
    document.body.appendChild(container);
    
    const images = [
        '🎂', '🍰', '🧁', '🍪', '🍫', '🍩', '🍬', '🍭', '🍦', '🍮', '🥮', '🍧', '🍨', '🍯', '🍎', '🍒', '🍓', '🍋', '🍌'
    ];
        
    function createFloatingImage() {
        const div = document.createElement('div');
        div.className = 'floating-image';
        div.textContent = images[Math.floor(Math.random() * images.length)];
        
        const startX = Math.random() * window.innerWidth;
        const startY = window.innerHeight + 100;
        const endX = Math.random() * window.innerWidth;
        const endY = -100;
        
        div.style.left = `${startX}px`;
        div.style.top = `${startY}px`;
        div.style.setProperty('--tx', `${endX - startX}px`);
        div.style.setProperty('--ty', `${endY - startY}px`);
        
        container.appendChild(div);
        
        // Remove the image after 15 seconds
        setTimeout(() => div.remove(), 15000);
    }
    
    // Create a floating image every second
    setInterval(createFloatingImage, 1000);
    
    // Create initial floating images
    for (let i = 0; i < 5; i++) {
        setTimeout(createFloatingImage, i * 500); // Create 5 images with a delay of 500ms each
    }
});
