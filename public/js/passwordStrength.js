document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.querySelector('input[name="customerPassword"]');
    const confirmPasswordInput = document.querySelector('input[name="pwdRepeat"]'); // إضافة حقل التأكيد
    const requirementsList = document.querySelector('#password-requirements');
    
    const requirements = [
        { label: '8+ chars', validate: pwd => pwd.length >= 8 },
        { label: 'Uppercase', validate: pwd => /[A-Z]/.test(pwd) },
        { label: 'Lowercase', validate: pwd => /[a-z]/.test(pwd) },
        { label: 'Number', validate: pwd => /[0-9]/.test(pwd) },
        { label: 'Special', validate: pwd => /[\W_]/.test(pwd) }
    ];

    // إنشاء عناصر المتطلبات
    requirements.forEach(req => {
        const reqElement = document.createElement('div');
        reqElement.className = 'requirement-item';
        reqElement.innerHTML = `                
            <span class="check">✓</span>
            <span class="x">✗</span>
            <span class="label">${req.label}</span>
        `;
        requirementsList.appendChild(reqElement);
    });

    // إضافة زر رؤية كلمة المرور
    const togglePassword = document.createElement('button');
    togglePassword.type = 'button';
    togglePassword.className = 'toggle-pass';
    togglePassword.innerHTML = '👁️';
    passwordInput.parentNode.appendChild(togglePassword);

    // تحديث المتطلبات عند إدخال كلمة المرور
    const updateRequirements = () => {
        const password = passwordInput.value;
        requirements.forEach((req, index) => {
            const reqElement = requirementsList.children[index];
            const isValid = req.validate(password);
            reqElement.classList.toggle('valid', isValid);
            reqElement.classList.toggle('invalid', !isValid);
        });
    };

    passwordInput.addEventListener('input', updateRequirements);
    confirmPasswordInput.addEventListener('input', updateRequirements); // إضافة هذا السطر لمراقبة حقل التأكيد

    // Toggle password visibility
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.innerHTML = type === 'password' ? '👁️' : '🙈';
        
        // تغيير نوع حقل التأكيد بناءً على نوع الحقل الرئيسي
        confirmPasswordInput.setAttribute('type', type);
    });
});
