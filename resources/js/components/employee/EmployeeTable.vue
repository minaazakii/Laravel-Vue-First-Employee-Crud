<template>
    <div class="flex align-items-center justify-content-center">
        <div class="card w-8 h-full p-5">
            <div class="grid">
                <div class="p-input-icon-left mb-3 col-9">
                    <i class="pi pi-search"></i>
                    <InputText v-model="filters['global'].value" @input="filterTable" placeholder="Search"></InputText>
                </div>

                <div class="col-3 ">
                    <a href="/add-employee" class="btn btn-primary">Add Employee</a>
                </div>
            </div>
            <DataTable v-model:filters="filters" :value="employees" :rows="5" :paginator="true">
                <Column field="name" header="Username"></Column>
                <Column field="email" header="email"></Column>
                <Column field="section" header="Section"></Column>
                <Column field="department" header="Department"></Column>

                <Column headerStyle="width: 4rem; text-align: center" bodyStyle="text-align: center; overflow: visible">
                    <template #body="{ data }">
                        <Button @click="deleteConfirm(data)" class="p-button-outlined p-button-danger" type="button"
                            icon="pi pi-trash"></Button>
                    </template>
                </Column>

                <Column headerStyle="width: 4rem; text-align: center" bodyStyle="text-align: center; overflow: visible">
                    <template #body="{ data }">
                        <Button @click="edit(data)" class="p-button-outlined p-button-warning" type="button"
                            icon="pi pi-user-edit"></Button>
                    </template>
                </Column>
            </DataTable>

            <Dialog header="Edit Employee" v-model:visible="displayEditModal" :modal="true">

                <span class="p-input">
                    <InputText class="w-full" id="username" type="text" v-model="form.name" placeholder="Username" />
                </span>

                <span class="p-input">
                    <InputText class="w-full mt-2" id="username" type="text" v-model="form.department"
                        placeholder="Department" />
                </span>

                <span class="p-input">
                    <InputText class="w-full mt-2" id="username" type="text" v-model="form.section" placeholder="Section" />
                </span>

                <span class="p-input">
                    <InputText class="w-full mt-2" id="username" type="text" v-model="form.email" placeholder="Email" />
                </span>

                <div class="mt-3 ">
                    <Button label="Submit" @click="updateEmployee" class="p-button-raised p-button-rounded w-full" />
                </div>
            </Dialog>

            <Dialog header="Delete Confirmation" v-model:visible="displayDeleteConfirmation" :style="{ width: '350px' }"
                :modal="true">
                <div class="confirmation-content">
                    <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
                    <span>Are you sure you want to Delete Employee?</span>
                </div>
                <template #footer>
                    <Button label="No" icon="pi pi-times" @click="dontDelete()" class="p-button-text" />
                    <Button label="Yes" icon="pi pi-check" @click="DeleteEmployee()" class="p-button-text" autofocus />
                </template>
            </Dialog>

        </div>
    </div>
</template>

<script>
import DataTable from 'primevue/datatable';
import { FilterMatchMode } from 'primevue/api';
import Column from 'primevue/column';
import { mapGetters } from 'vuex'
import Dialog from 'primevue/dialog';

export default {
    components: {
        DataTable, Column, Dialog
    },
    computed: {
        ...mapGetters({
            employees: 'getEmployees'
        })
    },
    mounted() {
        this.$store.dispatch('getEmployees');
    },
    data() {
        return {
            deleteId: '',
            form: {
                id: '',
                name: '',
                department: '',
                section: '',
                email: ''
            },
            filters: {
                'global': { value: null, matchMode: FilterMatchMode.CONTAINS },
            },
            displayEditModal: false,
            displayDeleteConfirmation: false
        };
    },
    methods: {
        edit(data) {
            this.displayEditModal = true;
            this.form.id = data.id;
            this.form.email = data.email
            this.form.section = data.section
            this.form.name = data.name
            this.form.department = data.department
            console.log(data)
        },
        async updateEmployee() {

            try {
                const response = await this.$store.dispatch('updateEmployee', this.form)
                console.log(response)
                alert(response.data.message)
                this.$store.dispatch('getEmployees');
                this.displayEditModal = false;
            } catch (e) {
                console.log(e)
                alert('error')
            }
        },
        deleteConfirm(data) {
            this.displayDeleteConfirmation = true
            this.deleteId = data.id;
        },
        async DeleteEmployee() {
            console.log(this.deleteId)
            try {
                const response = await this.$store.dispatch('deleteEmployee', this.deleteId)
                this.$store.dispatch('getEmployees');
                alert(response.data.message)
                this.displayDeleteConfirmation = false
            }catch(e)
            {
                alert('error')
                console.log(e)
            }

        },
        dontDelete()
        {
            this.displayDeleteConfirmation = false
        }
    }
}
</script>

<style></style>
