// login-register.js

document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('form');

    loginForm.addEventListener('submit', function(event) {
        // Get form values
        const username = document.querySelector('input[name="username"]').value;
        const password = document.querySelector('input[name="password"]').value;

        // Validate if both fields are filled out
        if (!username || !password) {
            event.preventDefault(); // Prevent form submission
            alert('Please fill in both username and password.');
        }
    });
});
