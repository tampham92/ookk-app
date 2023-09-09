<template>
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7">
                <div class="card p-3 py-4">
                    <div class="text-center">
                        <img
                        src="https://i.imgur.com/bDLhJiP.jpg"
                        width="100"
                        class="rounded-circle"
                        />
                    </div>

                    <form @submit.prevent="updateProfile" class="text-center mt-3">
                        <div class="form-outline mb-4">
                        <input
                            type="text"
                            placeholder="Nhập email"
                            class="form-control form-control-lg"
                            v-model="userInfo.email"
                        />
                        <small v-if="errors.email" class="text-danger">{{
                            errors.email[0]
                        }}</small>
                        </div>
                        <div class="form-outline mb-4">
                        <input
                            type="text"
                            placeholder="Nhập email"
                            class="form-control form-control-lg"
                            v-model="userInfo.name"
                        />
                        <small v-if="errors.email" class="text-danger">{{
                            errors.email[0]
                        }}</small>
                        </div>
                        <div class="px-4 mt-1">
                        <p class="fonts">
                            Lorem Ipsum is simply dummy text of the printing and typesetting
                            industry. Lorem Ipsum has been the industry’s standard dummy
                            text ever since the 1500s, when an unknown printer took a galley
                            of type and scrambled it to make a type specimen book. nullamco
                            laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        </div>

                        <div class="buttons">
                            <button type="submit" class="btn btn-primary px-4 ms-3">
                                Cập nhật tài khoản
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { defineComponent, ref, toRefs } from "vue";
import { api } from "../../boot/axios";

export default defineComponent({
  setup() {
    const userInfo = ref({});
    const errors = ref({});

    const getProfile = () => {
      api
        .get("/user/profile")
        .then((resp) => {
            userInfo.value = resp.data;
        })
        .catch((err) => {});
    };
    getProfile();

    const updateProfile = () =>{        
        api.put(`/user/update/${userInfo.value.id}`, userInfo)
        .then((resp) => {
            console.log(resp);
        })
        .catch((err) => {
            console.log(err);
        })
    }

    return {
      userInfo,
      updateProfile,
      errors
    };
  },
});
</script>