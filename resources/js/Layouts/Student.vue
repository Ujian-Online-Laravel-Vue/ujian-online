<template>
    <div class="w-full" style="background: url('/assets/images/bg-custom.jpg'); background-repeat: no-repeat; background-size: cover; height: 100vh; background-position: center;">
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-dark navbar-theme-primary mb-4 shadow">
            <div class="container position-relative">
                <Link class="navbar-brand me-lg-3" href="/student/dashboard">
                    <img class="navbar-brand-dark" src="/assets/images/logo_kemenag_aceh-removebg-preview.png" style="height:70px">
                    <span style="margin-left: 10px;">Ujian Online</span>
                </Link>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    </ul>
                    <form class="d-flex" v-if="$page.props.auth.student">
                        <Link href="/logout" method="POST" class="btn btn-secondary shadow" as="button">LOGOUT</Link>
                    </form>
                </div>
            </div>
        </nav>
        <div class="container">
            <slot />
        </div>
    </div>
</template>

<script>

    //import Link
    import { Link } from '@inertiajs/inertia-vue3';

    export default {

        //register components
        components: {
            Link
        },

    }

</script>

<style>

</style>
