let hambButton = document.querySelector('.navbar__hamburger')
let menu = document.querySelector('.navbar__menu')

hambButton.addEventListener('click', function () {
    menu.classList.toggle('navbar__menu__visible')
})
