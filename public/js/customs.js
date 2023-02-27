class DevTag extends HTMLElement {
	constructor() {
		// Always call super first in constructor
		super();

		// Create a shadow root
		const shadow = this.attachShadow({ mode: 'open' });

        const wrapper = document.createElement('span');

		// Create pis
		const name = document.createElement('p');
		name.setAttribute('class', 'name');

		let level = document.createElement('p');
		level.setAttribute('class', 'level');

		// Take attribute content and put it inside the info span
        const text = this.getAttribute('name');
        name.appendChild(document.createTextNode(text));

        switch (parseInt(this.getAttribute('level'))) {
            case 1:
                level.appendChild(document.createTextNode("begginer"));
                break;
            case 2:
                level.appendChild(document.createTextNode("intermediate"));
                break;
            case 3:
                level.appendChild(document.createTextNode("advanced"));
                break;
            default:
                if (this.getAttribute('level') !== null) {
                    console.log(this.getAttribute('level') + " is not a valid level number");
                }
                level = false;
                break;
        }

		// Create some CSS to apply to the shadow dom
		const style = document.createElement('style');
		// console.log(style.isConnected);

        style.textContent = `
            .name {
                display: inline;
                color: var(--primary-color);
                background-color: white;
                border: 1px solid var(--primary-color);
                border-radius: 0.2rem;
                padding: 0.2rem 0.5rem;
                box-shadow: 1px 1px 0 1px white;
                text-align: center;
                z-index: 1;
            }
            .level {
                margin-left: 0.2rem;
                text-transform: uppercase;
                font-size: small;
                margin-left: auto;
                border: 1px solid var(--primary-color);
                border-top: none;
                background-color: var(--primary-color);
                color: white;
                border-radius: 0.2rem;
                transform: translate(0.75rem, -0.4rem);
                padding: 0.5rem 0.2rem 0.3rem;
            }
            span {
                display: flex;
                flex-direction: column;
            }

            p {
                margin: 0;
            }
            `;

        switch (parseInt(this.getAttribute('scheme'))) {

            case 1:
                style.textContent += `
                    * {
                        --primary-color: blue;
                    }
                `;
                break;

            default:
                style.textContent += `
                    * {
                        --primary-color: purple;
                    }
                `;
                break;
        }

		// Attach the created elements to the shadow dom
        shadow.appendChild(style);
        shadow.appendChild(wrapper);
		// console.log(style.isConnected);
        wrapper.appendChild(name);
        if (level) {
            wrapper.appendChild(level);
        }
	}
}

customElements.define("dev-tag", DevTag);
