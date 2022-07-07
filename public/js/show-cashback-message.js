// shows cashback card message if not logged in
function showMessage(card) {
    const div = document.createElement("div");
    div.innerHTML = `
      <a href="/register">Register</a>
      <span>and/or</span>
      <a href="/login">Log In</a>
      <span>to continue.</span>
      `;
    div.classList.add("cashback-card-message");
    card.appendChild(div);
}
