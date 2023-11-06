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
                    <h1 class="font-20 m-0">จัดการผู้ใช้งาน</h1>
                </v-card-text>
                <v-card-text class="d-flex justify-end p-0">
                    <v-breadcrumbs :items="submenu" class="p-0">
                        <template v-slot:divider>
                            <v-icon>mdi-chevron-right</v-icon>
                        </template>
                    </v-breadcrumbs>
                </v-card-text>
            </div>

            <v-card elevation="2">
                <v-card-title class="justify-space-between text-card-title">
                    ผู้ใช้งานทั้งหมด
                </v-card-title>
                <v-card-subtitle class="mb-6">
                    <v-btn @click="linkPage('/manageuser/add')" class="btn-success pl-30 pr-30 mt-6" dark>
                        <img :src="base_url + `/images/icon/add-friend.png`" alt="" width="20" height="20" />
                        <span>เพิ่มผู้ใช้งาน</span>
                    </v-btn>
                </v-card-subtitle>
                <v-card-text>
                    <v-row>
                        <v-col xs="12" sm="6" md="8" lg="8" xl="8" cols="12">
                            <v-btn-toggle v-model="toggle_exclusive" borderless class="br-10">
                                <v-btn color="#B8C2CC">
                                    <span class="text-white fs-16">Copy</span>
                                </v-btn>
                                <v-btn color="#B8C2CC">
                                    <span class="text-white fs-16">PDF</span>
                                </v-btn>
                                <v-btn color="#B8C2CC">
                                    <span class="text-white fs-16">Print</span>
                                </v-btn>
                            </v-btn-toggle>
                        </v-col>
                        <v-col xs="12" sm="6" md="4" lg="4" xl="4" cols="12">
                            <v-text-field color="#B8C2CC" class="br-5" append-icon="mdi-magnify" hide-details="auto"
                                required v-model="search" placeholder="ค้นหา..." single-line outlined dense></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col xs="12" sm="12" md="12" lg="12" xl="12" cols="12">
                            <v-data-table :headers="headers" :items="desserts" :items-per-page="itemsPerPage" elevation="0"
                                :search="search" :page.sync="page" hide-default-footer @page-count="page = $event">
                                <template v-slot:item="{ item }">
                                    <tr>
                                        <td class="text-center">{{ `U-${item.id.toString().padStart(3, '0')}` }}</td>
                                        <td class="text-center">
                                            <v-avatar class="mt-1 mb-1">
                                                <img :src="item.pic_path" alt="John">
                                            </v-avatar>
                                        </td>
                                        <td>{{ item.name }}</td>
                                        <td>{{ item.tel }}</td>
                                        <td>{{ item.position }}</td>
                                        <td>
                                            <span class="review_approval_2" v-if="item.role == 1">ผู้ดูแลระบบ</span>
                                            <span class="review_approval_3" v-else>พนักงาน</span>
                                        </td>
                                        <td class="text-center">
                                            <v-btn @click="dialogResetRassword(item.id)" color="#60A577" elevation="2"
                                                outlined rounded>
                                                <v-icon class="mr-2">mdi-lock-reset</v-icon> รีเช็ตรหัสผ่าน</v-btn>
                                        </td>
                                        <td>
                                            <v-btn @click="dialogDetail(item.id)" class="ma-1 m-0 p-0" width="38"
                                                height="38" outlined large fab elevation="4" color="#0D99FF">
                                                <v-icon>mdi-magnify</v-icon>
                                            </v-btn>
                                            <v-btn @click="linkPage(`/manageuser/edit?id=${base64Encode(item.id)}`)"
                                                class="ma-1 m-0 p-0" width="38" height="38" outlined large fab elevation="4"
                                                color="#FF5B00">
                                                <v-icon>mdi-pencil</v-icon>
                                            </v-btn>
                                            <v-btn @click="dialogDelete(item.id)" class="ma-1 m-0 p-0" width="38"
                                                height="38" outlined large fab elevation="4" color="#FF1E1E">
                                                <v-icon>mdi-trash-can</v-icon>
                                            </v-btn>
                                        </td>
                                    </tr>
                                </template>
                            </v-data-table>
                        </v-col>
                        <v-col xs="12" sm="12" md="6" lg="6" xl="6" cols="12" class="d-flex align-items-center">
                            <div class="text-footer-table">แสดงตั้งแต่ 1 ถึง 10 จาก 12 รายการ</div>
                        </v-col>
                        <v-col xs="12" sm="12" md="6" lg="6" xl="6" cols="12">
                            <div class="d-flex align-items-center justify-end">
                                <v-pagination class="pagination_review" v-model="page" :length="pages" prev-icon="< ก่อน"
                                    next-icon="ต่อไป >" color="#86D780" navigation-color="#F0F0F0" flat
                                    circle></v-pagination>
                            </div>
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>

            <!-- Dialog Delete-->
            <v-dialog v-model="dialog_delete" width="500">
                <v-card>
                    <v-card-text class="d-flex flex-column align-center pb-0">
                        <img class="mt-4 mb-8" :src="base_url + `/images/exclamation.png`" alt="image list slide"
                            width="130" max-width="130" height="auto" />
                        <h3 class="mag-modal mb-8">ท่านแน่ใจใช่ไหม ที่จะต้องการลบข้อมูลนี้ !</h3>
                    </v-card-text>

                    <v-card-actions class="d-flex justify-center">
                        <v-btn @click="adminDelete()" class="btn-success mb-32 mr-4 pl-30 pr-30">
                            <span>ใช่ , ฉันต้องการลบ</span>
                        </v-btn>
                        <v-btn class="btn-danger mb-32 ml-4 pl-30 pr-30" @click="dialog_delete = false">
                            <span>ไม่ใช่</span>
                        </v-btn>
                    </v-card-actions>

                </v-card>
            </v-dialog>

            <!-- Dialog Reset Password-->
            <v-dialog v-model="dialog_reset_password" width="500">
                <v-card>
                    <v-card-text class="d-flex flex-column align-center pb-0">
                        <img class="mt-4 mb-8" :src="base_url + `/images/exclamation.png`" alt="image list slide"
                            width="130" max-width="130" height="auto" />
                        <h3 class="mag-modal mb-8">ท่านแน่ใจใช่ไหม ที่จะเปลี่ยนรหัสผ่าน !</h3>
                    </v-card-text>

                    <v-card-actions class="d-flex justify-center">
                        <v-btn @click="adminResetPassword()" class="btn-success mb-32 mr-4 pl-30 pr-30">
                            <span>ใช่ , ฉันต้องการเปลี่ยน</span>
                        </v-btn>
                        <v-btn class="btn-danger mb-32 ml-4 pl-30 pr-30" @click="dialog_reset_password = false">
                            <span>ไม่ใช่</span>
                        </v-btn>
                    </v-card-actions>

                </v-card>
            </v-dialog>

            <!-- Dialog Detail-->
            <v-dialog v-model="dialog_detail" width="1054">
                <v-card>
                    <v-card-title
                        class="text-h5 color-black fs-20 h-65 p-0 pl-30 pr-30 d-flex justify-space-between bg-F8F8F8">
                        <span>รายละเอียดผู้ใช้งาน</span>
                        <v-btn @click="dialog_detail = false" class="p-0 m-0" width="50" height="50"
                            style="min-width: 50px !important;">
                            <img class="p-0 m-0" :src="base_url + `/images/icon/close.png`" alt="" width="20" height="20" />
                        </v-btn>

                    </v-card-title>
                    <v-card class="mt-2 p-5 pt-3" elevation="0">
                        <v-list-item three-line class="pl-0 pr-0 ml-0 mr-0">
                            <div class="row-list w-100" style="gap: 50px;">
                                <div class="col-list image-list-slide">
                                    <img class="p-0 m-0 br-50" :src="base_url + `/public/` + data_detail.pic_path" alt=""
                                        width="150" height="150" />
                                </div>
                                <div class="col-list d-flex flex-column justify-center align-center w-100 max-w-100">
                                    <v-card-text class="p-0 mt-2">
                                        <div class="d-flex align-center mb-4 ">
                                            <img class="mr-2"
                                                :src="base_url + `/images/icon/a97d9bb00d624b994fee78c2738c1c8e.png`" alt=""
                                                width="20" height="20" />
                                            <span class="font-16 color-title-card ">ข้อมูลส่วนบุคคล</span>
                                        </div>
                                        <div>
                                            <v-row>
                                                <v-col cols="12" xs="12" sm="6" md="4" lg="4" xl="4">
                                                    <span class="fs-14 fw-500 color-707070">ชื่อ - สกุล : </span>
                                                    <span class="fs-16 fw-500 color-707070">{{ data_detail.name }}</span>
                                                </v-col>
                                                <v-col cols="12" xs="12" sm="6" md="4" lg="4" xl="4">
                                                    <span class="fs-14 fw-500 color-707070">เบอร์โทรศัพท์ : </span>
                                                    <span class="fs-16 fw-500 color-707070">{{ data_detail.tel }}</span>
                                                </v-col>
                                                <v-col cols="12" xs="12" sm="6" md="4" lg="4" xl="4">
                                                    <span class="fs-14 fw-500 color-707070">ตำแหน่งงาน : </span>
                                                    <span class="fs-16 fw-500 color-707070">{{ data_detail.position
                                                    }}</span>
                                                </v-col>
                                                <v-col cols="12" xs="12" sm="12" md="4" lg="4" xl="4">
                                                    <div class="d-flex align-center mb-4">
                                                        <img class="mr-2"
                                                            :src="base_url + `/images/icon/52ae51c12b94c5c0c0dac28c79d37c22.png`"
                                                            alt="" width="20" height="20" />
                                                        <span class="font-16 color-title-card">ข้อมูลการเข้าสู่ระบบ</span>
                                                    </div>
                                                    <span class="fs-14 fw-500 color-707070">ชื่อผู้ใช้งาน : </span>
                                                    <span class="fs-16 fw-500 color-707070">{{ data_detail.username
                                                    }}</span>
                                                </v-col>
                                                <v-col cols="12" xs="12" sm="12" md="4" lg="4" xl="4">
                                                    <div class="d-flex align-center mb-4">
                                                        <img class="mr-2"
                                                            :src="base_url + `/images/icon/b1e08be1addd3bdac663cd263fb993d9.png`"
                                                            alt="" width="20" height="20" />
                                                        <span
                                                            class="font-16 color-title-card">สิทธิ์การเข้าใช้งานระบบ</span>
                                                    </div>
                                                    <span class="fs-14 fw-500 color-707070">สิทธิ์ : </span>
                                                    <span class="fs-16 fw-500 color-707070">{{ data_detail.role === 1 ?
                                                        "ผู้ดูแลระบบ" : "ผู้ใช้งาน (จำกัดสิทธิ์)" }}</span>
                                                </v-col>
                                            </v-row>
                                        </div>
                                    </v-card-text>
                                </div>
                            </div>

                        </v-list-item>
                        <v-card v-if="data_detail.role === 0" elevation="0" class="mt-6">
                            <p class="font-14 fw-500 mt-0 text-ex color-B7B7B7">
                                ผู้ใช้งานมีสิทธิ์เข้าถึงฟังก์ชัน</p>

                            <!-- Checkbox user_permission -->
                            <v-row v-for="(data, i) in user_permission" v-if="data_detail[data.title_db] === 1" :key="i">
                                <v-col cols="12" xs="12" sm="12" md="3" lg="4" xl="3">
                                    <span class="fs-14 fw-500 color-707070">{{ data.topic }}</span>
                                </v-col>
                                <v-col cols="12" xs="12" sm="12" md="9" lg="8" xl="9">
                                    <v-row>
                                        <v-col v-for="(item, i) in data.items" v-if="data_detail[item.db] === 1" :key="i"
                                            cols="12" xs="12" sm="6" md="4" lg="4" xl="3">
                                            <span class="fs-12 fw-500 color-707070">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                                    viewBox="0 0 13 13" fill="none">
                                                    <path d="M1 7L3.5 11L12 1" stroke="#60A577" stroke-width="2" />
                                                </svg>
                                                {{ item.label }}
                                            </span>
                                        </v-col>
                                    </v-row>
                                </v-col>
                            </v-row>

                        </v-card>
                    </v-card>
                </v-card>
            </v-dialog>

        </div>
    </div>
</template>

<script>
import admin from '../../../api/admin.js';

export default {
    data() {
        return {
            dialog_delete: false,
            id_delete: null,

            dialog_detail: false,
            id_detail: null,

            dialog_reset_password: false,
            id_reset_password: null,

            loading_page: false,
            alert_success: false,
            alert_message_success: '',
            alert_error: false,
            alert_message_error: '',
            content_picture: null,
            imagePreviewURL: null,
            toggle_exclusive: null,
            submenu: [
                {
                    text: 'จัดการผู้ใช้งาน',
                    disabled: true,
                },
            ],
            search: "",
            page: 1,
            itemsPerPage: 10,
            headers: [
                {
                    text: 'ID',
                    align: 'center',
                    sortable: true,
                    value: 'id',
                },
                {
                    text: 'รูปภาพ', value: '',
                    align: 'center'
                },
                {
                    text: 'ชื่อ - สกุล', value: 'name',
                },
                {
                    text: 'เบอร์โทรศัพท์', value: 'tel',
                },
                {
                    text: 'ตำแหน่งงาน', value: 'position',
                },
                {
                    text: 'สถานะ', value: '',
                },
                {
                    text: 'รีเซ็ตรหัสผ่าน', value: '',
                    align: 'center'
                },
                {
                    text: 'จัดการ', value: '',
                },
            ],
            desserts: [

            ],
            page: 1,
            pages: 0,
            user_permission: [
                {
                    topic: 'Dashboard',
                    title_db: 'title_dashboard',
                    items: [
                        { label: 'ดูรายงาน', checked: 0, db: 'dashboard_view_report' }
                    ]
                },
                {
                    topic: 'จัดการคำร้อง',
                    title_db: 'title_manage_request',
                    items: [
                        { label: 'ดูรายการคำร้องทั้งหมด', checked: 0, db: 'manage_request_view_request' },
                        { label: 'เปลี่ยนสถานะคำร้อง', checked: 0, db: 'manage_request_change_status' },
                    ]
                },
                {
                    topic: 'จัดการการเช่า',
                    title_db: 'title_manage_rental',
                    items: [
                        { label: 'ดูรายการเช่าทั้งหมด', checked: 0, db: 'manage_rental_view_rental' },
                        { label: 'ดูรายงาน', checked: 0, db: 'manage_rental_view_report' },
                    ]
                },
                {
                    topic: 'สมาชิกผู้เช่า',
                    title_db: 'title_tenant_member',
                    items: [
                        { label: 'ดูรายการผู้เช่าทั้งหมด ', checked: 0, db: 'tenant_member_view_tenant' },
                        { label: 'เพิ่มผู้เช่าใหม่', checked: 0, db: 'tenant_member_add_tenant' },
                        { label: 'แก้ไขข้อมูลผู้เช่า', checked: 0, db: 'tenant_member_edit_tenant' },
                        { label: 'ประชาสัมพันธ์ร้าน', checked: 0, db: 'tenant_member_publicize_shop' },
                    ]
                },
                {
                    topic: 'การจัดการผู้ใช้งาน',
                    title_db: 'title_manage_user',
                    items: [
                        { label: 'ดูรายการผู้ใช้งานทั้งหมด', checked: 0, db: 'manage_user_view_user' },
                        { label: 'เพิ่มผู้ใช้งาน', checked: 0, db: 'manage_user_add_user' },
                        { label: 'แก้ไขข้อมูลผู้ใช้งาน', checked: 0, db: 'manage_user_edit_user' },
                    ]
                },
                {
                    topic: 'จัดการตลาด',
                    title_db: 'title_manage_market',
                    items: [
                        { label: 'ดูรายการแผงตลาดทั้งหมด', checked: 0, db: 'manage_market_view_market' },
                    ]
                },
                {
                    topic: 'จัดการเว็บไซต์ประชาสัมพันธ์',
                    title_db: 'title_manage',
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
            ],
            get_data: [],
            data_detail: {}
        }
    },
    methods: {
        // Get List admin
        async getList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await admin.adminList(this.page, '', config).then((result) => {
                if (result.data.success === true) {
                    this.get_data = result.data.data;
                    this.desserts = result.data.data.map(item => {
                        return {
                            id: item.id,
                            pic_path: this.base_url + `/public/` + item.pic_path,
                            name: item.name,
                            tel: item.tel,
                            position: item.position,
                            role: item.role,
                        };
                    });

                    this.pages = result.data.pages;
                    this.page = parseInt(result.data.current_page);
                }
            }).catch((error) => {
                if (error.response.status === 401) {
                    this.loading_page = false
                    this.$store.commit('logOutSuccess')
                    this.$router.push('/login')
                }
            })
        },
        // Delete admin By ID
        async adminDelete() {
            this.loading_page = true;

            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await admin.adminDelete(this.id_delete, config).then((result) => {
                if (result.data.success === true) {
                    this.getList()
                    this.loading_page = false;
                    this.dialog_delete = false
                    this.alert_success = true
                    this.alert_message_success = 'ลบแบนเนอร์เรียบร้อยแล้ว'
                    setTimeout(() => this.alert_success = false, 3000)
                }
            }).catch((error) => {
                if (error.response.status === 401) {
                    this.loading_page = false
                    this.$store.commit('logOutSuccess')
                    this.$router.push('/login')
                }
            })

        },


        // Reset Password admin By ID
        async adminResetPassword() {
            this.loading_page = true;

            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            let data = new FormData();
            data.append('id', this.id_reset_password);
            data.append('password', '123456');
            console.log(data)
            await admin.adminUpdate(data, config).then((result) => {
                if (result.data.success === true) {
                    this.dialog_reset_password = false
                    this.loading_page = false;
                    this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                    this.$router.push('/manageuser')
                }
            }).catch((error) => {
                if (error.response.status === 401) {
                    this.loading_page = false
                    this.$store.commit('logOutSuccess')
                    this.$router.push('/login')
                }
            })

        },

        async onFileChange(payload) {
            const file = payload
            let extall = "png,PNG,jpeg,JPEG,jpg,JPG";
            let file_ext = file.name;

            let ext = file_ext.split('.').pop().toLowerCase();
            if (parseInt(extall.indexOf(ext)) < 0) {

                this.imagePreviewURL = this.base_url + `/images/image-list-slide.png`
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
            this.imagePreviewURL = this.base_url + '/images/image-list-slide.png'
        },

        async dialogDelete(id) {
            this.id_delete = id
            this.dialog_delete = true
        },

        async dialogDetail(id) {
            this.id_detail = id
            this.data_detail = this.get_data.filter(v => v.id === id)[0]
            this.dialog_detail = true
        },

        async dialogResetRassword(id) {
            this.id_reset_password = id
            this.dialog_reset_password = true
        }
    },
    created() {
    },
    mounted() {
        this.imagePreviewURL = this.base_url + '/images/image-list-slide.png'
        this.getList()
    },
    watch: {
        page() {
            this.getList()
        }
    },

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
    display: flex;
    align-items: center;
    justify-content: center;
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