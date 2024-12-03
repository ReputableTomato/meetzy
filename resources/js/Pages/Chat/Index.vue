<template>
    <PreLoader />
    <TopNav :user="user" />

    <div class="main_dashboard">
        <SideBar :user="user" />

        <!-- overlay -->
        <div class="overlay pb_32 d-lg-none d-block"> </div>

        <!-- Main Content -->
        <div class="main_content main_content_chat">
            <div class="container-fluid">
                <div class="row bg-white rounded-2 shadow-sm d-flex flex-column chat-content">
                    <!-- Header Section -->
                    <div class="col-12 p-4 d-flex align-items-center justify-content-between shadow-sm">
                        <div class="d-flex align-items-center">
                            <a :href="'/u/' + user.username" class="profile_img profile_img_48 mr_10">
                                <img :src="user.profile_picture.url" :alt="user.first_name + '\'s profile picture'">
                            </a>
                            <div class="post_profile_info">
                                <div class="d-flex align-items-center pb_8">
                                    <a :href="'/u/' + user.username" class="site_icon f_700 title18">
                                        {{ user.first_name }}
                                    </a>
                                    <p class="text_sm text_bodyColor50 pl_5 pr_5">{{ user.age }} . </p>
                                    <p class="text_sm text_bodyColor50" :title="created_at_title">{{ created_at_display }}</p>
                                </div>
                                <p class="text_sm text_bodyColor50"><a :href="'/u/' + user.username + '/followers'">{{ user.follower_count }} followers</a></p>
                            </div>
                        </div>
                        <div class="more d-flex align-items-center">
                            <button class="btn btn-link text-dark border-0 fs-3 p-0 d-flex align-items-center justify-content-center rounded-circle me-3"
                                    :class="$store.state.isNightMode ? 'post-more-dark' : 'post-more-light'"
                                    type="button"
                                    id="infoButton"
                                    style="width: 35px; height: 35px;">
                                <i class="bi bi-info-circle text-secondary"></i>
                            </button>

                            <button class="btn btn-link text-dark border-0 fs-3 p-0 d-flex align-items-center justify-content-center rounded-circle me-3"
                                    :class="$store.state.isNightMode ? 'post-more-dark' : 'post-more-light'"
                                    type="button"
                                    id="searchButton"
                                    style="width: 35px; height: 35px;">
                                <i class="bi bi-search text-secondary"></i>
                            </button>

                            <button class="btn btn-link text-dark border-0 fs-3 p-0 d-flex align-items-center justify-content-center rounded-circle me-3"
                                    :class="$store.state.isNightMode ? 'post-more-dark' : 'post-more-light'"
                                    type="button"
                                    id="cameraButton"
                                    style="width: 35px; height: 35px;">
                                <i class="bi bi-camera-video text-secondary"></i>
                            </button>

                            <button class="btn btn-link text-dark border-0 fs-3 p-0 d-flex align-items-center justify-content-center rounded-circle me-3"
                                    :class="$store.state.isNightMode ? 'post-more-dark' : 'post-more-light'"
                                    type="button"
                                    id="callButton"
                                    style="width: 35px; height: 35px;">
                                <i class="bi bi-telephone text-secondary"></i>
                            </button>

                            <div class="dropdown">
                                <button class="btn btn-link text-dark border-0 fs-3 p-0 d-flex align-items-center justify-content-center rounded-circle"
                                        :class="$store.state.isNightMode ? 'post-more-dark' : 'post-more-light'"
                                        type="button"
                                        id="moreDropdown"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        style="width: 35px; height: 35px;">
                                    <i class="bi bi-three-dots-vertical text-secondary" :class="$store.state.isNightMode ? 'text-white' : 'text-dark'"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-end"
                                    :class="$store.state.isNightMode ? 'dropdown-menu-dark' : ''"
                                    aria-labelledby="moreDropdown">
                                    <li><button class="dropdown-item fs-4" v-if="user.id === user.id" @click="deletePost(_id)">Delete</button></li>
                                    <li><button class="dropdown-item fs-4">Report</button></li>
                                    <li><button class="dropdown-item fs-4">Favourite</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Messages Section -->
                    <div class="col-12 chat-messages p-4 overflow-auto flex-grow-1">
                        <div class="d-flex mb-3">
                            <div class="me-3">
                                <a :href="'/u/' + user.username" class="profile_img profile_img_48 mr_10">
                                    <img :src="user.profile_picture.url" :alt="user.first_name + '\'s profile picture'">
                                </a>
                            </div>
                            <div class="bg-light p-3 rounded-3 shadow-sm">
                                <p class="mb-0">Hey! How's it going?</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3 justify-content-end">
                            <div class="bg-primary text-white p-3 rounded-3 shadow-sm">
                                <p class="mb-0">Hi! I'm good, thanks. You?</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="me-3">
                                <a :href="'/u/' + user.username" class="profile_img profile_img_48 mr_10">
                                    <img :src="user.profile_picture.url" :alt="user.first_name + '\'s profile picture'">
                                </a>
                            </div>
                            <div class="bg-light p-3 rounded-3 shadow-sm">
                                <p class="mb-0">Not bad. Just finished work. Any plans for tonight?</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3 justify-content-end">
                            <div class="bg-primary text-white p-3 rounded-3 shadow-sm">
                                <p class="mb-0">Just relaxing, maybe watch a movie. You?</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="me-3">
                                <a :href="'/u/' + user.username" class="profile_img profile_img_48 mr_10">
                                    <img :src="user.profile_picture.url" :alt="user.first_name + '\'s profile picture'">
                                </a>
                            </div>
                            <div class="bg-light p-3 rounded-3 shadow-sm">
                                <p class="mb-0">Sounds good. I might do the same!</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3 justify-content-end">
                            <div class="bg-primary text-white p-3 rounded-3 shadow-sm">
                                <p class="mb-0">Cool! Let me know what you end up watching. 😊</p>
                            </div>
                        </div>
                    </div>

                    <!-- Input Section -->
                    <div class="col-12 bg-light p-3 border-top">
                        <div class="quick_post_top">
                            <Link :href="'/u/' + user.username" class="profile_img profile_img_48">
                                <img :src="user.profile_picture.url" alt="admin_img">
                            </Link>
                            <div class="input-group ps-4">
                                <Editor ref="editor" class="bg-white" @input="onEditorInput" />

                                <span class="input-group-text" :class="$store.state.isNightMode ? 'bg-dark' : 'bg-light'">
                                    <Recorder @audio-recorded="onAudioRecorded" />
                                </span>
                                <span class="input-group-text" :class="$store.state.isNightMode ? 'bg-dark' : 'bg-light'">
                                    <input id="file-input" type="file" accept="image/png, image/jpeg" @input="addImage($event)" ref="fileInput" style="display: none;" multiple required />
                                    <button type="button" class="site_icon" @click="triggerFileInput">
                                        <img src="/images/Gallery-2.svg" class="icon20" alt="Gallery">
                                    </button>
                                </span>
                                <span class="input-group-text" :class="$store.state.isNightMode ? 'bg-dark' : 'bg-light'">
                                    <button type="button" class="site_icon" @click="triggerFileInput">
                                        <img src="/images/send-button.svg" class="icon20 text-white" alt="Gallery">
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineAsyncComponent } from 'vue';

import Editor from "@/Shared/Editor.vue";
import Recorder from "@/Shared/Recorder.vue";
import SideBar from "@/Shared/Layout/SideBar.vue";
import TopNav from "@/Shared/Layout/TopNav.vue";
import PreLoader from "@/Shared/PreLoader.vue";
import axios from "axios";
import {Link} from "@inertiajs/vue3";

export default {
    components: {
        Link,
		PreLoader,
		SideBar,
		TopNav,
        Editor,
        Recorder,
        OnlineFriendsList: defineAsyncComponent(() => import('@/Shared/Layout/OnlineFriendsList.vue')),
        SiteAlert: defineAsyncComponent(() => import('@/Shared/Sections/SiteAlert.vue')),
    },
    data() {
        return {
            user: {
                profile_picture: {},
                settings: {
                    render_media: null
                },
            },
        }
    },
    mounted() {
        this.getUser();

        // if (!document.body.classList.contains('bg-white')) {
        //     document.body.classList.add('bg-white');
        // }
    },
    methods: {
        getUser() {
            axios.get('/user')
                .then(response => {
                    this.user = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
	}
};
</script>
