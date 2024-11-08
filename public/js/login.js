let container = document.getElementById('container');
let recordedInputs = [];

toggle = () => {
    container.classList.toggle('sign-in');
    container.classList.toggle('sign-up');
};

setTimeout(() => {
    container.classList.add('sign-in');
}, 200);

signup = () => {
    const username = document.getElementById('signup-username').value;
    const email = document.getElementById('signup-email').value;
    const password = document.getElementById('signup-password').value;
    const confirmPassword = document.getElementById('signup-confirm-password').value;

    // Validate password strength
    if (!validatePassword(password)) {
        alert('Password must be at least 8 characters long, contain at least one number, and at least one uppercase letter.');
        return;
    }

    // Validate password and confirm password match
    if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return;
    }

    // Validate email address
    if (!validateEmail(email)) {
        alert('Invalid email address.');
        return;
    }

    // Check if username already exists
    if (isUsernameTaken(username)) {
        alert('Username already exists.');
        return;
    }

    // Create user object
    const user = {
        username,
        email,
        password
    };

    // Store user object in local storage (stringified)
    localStorage.setItem(username, JSON.stringify(user));

    // Record input values
    recordInputs(username, email, password);

    // Show success message or redirect to another page (optional)
    alert('User created successfully!');
};

signin = () => {
    const username = document.getElementById('signin-username').value;
    const password = document.getElementById('signin-password').value;

    // Retrieve user object from local storage
    const storedUser = JSON.parse(localStorage.getItem(username));

    // Check if user exists and password matches
    if (storedUser && storedUser.username === username && storedUser.password === password) {
        // Successful login, redirect to another page
        window.location.href = 'index.html'; // Replace 'home.html' with your desired page
    } else {
        // Invalid credentials, show error message
        alert('Invalid username or password');
    }
};

// Function to validate password strength
function validatePassword(password) {
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
    return passwordRegex.test(password);
}

// Function to validate email address
function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Function to check if username already exists in local storage
function isUsernameTaken(username) {
    return localStorage.getItem(username) !== null;
}

// Function to record input values
function recordInputs(username, email, password) {
    recordedInputs.push({ username, email, password });
    console.log('Recorded inputs:', recordedInputs);
}
  // Password Validation
  const passwordInput = document.getElementById('password');
  const strengthMeter = document.querySelector('.strength-meter');
  const requirements = document.querySelectorAll('.requirement');
  const requirementPatterns = {
      length: /.{8,}/,
      lowercase: /[a-z]/,
      uppercase: /[A-Z]/,
      number: /\d/,
      special: /[^A-Za-z0-9]/
  };

  passwordInput.addEventListener('input', function () {
      const value = passwordInput.value;
      let strength = 0;

      requirements.forEach(req => {
          const requirement = req.dataset.requirement;
          const pattern = requirementPatterns[requirement];

          if (pattern.test(value)) {
              req.classList.add('valid');
              req.classList.remove('invalid');
              strength++;
          } else {
              req.classList.add('invalid');
              req.classList.remove('valid');
          }
      });

      strengthMeter.style.width = `${(strength / requirements.length) * 100}%`;
  });

  // Form toggle functionality
  function toggle() {
      const container = document.getElementById('container');
      container.classList.toggle('sign-in');
      container.classList.toggle('sign-up');
  }

  // Validate passwords match
  function validatePassword() {
      const password = document.querySelector('input[name="signup-password"]').value;
      const confirmPassword = document.querySelector('input[name="signup-confirm-password"]').value;

      if (password !== confirmPassword) {
          alert('Passwords do not match.');
          return false;
      }
      return true;
  }