// const checkboxes = Array.from(document.getElementsByClassName('checkbox'))
// const checkboxesLabel = Array.from(document.getElementsByClassName('text-content'))
// const expressDelivery = document.getElementById('express')
// const target = document.getElementById('target')

// let price = []
// let total = 0

// function isCheckbooxCheched() {
//     for (let i = 0; i < checkboxes.length; i++) {
//         if (checkboxes[i].checked == true) {
//             price.push(checkboxesLabel[i].textContent.slice(-5))
//         }
//     }

//     for (let i = 1; i < price.length; i++) {
//         price.shift()
//     }

//     total = sum(price).toFixed(1);
//     target.textContent = `€ ${total}`
// }

// function sum(a) {
//     return (a.length && parseFloat(a[0]) + sum(a.slice(1))) || 0;
// }
