<template>
    <Head>
        <title>Edit Pengawas - Aplikasi Ujian Online</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <Link
                    href="/admin/pengawas"
                    class="btn btn-md btn-primary border-0 shadow mb-3"
                    type="button"
                    ><i class="fa fa-long-arrow-alt-left me-2"></i>
                    Kembali</Link
                >
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5><i class="fa fa-user"></i> Edit Pengawas</h5>
                        <hr />
                        <form @submit.prevent="submit">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Nama Lengkap</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Masukkan Nama Pengawas"
                                            v-model="form.name"
                                        />
                                        <div
                                            v-if="errors.name"
                                            class="alert alert-danger mt-2"
                                        >
                                            {{ errors.name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Email</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Masukkan Email Pengawas"
                                            v-model="form.email"
                                        />
                                        <div
                                            v-if="errors.email"
                                            class="alert alert-danger mt-2"
                                        >
                                            {{ errors.email }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Sekolah</label>
                                        <select
                                            class="form-select"
                                            v-model="form.school_id"
                                        >
                                            <option
                                                v-for="(
                                                    school, index
                                                ) in schools"
                                                :key="index"
                                                :value="school.id"
                                            >
                                                {{ school.title }}
                                            </option>
                                        </select>
                                        <div
                                            v-if="errors.school_id"
                                            class="alert alert-danger mt-2"
                                        >
                                            {{ errors.school_id }}
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Sesi Ujian</label>
                                        <select
                                            class="form-select"
                                            v-model="form.exam_sessions_id"
                                        >
                                            <option
                                                v-for="(
                                                    exam_session, index
                                                ) in exam_sessions"
                                                :key="index"
                                                :value="exam_session.id"
                                            >
                                                {{ exam_session.title }}
                                            </option>
                                        </select>
                                        <div
                                            v-if="errors.exam_sessions_id"
                                            class="alert alert-danger mt-2"
                                        >
                                            {{ errors.exam_sessions_id }}
                                        </div>
                                    </div>
                                </div> -->
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Password</label>
                                        <input
                                            type="password"
                                            class="form-control"
                                            placeholder="Masukkan Password"
                                            v-model="form.password"
                                        />
                                        <div
                                            v-if="errors.password"
                                            class="alert alert-danger mt-2"
                                        >
                                            {{ errors.password }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Konfirmasi Password</label>
                                        <input
                                            type="password"
                                            class="form-control"
                                            placeholder="Masukkan Konfirmasi Password"
                                            v-model="form.password_confirmation"
                                        />
                                    </div>
                                </div>
                            </div>

                            <button
                                type="submit"
                                class="btn btn-md btn-primary border-0 shadow me-2"
                            >
                                Simpan
                            </button>
                            <button
                                type="reset"
                                class="btn btn-md btn-warning border-0 shadow"
                            >
                                Reset
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
//import layout
import LayoutAdmin from "../../../Layouts/Admin.vue";

//import Heade and Link from Inertia
import { Head, Link } from "@inertiajs/inertia-vue3";

//import reactive from vue
import { reactive } from "vue";

//import inerita adapter
import { Inertia } from "@inertiajs/inertia";

//import sweet alert2
import Swal from "sweetalert2";

export default {
    //layout
    layout: LayoutAdmin,

    //register components
    components: {
        Head,
        Link,
    },

    //props
    props: {
        errors: Object,
        user: Object,
        schools: Array,
        exam_sessions: Array,
    },

    //inisialisasi composition API
    setup(props) {
        console.log(props);
        //define form with reactive
        const form = reactive({
            name: props.user.name,
            email: props.user.email,
            school_id: props.user.school_id,
            //exam_sessions_id: props.user.exam_sessions_id,
            password: "",
            password_confirmation: "",
        });

        //method "submit"
        const submit = () => {
            //send data to server
            Inertia.put(
                `/admin/pengawas/${props.user.id}`,
                {
                    //data
                    name: form.name,
                    email: form.email,
                    school_id: form.school_id,
                    //exam_sessions_id: form.exam_sessions_id,
                    password: form.password,
                    password_confirmation: form.password_confirmation,
                },
                {
                    onSuccess: () => {
                        //show success alert
                        Swal.fire({
                            title: "Success!",
                            text: "Siswa Berhasil Disimpan.",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000,
                        });
                    },
                }
            );
        };

        //return
        return {
            form,
            submit,
        };
    },
};
</script>

<style></style>
