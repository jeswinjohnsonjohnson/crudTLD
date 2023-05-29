<template>
    <body class="authentication-bg">
        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-lg-5">
                        <div class="card">

                            <!-- Logo -->
                            <div class="card-header pt-4 pb-4 text-center bg-primary">
                                <a href="index.html">
                                    <span><img src="assets/images/logo.png" alt="logo" height="22"></span>
                                </a>
                            </div>

                            <div class="card-body p-4">

                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign In</h4>
                                    <p class="text-muted mb-4">Enter your email address and password to access admin panel.
                                    </p>
                                </div>




                                <form action="#" @submit.prevent="createEmployee">




                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input class="form-control" v-model="Form.email" type="email" id="email"
                                            placeholder="Enter your email"
                                            :class="{ 'is-invalid': submitted && v$.Form.email.$error, }"
                                            autocomplete="email">
                                        <div class="invalid-feedback" v-for="(error, index) of v$.Form.email.$errors"
                                            :key="index" autocomplete="off">
                                            <div class="error-msg">{{ error.$message }}</div>
                                        </div>
                                    </div>






                                    <div class="mb-3">
                                        <a href="pages-recoverpw.html" class="text-muted float-end"><small>Forgot your
                                                password?</small></a>


                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input v-model="Form.password" type="password" name="password" id="password"
                                                class="form-control" placeholder="Enter your password"
                                                :class="{ 'is-invalid': submitted && v$.Form.password.$error, }"
                                                autocomplete="password">

                                            <div class="invalid-feedback" v-for="(error, index) of v$.Form.password.$errors"
                                                :key="index" autocomplete="off">
                                                <div class="error-msg">{{ error.$message }}</div>
                                            </div>

                                        </div>
                                    </div>



                                    <div class="mb-3 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>

                                    <div class="mb-3 mb-0 text-center">
                                        <button type="submit" class="btn btn-primary"> <em class="mdi mdi-login"> </em> Log
                                            In </button>
                                    </div>

                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted">Don't have an account? <a href="/register"
                                        class="text-muted ms-1"><b>Sign Up</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


    </body>
</template>

<script>




import useVuelidate from "@vuelidate/core";
import { required, email, helpers } from "@vuelidate/validators";
export default {

    setup() {


        return {

            v$: useVuelidate()
        };
    },
    data() {
        return {
            Form: {
                email: '',
                password: '',
            },
            errors: {},
            submitted: false,


        };
    },
    validations: {
        Form: {
            email: {
                required: helpers.withMessage("Email is required", required),
                email: helpers.withMessage("Email is invalid", email),
            },
            password: {
                required: helpers.withMessage("Password is required", required),
            },
        },
    },

    methods: {
        createEmployee() {

            this.submitted = true;
            this.v$.$touch();
            if (this.v$.$invalid) {
                return;
            }

            console.log(this.Form);
            axios.post('/api/login', this.Form)
                .then(response => {
                    this.submit = false;
                    localStorage.setItem('token', response.data.token);
                    console.log("Logged-in Successfully");
                    this.$router.push({ name: 'employee' });
                })
                .catch(errors => {
                    let msg = "";
                    if (errors.response.data.status === false) {
                        msg = this.errors.response.data.message;
                        this.errors = {
                            password: this.msg,
                        };
                    } else {
                        this.errors = {

                        };
                    }
                });
        },
        //this.loginError = errors.response.data.message;
    }
}

</script>

