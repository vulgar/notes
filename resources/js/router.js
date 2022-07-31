
import {createRouter, createWebHistory} from 'vue-router';
import Notes from './components/Notes.vue';
import Tags from './components/Tags.vue';
const routes = [
    {
        name: 'Notes',
        path: '/notes',
        component: Notes,
        alias: '/'
    },
    {
        name: 'Tags',
        path: '/tags',
        component: Tags
    },
];

const router = createRouter({history:createWebHistory(), routes});
export default router;
