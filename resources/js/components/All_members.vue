<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-center">All members</h1>
            </div>
        </div>
        <div class="table_wrapper wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-container">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Report subject</th>
                                <th>Email</th>
                            </tr>d
                            </thead>
                            <tbody>
                            <tr v-for="member in members">
                                <td scope="row">{{ member.member.id }}</td>
                                <td v-if="member.photo != null">
                                    <img class="user_photo"
                                         :src="'/storage/' + member.photo"
                                         alt="user_photo">
                                </td>
                                <td v-else>
                                    <img class="user_photo"
                                         src="https://randomuser.me/api/portraits/lego/6.jpg"
                                         alt="user_photo">
                                </td>
                                <td>{{ member.member.firstname }} {{ member.member.lastname }}</td>
                                <td class="report_subject">{{ member.member.reportsubject}}</td>
                                <td><a href="mailto:">{{ member.member.email }}</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 back_to_home">
                <router-link :to="'homepage'" id="back_to_home" class="btn btn-primary">Back to homepage</router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "All_members",
    data() {
        return {
            members: null,
            key: 0
        }
    },
    mounted() {
        let self = this
        axios.get('/api/members')
            .then(response => {
                self.members = response.data
                console.log(response.data);
            });
    }
}
</script>

<style scoped>
img {
    height: 50px;
    weight: 50px;
}
</style>
