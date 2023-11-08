// $(document).ready(function() {
//    $(".star").click(function() {
//     var productId = $(this).data('product-id');
//     var rating = $(this).data('rating');

//         $.ajax({
//             type: 'POST',
//             url: 'index.php?action=ajax&function=addRating&id=' + productId,
//             data: { rating: rating },
//             success: function(response) {
//                 var result = JSON.parse(response);
//                 if (result.averageRating) {
//                     console.log('Gemiddelde rating:', result.averageRating);
//                 } else if (result.error) {
//                     console.error(result.error);
//                 }
//             }
//         });
//     });
// })

// $(document).ready(function(){
//     resetStarColors();

//     $('.fa-star').mouseover(function () {
//         resetStarColors();

//         var currentIndex = parseInt($(this).data('index'));

//         for (var i=0; i <= currentIndex; i++)
//             $('.fa-star:eq('+i+')').addClass('green');
//     });
        
//     $('.fa-star').mouseleave(function () {
//         resetStarColors();
//     });
// });

// function resetStarColors() {
//     $('.fa-star').removeClass('green');
// }

$(document).ready(function(){
    $('.star').on('mouseover', function() {
        $(this).prevAll().addBack().css('color', 'green');
    });

    $('.star').on('mouseleave', function() {
        resetStarColors();
    });

    function resetStarColors() {
        $('.star').css('color', 'white');
    }
});