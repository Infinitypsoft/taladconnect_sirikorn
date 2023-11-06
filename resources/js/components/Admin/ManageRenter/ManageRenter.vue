<template>
    <div class="loading_all_page" v-if="loading_page === true">
        <v-progress-circular indeterminate size="70" :width="8" color="#FFBC15"></v-progress-circular>
        <p class="mt-3">กำลังโหลดข้อมูล</p>
    </div>

    <div v-else data-aos="fade-up">
        <v-slide-x-reverse-transition>
            <v-alert type="success" class="alert_all_page" v-if="alert_success === true">{{ alert_message_success
            }}</v-alert>
            <v-alert type="error" class="alert_all_page" v-if="alert_error === true">{{ alert_message_error }}</v-alert>
        </v-slide-x-reverse-transition>

        <div class="container">
            <div class="d-flex justify-space-between align-items-center mt-4 mb-4">
                <v-card-text class="p-0">
                    <h1 class="font-20 m-0">จัดการสมาชิกผู้เช่า</h1>
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
                    สมาชิกผู้เช่าทั้งหมด
                </v-card-title>
                <v-card-subtitle class="mb-6">
                    <v-btn @click="linkPage('/managerenter/add')" class="btn-success pl-30 pr-30 mt-6" color="warning" dark>
                        <img :src="base_url + `/images/icon/add-friend.png`" alt="" width="20" height="20" />
                        <span>เพิ่มสมาชิกผู้เช่า</span>
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
                            <v-text-field color="#B8C2CC" class="input-radius" append-icon="mdi-magnify" hide-details="auto"
                                required v-model="search" placeholder="ค้นหา..." single-line outlined dense></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col xs="12" sm="12" md="12" lg="12" xl="12" cols="12">
                            <v-data-table :headers="headers" :items="desserts" :items-per-page="itemsPerPage" elevation="0" hide-default-footer>
                                <template v-slot:item="{ item }">
                                    <tr>
                                        <td>{{ `R-${item.id.toString().padStart(3, '0')}` }}</td>
                                        <td>{{ item.tenant_name }}</td>
                                        <td>{{ item.phone }}</td>
                                        <td>{{ item.store_name }}</td>
                                        <td>
                                            <v-switch v-model="item.status" @click="statusEdit(item.id, item.status)" inset
                                                color="#86D870"></v-switch>
                                        </td>
                                        <td>
                                            <v-btn @click="linkPage('/managerenter/detail?id='+base64Encode(item.id))" class="ma-1 m-0 p-0" width="38"
                                                height="38" outlined large fab elevation="4" color="#0D99FF">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M16.325 14.8987L21.705 20.2787C21.8941 20.468 22.0003 20.7246 22.0002 20.9921C22.0001 21.2596 21.8937 21.5161 21.7045 21.7052C21.5153 21.8943 21.2587 22.0005 20.9912 22.0004C20.7236 22.0003 20.4671 21.894 20.278 21.7047L14.898 16.3247C13.2897 17.5704 11.2673 18.1566 9.24214 17.9641C7.21699 17.7716 5.34124 16.8148 3.99649 15.2884C2.65174 13.7619 1.939 11.7806 2.00326 9.74729C2.06753 7.71402 2.90396 5.7816 4.34242 4.34315C5.78087 2.9047 7.71329 2.06826 9.74656 2.004C11.7798 1.93973 13.7612 2.65248 15.2876 3.99723C16.814 5.34198 17.7708 7.21772 17.9634 9.24287C18.1559 11.268 17.5697 13.2905 16.324 14.8987H16.325ZM10 15.9997C11.5913 15.9997 13.1174 15.3676 14.2427 14.2424C15.3679 13.1172 16 11.591 16 9.99974C16 8.40845 15.3679 6.88232 14.2427 5.7571C13.1174 4.63189 11.5913 3.99974 10 3.99974C8.40871 3.99974 6.88259 4.63189 5.75737 5.7571C4.63215 6.88232 4.00001 8.40845 4.00001 9.99974C4.00001 11.591 4.63215 13.1172 5.75737 14.2424C6.88259 15.3676 8.40871 15.9997 10 15.9997Z"
                                                        fill="#0D99FF" />
                                                </svg>
                                            </v-btn>

                                            <v-btn @click="linkPage(`/managerenter/edit?id=${base64Encode(item.id)}`)" class="ma-1 m-0 p-0" width="38"
                                                height="38" outlined large fab elevation="4" color="#FF5B00">
                                                <v-icon>mdi-pencil</v-icon>
                                            </v-btn>

                                            <v-btn @click="dialogDelete(item.id)
                                                " class="ma-1 m-0 p-0" width="38" height="38" outlined large fab
                                                elevation="4" color="#FF1E1E">
                                                <v-icon>mdi-trash-can</v-icon>
                                            </v-btn>
                                        </td>
                                    </tr>
                                </template>
                            </v-data-table>
                        </v-col>
                        <v-col xs="12" sm="12" md="6" lg="6" xl="6" cols="12">
                            <div class="text-footer-table">แสดงตั้งแต่ 1 ถึง 10 จาก 12 รายการ</div>
                        </v-col>
                        <v-col xs="12" sm="12" md="6" lg="6" xl="6" cols="12">
                            <div class="d-flex align-items-center justify-end mt-3">
                                <v-pagination class="pagination_review" v-model="page" :length="pages"
                                    prev-icon="< ก่อน" next-icon="ต่อไป >" color="#86D780" navigation-color="#F0F0F0" flat
                                    circle></v-pagination>
                            </div>
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>

            <!-- Dialog Delete -->
            <v-dialog v-model="dialog_delete" width="500">
                <v-card>
                    <v-card-text class="d-flex flex-column align-center pb-0">
                        <img class="mt-4 mb-8" :src="base_url + `/images/exclamation.png`" alt="image list slide"
                            width="130" max-width="130" height="auto" />
                        <h3 class="mag-modal mb-8">ท่านแน่ใจใช่ไหม ที่จะต้องการลบข้อมูลนี้ !</h3>
                    </v-card-text>

                    <v-card-actions class="d-flex justify-center">
                        <v-btn @click="renterDelete()" class="btn-success mb-32 mr-4 pl-30 pr-30">
                            <span>ใช่ , ฉันต้องการลบ</span>
                        </v-btn>
                        <v-btn class="btn-danger mb-32 ml-4 pl-30 pr-30" @click="dialog_delete = false">
                            <span>ไม่ใช่</span>
                        </v-btn>
                    </v-card-actions>

                </v-card>
            </v-dialog>

        </div>
    </div>
</template>

<script>
import tennant from '../../../api/tennant.js';

export default {
    data() {
        return {
            loading_page: false,
            alert_success: false,
            alert_message_success: '',
            alert_error: false,
            alert_message_error: '',
            dialog_add_or_edit: false,
            dialog_delete: false,
            content_picture: null,
            imagePreviewURL: null,
            id_delete: null,
            id_edit: null,
            submenu: [
                {
                    text: 'จัดการสมาชิกผู้เช่า',
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
                    text: 'ชื่อผู้เช่า', value: 'tenant_name',
                    align: 'start'
                },
                {
                    text: 'เบอร์โทร', value: 'phone',
                },
                {
                    text: 'ชื่อร้านค้า', value: 'store_name',
                },
                {
                    text: 'สถานะ', value: 'status',
                    align: 'center'
                },
                {
                    text: 'จัดการ', value: 'manage',
                    align: 'center'
                },
            ],
            desserts: [],
            name_thaiRules: [
                v => !!v && v.length <= 120 || 'สูงสุด 120 ตัวอักษร',
            ],
            name_engRules: [
                v => !!v && v.length <= 120 || 'สูงสุด 120 ตัวอักษร',
            ],
            name_thai: '',
            name_eng: '',
            page: 1,
            pages: 0,
            get_data: [],
            id_delete: null
        }
    },
    methods: {
        // Get List renter
        async getList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await tennant.tennantList(this.page, '', config).then((result) => {
                if (result.data.success === true) {
                    this.get_data = result.data.data;

                        this.desserts = result.data.data.map(item => {
                            return {
                                id: item.id,
                                tenant_name: item.name === null ? item.company_name : item.name,
                                phone: item.tel,
                                store_name: '',
                                status: item.status,
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

        // Status Edit
        async statusEdit(id, status) {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            const data = {
                id,
                status,
            }
            await tennant.statusEdit(data, config).then((result) => {
                if (result.data.success === true) {
                    this.alert_success = true
                    this.alert_message_success = 'เปลี่ยนสถานะเรียบร้อยแล้ว'
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

        async renterAdd() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            const data = new FormData()
            data.append('pic', this.content_picture)
            data.append('name_thai', this.name_thai)
            data.append('name_eng', this.name_eng)
            // await renter.renterAdd(data, config).then((result) => {
            //     if (result.data.success === true) {
            //         this.dialog_add_or_edit = false
            //         this.loading_page = false;
            //         this.getList()
            //         this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
            //         this.$router.push('/managerenter')
            //     }
            // }).catch((error) => {
            //     if (error.response.status === 401) {
            //         this.loading_page = false
            //         this.$store.commit('logOutSuccess')
            //         this.$router.push('/login')
            //     }
            // })
        },

        async renterEdit() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }

            const data = new FormData()
            data.append('id', this.id_edit)
            data.append('pic', this.content_picture)
            data.append('name_thai', this.name_thai)
            data.append('name_eng', this.name_eng)
            console.log(data);
            // await renter.renterUpdate(data, config).then((result) => {
            //     if (result.data.success === true) {
            //         this.dialog_add_or_edit = false
            //         this.loading_page = false;
            //         this.getList()
            //         this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
            //         this.$router.push('/managerenter')
            //     }
            // }).catch((error) => {
            //     if (error.response.status === 401) {
            //         this.loading_page = false
            //         this.$store.commit('logOutSuccess')
            //         this.$router.push('/login')
            //     }
            // })
        },

        // Delete renter By ID
        async renterDelete() {

            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            this.loading_page = true

            await tennant.tennantDelete(this.id_delete, config).then((result) => {
                if (result.data.success === true) {
                    this.getList()
                    this.loading_page = false
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

        async dialogDelete(id) {
            this.id_delete = id
            this.dialog_delete = true
        },

        async dialogAdd() {
            this.id_edit = null
            this.dialog_add_or_edit = true
            this.content_picture = null
            this.name_thai = null
            this.name_eng = null
            this.imagePreviewURL = this.base_url + `/images/image-list-slide.png`
        },

        async dialogEdit(id, name_thai, name_eng, pic_path) {
            this.id_edit = id
            this.name_thai = name_thai
            this.name_eng = name_eng
            this.content_picture = { name: pic_path }
            this.imagePreviewURL = pic_path
            this.dialog_add_or_edit = true
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

.pagination_review {
    border-radius: 20px;
    background: #F0F0F0 !important;
    padding: 0 20px;
}

.review_approval_1 {
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    text-wrap: nowrap;
    width: 112px;
    height: 38px;
    border-radius: 20px;
    border: 1px solid #60A577;
    padding: 0 15px;

    color: #60A577;
    font-size: 14px;
    font-weight: 500;
}

.review_approval_2 {
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    text-wrap: nowrap;
    width: 94px;
    height: 21px;
    border-radius: 10px;
    background: linear-gradient(90deg, #85D680 0%, #62A878 100%);
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
    background: linear-gradient(90deg, #E10122 0%, #9D0A0F 100%);
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
