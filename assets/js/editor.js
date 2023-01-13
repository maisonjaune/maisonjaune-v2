import EditorJS from '@editorjs/editorjs'

const content = document.querySelector("[data-editor=content]")

const editor = new EditorJS({
    holder: 'editor',
    placeholder: 'Rédigez votre article ici !',

    onReady() {
        editor.blocks.render(JSON.parse(content.value))
    },

    onChange() {
        save()
    }
})

function save() {
    editor.save()
        .then((savedData) => {
            content.innerText = JSON.stringify(savedData)
        })
        .catch((error) => {
            console.log("Erreur lors de l'enregistrement", error)
        })
}
