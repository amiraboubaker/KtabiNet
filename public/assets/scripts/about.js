// about.js

document.addEventListener("DOMContentLoaded", function() {
    // Sélectionne toutes les cartes de services
    const serviceCards = document.querySelectorAll(".services .card");

    // Ajoute un gestionnaire d'événement à chaque carte de service
    serviceCards.forEach(function(card) {
        card.addEventListener("click", function() {
            // Affiche un message d'exemple
            alert("Vous avez cliqué sur un service !");
        });
    });
});
