import { ContactFormElement } from './components/ContactFormElement.js';
import { AlertBoxElement } from "./components/AlertBoxElement.js";

customElements.define('alert-box', AlertBoxElement);
customElements.define('contact-form', ContactFormElement, {extends: 'form'});
