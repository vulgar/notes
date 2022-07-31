<template>
    <div>
        <div>
            <a href="" onclick="alert('Popup')"><button>Add Note</button></a>
        </div>
        <div class="flex flex-col space-y-4 divide-y">
            <div v-for="(note, noteKey) in notes" :key="noteKey" class="flex flex-col space-y-2">
                <span class="text-lg">{{ note.title }}</span>
                <span class="">{{ note.description }}</span>
                <div class="flex flex-row gap-4">
                    <span class="text-sm px-2 rounded-full" v-for="(tag, tagKey) in note.tags" :key="tagKey">
                        {{ tag.name }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                notes: null
            }
        },
        mounted () {
            axios
            .get('/api/notes')
            .then(response => (this.notes = response.data.data))
        }
    }
</script>
