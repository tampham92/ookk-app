<template>
    <div>
        <section class="vh-100">
            <div class="mask d-flex align-items-center h-100 gradient-custom-3">
                <div class="container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="card" style="border-radius: 15px;">
                                <div class="card-body p-5">
                                    <h2 class="text-uppercase text-center mb-5">Đăng Ký</h2>
                                    <form @submit.prevent="createUser" >
                                        <div class="form-outline mb-4">
                                            <label class="form-label">Họ và tên</label>
                                            <input type="text" placeholder="Nhập họ tên"
                                                class="form-control form-control-lg" 
                                                v-model="userData.name"/>
                                            <small v-if="errors.name" class="text-danger">{{ errors.name[0] }}</small>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label">Email</label>
                                            <input type="text" placeholder="Nhập email"
                                                class="form-control form-control-lg" 
                                                v-model="userData.email"/>
                                            <small v-if="errors.email" class="text-danger">{{ errors.email[0] }}</small>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label">Password</label>
                                            <input type="password" placeholder="Nhập mật khẩu"
                                                class="form-control form-control-lg" 
                                                v-model="userData.password"/>
                                            <small v-if="errors.password" class="text-danger">{{ errors.password[0] }}</small>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <button type="submit"
                                                class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Tạo tài khoản</button>
                                        </div>

                                        <p class="text-center text-muted mt-5 mb-0">Đã có tài khoản? 
                                            <a class="fw-bold text-body" v-bind:href="loginUrl"><u>Đăng nhập</u></a>
                                        </p>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue';
import router from '../../router';
import { api } from '../../boot/axios';

export default defineComponent({
    setup(){

        const userData = {
            name: "",
            email: "",
            password: ""
        }

        const errors = ref({});

        const createUser = () => {
            api.post("/auth/register", userData)
            .then((resp) => {
                if(resp){
                    router.push("/login")
                }
            })
            .catch((err) => {
                errors.value = err.response.data.data;
            })
        }

        return{
            createUser,
            userData,
            errors,
            loginUrl: "/login"
        }
    }
})
</script>