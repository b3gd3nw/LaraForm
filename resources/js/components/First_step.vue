<template>
  <div class="container">
    <div class="title text-center">
      <h2>
        To participate in the conference, please fill out the form
      </h2>
    </div>
    <div class="row">
      <div class="col-sm-12 text-center">
        <notifications group="foo" position="top center" ignoreDuplicates/>
        <ValidationObserver v-slot="{ handleSubmit }">
          <form @submit.prevent="handleSubmit(send)" method="POST" id="form">
            <p>
              <label for="firstname">First Name</label>
              <ValidationProvider rules="required|max:20|min:1" v-slot="{ errors }">
                <input
                    v-model="formData.firstname"
                    class="form-control"
                    id="firstname"
                    type="text"
                    name="firstname"
                    v-on:keypress="noDigits($event)"
                >
                <span  class="text-danger">{{ errors[0] }}</span>
              </ValidationProvider>
            </p>
            <p>
              <label for="lastname">Last Name</label>
              <ValidationProvider rules="required|max:20|min:1" v-slot="{ errors }">
                <input
                    v-model="formData.lastname"
                    class="form-control"
                    id="lastname"
                    type="text"
                    name="lastname"
                    v-on:keypress="noDigits($event)"
                >
                <span class="text-danger">{{ errors[0] }}</span>
              </ValidationProvider>
            </p>
            <p>
              <label for="birthdate">Birth Date</label>
              <ValidationProvider rules="required" v-slot="{ errors }">
                <datepicker
                    format="yyyy-MM-dd"
                    :disabled-dates="disabledDates"
                    v-model="formData.birthdate"
                    name="birthdate"
                    id="birthdate"
                    :input-class="'form-control'"
                    placeholder="Select Date">
                </datepicker>
                <span class="text-danger">{{ errors[0] }}</span>
              </ValidationProvider>
            </p>
            <p>

              <label for="reportsubject">Report Subject</label>
              <ValidationProvider rules="required|max:200|min:1" v-slot="{ errors }">
                <input
                    v-model="formData.reportsubject"
                    class="form-control"
                    id="reportsubject"
                    type="text"
                    name="reportsubject"
                >
                <span class="text-danger">{{ errors[0] }}</span>
              </ValidationProvider>
            </p>
            <p>
              <label for="countryId">Country</label>
              <ValidationProvider rules="required|max:200|min:1" v-slot="{ errors }">
                <select v-model="formData.countryId" name="countryId" id="countryId" class="form-control">
                  <option :value="country['id']" v-for="country in countries_data" :key="country['id']">
                    {{ country['name'] }}
                  </option>
                </select>
                <span class="text-danger">{{ errors[0] }}</span>
              </ValidationProvider>
            </p>
            <p>
              <label>Phone</label>
              <br>
              <ValidationProvider rules="required|max:20|min:11" v-slot="{ errors }">
                <phone-mask-input
                    v-model="phone"
                    inputClass="form-control"
                    id="phone"
                >
                </phone-mask-input>
                <span class="text-danger">{{ errors[0] }}</span>
              </ValidationProvider>
            </p>
            <p>

              <label for="email">Email</label>
              <ValidationProvider rules="required|email" v-slot="{ errors }">
                <input
                    v-model="formData.email"
                    class="form-control"
                    id="email"
                    type="email"
                    name="email"
                >
                <span class="text-danger">{{ errors[0] }}</span>
                <span class="text-danger">{{ error_mail }}</span>
              </ValidationProvider>
            </p>
            <button type="submit" class="btn btn-primary btn-next">Next</button>
          </form>
        </ValidationObserver>
      </div>
    </div>
    <div>{{ formData.phone }}</div>
  </div>
</template>


<script>
// Import moment
import moment from "moment";


export default {
  props : {
    countries_data: {
      type: Object.Array,
      default(){
        return {}
      }
    }
  },
  data: () => ({
    formData: {
      firstname: '',
      lastname: '',
      birthdate: '',
      reportsubject: '',
      countryId: '',
      phone: '',
      email: ''
    },
    phone: '',
    disabledDates: {
      from: new Date(Date.now() - 1)
    },
    error_mail: null
  }),
  methods: {
    send() {
      let formData = new FormData(document.getElementById("form"));
      if( /\d|[/?<>;:{}!@#$%^&*()+=]/.test(this.formData.firstname) || /\d|[/?<>;:{}!@#$%^&*()+=]/.test(this.formData.lastname) ) {
        console.log('Digit find!');
        this.$notify({
          group: 'foo',
          type: 'error',
          title: 'Attention',
          text: 'Use only letters to fill "First Name" and "Last Name" fields!'
        });
      } else {
        formData.append('phone', this.phone);
        axios.post(
            '/api/members', formData)
            .then(responce=> {
              if(responce['data']['exists'] === true){
                this.$notify({
                  group: 'foo',
                  type: 'error',
                  title: 'Attention',
                  text: 'This email already use!'
                });
              }else {
                this.$cookie.set('step', 'second', 1);
                this.$router.push('second');
              }
            });
      }
    },
    noDigits(e) {
      let char = String.fromCharCode(e.keyCode); // Get the character
      if(/\d/.test(char)) e.preventDefault(); // Match with regex
      else return true; // If not match, don't add to input text
    },
  },
}

</script>

<style scoped>

label {
  float: left;
}

.btn-next {
  float: right;
}
</style>
