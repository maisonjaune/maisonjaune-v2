import EditorJS from '@editorjs/editorjs'

import renderer from "./renderer"

export default function (Alpine) {
    document.addEventListener('alpine:init', () => {
        Alpine.directive('editor', (el, a, b) => {
            const formElement = el.querySelector('form')
            const contentElement = formElement.querySelector('[data-input=content]')
            const inputElements = formElement.querySelectorAll('[data-input]')

            const editor = new EditorJS({
                holder: 'editor',
                placeholder: 'Rédigez votre article ici !',

                onChange: (api, event) => {
                    editor.saver.save()
                        .then((outputData) => contentElement.value = JSON.stringify(outputData))
                        .catch((error) => console.error("Erreur lors de l'enregistrement", error))
                }
            })

            editor.isReady
                .then(() => editor.blocks.render(JSON.parse(contentElement.value)))
                .then(() => {
                    editor.saver.save()
                        .then((outputData) => contentElement.value = JSON.stringify(outputData))
                        .catch((error) => console.error("Erreur lors de l'enregistrement", error))
                })
                .catch((reason) => console.error(`Editor.js initialization failed because of ${reason}`))

            // elements data-input
            // elements data-render

            inputElements.forEach((input) => {
                const callback = input.hasAttribute('data-callback')
                    ? input.getAttribute('data-callback')
                    : 'textRenderer'

                input.addEventListener('change', (e) => renderer.run(callback, el, input, e))
            })
        })
    })

    function save() {
        // editor.save()
        //     .then((savedData) => content.value = JSON.stringify(savedData))
        //     .catch((error) => console.log("Erreur lors de l'enregistrement", error))
    }
}
