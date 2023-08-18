import './styles/app.scss'

import { Modal } from 'bootstrap'
import Alpine from 'alpinejs'

import editor from './js/editor'

Alpine.plugin(editor)

Alpine.magic('modal', () => Modal)

window.Alpine = Alpine
window.Alpine.start()