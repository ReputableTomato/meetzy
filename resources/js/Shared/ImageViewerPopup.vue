<template>
    <!-- Modal -->
    <div class="modal fade" id="imageViewerModal" tabindex="-1" aria-labelledby="imageViewerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="row" :class="$store.state.isNightMode ? 'bg-dark' : 'bg-white'">
                        <div :class="showCommentSection ? 'col-md-6 p-0' : 'col-md-12 p-0'" >
                            <template v-if="post.image_assets">
                                <img
                                    :src="post.image_assets[0].url"
                                    :alt="post.user.first_name + '\'s image'"
                                    class="img-fluid h-100 w-100"
                                    style="object-fit: cover;"
                                    v-if="post.image_assets.length === 1"
                                >
                                <div :id="'image-viewer-' + post.id" class="carousel slide post_images h-100 w-100" v-else>
                                    <div class="carousel-inner h-100">
                                        <div class="carousel-item" :class="{'active' : index === 0}" v-for="(image, index) in post.image_assets">
                                            <img
                                                :src="image.url"
                                                :alt="post.user.first_name + '\'s image'"
                                                class="img-fluid modal-image h-100 w-100"
                                                style="object-fit: cover;max-height:500px"
                                            >
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" :data-bs-target="'#image-viewer-' + post.id" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" :data-bs-target="'#image-viewer-' + post.id" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </template>
                        </div>

                        <div class="col-md-6 p-4 d-flex flex-column" v-if="showCommentSection">
                            <div class="row mb-3 align-items-center justify-content-between">
                                <!-- User Info with Profile Picture -->
                                <div class="col-auto d-flex align-items-center">
                                    <a class="profile_img profile_img_48 mr_10">
                                        <img :src="post.user.profile_picture.url" :alt="post.user.first_name + '\'s profile picture'" class="rounded-circle me-2">
                                    </a>
                                    <div>
                                        <h6 class="mb-0">{{ post.user.first_name }} {{ post.user.last_name }}</h6>
                                        <p class="text-muted mb-0 small">Posted on: <span class="fw-bold" :title="post.created_at_title">{{ post.created_at_display }}</span></p>
                                    </div>
                                </div>

                                <!-- Close Button -->
                                <div class="col-auto">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>

                            <!-- Reactions (without emojis) -->
                            <div class="row mb-3">
                                <div class="col">
                                    <p>{{ processedContent }}</p>
                                </div>
                            </div>

                            <!-- Scrollable Comments Section -->
                            <div class="row flex-grow-1 overflow-auto mb-3" style="max-height: 250px;">
                                <div class="col">
                                    <div class="comment_box">
                                        <div class="default_post_wrap" v-for="comment in comments" v-if="comments.length > 0">
                                            <PostComment :comment="comment" :user="post.user" />
                                        </div>
                                        <div class="default_post_wrap" v-else>
                                            <p class="text-center text-muted">No comments yet.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Add New Comment Section (fixed height and non-expandable) -->
                            <div class="row">
                                <div class="col">
                                    <div class="quick_post_top">
                                        <a href="#" class="profile_img profile_img_48 mr_10">
                                            <img :src="post.user.profile_picture.url" :alt="post.user.first_name + '\'s profile picture'">
                                        </a>
                                        <div class="quick_post_text position-relative ml_12">
                                            <input type="text" class="input_grey pt_12 pb_12 pl_15 pr_15 round12 greybg w-100 form-control" placeholder="Write a comment ...">
                                            <div class="position-absolute border_t1_left position_center_y right_0 pr_16 d-flex align-items-center">
                                                <button type="button" class="site_icon pl_10 border_left">
                                                    <img src="/images/face-smile.svg" class="icon20" alt="face-smile">
                                                </button>
                                                <button type="button" class="f_700 text_blue text_sm pl_10 site_icon comment_send">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import PostComment from "@/Shared/Sections/Post/PostComment.vue";

export default {
    components: {
		PostComment
	},
    props: {
        post: {
            type: Object,
            required: true
        },
        showCommentSection: {
            type: Boolean,
            default: true
        }
    },
    data() {
        return {
            comments: {},
            newCommentText: ''
        }
    },
    computed: {
        processedContent() {
            this.post.content = this.post.content.replace(/<p><\/p>/g, '<p>&nbsp;</p>');

            return this.post.content;
        }
    },
    mounted() {
        if (this.showCommentSection) {
            this.getComments();
        }
    },
    methods: {
        addNewComment() {},
        getComments() {
            axios.get(`/post/${this.post._id}/comments`)
                .then(response => {
                    this.comments = response.data.data;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
}
</script>

<style scoped>

</style>
