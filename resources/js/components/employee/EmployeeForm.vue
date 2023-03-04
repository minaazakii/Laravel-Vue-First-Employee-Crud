<template>
    <div class="container">
        <Toast />
        <div class="spinner-container" v-if="isLoading">
            <ProgressSpinner />
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Employee</div>
                    <form @submit.prevent="addEmployee()">
                        <div class="card-body">

                            <span class="p-input">
                                <InputText class="w-full" id="username" type="text" v-model="form.username"
                                    placeholder="Username" />
                            </span>

                            <span class="p-input">
                                <InputText class="w-full mt-2" id="username" type="text" v-model="form.department"
                                    placeholder="Department" />
                            </span>

                            <span class="p-input">
                                <InputText class="w-full mt-2" id="username" type="text" v-model="form.section"
                                    placeholder="Section" />
                            </span>

                            <span class="p-input">
                                <InputText class="w-full mt-2" id="username" type="text" v-model="form.email"
                                    placeholder="Email" />
                            </span>

                            <div class="mt-3 ">
                                <Button label="Submit" type="submit" class="p-button-raised p-button-rounded w-full" />
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Toast from 'primevue/toast';
import ProgressSpinner from 'primevue/progressspinner';
export default {
    components:
    {
        Toast,
        ProgressSpinner
    },
    name: 'employeeForm',
    data() {
        return {
            form: {
                username: '',
                department: '',
                section: '',
                email: ''
            },
            isLoading: false

        }
    },
    methods: {
        async addEmployee() {
            this.isLoading = true;
            setTimeout(() => {

            }, 2000);
            try {
                const response = await this.$store.dispatch('saveEmployee', this.form);
                if (response) { this.isLoading = false; }
                this.$toast.add({
                    severity: 'success',
                    summary: 'Success',
                    detail: 'Employee Added successfully'
                });
            }
            catch (error) {
                if (error) { this.isLoading = false; }
                this.$toast.add({
                    severity: 'error',
                    summary: 'Error',
                    detail: error.message
                });
            }

        },
    }
}
</script>

<style>
.spinner-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.8);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
