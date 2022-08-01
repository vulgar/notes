<template>
    <div class="py-4">
        <a href="#" class="mt-4 border-slate-500 border rounded-md px-4" @click="showModal = true"><button>Add Note</button></a>
        <Modal v-if="showModal" @close="showModal = false" @added="noteAdded" />
        <div class="flex flex-col divide-y">
            <transition-group name="list">
            <div v-for="(note, noteKey) in notes" :key="noteKey" :data-index="noteKey" class="flex flex-col space-y-2 py-4">
                <div class="flex flex-col md:flex-row">
                    <span class="text-lg font-bold">{{ note.title }}</span>
                    <span class="text-sm md:ml-auto md:mt-auto text-slate-400">Created: {{ note.createdOn}}</span>
                </div>
                <span class="">{{ note.description }}</span>
                <div class="flex flex-row gap-4">
                    <span class="text-sm px-2 rounded-md bg-slate-200" v-for="(tag, tagKey) in note.tags" :key="tagKey">
                        {{ tag.name }}
                    </span>
                </div>
            </div>
            </transition-group>
        </div>
    </div>
</template>
<style scoped>
.list-enter-active,
.list-leave-active {
  transition: all 0.5s ease;
}
.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateX(30px);
}
</style>
<script>
    import Modal from './Modal.vue';
    export default{
        data(){
            return {
                notes: null,
                showModal: false
            }
        },
        mounted () {
            axios
            .get('/api/notes')
            .then(response => (this.notes = response.data.data))
        },
        methods:{
            noteAdded(note){
                this.showModal = false;
                this.notes.push(note);
            }
        },
        components:{Modal}
    }
</script>
