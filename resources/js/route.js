import Vue from 'vue';
import Router from 'vue-router';
import GalleryView from './components/GalleryView.vue';
import uploadImage from './components/uploadImage.vue';
Vue.use(Router)
const routes = [
    {
        name: 'home',
        path: '/',
        component: uploadImage
    },
    {
        name: 'galleryview',
        path: '/galleryview',
        component: GalleryView
    },
]

const router = new Router({
    mode: 'history',
    routes
});

export default router;
