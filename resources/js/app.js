import './bootstrap';
import '../css/app.css';

import { createApp } from 'vue';

// Importar os componentes Vue
import SupportPage from './components/SupportPage.vue';
import EquipmentHistoryPage from './components/EquipmentHistoryPage.vue';
import EquipmentManagementPage from './components/EquipmentManagementPage.vue';
import ForgotPasswordPage from './components/ForgotPasswordPage.vue';
import ResetPasswordPage from './components/ResetPasswordPage.vue';
import PasswordResetSuccessPage from './components/PasswordResetSuccessPage.vue';
import DashboardPage from './components/DashboardPage.vue';
import GenerateReportPage from './components/GenerateReportPage.vue';

const app = createApp({});

// Registrar os componentes globalmente
app.component('support-page', SupportPage);
app.component('equipment-history-page', EquipmentHistoryPage);
app.component('equipment-management-page', EquipmentManagementPage);
app.component('forgot-password-page', ForgotPasswordPage);
app.component('reset-password-page', ResetPasswordPage);
app.component('password-reset-success-page', PasswordResetSuccessPage);
app.component('dashboard-page', DashboardPage);
app.component('generate-report-page', GenerateReportPage);

// Montar a aplicação se o elemento #app existir
const appElement = document.getElementById('app');
if (appElement) {
    app.mount('#app');
}


