<template>
    <div>
        <Header />
        <router-view />
    </div>
</template>
<script>

import Header from '../components/header.vue';

export default{
    name: "main-layout",
    components: {
        Header
    }
}
</script>