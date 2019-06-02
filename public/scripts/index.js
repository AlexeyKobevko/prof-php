
const btn = document.querySelectorAll('.addToCartBtn');

btn.forEach(elem => {
    const id = elem.dataset.id;
    elem.addEventListener('click', () => {

        fetch('/basket/addBasket/', {
            method: 'GET',
            headers: {
                "Content-type": "application/json" },
            body: id,
        })
            .then(response => response.json())
            .then(body => console.log(body))
            .catch(err => console.log(err))
    });
});