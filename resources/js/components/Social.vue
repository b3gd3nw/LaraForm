<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 text-center">
                <div class="item">
                    <a href="https://www.facebook.com/sharer/sharer.php?u="
                       onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                        <img src="/img/facebook.svg" alt="facebook">
                    </a>
                </div>
            </div>
            <div class="col-sm-6 text-center">
                <div class="item">
                    <a href="http://twitter.com/share?&url="
                       onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                        <img src="/img/twitter.svg" alt="twitter">
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <router-link :to="'all_members'" id="counter" class="float-right">All members: {{ counter }}  </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            counter: ''
        }
    },
    name: "Social",
    mounted() {
        let self = this
        axios.get('/api/members')
            .then(response => {
                self.counter = response.data
            });
    }
}
</script>

<style scoped>
    .item>a>img {
        height: 100px;
        width: 100px;
    }
</style>
