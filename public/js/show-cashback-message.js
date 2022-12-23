// shows cashback card message if not logged in
function loadCashbackMessageScript() {
    const cashbackCard = document.querySelectorAll(".cashback-card.guest");
    cashbackCard.forEach((card) => {
        card.addEventListener("click", () => {
            if (card.children[0].classList.contains("cashback-card-message")) {
                card.children[0].classList.add("show-message");
                // card.children[0].classList.toggle("show-message");
            }
        });
    });
}
window.onload = loadCashbackMessageScript();
