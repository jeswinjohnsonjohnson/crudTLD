<template>
  <Layout>
    <br>
    <br>
    <div style="width:1000px; color: white;" class="container p-3 bg-dark">
      <h2 class="page-title">{{ editmode ? 'Edit Employee' : 'Add Employee' }}</h2>
      <br>




      <form @submit.prevent="editmode ? updateEmployee() : createEmployee()" class="row">
        <div class="col-md-6">



          <div class="mb-3">
            <label for="name" class="form-label">Employee Name:</label>
            <input type="text" v-model="form.Employee_Name" id="name" placeholder="Enter your name" class="form-control"
              :class="{ 'is-invalid': submitted && v$.form.Employee_Name.$error, }" autocomplete="name">
            <div class="invalid-feedback" v-for="(error, index) of v$.form.Employee_Name.$errors" :key="index"
              autocomplete="off">
              <div class="error-msg">{{ error.$message }}</div>
            </div>
          </div>



          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input class="form-control" v-model="form.Email" type="email" id="email" placeholder="Enter your email"
              :class="{ 'is-invalid': submitted && v$.form.Email.$error, }" autocomplete="email">
            <div class="invalid-feedback" v-for="(error, index) of v$.form.Email.$errors" :key="index" autocomplete="off">
              <div class="error-msg">{{ error.$message }}</div>
            </div>
          </div>





          <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <textarea class="form-control" v-model="form.Address" id="address" rows="3" placeholder="Enter your Address"
              :class="{ 'is-invalid': submitted && v$.form.Address.$error, }" autocomplete="Address"></textarea>
            <div class="invalid-feedback" v-for="(error, index) of v$.form.Address.$errors" :key="index"
              autocomplete="off">
              <div class="error-msg">{{ error.$message }}</div>
            </div>
          </div>

          <div>
            <label for="example-status" class="form-label">Is Active:</label>
            <input type="checkbox" id="switch6" data-switch="success" v-model="form.Status" />
            <label for="switch6" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
          </div>


        </div>




        <div class="col-md-6">
          <div class="mb-3">
            <label for="example-date" class="form-label">Joined Date:</label>
            <input class="form-control" id="example-date" v-model="form.Date" type="date" name="date"
              placeholder="Enter your Date" :class="{ 'is-invalid': submitted && v$.form.Date.$error, }"
              autocomplete="Date">
            <div class="invalid-feedback" v-for="(error, index) of v$.form.Date.$errors" :key="index" autocomplete="off">
              <div class="error-msg">{{ error.$message }}</div>
            </div>
          </div>



          <div class="mb-3">
            <label for="example-fileinput" class="form-label">Default file input:</label>
            <input type="file" class="form-control" v-on:change="onChange">
          </div>




          <div class="form-group">
            <label for="gender">Gender:</label>
            <select class="form-control" id="gender" name="gender" v-model="form.selectedGender">
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
            </select>
          </div>

          
          <br>

          <div class="mb-3">
            <label for="phone" class="form-label">Phone:</label>
            <input type="tel" v-model="form.Phone" id="phone" class="form-control" placeholder="Enter your Phone number"
              :class="{ 'is-invalid': submitted && v$.form.Phone.$error }" autocomplete="tel">
            <div class="invalid-feedback" v-for="(error, index) of v$.form.Phone.$errors" :key="index">
              <div class="error-msg">{{ error.$message }}</div>
            </div>
          </div>




        </div>


        <div class="col-md-12">
          <button style="margin-left: 400px;" type="submit" class="btn btn-primary">{{ editmode ? 'Update' : 'Add'
          }}</button>
        </div>
      </form>
    </div>



  </Layout>
</template>
  
<script>


import useVuelidate from "@vuelidate/core";
import { required, helpers, email, numeric, minLength, maxLength } from "@vuelidate/validators";
import Layout from "../../layouts/main";

export default {
  components: {
    Layout,
  },
  setup() {
    let baseurl = process.env.MIX_BASE_URL;
    return {
      baseurl, v$: useVuelidate()
    };

  },




  data() {
    return {
      form: {
        Employee_Name: '',
        Email: '',
        Address: '',
        Date: '',
        Status: false,
        Phone: '',
        selectedGender: ''

      },
      errors: {},
      submitted: false,
      id: this.$route.params.id,
      editmode: false,
      Status: false,
    }
  },
  validations: {
    form: {
      Employee_Name: {
        required: helpers.withMessage("Name is required", required),
      },
      Email: {
        required: helpers.withMessage("Email is required", required),
        Email: helpers.withMessage("Email is invalid", email),
      },
      Address: {
        required: helpers.withMessage("Address is required", required),
      },
      Date: {
        required: helpers.withMessage("Date is required", required),

      }, Phone: {
        required,
        numeric,
        minLength: minLength(10),
        maxLength: maxLength(10),
      },

    },
  },

  mounted() {
    this.editmode = true;
    if (typeof this.id == "undefined") {
      this.editmode = false;
    }
    this.getEmployee();
  },



  methods: {
    createEmployee() {
      this.submitted = true;
      console.log(this.form);
      this.v$.$touch();
      if (this.v$.$invalid) {
        return;
      }
      axios.post('/api/employee', this.form)
        .then(() => {
          this.submit = false;
          Toast.fire({
            icon: 'success',
            title: 'Added Successfully'
          })
          this.$router.push({ name: 'employee' });
        }).catch(errors => {
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


    selectGender(gender) {
      this.selectedGender = gender;
      console.log(gender);
    },


    getEmployee() {
      axios.get('/api/employee/' + this.id)
        .then((response) => {
          this.form = response.data;
        });
    },



    updateEmployee() {
      axios.put('/api/employee/' + this.id, this.form)
        .then(() => {
          this.$router.push({ name: 'employee' });
        });
    },
  },



}

</script>