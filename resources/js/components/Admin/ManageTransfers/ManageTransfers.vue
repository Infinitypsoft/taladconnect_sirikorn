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
                    <h1 class="font-20 m-0">ตั้งค่าช่องทางรับเงินโอน</h1>
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
                    ช่องทางรับเงินโอน
                </v-card-title>
                <v-card-subtitle class="mb-2">
                    <v-btn @click="dialog_add_or_edit = true" class="btn-success pl-30 pr-30 mt-6" color="warning" dark>
                        <img :src="base_url + `/images/icon/card.png`" alt="" width="20" height="20" class="" />
                        <span class="ml-2">เพิ่มช่องทางการรับเงินโอน</span>
                    </v-btn>
                </v-card-subtitle>
                <v-card-text>
                    <v-row>
                        <v-col cols=""></v-col>
                        <v-col xs="12" sm="6" md="4" lg="4" xl="4" cols="12">
                            <v-text-field color="#B8C2CC" class="input-radius" append-icon="mdi-magnify" hide-details="auto"
                                required v-model="search" placeholder="ค้นหา..." single-line outlined dense></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col xs="12" sm="12" md="12" lg="12" xl="12" cols="12">
                            <v-data-table :headers="headers" :items="desserts" :items-per-page="itemsPerPage" elevation="0"
                                :search="search" :page.sync="page" hide-default-footer @page-count="page = $event">
                                <template v-slot:item="{ item }">
                                    <tr class="">
                                        <td>{{ `${item.id.toString().padStart(1, '0')}` }}</td>
                                        <td class=""><img height="111" :src="item.pic_path" class="my-3" alt="">
                                        </td>
                                        <td>{{ item.bankname }}</td>
                                        <td>{{ item.number }}</td>
                                        <td>{{ item.account }}</td>
                                        <td>
                                            <v-switch v-model="item.status" @click="statusEdit(item.id, item.status)" inset
                                                color="#86D870"></v-switch>
                                        </td>
                                        <td>
                                            <v-btn
                                                @click="dialogEdit(item.id, item.bankname, item.number, item.account, item.pic, item.pic_path)"
                                                class="ma-1 m-0 p-0" width="38" height="38" outlined large fab elevation="4"
                                                color="#FF5B00">
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


            <!-- Dialog Add Or Edit-->
            <v-dialog v-model="dialog_add_or_edit" width="1054">
                <v-card>
                    <v-card-title
                        class="text-h5 color-black fs-20 h-65 p-0 pl-30 pr-30 d-flex justify-space-between bg-F8F8F8">
                        <span v-if="id_edit === null">เพิ่มช่องทางการรับเงินโอน</span>
                        <span v-else>แก้ไขช่องทางการรับเงินโอน</span>
                        <v-btn @click="() => { dialog_add_or_edit = false }" class="p-0 m-0" width="50" height="50"
                            style="min-width: 50px !important;">
                            <img class="p-0 m-0" :src="base_url + `/images/icon/close.png`" alt="Keyword" width="20"
                                height="20" />
                        </v-btn>
                    </v-card-title>
                    <v-card class="mt-2 p-5 pt-3" elevation="0">
                        <v-form ref="form_transfer_add_or_edit"
                            v-on:submit.prevent="id_edit ? transferEdit() : transferAdd()">
                            <v-card-text class="p-0 mt-5">
                                <div class="row">
                                    <div class="col-list col-4  text-center image-list-slide">
                                        <v-img class="mt-4" v-if="imagePreviewURL" :src="imagePreviewURL"
                                            alt="image list slide" width="250" height="200" style="max-width: 400px;" />
                                    </div>

                                    <div class="col-list col-8 d-flex flex-column justify-center align-center">
                                        <v-card-text class="p-0 mt-2">
                                            <div class="d-flex align-center">
                                                <img class="mr-2"
                                                    :src="base_url + `/images/icon/d41b2ce1f43c76c24da0e89c84f024f5.png`"
                                                    alt="Title" width="20" height="20" />
                                                <span class="font-16 color-title-card">เพิ่มรูปภาพช่องทางการรับเงินโอน
                                                    <span style="color: red;">*</span></span>
                                            </div>
                                            <div>
                                                <p class="font-14 mt-3 text-ex">คำแนะนำ : ขนาดไฟล์ไม่เกิน 2 gb สกุลไฟล์ jpg
                                                    png jpeg เท่านั้น</p>

                                                <v-file-input class="w-100" outlined dense id="uploader" accept="image/*"
                                                    v-model="content_picture" :rules="[v => !!v || 'กรุณาเลือกรูปภาพ']"
                                                    @change="onFileChange" single-line clearable="false" clear-icon=""
                                                    label="กรุณาเลือกไฟล์รูปภาพ" required></v-file-input>
                                            </div>
                                        </v-card-text>
                                    </div>

                                </div>
                                <div class="d-flex align-center mt-5 pt-5">
                                    <img class="mr-2" :src="base_url + `/images/icon/megaphone_green.png`" alt="Keyword"
                                        width="20" height="20" />

                                    <span class="font-16 color-title-card">ข้อมูลช่องทางการรับเงินโอน</span>
                                </div>
                                <div>
                                    <p class="font-14 mt-5 text-ex">ชื่อธนาคาร <span class="text-red"> * </span> </p>
                                    <v-text-field label="กรุณากรอกชื่อธนาคาร เช่น พร้อมเพย์ , ธนาคารxxxxxx"
                                        v-model="bank_name" outlined dense single-line :rules="rules.bank_name"
                                        hide-details=""></v-text-field>
                                </div>
                                <div>
                                    <p class="font-14 mt-5 text-ex">เลขบัญชี <span class="text-red"> * </span> </p>
                                    <v-text-field label="กรุณากรอกเลขบัญชี" v-model="bank_number"  outlined dense single-line
                                    @keypress="isNumber($event, bank_number)"
                                        :rules="rules.bank_number" hide-details=""></v-text-field>
                                </div>
                                <div>
                                    <p class="font-14 mt-5 text-ex">ชื่อบัญชี <span class="text-red"> * </span> </p>
                                    <v-text-field label="กรุณากรอกชื่อบัญชี" v-model="account_name" outlined dense
                                        single-line :rules="rules.account_name" hide-details=""></v-text-field>
                                </div>
                            </v-card-text>
                            <v-card-actions>
                                <v-card-text class="p-0 d-flex justify-center">
                                    <v-btn type="submit" class="btn-success pl-30 pr-30" color="warning" dark>
                                        <v-icon class="fs-20" left dark>
                                            mdi-content-save
                                        </v-icon>
                                        <span>บันทึกข้อมูล</span>
                                    </v-btn>
                                </v-card-text>
                            </v-card-actions>
                        </v-form>

                    </v-card>
                </v-card>
            </v-dialog>


            <!-- Dialog Delete -->
            <v-dialog v-model="dialog_delete" width="500">
                <v-card>
                    <v-card-text class="d-flex flex-column align-center pb-0">
                        <img class="mt-4 mb-8" :src="base_url + `/images/exclamation.png`" alt="image list slide"
                            width="130" max-width="130" height="auto" />
                        <h3 class="mag-modal mb-8">ท่านแน่ใจใช่ไหม ที่จะต้องการลบข้อมูลนี้ !</h3>
                    </v-card-text>

                    <v-card-actions class="d-flex justify-center">
                        <v-btn @click="transferDelete()" class="btn-success mb-32 mr-4 pl-30 pr-30">
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
import transfer from '../../../api/transfer.js';

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
                    text: 'ตั้งค่าช่องทางรับเงินโอน',
                    disabled: true,
                },
            ],
            search: "",
            // pageCount: 0,
            itemsPerPage: 10,
            headers: [
                {
                    text: 'ลำดับ',
                    align: 'center',
                    sortable: true,
                    value: 'id',
                },
                {
                    text: 'รูปภาพ',
                    value: 'img',
                    align: 'start'
                },
                {
                    text: 'ชื่อธนาคาร',
                    value: 'bankname',
                },
                {
                    text: 'เลขบัญชี',
                    value: 'number',
                },
                {
                    text: 'ชื่อบัญชี',
                    value: 'account',
                    align: 'center'
                },
                {
                    text: 'สถานะ',
                    value: 'status',
                    align: 'center'
                },
                {
                    text: 'จัดการ',
                    value: 'manage',
                    align: 'center'
                },
            ],
            desserts: [
                // {
                //     id: 1,
                //     bankname: 'พร้อมเพย์',
                //     number: 'xxx-xxxxxxx',
                //     account: 'นาย xxxxx    xxxxxxxx',
                //     status: 0,
                // }, {
                //     id: 2,
                //     bankname: 'ธนาคารกสิกรไทย สาขาหนองแคม',
                //     number: 'xxx-x-xxxxx-x',
                //     account: 'บริษัท อิ่มเอมบารมี จำกัด',
                //     status: 1,
                // }
            ],
            rules: {
                bank_name: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                bank_number: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                account_name: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
            },
            bank_name: '',
            bank_number: '',
            account_name: '',
            page: 1,
            pages: 0,
            get_data: [],
            id_delete: null
        }
    },
    methods: {
        // Get List transfer
        async getList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await transfer.transferList(this.page, 10, config).then((result) => {
                if (result.data.success === true) {
                    this.get_data = result.data.data;

                    this.desserts = result.data.data.map(item => {
                        return {
                            id: item.id,
                            pic: item.pic,
                            pic_path: this.base_url + `/public/` + item.pic_path,
                            bankname: item.bank_name,
                            number: item.bank_number,
                            account: item.account_name,
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
            await transfer.statusEdit(data, config).then((result) => {
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

        async transferAdd() {
            if (this.$refs.form_transfer_add_or_edit.validate()) {
                let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.access_token}`,
                    },
                }
                this.loading_page = true;
                let data = new FormData();
                data.append('pic', this.content_picture);
                data.append('bank_name', this.bank_name);
                data.append('bank_number', this.bank_number);
                data.append('account_name', this.account_name);


                await transfer.transferAdd(data, config).then((result) => {
                    if (result.data.success === true) {
                        this.dialog_add_or_edit = false
                        this.loading_page = false;
                        this.getList()
                        this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                        // this.$router.push('/managetransfers')
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

        async transferEdit() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }

            const data = new FormData()
            data.append('id', this.id_edit)
            if (this.content_picture.size) {
                data.append('pic', this.content_picture);
            }

            data.append('bank_name', this.bank_name);
            data.append('bank_number', this.bank_number);
            data.append('account_name', this.account_name);
            // console.log(data);
            await transfer.transferUpdate(data, config).then((result) => {
                if (result.data.success === true) {
                    this.dialog_add_or_edit = false
                    this.loading_page = false;
                    this.getList()
                    this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                    // this.$router.push('/managerenter')
                }
            }).catch((error) => {
                if (error.response.status === 401) {
                    this.loading_page = false
                    this.$store.commit('logOutSuccess')
                    this.$router.push('/login')
                }
            })
        },

        // Delete transfer By ID
        async transferDelete() {
            // this.loading_page = true
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }

            await transfer.transferDelete(this.id_delete, config).then((result) => {
                if (result.data.success === true) {
                    this.getList()
                    this.dialog_delete = false
                    this.alert_success = true
                    this.loading_page = false
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
            this.bank_name = null
            this.bank_number = null
            this.account_name = null
            this.imagePreviewURL = this.base_url + `/images/image-list-slide.png`
        },

        async dialogEdit(id, bank_name, bank_number, account_name, pic, pic_path) {
            this.id_edit = id
            this.bank_name = bank_name
            this.bank_number = bank_number
            this.account_name = account_name

            this.content_picture = { name: pic }
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
.text-red {
    color: #E60023 !important;
}

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



.row-list {
    display: flex;
    justify-content: flex-start;

    @media screen and (max-width: 960px) {
        flex-direction: column;

        .image-list-slide {
            display: flex;
            justify-content: center;
            width: 100% !important;
            max-width: 100% !important;
        }
    }

    .col-list {
        width: fit-content;
        max-width: fit-content;

    }
}
</style>
