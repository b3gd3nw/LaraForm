<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <form method="POST" id="form">
                    <p>
                        <label for="firstname">First Name</label>
                        <input
                            class="form-control"
                            v-model="firstname"
                            id="firstname"
                            type="text"
                            name="firstname"
                        >
                    </p>
                    <p>
                        <label for="lastname">Last Name</label>
                        <input
                            class="form-control"
                            v-model="lastname"
                            id="lastname"
                            type="text"
                            name="firstname"
                        >
                    </p>
                    <p>
                        <label for="birthdate">Birth Date</label>
                        <input
                            class="form-control"
                            v-model="birthdate"
                            id="birthdate"
                            type="date"
                            name="birthdate"
                        >
                    </p>
                    <p>
                        <label for="reportsubject">Report Subject</label>
                        <input
                            class="form-control"
                            v-model="reportsubject"
                            id="reportsubject"
                            type="text"
                            name="reportsubject"
                        >
                    </p>
                    <p>
                        <label for="country">Country</label>
                        <select v-model="country" name="country" id="country" class="form-control">
                            <option :value="country['id']" v-for="country in countries_data" :key="country['id']">
                                {{ country['name'] }}
                            </option>
                        </select>
                    </p>
                    <p>
                        <label for="phone">Phone</label>
                        <input
                            class="form-control"
                            v-model="phone"
                            id="phone"
                            type="text"
                            name="phone"
                        >
                    </p>
                    <p>
                        <label for="email">Email</label>
                        <input
                            class="form-control"
                            v-model="email"
                            id="email"
                            type="email"
                            name="email"
                        >
                    </p>
                    <a @click="send" class="btn btn-primary btn-next">Next</a>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { required, minLength, between } from 'vuelidate/lib/validators'
// // console.log(Object.keys(allCountry));
// console.log(this.countries);
export default {
    data() {
        return {
            firstname: '',
            lastname: '',
            birthdate: '',
            reportsubject: '',
            country: '',
            phone: '',
            email: '',

        }
    },
    props : {
        countries_data: {
            type: Object.Array,
            default(){
                return {}
            }
        }
    },
    methods: {
        send() {
            console.log(this.countries);
            // let formData = new FormData(document.getElementById("form"));
            // console.log(formData);
            axios.post(
                '/api/submit_member', {
                    firstname: this.firstname,
                    lastname: this.lastname,
                    birthdate: this.birthdate,
                    reportsubject: this.reportsubject,
                    country: this.country,
                    phone: this.phone,
                    email: this.email
                }
            ).then(responce=> {
                if(responce['data'] === 200){
                    this.$cookie.set('step', 'second', 1);
                    this.$router.push('second');
                }
            });
        }


    }
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
