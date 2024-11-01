// Get elements
const newProjectBtn = document.getElementById('newProjectBtn');
const popupMessage = document.getElementById('popupMessage');
const loginBtn = document.getElementById('loginBtn');
const closePopup = document.getElementById('closePopup');
const loginForm = document.getElementById('loginForm');

// Show the popup message when "New +" button is clicked
newProjectBtn.addEventListener('click', () => {
    popupMessage.style.display = 'flex';
});

// Close the popup message when "Close" button is clicked
closePopup.addEventListener('click', () => {
    popupMessage.style.display = 'none';
});

// Show the login form when "Login" button in the popup message is clicked
loginBtn.addEventListener('click', () => {
    popupMessage.style.display = 'none';
    loginForm.style.display = 'flex';
});
