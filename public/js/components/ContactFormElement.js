export class ContactFormElement extends HTMLFormElement {
    constructor() {
        super();
        this.action = this.getAttribute('action');
        this.addEventListener("submit", this.onSubmit);
    }


    /**
     * Send the ajax request when the form is submitted
     *
     * @param {object} event
     */
    onSubmit(event) {
        event.preventDefault();

        const init = {
            method: 'POST',
            headers: {
                'Content-type': "application/json; charset=UTF-8",
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': this.elements['_token'].value,
            },
            body: JSON.stringify({
                email: this.elements['email'].value,
                name: this.elements['name'].value,
                message: this.elements['message'].value
            }),
        };

        fetch(this.action, init)
            .then((response) => {
                if (response.ok && response.status === 201)
                    this.success();
                else
                    this.error();
            });
    }


    /**
     * When the ajax request is a success it display a success alert box and reset inputs
     */
    success() {
        this.prependMessage('Le message a bien été envoyé', 'success');
        this.reset();
    }

    /**
     * Called function when the ajax request failed
     */
    error() {
        this.prependMessage('Une erreur est survenue', 'failure');
    }


    /**
     * Utility function that create an alert box to display the result
     *
     * @param {string} text
     * @param {string} type
     */
    prependMessage(text, type) {
        if (this.alert != null) {
            this.removeChild(this.alert)
        }

        this.alert = document.createElement('alert-box');
        this.alert.setAttribute('type', type);
        this.alert.slot = text;

        this.prepend(this.alert);
    }
}
