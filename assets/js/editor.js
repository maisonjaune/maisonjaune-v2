import EditorJS from '@editorjs/editorjs'
import List from '@editorjs/list'
import ImageTool from './editorjs/plugins/image/image'

import renderer from "./renderer"

export default function (Alpine) {
    document.addEventListener('alpine:init', () => {
        Alpine.directive('editor', (el, a, b) => {
            const form = el.querySelector('form')
            const inputs = form.querySelectorAll('[data-input]')

            const editor = new EditorJS({
                holder: 'editor',
                placeholder: 'Rédigez votre article ici !',

                tools: {
                    list: {
                        class: List,
                        inlineToolbar: true,
                        config: {
                            defaultStyle: 'unordered'
                        }
                    },
                    image: {
                        class: ImageTool
                    },
                },

                onReady() {
                    const content = form.querySelector('[data-input=content]').value
                    editor.blocks.render(JSON.parse(content))
                },

                onChange() {
                    save()
                }
            })

            // elements data-input
            // elements data-render

            inputs.forEach((input) => {
                const callback = input.hasAttribute('data-callback')
                    ? input.getAttribute('data-callback')
                    : 'textRenderer'

                console.log(callback)

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
