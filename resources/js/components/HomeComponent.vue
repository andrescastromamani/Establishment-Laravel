<template>
    <div class="">
        <hospital-category></hospital-category>
        <restaurant-category></restaurant-category>
        <gym-category></gym-category>
        <university-category></university-category>
    </div>
</template>
<script>
import HospitalCategory from './HospitalCategory.vue';
import RestaurantCategory from './RestaurantCategory.vue';
import UniversityCategory from "./UniversityCategory";
import GymCategory from "./GymCategory";

export default {
    components: {
        'hospital-category': HospitalCategory,
        'restaurant-category': RestaurantCategory,
        'gym-category': GymCategory,
        'university-category': UniversityCategory
    }
}
</script>
