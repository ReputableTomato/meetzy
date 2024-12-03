<template>
    <PreLoader />
    <TopNav :user="user" />

    <div class="main_dashboard">
        <SideBar :user="user" />

        <!-- overlay -->
        <div class="overlay pb_32 d-lg-none d-block"> </div>
        <OnlineFriendsList />

        <!-- Main Content -->
        <div class="main_content">
            <div class="container-fluid">
<!--                <SiteAlert />-->

                <div class="row">
                    <div class="col-lg-7 order-2 order-lg-1">
                        <NewPost :user="user" />

                        <!-- posts -->
                        <div class="posts">
                            <div class="post" v-for="post in $store.state.posts" :class="$store.state.isNightMode ? 'bg-black' : 'bg-white'" :key="post._id">
                                <Post @image-viewer-clicked="showImageViewer" :post="post" :user="user" />
                            </div>
                        </div>

                        <div ref="loadingDiv" class="loading-div"></div>
                    </div>

                    <div class="col-lg-5 order-1 order-lg-2">
                        <Events />
                        <Updates />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ImageViewerPopup v-if="imageViewerModalAsset.post._id" :post="imageViewerModalAsset.post" :show-comment-section="false" />
</template>

<script>
import { defineAsyncComponent } from 'vue';
import axios from "axios";
import { useToast } from "vue-toastification";

import SideBar from "@/Shared/Layout/SideBar.vue";
import TopNav from "@/Shared/Layout/TopNav.vue";
import PreLoader from "@/Shared/PreLoader.vue";

export default {
    components: {
		PreLoader,
		SideBar,
		TopNav,
        OnlineFriendsList: defineAsyncComponent(() => import('@/Shared/Layout/OnlineFriendsList.vue')),
        Events: defineAsyncComponent(() => import('@/Shared/Sections/Events.vue')),
        Updates: defineAsyncComponent(() => import('@/Shared/Sections/Updates.vue')),
        SiteAlert: defineAsyncComponent(() => import('@/Shared/Sections/SiteAlert.vue')),
        Post: defineAsyncComponent(() => import('@/Shared/Sections/Post.vue')),
        NewPost: defineAsyncComponent(() => import('@/Shared/NewPost.vue')),
        ImageViewerPopup: defineAsyncComponent(() => import('@/Shared/ImageViewerPopup.vue'))
    },
    data() {
        return {
            user: {
                profile_picture: {},
				settings: {
					render_media: null
				},
            },
            observer: null,
            nextPage: null,
            imageViewerModal: null,
            imageViewerModalAsset: {
                post: {
                    user: {
                        profile_picture: {}
                    },
                    assets: [],
					comments: []
                }
            }
        }
    },
    mounted() {
        this.getUser();
        this.getPosts();
		this.toast = useToast();

        this.observer = new IntersectionObserver(this.handleIntersection, {
            root: null,
            rootMargin: '0px',
            threshold: 1
        });
        const loadingDiv = this.$refs.loadingDiv;

        if (loadingDiv) {
            this.observer.observe(loadingDiv);
        }
    },
    methods: {
        getUser() {
            axios.get('/user')
                .then(response => {
                    this.user = response.data;

                    this.setupWebsocketChannels();
                })
                .catch(error => {
                    console.error(error);
                });
        },
        getPosts(url = null) {
            const apiUrl = url ? url : '/post';

            axios.get(apiUrl)
                .then(response => {
                    if (this.$store.state.posts.length > 0) {
                        this.$store.state.posts.push(...response.data.data);
                    } else {
                        this.$store.state.posts = response.data.data;
                    }

                    this.nextPage = response.data.next_page_url;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        setupWebsocketChannels() {
            window.echo.private(`notifications.${this.user.id}`)
                .listen('.PostAdded', (e) => {
                    this.$store.state.posts.unshift(e.post);
                })
                .listen('.PostDeleted', (e) => {
                    this.postDeleted(e.post)
                })
        },
        async handleIntersection(entries, observer) {
            if (entries[0].isIntersecting) {
                if (this.nextPage) {
                    this.getPosts(this.nextPage);
                }
            }
        },
        showImageViewer(post) {
            this.imageViewerModalAsset.post = post;

            this.$nextTick(() => {
                const imageViewerModal = document.getElementById('imageViewerModal');

                if (!imageViewerModal) {
                    return;
                }

                this.imageViewerModal = new bootstrap.Modal(imageViewerModal);
                this.imageViewerModal.show();
            });
        }
	}
};
</script>
