document.getElementById('loginForm').addEventListener('submit', async function(event) {
    event.preventDefault();
   // window.alert("success");
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    if (!username || !password) {
        alert('Please fill in both fields');
        return;
    }

    try {
        const response = await fetch('ajax/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ username, password }),
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const result = await response.json();
          console.log(result);
        if (result.status === true) {
            alert('Success: ' + result.message);
            window.location.href = 'http://localhost/teacher-portal/teacher/';
        } else {
            alert('Login failed: ' + result.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    }
});