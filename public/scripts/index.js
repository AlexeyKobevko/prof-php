
// const btn = document.querySelectorAll('.addToCartBtn');
// const field = document.querySelector('.count');
//
// btn.forEach(elem => {
//     const id = elem.dataset.id;
//     elem.addEventListener('click', () => {
//         console.log(id);
//         fetch('/basket/AddBasket/', {
//             method: 'POST',
//             headers: {
//                 "Content-type": "application/json" },
//             body: id,
//         })
//             .then(response => response.json())
//             .then(body => console.log(body))
//     });
// });

$(document).ready(function () {
    $('.addToCartBtn').on('click', function (e) {
        let $id = $(e.target).data('id');

        $.ajax({
            url: "/basket/AddBasket/",
            type: "POST",
            dataType : "json",
            data:{
                id: $id,
            },
            error: function() {alert('error');},
            success: function(answer){
                {

                    $(".count").html(answer.count);
                }
            },

        })
    })
});

$(document).ready(function () {
    $('.removeCartBtn').on('click', function (e) {
        let $id = $(e.target).data('id');

        $.ajax({
            url: "/basket/Delete/",
            type: "POST",
            dataType : "json",
            data:{
                id: $id,
            },
            success: function(answer){
                {
                    $('#' + $id).remove();
                    $(".count").html(answer.count);
                }
            },
            error: function() {alert('error');},

        })
    })
});

$(document).ready(function () {
    $('#loginBtn').on('click', function (e) {
        const $login = $('#login').val();
        const $pass = $('#password').val();

        $.ajax({
            url: "/user/Login/",
            type: "POST",
            dataType : "json",
            data:{
                submit: {
                    login: $login,
                    password: $pass,
                }
            },
            success: function(){
                {
                    window.location.replace('/');
                }
            },
            error: function() {alert('error');},

        })
    })
});