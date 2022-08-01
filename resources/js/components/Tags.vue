<template>
    <div class="py-4">
        <div class="flex flex-col">
            <div class="flex items-stretch">
                <input type="text" v-model="tagInput" @input="resetErrors" ref="tagInput" @keyup.enter="addTag">
                <a href="#" class="ml-4 border-slate-500 border rounded-md px-4"><button class="h-full" @click="addTag">Add Tag</button></a>
            </div>
            <span class="text-red-500" v-if="inputError && inputError.status == 422">{{ inputError.data.message }}</span>
        </div>

        <div class="flex flex-col">
            <transition-group name="list" tag="ul">
            <li v-for="(tag, tagKey) in tags" :key="tagKey" class="flex flex-row space-y-2 py-1 items-center">
                <p>{{ tag.name }}</p>
                <button href="" class="text-red-500 ml-auto block" :value="tagKey" @click="removeTag">delete</button>
            </li>
            </transition-group>
        </div>
    </div>
</template>

<style scoped>
.list-enter-active{
  transition: all 0.5s ease;
}
.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateX(30px);
}
</style>
<script>
    export default{
        data(){
            return {
                tagInput: '',
                inputError:null,
                tags: null
            }
        },
        mounted () {
            this.refreshTags();
            this.$refs.tagInput.addEven
        },
        computed:{
            cleansedInput(){
                return this.tagInput.trim();
            }
        },
        methods:{
            removeTag(e){
                let tag = this.tags[e.target.value];

                axios
                .delete('/api/tags/'+tag.id)
                .then(this.tags.splice(e.target.value, 1));
            },
            addTag(e){
                axios
                .post('/api/tags',{'name':this.cleansedInput})
                .then(response => (this.appendTag(response.data)))
                .catch(error => (this.inputError = error.response));
            },
            refreshTags(){
                axios
                .get('/api/tags')
                .then(response => (this.tags = response.data.data));
            },
            appendTag(tag){
                this.tags.push(tag);
                this.tagInput = '';
            },
            resetErrors(e){
                this.inputError = null;
            }
        }
    }
</script>
