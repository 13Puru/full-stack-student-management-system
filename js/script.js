    // Function to check login status
    function checkLoginStatus() {
        const isLoggedIn = sessionStorage.getItem('isLoggedIn');
        const userType = sessionStorage.getItem('userType');

        if (!isLoggedIn || !userType) {
            alert('You must log in to access this page.');
            window.location.href = 'login.php';
        } else {
            console.log(`Logged in as ${userType}`);
        }
    }

    // Call the function on page load
    document.addEventListener('DOMContentLoaded', checkLoginStatus);

    // Logout function
    function logout() {
        sessionStorage.removeItem('isLoggedIn');
        sessionStorage.removeItem('userType');
        alert('You have been logged out.');
        window.location.href = 'login.php';
    }

    //logout script 
    function logout() {
        // Confirm logout
        if (confirm('Are you sure you want to log out?')) {
            // Make an AJAX call to destroy the session
            fetch('logout.php', {
                method: 'POST'
            })
            .then(response => {
                if (response.ok) {
                    // Clear client-side session storage
                    sessionStorage.removeItem('isLoggedIn');
                    sessionStorage.removeItem('userType');
                    alert('You have been logged out.');
                    // Redirect to login page
                    window.location.href = 'login.php';
                } else {
                    alert('Logout failed. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error during logout:', error);
                alert('An error occurred. Please try again.');
            });
        }
    }
