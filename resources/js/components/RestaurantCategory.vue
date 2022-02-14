<template>
    <div class="container">
        <h2>Restaurant Category</h2>
        <div class="row">
            <div class="col-12 col-md-3" v-for="restaurant in this.restaurants" v-bind:key="restaurant.id">
                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <img :src="`storage/${restaurant.image}`" class="card-img-top" alt="image category">
                    <div class="card-body">
                        <h5 class="card-title">{{ restaurant.name }}</h5>
                        <p class="card-text">{{ restaurant.direction }}</p>
                        <p class="card-text">{{ restaurant.open_time }} - {{ restaurant.close_time }}</p>
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
        axios.get('/api/categories/restaurant')
            .then(response => {
                this.$store.commit("ADD_RESTAURANT", response.data);
            })
            .catch(function (error) {
                console.log(error);
            })
    },
    computed: {
        restaurants() {
            return this.$store.state.restaurants;
        }
    }
}
</script>
