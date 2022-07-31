<template>
    <div class="p-4">
        <div class="flex gap-4">
            <router-link to="/notes">Notes</router-link>
            <router-link to="/tags">Tags</router-link>
        </div>
        <div class="flex flex-row d">
            <router-view v-slot="{ Component }">
                <transition name="fade">
                    <component :is="Component" />
                    </transition>
            </router-view>
        </div>
    </div>
</template>
<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
.router-link-active{
    @apply font-bold;
}
</style>
<script>
    export default{
        data(){
            return {
                category: "notes",
            }
        }
    }
</script>
