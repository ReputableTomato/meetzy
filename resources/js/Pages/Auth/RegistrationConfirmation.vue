<template>
    <DarkModeHeader />

    <div class="default_area">
        <div class="default_wrap">
            <FormTop title="Waiting for Email Confirmation" description="Please check your inbox and confirm your email address to continue." />

            <div class="default_form bg-white p-4 round12">
                <Alerts />

                <div class="text-center" v-if="!$page.props.error">
                    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="text_sm f_500 mt_12 text_form_bottom text_bodyColor50">Waiting for your confirmation...</p>
                </div>
            </div>

            <p class="text-center text_sm f_500 mt_32 text_form_bottom" v-if="!$page.props.error">
                <span class="text_bodyColor50">Didn't receive an email? </span>
                <Link :href="'/registration/' + $page.props.user.id + '/resend'" class="site_icon text_blue">Resend Email</Link>
            </p>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3'
import DarkModeHeader from '@/Shared/Auth/DarkModeHeader.vue';
import Alerts from "@/Shared/Auth/Alerts.vue";
import FormTop from "@/Shared/Auth/FormTop.vue";

export default {
    components: {
        DarkModeHeader,
        Alerts,
        FormTop,
        Link
    }
};
</script>
