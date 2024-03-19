<template>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <!-- Navbar start-->
        <Navbar/>
        <!-- end -->
        <!-- Sidebar -->
        <Sidebar/>
        <!-- end -->
        <slot></slot>
    </div>
</template>
<script setup>
import { onMounted } from "vue"
import { initFlowbite } from "flowbite"
import Navbar from './Navbar.vue'
import Sidebar from './Sidebar.vue'


onMounted(() => {
    initFlowbite();
});
</script>
