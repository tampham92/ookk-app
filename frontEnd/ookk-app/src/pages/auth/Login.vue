<template>
    <div>
        <section class="vh-100">
            <div class="mask d-flex align-items-center h-100 gradient-custom-3" action="" method="POST">
                <div class="container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="card" style="border-radius: 15px;">
                                <div class="card-body p-5">
                                    <h2 class="text-uppercase text-center mb-5">Đăng nhập để sử dụng</h2>
                                    <form @submit.prevent="login">
                                        <div class="form-outline mb-4">
                                            <label class="form-label">Email</label>
                                            <input type="text" placeholder="Nhập email"
                                                class="form-control form-control-lg" 
                                                v-model="email"/>
                                            <small v-if="errors.email" class="text-danger">{{ errors.email[0] }}</small>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label">Password</label>
                                            <input type="password" placeholder="Nhập mật khẩu"
                                                class="form-control form-control-lg" 
                                                v-model="password"/>
                                            <small v-if="errors.password" class="text-danger">{{ errors.password[0] }}</small>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">
                                                Đăng nhập
                                            </button>
                                        </div>

                                        <p class="text-center text-muted mt-5 mb-0">Chưa có tài khoản? 
                                            <a class="fw-bold text-body" v-bind:href="registerUrl"><u>Đăng ký</u></a>
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
import { defineComponent, reactive, ref, toRefs } from 'vue';
import { api } from '../../boot/axios';

export default defineComponent({
    setup(){
        const loginData = reactive({
            email: "",
            password: ""
        })

        const errors = ref({});

        const login = () => {
            api.post("/auth/login", loginData)
            .then((resp) => {
                if(resp){
                    localStorage.setItem('token', resp.data.token);
                    localStorage.setItem('user', JSON.stringify(resp.data.user));

                    window.location.href = "/profile";
                }
            })
            .catch((err) => {
                errors.value = err.response.data.data;
            })
        }

        return{
            login,
            ...toRefs(loginData),
            errors,
            registerUrl: "/register"
        }
    }
})</script>