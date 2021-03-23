<template>
    <div class="m-2">

        <div class="card mb-4">
            <div class="card-header">
                <b-button v-if="getGuard === 'user'" v-b-modal="'my-modal'" class="float-right">Add
                    Employee
                </b-button>
                <i class="fas fa-table mr-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="alert alert-success" v-if="showSuccess">
                        <span>Operation Successful</span>
                    </div>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th v-if="getGuard === 'user'">Company</th>
                            <th v-if="getGuard === 'user'">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="employee in getEmployee.data">
                            <td>{{ employee.name }}</td>
                            <td>{{ employee.email }}</td>
                            <td v-if="getGuard === 'user'">{{ employee.company.name }}</td>
                            <td v-if="getGuard === 'user'">
                                <div class="btn-group">
                                    <a href="javascript:void(0);" class="btn btn-danger"
                                       @click="deleteEmployee(employee.id)">Delete</a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <pagination :data="getEmployee"
                                @pagination-change-page="getEmployeeAction"></pagination>

                    <b-modal id="my-modal">
                        <form @submit.prevent="createEmployee">
                            <div class="form-group">
                                <label class="small mb-1" for="email">Name</label>
                                <input class="form-control py-4"
                                       id="name"
                                       v-model="formData.name"
                                       type="text" placeholder="Enter full name"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="email">Email</label>
                                <input class="form-control py-4"
                                       id="email"
                                       v-model="formData.email"
                                       type="email" placeholder="Enter email address"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="password">Password</label>
                                <input class="form-control py-4"
                                       id="password"
                                       v-model="formData.password"
                                       type="password" placeholder="Enter password"/>
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="company_id">Company</label>
                                <select v-model="formData.company_id" id="company_id"
                                        class="form-control">
                                    <option value="" disabled>Select a company</option>
                                    <option v-for="jobTitle in getAllCompany" :value="jobTitle.id"
                                            :key="jobTitle.id">
                                        {{ jobTitle.name }}
                                    </option>
                                </select>
                            </div>
                            <div
                                class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                <button type="submit" class="btn btn-primary">Add Employee
                                </button>
                            </div>
                        </form>
                    </b-modal>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
import pagination from 'laravel-vue-pagination';


export default {
    name: "Employee",
    components: {
        pagination
    },
    data() {
        return {
            formData: {
                name: '',
                email: '',
                password: '',
                company_id: ''
            },
            showSuccess: false
        }
    },
    computed: {
        ...mapGetters([
            'getEmployee',
            'getGuard',
            'getAllCompany'
        ])
    },
    methods: {
        ...mapActions([
            'getEmployeeAction',
            'createEmployeeAction',
            'deleteEmployeeAction',
            'getAllCompanyAction'
        ]),
        async createEmployee() {
            try {
                await this.createEmployeeAction(this.formData);
                location.reload();
            } catch (error) {
                console.log(error);
            }
        },

        async deleteEmployee(id) {
            try {
                console.log(id);
                await this.deleteEmployeeAction(id);
                this.showSuccess = true;
                setTimeout(() => this.showSuccess = false, 1000);
                //await this.$router.push({name: "Employee"});
                location.reload();

            } catch (error) {
                console.log(error);
            }
        }
    },
    created() {
        this.getEmployeeAction(this.$store.state.pagination.currentPage);
        this.getAllCompanyAction();
    },
}
</script>

<style scoped>

</style>
