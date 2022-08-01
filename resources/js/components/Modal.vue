<template>
  <transition name="modal">
    <div
      class="
        fixed
        z-[9998]
        h-screen
        w-screen
        bg-opacity-50 bg-slate-500
        top-0
        left-0
        flex
        items-center
        justify-center
      "
    >
      <div class="modal-wrapper bg-white max-w-screen-sm">
        <div class="p-4">
          <div class="modal-header"></div>

          <div class="modal-body flex flex-col">
            <label for="title">Title</label>
            <input type="text" id="title" v-model="note.title" />

            <label for="description" class="mt-3">Description</label>
            <textarea id="description" v-model="note.description"></textarea>

            <label class="mt-3">Tags</label>
            <div class="border border-slate-500 p-4">
              <ul>
                <li v-for="(tag, tagKey) in tags" :key="tagKey">
                  <input
                    :id="'tag' + tag.id"
                    type="checkbox"
                    :value="tag.id"
                    v-model="note.tags"
                  />
                  <label :for="'tag' + tag.id" class="ml-2">{{
                    tag.name
                  }}</label>
                </li>
              </ul>
            </div>
          </div>

          <span
            class="text-red-500 my-3"
            v-if="inputError && inputError.status == 422"
            >{{ inputError.data.message }}</span
          >

          <div class="flex">
            <button class="mt-2 mr-auto" @click="$emit('close')">cancel</button>
            <button
              class="mt-2 ml-auto px-3 py-2 bg-blue-500 text-white"
              @click="submit"
            >
              OK
            </button>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>
<style scoped>
/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>
<script>
export default {
  data() {
    return {
      tags: null,
      note: null,
      inputError: null,
    };
  },
  props: {
    editNote: {
      type: Object,
      default() {
        return {
          title: "",
          description: "",
          tags: [],
        };
      },
    },
  },
  created() {
    this.note = this.editNote;
    window.addEventListener("keydown", (e) => {
      if (e.key == "Escape") {
        this.$emit("close");
      }
    });
  },
  mounted() {
    // check if it is update, and populate the note
    // populate tags for selection
    this.refreshTags();
  },
  methods: {
    refreshTags() {
      axios
        .get("/api/tags")
        .then((response) => (this.tags = response.data.data));
    },
    submit(e) {
      axios
        .post("/api/notes", this.note)
        .then((response) => (this.$emit('added', response.data.data) ))
        // .then((response) => (console.log(response) ))
        .catch(error => (this.inputError = error.response));
        // .catch(error => (console.log(error)));
    },
  },
};
</script>
