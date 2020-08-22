export class AlertElement extends HTMLElement {
    constructor() {
        super();
        console.log('CREATION DE ALERT BOX');
        this.type = this.getAttribute('type');
        this.message = this.slot;

        console.log(this.slot)

        this.classList.add('alert__' + type);
        this.innerHTML = `<div class="alert__close">
<i class="fa fa-times" aria-hidden="true"></i>
</div>
<p>SLOT ICI</p>`;

        const closeButton = this.querySelector('.alert__close');
        console.log(closeButton)

        closeButton.addEventListener('click', this.close);
    }

    close() {
        document.removeChild(this);
    }
}
