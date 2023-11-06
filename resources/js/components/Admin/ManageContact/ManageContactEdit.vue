<template>
    <div class="loading_all_page" v-if="loading_page === true">
        <v-progress-circular indeterminate size="70" :width="8" color="#FFBC15"></v-progress-circular>
        <p class="mt-3">กำลังโหลดข้อมูล</p>
    </div>

    <div v-else>
        <div class="container">
            <div class="d-flex justify-space-between align-items-center mt-4 mb-4">
                <v-card-text class="p-0">
                    <h1 class="font-20 m-0">จัดการช่องทางติดต่อ</h1>
                </v-card-text>
                <v-card-text class="d-flex justify-end p-0">
                    <v-breadcrumbs :items="submenu" class="p-0">
                        <template v-slot:divider>
                            <v-icon>mdi-chevron-right</v-icon>
                        </template>
                    </v-breadcrumbs>
                </v-card-text>
            </div>
            <v-row>
                <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                    <v-card elevation="2">
                        <v-row class="m-0 p-4">
                            <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                                <v-card-title class="p-0 justify-space-between text-card-title">
                                    ข้อมูลช่องทางการติดต่อ
                                </v-card-title>
                                <v-card-text class="p-0 mt-4">
                                    <div class="d-flex align-center">
                                        <img class="mr-2" :src="base_url + `/images/icon/address.png`" alt="Address"
                                            width="20" height="20" />

                                        <span class="font-16 color-title-card">ที่อยู่ <span
                                                style="color: red;">*</span></span>
                                    </div>
                                    <div class="mt-3">
                                        <v-textarea solo outlined single-line flat label="กรุณากรอกที่อยู่"
                                            :value="value_textarea_address" :rules="rules.address" required></v-textarea>

                                    </div>


                                </v-card-text>
                                <v-card-text class="p-0 mt-2">
                                    <div class="d-flex align-center">
                                        <img class="mr-2" :src="base_url + `/images/icon/contact2.png`" alt="Contact"
                                            width="20" height="20" />
                                        <span class="font-16 color-title-card">ช่องทางการติดต่อ</span>
                                    </div>
                                    <div class="mt-3">
                                        <v-row class="container-input-contact">
                                            <v-col xs="12" sm="12" md="6" lg="6" xl="6">
                                                <p class="font-14 text-ex">เบอร์โทร <span style="color: red;">*</span></p>
                                                <v-text-field label="กรุณากรอกเบอร์โทร" @keypress="isTelephone($event, phone)" v-model="phone" :rules="rules.phone"
                                                    outlined dense single-line required></v-text-field>
                                            </v-col>
                                            <v-col xs="12" sm="12" md="6" lg="6" xl="6">
                                                <p class="font-14 text-ex">อีเมล</p>
                                                <v-text-field label="กรุณากรอกอีเมล" v-model="email" outlined dense
                                                    single-line></v-text-field>
                                            </v-col>
                                            <v-col xs="12" sm="12" md="6" lg="6" xl="6">
                                                <p class="font-14 text-ex">เฟสบุ๊ค (Facebook)</p>
                                                <v-text-field label="กรุณากรอกเฟสบุ๊ค (Facebook)" v-model="facebook"
                                                    outlined dense single-line></v-text-field>
                                            </v-col>
                                            <v-col xs="12" sm="12" md="6" lg="6" xl="6">
                                                <p class="font-14 text-ex">ไลน์ไอดี (Line ID)</p>
                                                <v-text-field label="กรุณากรอกไลน์ไอดี (Line ID)" v-model="line_id" outlined
                                                    dense single-line></v-text-field>
                                            </v-col>
                                            <v-col xs="12" sm="12" md="6" lg="6" xl="6">
                                                <p class="font-14 text-ex">อินสตราแกรม (Instagram)</p>
                                                <v-text-field label="กรุณากรอกอินสตราแกรม (Instagram)" v-model="instagram"
                                                    outlined dense single-line></v-text-field>
                                            </v-col>
                                            <v-col xs="12" sm="12" md="6" lg="6" xl="6">
                                                <p class="font-14 text-ex">ติ๊กต็อก (TikTok)</p>
                                                <v-text-field label="กรุณากรอกติ๊กต็อก (TikTok)" v-model="tikTok" outlined
                                                    dense single-line></v-text-field>
                                            </v-col>
                                        </v-row>
                                    </div>


                                </v-card-text>

                                <v-card-text class="p-0 mt-8">
                                    <div class="d-flex justify-center">
                                        <v-btn color="white" class="ma-2 btn-save rounded-pill pl-30 pr-30">
                                            <v-icon class="fs-20" left dark>
                                                mdi-content-save
                                            </v-icon>
                                            บันทึกข้อมูล
                                        </v-btn>
                                    </div>
                                </v-card-text>
                            </v-col>
                        </v-row>
                    </v-card>
                </v-col>
            </v-row>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            loading_page: false,
            submenu: [
                {
                    text: 'จัดการเว็บไซต์ประชาสัมพันธ์',
                    disabled: false,
                },
                {
                    text: 'จัดการช่องทางติดต่อ',
                    disabled: true,
                },
            ],
            value_textarea_address: "777 ถ. มิตรภาพ ต.ปากเพียว อ.เมืองสระบุรี จ.สระบุรี 18000",
            phone: "0805838888",
            email: "imaimmarket@gmail.com",
            facebook: "imaimmarket@gmail.com",
            line_id: "imaimmarket",
            instagram: "imaimmarket",
            tikTok: "imaimmarket",
            rules: {
                address: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                phone: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
            },
        }
    },
    methods: {

    },
    created() {
    },
    mounted() {
    }
}
</script>

<style scoped lang="scss">
* {
    font-family: 'Kanit', sans-serif !important;
}

.btn-edit {
    background: linear-gradient(270deg, #FF5B00 0%, #FFC700 53.65%);
    box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);

    color: #F9F9F9;
    font-size: 16px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;

    .icon-btn-edit {
        font-size: 24px !important;
        margin-right: 10px;
    }
}

.btn-back {
    border-radius: 30px;
    border: 1px solid var(--primary-button, #86D780) !important;
    box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);

    color: #60A577;
    font-size: 16px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
}
</style>