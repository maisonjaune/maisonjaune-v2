class Renderer {
    constructor() {
        this.renders = {
            textRenderer: this.textRenderer,
            checkboxesRenderer: this.checkboxesRenderer,
        };
    }
    run(render, el, input, e) {
        this.renders[render].call(this, el, input, e);
    }

    textRenderer(el, input, e) {
        el.querySelector(`[data-render=${input.getAttribute('data-input')}]`).innerHTML = e.target.value
    }

    checkboxesRenderer(el, input, e) {
        const checkboxes = e.target.closest('[data-input]').querySelectorAll('input[type=checkbox]:checked');
        const labels = Array.prototype.map.call(checkboxes, el => el.parentNode.querySelector('label').innerText);
        el.querySelector(`[data-render=${input.getAttribute('data-input')}]`).innerHTML = labels.join(' / ');
    }
}

export default new Renderer();