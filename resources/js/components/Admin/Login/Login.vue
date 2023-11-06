<template>
    <div class="loading_all_page" v-if="loading_page === true">
        <v-progress-circular indeterminate size="70" :width="8" color="#FFBC15"></v-progress-circular>
        <p class="mt-3">กำลังโหลดข้อมูล</p>
    </div>

    <div v-else>


        <div class="login_page" v-bind:style="{ backgroundImage: 'url(' + base_url + '/images/bg_taladconnect.png)' }">
            <v-row>
                <div class="text-header"><span>TALAD CONNEx</span></div>
                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6"></v-col>
                <v-col class="container-from-login" cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                    <v-card max-width="593" class="box-login">
                        <div class="logo">
                            <img alt="Logo Talad Connect" :src="base_url + `/images/logo_taladconnect.png`" width="180"
                                height="180" />
                        </div>

                        <div class="login_title">
                            <h1>ยินดีต้อนรับเข้าสู่ระบบ</h1>
                            <span>กรุณากรอกเบอร์โทรและรหัสผ่านเพื่อเข้าสู่ระบบ</span>
                        </div>

                        <!-- Form Login -->
                        <v-form ref="form_login" v-on:submit.prevent="loginMe()">
                            <span>เบอร์โทร</span>

                            <v-text-field class="input radius-10" v-model="tel" label="กรุณากรอกเบอร์โทร" solo dense
                                hide-details="auto" @keypress="isTelephone($event, tel)"
                                :rules="[v => !!v || 'กรุณากรอกเบอร์โทร']"></v-text-field>

                            <span>รหัสผ่าน</span>

                            <v-text-field v-model="password" :append-icon="show_password ? 'mdi-eye' : 'mdi-eye-off'" :rules="[rules.required]"
                                :type="show_password ? 'text' : 'password'" name="input-10-2"
                                class="input input-password input-group--focused radius-10" label="กรุณากรอกรหัสผ่าน"
                                @click:append="show_password = !show_password" solo dense
                                hide-details="auto"></v-text-field>

                            <div class="forgot-password-group">
                                <input class="custom-checkbox" type="checkbox" name="remember"
                                    id="checkbox_forgot_password" />
                                <label for="checkbox_forgot_password"><span>จดจำฉันไว้ในระบบ</span></label>
                            </div>

                            <button class="btn-login">
                                <img class="mr-2" alt="Login" :src="base_url + `/images/icon/login.png`" width="20" height="20" />
                                เข้าสู่ระบบ
                            </button>
                        </v-form>
                    </v-card>

                </v-col>
            </v-row>


        </div>
    </div>
</template>
<script>

import login from '../../../api/login.js';

export default {
    data() {
        return {
            loading_page: false,
            tel: null,
            password: null,
            show_password: false,
            rules: {
                required: value => !!value || 'กรุณากรอกรหัสผ่าน',
            },
        }
    },
    methods: {
        async loginMe() {
            if (this.$refs.form_login.validate()) {
                this.loading_page = true
                const data = {
                    tel: this.tel,
                    password: this.password,
                }
                login.authLogin(data).then((response) => {
                    if (response.data.success === true) {
                        const data_success = {
                            access_token: response.data.access_token,
                        }
                        this.$store.commit('logInSuccess', data_success)
                        if (this.$store.state.access_token != null) {
                            this.$router.push('/dashboard')
                        }
                    }
                }).catch((error) => {
                    if (error.response.status === 401) {
                        this.loading_page = false
                        this.alertData('error', 'แจ้งเตือน', 'เบอร์โทร หรือ รหัสผ่าน ไม่ถูกต้อง.');
                    }
                })
            }
        }
    },
    created() {
    },
    mounted() {
    }
}
</script>
<style scoped lang="scss">
.radius-10 {
    border-radius: 10px !important;
}

.v-messages__message {
    color: #2A4858;
}

.login_page {
    width: 100%;
    height: 100vh;
    // align-items: flex-end;
    // flex-direction: column;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    padding: 0 20px;

    .container-from-login {
        @media (min-width: 600px) {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    }

    .text-header {
        display: flex;
        justify-content: flex-end;
        margin-top: 40px;
        margin-bottom: 120px;

        span {
            color: #2A4858;
            font-family: 'Kanit', sans-serif;
            font-size: 16px;
            font-style: normal;
            font-weight: 700;
            line-height: normal;
            margin-right: 113px;
        }
    }

    .box-login {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 50px;
        padding-top: 0;
        border-radius: 20px;
        border: 1px solid #2A4858;
        background: #2A4858;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        // margin-right: 245px;
        // width: 593px;
        width: 100%;

        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 34px;
            position: absolute;

            img {
                margin-top: -50%;
            }
        }

        .login_title {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 100px;
            margin-bottom: 20px;

            h1 {
                color: #FFF;
                font-family: 'Kanit', sans-serif;
                font-size: 36px;
                font-style: normal;
                font-weight: 600;
                line-height: normal;
                margin: 0;
                padding: 0;
            }

            span {
                color: #FFF;
                font-family: 'Kanit', sans-serif;
                font-size: 16px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
            }
        }

        form {
            width: 100%;

            span {
                color: #FFF;
                font-family: 'Kanit', sans-serif;
                font-size: 16px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
            }

            .input {
                // border-radius: 10px;
                font-family: 'Kanit', sans-serif !important;
                // font-size: 14px;
                // color: #000;
                // border: 1px solid #B7B7B7;
                // background: #FFF;
                width: 100% !important;
                // height: 35px;
                // padding: 7px 10px;
                margin-bottom: 15px;
                margin-top: 8px;
                // outline: none;
            }

            input::placeholder {
                color: #B7B7B7;
                font-family: 'Kanit', sans-serif;
                font-size: 14px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
            }


            .forgot-password-group {
                display: flex;
                align-items: center;
                gap: 10px;
                color: #c4c4c4;
                font-size: 14px;

                label {
                    display: flex;
                    align-items: center;
                }

                .custom-checkbox {
                    display: none;
                }

                .custom-checkbox+label::before {
                    content: '';
                    display: inline-block;
                    width: 24px;
                    height: 24px;
                    background: #FFF;
                    margin-right: 10px;
                    border: #fff solid 1px;
                    border-radius: 5px;
                }

                .custom-checkbox:checked+label::before {
                    background-color: #FFF;
                    color: #2A4858;
                    content: '✔';
                    text-align: center;
                    font-size: 16px;
                    line-height: 20px;
                }
            }

            .btn-login {
                margin-top: 20px;
                width: 100%;
                border-radius: 30px;
                height: 38px;
                background: linear-gradient(90deg, #F9FA6E 0%, #86D780 50%, #60A577 100%);
                box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);

                color: #FFF;
                font-family: 'Kanit', sans-serif;
                font-size: 16px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
            }
        }
    }
}
</style>
