<template>
    <div class="default_top text-center">
        <a href="#" class="logo">
            <img src="/images/logo_blue.svg" class="logo_day" alt="logo">
            <img src="/images/logo_night.svg" class="logo_night" alt="logo">
        </a>
        <h2>{{ title }}</h2>
        <p class="text_xxl f_400">{{ description }}</p>
    </div>
</template>
<script>
export default {
    props: {
        title: {
            type: String,
            default: 'Header Title'
        },
        description: {
            type: String,
            default: 'Header Description'
        }
    }
}
</script>
