<template>
    <div class="container">
        <h2>Hospital Category</h2>
        <div class="row">
            <div class="col-12 col-md-3" v-for="hospital in this.hospitals" v-bind:key="hospital.id">
                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <img :src="`storage/${hospital.image}`" class="card-img-top" alt="image category">
                    <div class="card-body">
                        <h5 class="card-title">{{ hospital.name }}</h5>
                        <p class="card-text">{{ hospital.direction }}</p>
                        <p class="card-text">{{ hospital.open_time }} - {{ hospital.close_time }}</p>
                        <a href="#" class="btn btn-dark d-block">Show More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    mounted() {
        axios.get('/api/categories/hospital')
            .then(response => {
                this.$store.commit("ADD_HOSPITAL", response.data);
            })
            .catch(function (error) {
                console.log(error);
            })
    },
    computed: {
        hospitals() {
            return this.$store.state.hospitals;
        }
    }
}
</script>
