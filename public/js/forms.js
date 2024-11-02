document.addEventListener('DOMContentLoaded', function() {
  // Floating Animation Setup
  const container = document.createElement('div');
  container.className = 'floating-images';
  document.body.appendChild(container);
  
  const images = ['🍰', '🧁', '🎂', '🍪', '🥮', '🥯', '🍩', '🍦', '🍫', '🍭', '🍬', '🍇', '🍉'];
  
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
      
      setTimeout(() => div.remove(), 15000);
  }
  
  setInterval(createFloatingImage, 1000);
  for(let i = 0; i < 5; i++) {
      setTimeout(createFloatingImage, i * 500);
  }
  
  // Password Validation
  const passwordInput = document.querySelector('input[name="usersPwd"]');
  const confirmPasswordInput = document.querySelector('input[name="pwdRepeat"]');
  const phoneInput = document.querySelector('input[name="usersPhoneNumber"]');
  
  if (passwordInput) {
      const requirements = [
          { regex: /.{8,}/, text: 'At least 8 characters' },
          { regex: /[A-Z]/, text: 'At least one uppercase letter' },
          { regex: /[a-z]/, text: 'At least one lowercase letter' },
          { regex: /[0-9]/, text: 'At least one number' },
          { regex: /[!@#$%^&*]/, text: 'At least one special character (!@#$%^&*)' }
      ];
      
      const requirementsContainer = document.querySelector('.password-requirements');
      
      requirements.forEach(req => {
          const reqElement = document.createElement('div');
          reqElement.className = 'requirement';
          reqElement.innerHTML = `
              <div class="requirement-bullet">•</div>
              <span class="requirement-text">${req.text}</span>
          `;
          requirementsContainer.appendChild(reqElement);
      });
      
      passwordInput.addEventListener('input', function() {
          const password = this.value;
          const reqElements = document.querySelectorAll('.requirement');
          
          requirements.forEach((req, index) => {
              const isValid = req.regex.test(password);
              const reqElement = reqElements[index];
              
              if (isValid) {
                  reqElement.classList.add('valid');
              } else {
                  reqElement.classList.remove('valid');
              }
          });
          
          // Check password match
          if (confirmPasswordInput.value) {
              validatePasswordMatch();
          }
      });
  }
  
  // Confirm Password Validation
  if (confirmPasswordInput) {
      function validatePasswordMatch() {
          if (passwordInput.value !== confirmPasswordInput.value) {
              confirmPasswordInput.setCustomValidity("Passwords don't match");
          } else {
              confirmPasswordInput.setCustomValidity('');
          }
      }
      
      confirmPasswordInput.addEventListener('input', validatePasswordMatch);
  }
  
  // Phone Number Validation
  if (phoneInput) {
      phoneInput.addEventListener('input', function() {
          this.value = this.value.replace(/[^0-9]/g, '');
          
          if (this.value.length > 10) {
              this.value = this.value.slice(0, 10);
          }
          
          if (this.value.length > 0 && !this.value.startsWith('07')) {
              this.setCustomValidity('Phone number must start with 07');
          } else if (this.value.length === 10) {
              this.setCustomValidity('');
          } else {
              this.setCustomValidity('Phone number must be 10 digits');
          }
      });
  }
});