var items = $(".list-wrapper .list-item");
    var numItems = items.length;
    var perPage = 3;

    items.slice(perPage).hide();

    $('#pagination-panier').pagination({
        items: numItems,
        itemsOnPage: perPage,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber) {
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;
            items.hide().slice(showFrom, showTo).show();
        }
    });