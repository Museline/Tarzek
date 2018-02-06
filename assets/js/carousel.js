module.exports = function() {

    var items = $("*[data-event='carousel']");

    // Index
    var indexItem = items.length - 1;
    var i = 0;

    // Item courante
    var currentItem = items.eq(i);

    // Cache les items
    items.css('display', 'none');
    // Affiche l'item courante
    currentItem.css('display', 'inline-block');

    // Si on clique sur le bouton next
    $('[data-event="carousel_next"]').click(function()
    {
        // on cache les items
        items.css('display', 'none');

        // si i est supérieur à indexItem alors on a fait le tour les annonces
        i++;
        if( i > indexItem) {
            i = 0;
        }
        // on affiche le prochain item
        currentItem = items.eq(i);
        currentItem.css('display', 'inline-block');
    });

    // Si on clique sur le bouton prec
    $('[data-event="carousel_prec"]').click(function()
    {
        // on cache les items
        items.css('display', 'none');

        // si i est supérieur à indexItem alors on a fait le tour les annonces
        i--;
        if( i > indexItem) {
            i = 0;
        }
        // on affiche le prochain item
        currentItem = items.eq(i);
        currentItem.css('display', 'inline-block');
    });
};