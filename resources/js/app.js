import './bootstrap';
import '../css/app.css';

import { createApp } from 'vue';

// Importar os componentes Vue
import SupportPage from './components/SupportPage.vue';
import EquipmentHistoryPage from './components/EquipmentHistoryPage.vue';
import EquipmentRestorePage from './components/EquipmentRestorePage.vue';

const app = createApp({});

// Registrar os componentes globalmente
app.component('support-page', SupportPage);
app.component('equipment-history-page', EquipmentHistoryPage);
app.component('equipment-restore-page', EquipmentRestorePage);

// Montar a aplicação se o elemento #app existir
const appElement = document.getElementById('app');
if (appElement) {
    app.mount('#app');
}
