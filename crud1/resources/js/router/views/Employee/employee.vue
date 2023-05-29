<template>
    <Layout>

        <div>
            <br>
            <br>
            <h2>Employee Management</h2>
            <div><br>
                <button type="button" class="btn btn-success" @click="AddNewForm(employee)">Add</button>
            </div>

            <br>


            <table class="table table-dark mb-0">

                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Employee Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">IsActive</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Joined Date</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>

                    <tr v-if="loading">
                        <td colspan="7">
                            <div class="spinner-border text-warning" role="status"></div>
                        </td>
                    </tr>




                    <tr v-else v-for="employee in emp" :key="employee.id">
                        <td>{{ employee.id }}</td>
                        <td>{{ employee.Employee_Name }}</td>
                        <td>{{ employee.Address }}</td>
                        <td>{{ employee.Email }}</td>
                        <td>{{ employee.Phone }}</td>
                        <td :style="{ color: employee.Status ? 'green' : 'red' }">{{ employee.Status ? 'Active' : 'Inactive'
                        }}</td>


                        <td>
                            <span v-if="employee.selectedGender === 'male'" class="gender-icon male">Male ♂</span>
                            <span v-else-if="employee.selectedGender === 'female'" class="gender-icon female">Female
                             &nbsp; ♀</span>
                            <span v-else class="gender-icon other"> Others ⚥</span>
                        </td>


                        <td>{{ employee.Date }}</td>
                        <td>
                            <button type="button" class="btn btn-warning" @click="editEmployee(employee)">Edit</button>
                            &nbsp;
                            <button type="button" class="btn btn-danger" @click="deleteEmployee(employee)">Delete</button>
                        </td>
                    </tr>



                </tbody>
            </table>



        </div>



    </Layout>
</template>
 



<script>






import Layout from "../../layouts/main"
export default {
    components: {
        Layout,
    },
    setup() {
        let baseurl = process.env.MIX_BASE_URL;

        return {
            baseurl,
        };
    },
    methods: {},

    data() {
        return {
            emp: [],
            form: {

                Employee_Name: '',
                Email: '',
                Address: '',
                Date: '',
                Status: false,
                Phone: '',
                selectedGender: ''
            },
            loading: false
        };
    },
    created() {

        this.loadEmployees();
    },

    methods: {

        loadEmployees() {
            this.loading = true;

            axios.get('/api/employee')
                .then((response) => {
                    this.emp = response.data;
                    this.loading = false;
                })
                .catch((error) => {
                    console.error('Error fetching employees:', error);
                    this.loading = false;
                });
        },



        deleteEmployee(employee) {

            axios.delete('/api/employee/' + employee.id).then(() => {
                this.loadEmployees();
            });
        },

        editEmployee(employee) {
            this.$router.push({ name: 'update-employee', params: { id: employee.id } });
        },

        AddNewForm() {
            this.$router.push({ name: 'add-employee' });
        },

    }
}


</script>



<style scoped></style>