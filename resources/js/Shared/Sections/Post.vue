<template>
    <div class="post_header mb_10 pl_8 pt_8 pb_8 d-flex align-items-center justify-content-between">
        <div class="post_header_left d-flex align-items-center">
			<Link :href="'/u/' + post.user.username" class="profile_img profile_img_48 mr_10">
				<img :src="post.user.profile_picture.url" :alt="post.user.first_name + '\'s profile picture'">
			</Link>
            <div class="post_profile_info">
                <div class="d-flex align-items-center pb_8">
					<Link :href="'/u/' + post.user.username" class="site_icon f_700 title18">
						{{ post.user.first_name }}
					</Link>
                    <p class="text_sm text_bodyColor50 pl_5 pr_5">{{ post.user.age }} . </p>
                    <p class="text_sm text_bodyColor50" :title="post.created_at_title">{{ post.created_at_display }}</p>
                </div>
                <p class="text_sm text_bodyColor50"><a :href="'/u/' + post.user.username + '/followers'">{{ post.user.follower_count }} followers</a></p>
            </div>
        </div>
        <div class="more">
            <div class="dropdown">
                <div class="dropdown">
                    <!-- Three dots button -->
                    <button class="btn btn-link text-dark border-0 fs-3 p-0 d-flex align-items-center justify-content-center rounded-circle" :class="$store.state.isNightMode ? 'post-more-dark' : 'post-more-light'" type="button" id="moreDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="width: 35px; height: 35px;">
                        <i class="bi bi-three-dots" :class="$store.state.isNightMode ? ' text-white' : 'text-dark'"></i>
                    </button>

                    <!-- Dropdown menu -->
                    <ul class="dropdown-menu dropdown-menu-end" :class="$store.state.isNightMode ? 'dropdown-menu-dark' : ''" aria-labelledby="moreDropdown">
                        <li><button class="dropdown-item fs-4" v-if="post.user.id === user.id" @click="deletePost(post._id)">Delete</button></li>
                        <li><button class="dropdown-item fs-4">Report</button></li>
                        <li><button class="dropdown-item fs-4">Favourite</button></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="post_text pl_8 pr_8">
        <div id="post-content" v-html="processedContent"></div>

		<AudioRecording v-for="asset in post.audio_assets" v-if="post.audio_assets.length > 0" :key="asset" :container-classes="$store.state.isNightMode ? 'bg-dark mt-4' : 'bg-white mt-4'" is-embedded="true" :path="asset.url" />

        <div class="post_tags_list d-flex align-items-center gap_8">
            <button class="post_tag" v-for="tag in post.tags">#{{ tag }}</button>
        </div>

        <a href="#" class="post_link text_blue f_700 d-flex align-items-center mb-4">
            See Translation <img src="/images/To-Right.svg" class="icon16" alt="Right">
        </a>
    </div>
    <div class="post_images pt_20 pb_12" v-if="post.image_assets.length === 1">
        <img role="button" :src="post.image_assets[0].url" alt="..." @click="$emit('imageViewerClicked', post)">
    </div>
    <div id="carouselExample" class="carousel slide post_images pt_20 pb_12" v-if="post.image_assets && post.image_assets.length > 1">
        <div class="carousel-inner">
            <div class="carousel-item" :class="{'active' : index === 0}" v-for="(asset, index) in post.image_assets">
                <img role="button" :src="asset.url" alt="..." @click="$emit('imageViewerClicked', post)">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- post_bottom -->
    <div class="post_bottom">
        <div class="post_bottom_top d-flex align-items-center">
            <button type="button" class="like_button d-flex align-items-center pr_12" @click="likePost">
                <img src="/images/icons/liked-button.svg" alt="Like Icon" class="icon20 mr_5" v-if="post.liked_by_user" />
                <img src="/images/icons/like-button.svg" alt="Like Icon" class="icon20 mr_5" v-else />
                <p class="text_sm" v-if="post.like_count === 1"><span class="like_num">{{ post.like_count }} Like</span></p>
                <p class="text_sm" v-else><span class="like_num">{{ post.like_count }} Likes</span></p>
            </button>

            <button type="button" class="comment_button collapsed d-flex align-items-center pl_12" data-bs-toggle="collapse" :href="'#comment_collapse_btn_' + post._id" role="button" aria-expanded="false" :aria-controls="'comment_collapse_btn_' + post._id" @click="getComments(post)">
                <svg class="icon20 mr_5" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.8083 11.3417C17.2666 14.625 14.825 17.15 11.5583 17.7667C9.76662 18.1083 8.06661 17.8417 6.59994 17.15C6.35828 17.0333 5.9666 16.9833 5.70827 17.0417C5.15827 17.175 4.2333 17.4 3.44997 17.5833C2.69997 17.7667 2.23331 17.3 2.41664 16.55L2.95828 14.3C3.02495 14.0417 2.96661 13.6417 2.84994 13.4C2.18328 12 1.91663 10.375 2.19163 8.66667C2.72496 5.38334 5.37497 2.725 8.6583 2.18334C14.075 1.30834 18.6916 5.925 17.8083 11.3417Z" stroke="#4182EB" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M11.7412 5.48334C13.0245 5.98334 14.0412 7.00834 14.5245 8.3" stroke="#4182EB" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

                <p class="text_sm" v-if="post.comment_count === 1">{{ post.comment_count }} Comment</p>
                <p class="text_sm" v-else-if="post.comment_count > 1">{{ post.comment_count }} Comments</p>
                <p class="text_sm" v-else>No Comments</p>
            </button>
        </div>

		<div class="collapse" :id="'comment_collapse_btn_' + post._id">
            <div class="comment_box">
				<button type="button" class="btn btn-outline-primary w-100 fs-4" v-if="post.comments && post.comments.next_page_url" @click="loadMoreComments">Load More</button>
                <div class="default_post_wrap" v-for="comment in post.comments.data" v-if="post.comments">
                    <PostComment :post="post" :comment="comment" :user="user" />
                </div>
                <div class="default_post_wrap" v-if="post.comment_count === 0">
                    <p class="text-center text-muted">No comments yet.</p>
                </div>
            </div>

            <NewComment :post="post" />
        </div>
    </div>
</template>
<script>
import { defineAsyncComponent } from 'vue';
import axios from "axios";
import DOMPurify from 'dompurify';
import {useToast} from "vue-toastification";
import {Link} from "@inertiajs/vue3";

export default {
    components: {
		Link,
		AudioRecording: defineAsyncComponent(() => import('@/Shared/AudioRecording.vue')),
        PostComment: defineAsyncComponent(() => import('@/Shared/Sections/Post/PostComment.vue')),
        NewComment: defineAsyncComponent(() => import('@/Shared/NewComment.vue'))
    },
    props: {
        post: {
            type: Object,
            required: true
        },
        user: {
            type: Object,
            required: true
        }
    },
    computed: {
        processedContent() {
            this.post.content = this.post.content.replace(/<p><\/p>/g, '<p>&nbsp;</p>');

            return this.withReplacements(this.post.content);
        }
    },
    data() {
        return {
            toast: null
        }
    },
    mounted() {
        this.toast = useToast();
    },
    methods: {
        getComments(post) {
            axios.get(`/post/${post._id}/comments`)
                .then(response => {
					response.data.data = response.data.data.slice().reverse();
					this.post.comments = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
		loadMoreComments() {
			axios.get(this.post.comments.next_page_url)
				.then(response => {
					let newData = response.data;

					newData.data = [...newData.data.slice().reverse(), ...this.post.comments.data.slice().reverse()];

					this.post.comments = newData;
				})
				.catch(error => {
					console.log(error);
				});
		},
        deletePost(postId) {
            if (confirm('Are you sure you want to delete this post?') === false) {
                return;
            }

            axios.delete(`/post/${postId}`)
                .then(response => {
                    this.toast.success('Post deleted successfully');

                    this.$store.state.posts = this.$store.state.posts.filter(p => p._id != postId);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        withReplacements(content) {
            content = DOMPurify.sanitize(content);

            if (this.user.settings.render_media) {
                const youtubeRegex = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]{11})([^\s]*)?/g;
                const matches = [...content.matchAll(youtubeRegex)];

                for (const match of matches) {
                    const videoId = match[1];

                    let url = match[0];

                    url = url.replace(/&amp;/g, '&').replace(/<\/?[^>]+(>|$)/g, "");

                    const urlParams = new URLSearchParams(url.split('?')[1]);
                    const timestamp = urlParams.get('t') ? parseInt(urlParams.get('t')) : null;
                    const embedUrl = `https://www.youtube.com/embed/${videoId}?start=${timestamp}`;
                    const iframeElement = `<div class="ratio ratio-16x9 mt-4"><iframe class="embed-responsive-item" src="${embedUrl}" frameborder="0" allowfullscreen></iframe></div>`;

                    content = content.replace(match[0], iframeElement);
                }
            }

            return content;
        },
        likePost() {
            axios.post(`/post/likes/${this.post._id}`)
                .then(response => {
                    this.$store.state.posts = this.$store.state.posts.map(p => {
                        if (p._id === this.post._id) {
                            p.liked_by_user = response.data.liked_by_user;
                            p.like_count = response.data.like_count;
                        }

                        return p;
                    });
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
}
</script>

<style scoped>
#post-content > a {
    color: blue;
    text-decoration: underline;
    cursor: pointer;
}
</style>
