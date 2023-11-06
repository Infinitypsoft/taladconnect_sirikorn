<template>
    <div class="loading_all_page" v-if="loading_page === true">
        <v-progress-circular indeterminate size="70" :width="8" color="#FFBC15"></v-progress-circular>
        <p class="mt-3">กำลังโหลดข้อมูล</p>
    </div>

    <div v-else>
        <v-slide-x-reverse-transition>
            <v-alert type="success" class="alert_all_page" v-if="alert_success === true">{{ alert_message_success
            }}</v-alert>
            <v-alert type="error" class="alert_all_page" v-if="alert_error === true">{{ alert_message_error }}</v-alert>
        </v-slide-x-reverse-transition>

        <div class="container">
            <div class="d-flex justify-space-between align-items-center mt-4 mb-4">
                <v-card-text class="p-0">
                    <h1 class="font-20 m-0">แก้ไขข้อมูลผู้ใช้งาน</h1>
                </v-card-text>
                <v-card-text class="d-flex justify-end p-0">
                    <v-breadcrumbs :items="submenu" class="p-0">
                        <template v-slot:divider>
                            <v-icon>mdi-chevron-right</v-icon>
                        </template>
                    </v-breadcrumbs>
                </v-card-text>
            </div>

            <v-card class="mb-6" elevation="2">
                <v-card-title class="justify-space-between text-card-title">
                    ฟอร์มการลงทะเบียนผู้ใช้งาน
                </v-card-title>
                <v-form ref="form_user_update" v-on:submit.prevent="userUpdate()">
                    <v-card-text class=" mt-3">
                        <div class="row-list mb-5" style="gap: 50px;">
                            <div class="col-list image-list-slide">
                                <img class="mt-4 ml-6" v-if="imagePreviewURL" :src="imagePreviewURL" alt="image list slide"
                                    width="100%" height="auto" style="max-width: 150px;" />
                            </div>
                            <div class="col-list d-flex flex-column justify-center align-center">
                                <v-card-text class="p-0 mt-2">
                                    <div class="d-flex align-center">
                                        <img class="mr-2"
                                            :src="base_url + `/images/icon/d41b2ce1f43c76c24da0e89c84f024f5.png`"
                                            alt="Title" width="20" height="20" />
                                        <span class="font-16 color-title-card">ข้อมูลส่วนบุคคล
                                            <span style="color: red;">*</span></span>
                                    </div>
                                    <div>
                                        <p class="font-14 mt-3 text-ex">คำแนะนำ : ขนาดรูปภาพแนะนำ 500 x 500
                                            หรือรูปสี่เหลี่ยมจตุรัส ขนาดไฟล์ไม่เกิน 2 gb สกุลไฟล์ jpg png jpeg เท่านั้น </p>

                                        <v-file-input class="w-100" outlined dense id="uploader" accept="image/*"
                                            v-model="content_picture" :rules="[v => !!v || 'กรุณาเลือกรูปภาพ']"
                                            @change="onFileChange" single-line clearable clear-icon=""
                                            label="กรุณาเลือกไฟล์รูปภาพ" required></v-file-input>
                                    </div>
                                </v-card-text>
                            </div>
                        </div>
                        <v-row class="container-input-contact">
                            <div class="d-flex align-center mt-5">
                                <img class="mr-2" :src="base_url + `/images/icon/a97d9bb00d624b994fee78c2738c1c8e.png`"
                                    alt="" width="20" height="20" />
                                <span class="font-16 color-title-card">ข้อมูลส่วนบุคคล</span>
                            </div>

                            <v-col cols="12" xs="12" sm="12" md="4" lg="4" xl="4">
                                <p class="font-14 text-ex fs-16 fw-500">ชื่อ - สกุล
                                    <span style="color: red;">*</span>
                                </p>
                                <v-text-field hide-details="auto" label="กรุณากรอก ชื่อ - สกุล" v-model="name"
                                    :rules="rules.name" outlined dense single-line required></v-text-field>
                            </v-col>

                            <v-col cols="12" xs="12" sm="12" md="4" lg="4" xl="4">
                                <p class="font-14 text-ex fs-16 fw-500">เบอร์โทรศัพท์
                                    <span style="color: red;">*</span>
                                </p>
                                <v-text-field hide-details="auto" label="กรุณากรอกเบอร์โทรศัพท์" v-model="phone"
                                    :rules="rules.phone" @keypress="isTelephone($event, phone)" outlined dense single-line
                                    required></v-text-field>
                            </v-col>

                            <v-col cols="12" xs="12" sm="12" md="4" lg="4" xl="4">
                                <p class="font-14 text-ex fs-16 fw-500">ตำแหน่งงาน</p>
                                <v-text-field hide-details="auto" label="กรุณากรอกตำแหน่งงาน" v-model="position" outlined
                                    dense single-line></v-text-field>
                            </v-col>

                            <div class="d-flex align-center mt-5">
                                <img class="mr-2" :src="base_url + `/images/icon/52ae51c12b94c5c0c0dac28c79d37c22.png`"
                                    alt="" width="20" height="20" />
                                <span class="font-16 color-title-card">ข้อมูลการเข้าสู่ระบบ</span>
                            </div>

                            <v-col cols="12" xs="12" sm="12" md="4" lg="4" xl="4">
                                <p class="font-14 text-ex fs-16 fw-500">ชื่อผู้ใช้งาน
                                    <span style="color: red;">*</span>
                                </p>
                                <v-text-field label="กรุณากรอกชื่อผู้ใช้งาน" v-model="username" :rules="rules.username"
                                    outlined dense single-line required></v-text-field>
                            </v-col>

                            <!-- <v-col cols="12" xs="12" sm="12" md="4" lg="4" xl="4">
                                <p class="font-14 text-ex fs-16 fw-500">รหัสผ่าน
                                    <span style="color: red;">*</span>
                                </p>
                                <v-text-field hide-details="auto" type="password" label="กรุณากรอกรหัสผ่าน"
                                    v-model="password" outlined dense single-line required></v-text-field>
                            </v-col>

                            <v-col cols="12" xs="12" sm="12" md="4" lg="4" xl="4">
                                <p class="font-14 text-ex fs-16 fw-500">ยืนยันรหัสผ่าน
                                    <span style="color: red;">*</span>
                                </p>
                                <v-text-field hide-details="auto" type="password" label="กรุณากรอกยืนยันรหัสผ่าน"
                                    v-model="confirm_password" outlined dense single-line></v-text-field>
                            </v-col> -->

                            <div class="d-flex align-center">
                                <img class="mr-2" :src="base_url + `/images/icon/b1e08be1addd3bdac663cd263fb993d9.png`"
                                    alt="Contact" width="20" height="20" />
                                <span class="font-16 color-title-card">สิทธิ์การเข้าใช้งานระบบ</span>
                            </div>
                            <v-radio-group hide-details="auto" v-model="radio_role" row>
                                <v-radio color="success" label="ผู้ดูแลระบบ" :value="1"></v-radio>
                                <v-radio color="success" label="ผู้ใช้งาน (จำกัดสิทธิ์)" :value="0"></v-radio>
                            </v-radio-group>
                            <div class="container p-20">
                                <v-card v-if="radio_role == 0" class="p-4">
                                    <p class="font-14 fw-500 mt-0 text-ex color-B7B7B7">
                                        กรุณาติ๊กเลือกในช่องสี่เหลี่ยม
                                        เพื่อให้ผู้ใช้งานมีสิทธิ์เข้าถึงฟังก์ชันการใช้งาน</p>

                                    <!-- Checkbox user_permission -->
                                    <v-row v-for="(data, i) in user_permission" :key="i">
                                        <v-col cols="12" xs="12" sm="12" md="2" lg="2" xl="2">
                                            <span class="fs-14 fw-500 color-707070">{{ data.topic }}</span>
                                        </v-col>
                                        <v-col cols="12" xs="12" sm="12" md="10" lg="10" xl="10">
                                            <v-row>
                                                <v-col v-for="(item, i) in data.items" :key="i" cols="12" xs="12" sm="6"
                                                    md="3" lg="2" xl="2">
                                                    <v-checkbox hide-details="auto" class="m-0 p-0" v-model="item.checked"
                                                        color="#60A577">
                                                        <template v-slot:label>
                                                            <span class="fs-12 fw-500 color-707070">{{ item.label }}
                                                            </span>
                                                        </template>
                                                    </v-checkbox>
                                                </v-col>
                                            </v-row>
                                        </v-col>
                                    </v-row>
                                </v-card>
                            </div>
                        </v-row>
                        <div class="d-flex justify-center">
                            <v-btn type="submit" color="white" class="ma-2 btn-save rounded-pill pl-30 pr-30">
                                <v-icon class="fs-20" left dark>
                                    mdi-content-save
                                </v-icon>
                                <span>บันทึกข้อมูล</span>
                            </v-btn>
                        </div>
                    </v-card-text>
                </v-form>
            </v-card>
        </div>
    </div>
</template>

<script>
import admin from '../../../api/admin.js';

export default {
    data() {
        return {
            loading_page: false,
            alert_success: false,
            alert_message_success: '',
            alert_error: false,
            alert_message_error: '',
            content_picture: null,
            imagePreviewURL: null,

            submenu: [
                {
                    text: 'จัดการผู้ใช้งาน',
                    disabled: false,
                }, {
                    text: 'เพิ่มข้อมูลผู้ใช้งาน',
                    disabled: true,
                },
            ],

            checkbox: false,

            name: '',
            phone: '',
            position: '',
            username: '',
            // password: '',
            // confirm_password: '',
            radio_role: 1,
            rules: {
                name: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                phone: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                position: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                username: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
            },

            user_permission: [
                {
                    topic: 'Dashboard',
                    items: [
                        { label: 'ดูรายงาน', checked: 0, db: 'dashboard_view_report' }
                    ]
                },
                {
                    topic: 'จัดการคำร้อง',
                    items: [
                        { label: 'ดูรายการคำร้องทั้งหมด', checked: 0, db: 'manage_request_view_request' },
                        { label: 'เปลี่ยนสถานะคำร้อง', checked: 0, db: 'manage_request_change_status' },
                    ]
                },
                {
                    topic: 'จัดการการเช่า',
                    items: [
                        { label: 'ดูรายการเช่าทั้งหมด', checked: 0, db: 'manage_rental_view_rental' },
                        { label: 'ดูรายงาน', checked: 0, db: 'manage_rental_view_report' },
                    ]
                },
                {
                    topic: 'สมาชิกผู้เช่า',
                    items: [
                        { label: 'ดูรายการผู้เช่าทั้งหมด ', checked: 0, db: 'tenant_member_view_tenant' },
                        { label: 'เพิ่มผู้เช่าใหม่', checked: 0, db: 'tenant_member_add_tenant' },
                        { label: 'แก้ไขข้อมูลผู้เช่า', checked: 0, db: 'tenant_member_edit_tenant' },
                        { label: 'ประชาสัมพันธ์ร้าน', checked: 0, db: 'tenant_member_publicize_shop' },
                    ]
                },
                {
                    topic: 'การจัดการผู้ใช้งาน',
                    items: [
                        { label: 'ดูรายการผู้ใช้งานทั้งหมด', checked: 0, db: 'manage_user_view_user' },
                        { label: 'เพิ่มผู้ใช้งาน', checked: 0, db: 'manage_user_add_user' },
                        { label: 'แก้ไขข้อมูลผู้ใช้งาน', checked: 0, db: 'manage_user_edit_user' },
                    ]
                },
                {
                    topic: 'จัดการตลาด',
                    items: [
                        { label: 'ดูรายการแผงตลาดทั้งหมด', checked: 0, db: 'manage_market_view_market' },
                    ]
                },
                {
                    topic: 'จัดการเว็บไซต์ประชาสัมพันธ์',
                    items: [
                        { label: 'จัดการ SEO', checked: 0, db: 'manage_seo' },
                        { label: 'จัดการภาพปกสไลด์', checked: 0, db: 'manage_slide_cover' },
                        { label: 'จัดการบทความ', checked: 0, db: 'manage_article' },
                        { label: 'จัดการช่องทางติดต่อ', checked: 0, db: 'manage_contact' },
                        { label: 'จัดการรีวิว', checked: 0, db: 'manage_review' },
                        { label: 'จัดการภาพแกลลอรี่', checked: 0, db: 'manage_gallery' },
                        { label: 'จัดการรางวัลและมาตรฐาน', checked: 0, db: 'manage_reward_standard' },
                    ]
                },
            ]

        }
    },
    methods: {
        // Get List admin
        async getDetail() {
            this.imagePreviewURL = null
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await admin.adminDetail(this.base64Decode(this.$route.query.id), config).then((result) => {
                if (result.data.success === true) {
                    this.get_data = result.data.data
                    this.name = this.get_data.name
                    this.phone = this.get_data.tel
                    this.position = this.get_data.position
                    this.username = this.get_data.username
                    this.radio_role = this.get_data.role
                    this.user_permission.map(v => {
                        v.items.map(item =>
                            item.checked = this.get_data[item.db]
                        )
                    })
                    this.content_picture = { name: this.get_data.pic }
                    this.imagePreviewURL = this.base_url + `/public/` + this.get_data.pic_path
                    this.loading_page = false;
                }
            })
        },

        async userUpdate() {
            if (this.$refs.form_user_update.validate()) {
                // this.loading_page = true;
                let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.access_token}`,
                    },
                }
                this.loading_page = true

                let data = new FormData();
                data.append('id', this.get_data.id);
                data.append('name', this.name);
                // if (this.password) {
                //     data.append('password', this.password);
                // }
                data.append('tel', this.phone);
                if (this.content_picture.size !== undefined) {
                    data.append('pic', this.content_picture);
                }
                data.append('role', this.radio_role);
                data.append('position', this.position);
                data.append('username', this.username);

                this.user_permission.map(v => {
                    v.items.map(item => {
                        data.append(item.db, item.checked ? 1 : 0);
                    })
                })

                await admin.adminUpdate(data, config).then((result) => {
                    if (result.data.success === true) {
                        this.loading_page = false;
                        this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                        this.$router.push('/manageuser')
                    } else {
                        this.loading_page = false;
                        this.alertData('error', 'ทำรายการไม่สำเร็จ', result.data.message);
                    }
                }).catch((error) => {
                    if (error.response.status === 401) {
                        this.loading_page = false
                        this.$store.commit('logOutSuccess')
                        this.$router.push('/login')
                    }
                })

            }
        },
        async onFileChange(payload) {
            const file = payload
            let extall = "png,PNG,jpeg,JPEG,jpg,JPG";
            let file_ext = file.name;

            let ext = file_ext.split('.').pop().toLowerCase();
            if (parseInt(extall.indexOf(ext)) < 0) {

                this.imagePreviewURL = this.base_url + `/images/user1.png`
                this.content_picture = null
            } else {
                if (file) {

                    this.imagePreviewURL = URL.createObjectURL(file)
                    console.log(this.imagePreviewURL);
                    URL.revokeObjectURL(file)
                } else {
                    this.imagePreviewURL = before_image
                }
            }
        },
        async onFileRemove() {
            this.content_picture = null
            this.imagePreviewURL = this.base_url + '/images/user1.png'
        },
    },
    created() {
    },
    mounted() {
        this.imagePreviewURL = this.base_url + '/images/user1.png'
        this.getDetail()
    },
    watch: {
        page() {

        }
    }
}
</script>

<style lang="scss">
.pagination_review {
    .v-icon {
        color: #707070 !important;
        font-size: 16px !important;
        font-weight: 500 !important;
        font-family: "Kanit", sans-serif !important;
    }

    .v-pagination__item {
        background: #F0F0F0 !important;
        box-shadow: none !important;
        color: #707070 !important;
        font-size: 16px !important;
        font-weight: 500 !important;
    }

    .v-pagination__item--active {
        background: #86D780 !important;
        color: #ffffff !important;
    }

    .v-pagination__navigation {
        background: #F0F0F0 !important;
        box-shadow: none !important;
        color: #707070 !important;
        font-size: 16px !important;
        font-weight: 500 !important;
    }


}
</style>
<style scoped lang="scss">
* {
    font-family: 'Kanit', sans-serif !important;
}

.role_admin {
    height: 21px;
    font-size: 12px;
    border-radius: 10px;
    background: linear-gradient(90deg, #E8BD4B 0%, #D19A3B 100%) !important;
}

.role_emp {
    height: 21px;
    font-size: 12px;
    border-radius: 10px;
    background: linear-gradient(90deg, #707070 0%, #1E1E1E 100%) !important;
}

.pagination_review {
    border-radius: 20px;
    background: #F0F0F0 !important;
    padding: 0 20px;
}


.review_approval_2 {
    width: 94px;
    height: 21px;
    border-radius: 10px;
    background: linear-gradient(90deg, #E8BD4B 0%, #D19A3B 100%);
    padding: 0 15px;

    color: #FFF;
    text-align: center;
    font-size: 12px;
    font-weight: 500;
}

.review_approval_3 {
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    text-wrap: nowrap;
    width: 94px;
    height: 21px;
    border-radius: 10px;
    background: linear-gradient(90deg, #707070 0%, #1E1E1E 100%);
    padding: 0 15px;

    color: #FFF;
    text-align: center;
    font-size: 12px;
    font-weight: 500;
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