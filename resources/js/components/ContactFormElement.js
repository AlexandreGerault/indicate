export class ContactFormElement extends HTMLFormElement
{
    constructor() {
        super();
        this.addEventListener("submit", this.onSubmit);
    }

    onSubmit(event) {
        event.preventDefault();
        console.log("Form submitted")
    }
}
