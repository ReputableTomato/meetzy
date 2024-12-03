<template>
    <header class="site_header pl_32 pr_32 shadow-sm">
        <div class="container-fluid p-0">
            <div class="nav d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <button type="button" class="hamburger d-lg-none d-flex align-items-center justify-content-center mr_10 site_icon" @click="toggleSidebar">
                        <img src="/images/hamburger.svg" class="hamburger_icon imgBlack" alt="hamburger">
                    </button>
                    <button type="button" class="expand_btn d-lg-flex d-none align-items-center justify-content-center mr_10" @click="toggleSidebar">
                        <img src="/images/hamburger.svg" class="imgBlack icon28" alt="hamburger">
                        <img src="/images/close.svg" class="imgBlack icon28" alt="Close_2">
                    </button>
                </div>
                <div class="header_right d-flex align-items-center">
                    <div class="mobile_search_bar position-relative">
                        <div class="search_icon d-lg-none d-flex align-items-center justify-content-between">
                            <img src="/images/search_2.svg" class="imgBlack icon24" alt="Search">
                            <img src="/images/close.svg" class="imgBlack icon24" alt="Search">
                        </div>
                        <div class="header_search position-relative mr_25">
                            <input type="text" class="input_grey pt_12 pb_12 pl_40 pr_15 round12 greybg form-control" placeholder="Search for languages, tips, and more...">
                            <div class="position-absolute position_center_y left_0 pl_15">
                                <img src="/images/Search.svg" class="icon16" alt="Search">
                            </div>
                        </div>
                    </div>

                    <div class="header_profile y_center ps-4 d-flex align-items-center">
                        <!-- Day/Night Toggle -->
                        <button type="button" class="day_night_btn mr_10 site_icon" @click="$store.dispatch('toggleDayNight')" v-if="$store.state.isNightMode">
                            <i class="bi bi-sun-fill text-light fs-1"></i>
                        </button>
                        <button type="button" class="day_night_btn mr_10 site_icon" @click="$store.dispatch('toggleDayNight')" v-if="!$store.state.isNightMode">
                            <i class="bi bi-moon fs-1"></i>
                        </button>

                        <!-- Notifications Dropdown -->
                        <div class="dropdown position-relative">
                            <button type="button" class="day_night_btn position-relative mr_10" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-bell fs-1 site_icon" :class="{'text-light': $store.state.isNightMode}"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    3
                                </span>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end p-3 shadow-lg animate__animated animate__fadeIn fs-4" :class="$store.state.isNightMode ? 'dropdown-menu-dark' : ''" aria-labelledby="notificationDropdown" style="min-width: 350px;">
                                <li>
                                    <h6 class="dropdown-header fs-5 text-primary">Notifications</h6>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center p-3 notification-item" href="#">
                                        <i class="bi bi-envelope-fill me-3 fs-4 text-secondary"></i> New message from John
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center p-3 notification-item" href="#">
                                        <i class="bi bi-person-fill me-3 fs-4 text-secondary"></i> Anna followed you
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center p-3 notification-item" href="#">
                                        <i class="bi bi-check-circle-fill me-3 fs-4 text-secondary"></i> Task completed
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-center notification-item" href="#">View all notifications</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Profile Dropdown -->
                        <div class="dropdown ps-4">
                            <a href="#" class="profile_img profile_img_44" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" v-if="user.profile_picture.url">
                                <img :src="user.profile_picture.url" alt="admin_img" class="rounded-circle" style="width: 44px; height: 44px;">
                                <!-- Active dot (optional) -->
                                <div class="active_dot active" style="position: absolute; top: 32px; right: 5px; background-color: #28a745; width: 10px; height: 10px; border-radius: 50%;"></div>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end shadow-lg fs-4" :class="$store.state.isNightMode ? 'dropdown-menu-dark' : ''" aria-labelledby="profileDropdown" style="min-width: 250px;">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="bi bi-person-fill me-3 fs-5"></i> My Profile
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="bi bi-gear me-3 fs-5"></i> Settings
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="bi bi-envelope me-3 fs-5"></i> Messages
                                        <span class="badge bg-primary rounded-pill ms-auto">42</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <Link href="/logout" class="dropdown-item d-flex align-items-center">
                                        <i class="bi bi-box-arrow-right me-3 fs-5"></i> Sign Out
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>



<script>
import {Link} from "@inertiajs/vue3";

export default {
    components: {Link},
    props: {
        user: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            isSidebarUnexpanded: true
        };
    },
    watch: {
        isSidebarUnexpanded(newValue) {
            if (newValue) {
                document.body.classList.add('sidebar_unexpanded');
            } else {
                document.body.classList.remove('sidebar_unexpanded');
            }
        }
    },
    methods: {
        toggleSidebar() {
            this.isSidebarUnexpanded = !this.isSidebarUnexpanded;
        }
    }
}
</script>

<style scoped>
.dropdown-toggle::after {
    display: none !important;
}

.nav-link {
    padding: 0px !important;
}

.dropdown-menu {
    min-width: 250px;
}
</style>
