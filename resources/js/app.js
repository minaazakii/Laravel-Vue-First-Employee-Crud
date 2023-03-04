
// import './bootstrap';
import PrimeVue from 'primevue/config';
import { createApp } from 'vue';
import  store  from './store/index.js'
import ToastService from 'primevue/toastservice';

import 'primevue/resources/themes/saga-blue/theme.css';
import 'primevue/resources/primevue.min.css';
import 'primeicons/primeicons.css';
import 'primeflex/primeflex.scss'

import ExampleComponent from './components/ExampleComponent.vue';
import EmployeeFormComponent from './components/employee/EmployeeForm.vue';
import EmployeeTableComponent from './components/employee/EmployeeTable.vue'

import InputText from 'primevue/inputtext';
import Button from 'primevue/button';


const app = createApp({});
app.component('example-component', ExampleComponent);
app.component('employee-form', EmployeeFormComponent);
app.component('employee-table', EmployeeTableComponent);

app.component('InputText', InputText);
app.component('Button', Button);

app.use(ToastService);
app.use(PrimeVue);
app.use(store);
app.mount('#app');
