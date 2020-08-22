export class AlertBoxElement extends HTMLElement {
    constructor() {
        super();

        this.template = document.createElement('template');
        this.rendered = false;
    }


    /**
     * Reactive attributes
     * Doc: https://developer.mozilla.org/en-US/docs/Web/Web_Components/Using_custom_elements#Using_the_lifecycle_callbacks
     *
     * @returns {string[]}
     */
    static get observedAttributes() {
        return ['type'];
    }


    /**
     * Callback called when the element is appended to the DOM
     * Doc: https://developer.mozilla.org/en-US/docs/Web/Web_Components/Using_custom_elements#Using_the_lifecycle_callbacks
     */
    connectedCallback() {
        if (!this.rendered) {
            this.render();

            const closeButton = this.querySelector('.alert__close');
            closeButton.addEventListener('click', this.close.bind(this));
        }
    }


    /**
     * Callback getting called whenever observed attributes change
     * Doc: https://developer.mozilla.org/en-US/docs/Web/Web_Components/Using_custom_elements#Using_the_lifecycle_callbacks
     *
     * @param {string} attribute
     * @param {string} old
     * @param {string} current
     */
    attributeChangedCallback(attribute, old, current) {
        if(attribute === 'type') {
            this.type = current;
            this.classList.remove('alert__' + old);
            this.updateStyle()
        }
    }


    render() {
        this.template.innerHTML = `<div class="alert__close"><i class="fa fa-times" aria-hidden="true"></i></div><p>${this.slot}</p>`;
        this.root = this.template.content;
        this.appendChild(this.root);
        this.rendered = true;
        this.root = this;
        this.classList.add('alert');
    }

    updateStyle() {
        this.classList.add('alert__' + this.type);
    }

    close() {
        this.parentNode.removeChild(this);
    }
}
