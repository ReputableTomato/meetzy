<template>
    <DarkModeHeader />

    <div class="default_area">
        <div class="default_wrap">
            <FormTop title="Log into your account" description="Welcome back! Please enter your details." />

            <form class="default_form login bg-white" @submit.prevent="login">
                <Alerts />

                <div class="form_group mb_20">
                    <label for="email" class="text_blue text_sm pb_8">Email</label>
                    <input type="text" class="input_grey pt_12 pb_12 pl_15 pr_15 round12 greybg w-100" placeholder="Enter your email" v-model="loginForm.email">
                </div>
                <div class="form_group password_from_group input_active pb_20">
                    <label for="password" class="text_blue text_sm pb_8">Password</label>
                    <div class="position-relative">
                        <input id="password" class="input_grey pt_12 pb_12 pl_15 pr_50 round12 greybg w-100" placeholder="Enter your password" v-model="loginForm.password" :type="showPassword ? 'text' : 'password'">
                        <button type="button" class="password_eye position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); width: 30px; height: 30px; background: transparent; border: none;" @click="toggleShowPassword">
                            <img src="/images/eye.svg" class="eye" alt="eye" style="width: 20px; height: 20px;">
                        </button>
                    </div>
                </div>

                <div class="form_group mb_32 d-flex align-items-center justify-content-between">
                    <div class="checkbox d-flex align-items-center gap_x_8" :class="{ active: keepMeLoggedIn === true }" @click="toggleKeepMeLoggedIn">
                        <div class="check">
                            <img src="/images/check.svg" class="icon14 imgWhite" alt="check">
                        </div>
                        <p class="text_sm f_500 text-black">Keep me logged in</p>
                    </div>

                    <Link href="/forgotten-password" class="f_600 text_blue text_sm site_icon">Forgot Password</Link>
                </div>

                <button type="submit" class="blue_button w-100">Log me in</button>
            </form>

            <p class="text-center text_sm f_500 mt_32 text_form_bottom">
                <span class="text_bodyColor50">Don’t have an account? </span>

                <Link href="/registration" class="site_icon text_blue">Register</Link>
            </p>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import DarkModeHeader from "@/Shared/Auth/DarkModeHeader.vue";
import Alerts from "@/Shared/Auth/Alerts.vue";
import FormTop from "@/Shared/Auth/FormTop.vue";

export default {
    components: {
        Link,
        DarkModeHeader,
        Alerts,
        FormTop
    },
    data() {
        return {
            keepMeLoggedIn: false,
            showPassword: false,
            loginForm: this.$inertia.form({
                email: 'test@test.com',
                password: '&BrefT2D3UopN$s$',
            })
        }
    },
    methods: {
        toggleKeepMeLoggedIn() {
            this.keepMeLoggedIn = !this.keepMeLoggedIn;
        },
        toggleShowPassword() {
            this.showPassword = !this.showPassword;
        },
        login() {
            this.loginForm.post('/login');
        },
    }
};
</script>
