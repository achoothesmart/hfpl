$(document).ready(function () {
    $("#buyer").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "/Buyer/Index",
                type: "POST",
                dataType: "json",
                data: { Prefix: request.term },
                success: function (data) {
                    response($.map(data, function (item) {
                        //return { label: item.buyerName, value: item.buyerName + " - " + item.buyerId };
                        return { label: item.buyerName, value: item.buyerName };
                    }))
                }
            })
        },
        messages: {
            noResults: "", results: ""
        }
    });
})