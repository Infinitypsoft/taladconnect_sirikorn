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
                    <h1 class="font-20 m-0">จัดการรางวัลและมาตรฐาน</h1>
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
                    รางวัลและมาตรฐานทั้งหมด
                </v-card-title>
                <v-card-subtitle class="mb-6">
                    <v-btn @click="dialogAdd()" class="btn-success pl-30 pr-30 mt-6" color="warning" dark>
                        <img :src="base_url + `/images/icon/add-friend 1.png`" alt="" width="20" height="20" />
                        <span>เพิ่มรูปภาพ</span>
                    </v-btn>
                </v-card-subtitle>
                <v-card-text>
                    <v-row>
                        <v-col xs="12" sm="6" md="8" lg="8" xl="8" cols="12">

                        </v-col>
                        <v-col xs="12" sm="6" md="4" lg="4" xl="4" cols="12">
                            <v-text-field color="#B8C2CC" class="input-radius" append-icon="mdi-magnify" hide-details="auto"
                                required v-model="search" placeholder="ค้นหา..." single-line outlined dense></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col xs="12" sm="12" md="12" lg="12" xl="12" cols="12">
                            <v-data-table :headers="headers" :items="desserts" :items-per-page="itemsPerPage" elevation="0"
                                :search="search" :page.sync="page" hide-default-footer @page-count="pageCount = $event">
                                <template v-slot:item="{ item }">
                                    <tr>
                                        <td>{{ `A-${item.id.toString().padStart(3, '0')}` }}</td>
                                        <td><v-img class="mr-2" :src="item.pic_path" alt="" width="70" height="70" /></td>
                                        <td>{{ item.name_thai }}</td>
                                        <td>{{ item.name_eng }}</td>
                                        <td><v-switch v-model="item.status" @click="statusEdit(item.id, item.status)" inset
                                                color="#86D870"></v-switch></td>
                                        <td><v-btn
                                                @click="dialogEdit(item.id, item.name_thai, item.name_eng, item.pic_path)"
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
                                <v-pagination class="pagination_review" v-model="page" :length="pageCount"
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
                        <v-btn @click="awardDelete()" class="btn-success mb-32 mr-4 pl-30 pr-30">
                            <span>ใช่ , ฉันต้องการลบ</span>
                        </v-btn>
                        <v-btn class="btn-danger mb-32 ml-4 pl-30 pr-30" @click="dialog_delete = false">
                            <span>ไม่ใช่</span>
                        </v-btn>
                    </v-card-actions>

                </v-card>
            </v-dialog>

            <!-- Dialog Add Or Edit-->
            <v-dialog v-model="dialog_add_or_edit" width="1054">
                <v-card>
                    <v-card-title
                        class="text-h5 color-black fs-20 h-65 p-0 pl-30 pr-30 d-flex justify-space-between bg-F8F8F8">
                        <span v-if="id_edit">แก้ไขรางวัลและมาตรฐาน</span>
                        <span v-else>เพิ่มรางวัลและมาตรฐาน</span>
                        <v-btn @click="() => { dialog_add_or_edit = false }" class="p-0 m-0" width="50" height="50"
                            style="min-width: 50px !important;">
                            <img class="p-0 m-0" :src="base_url + `/images/icon/close.png`" alt="Keyword" width="20"
                                height="20" />
                        </v-btn>

                    </v-card-title>
                    <v-card class="mt-2 p-5 pt-3" elevation="0">
                        <v-form ref="form_banner_add" v-on:submit.prevent="id_edit ? awardEdit() : awardAdd()">
                            <v-list-item three-line class="pl-0 pr-0 ml-0 mr-0">
                                <div class="row-list w-100" style="gap: 50px;">
                                    <div class="col-list image-list-slide">
                                        <img class="mt-4 object-fit-cover" v-if="imagePreviewURL" :src="imagePreviewURL"
                                            alt="image list slide" width="250" height="250" />
                                    </div>
                                    <div class="col-list d-flex flex-column justify-center align-center w-100 max-w-100">
                                        <v-card-text class="p-0 mt-2">
                                            <div class="d-flex align-center">
                                                <img class="mr-2" :src="base_url + `/images/icon/picture.png`" alt="Picture"
                                                    width="20" height="20" />
                                                <span class="font-16 color-title-card">เพิ่มรูปภาพรางวัลและมาตรฐาน
                                                    <span style="color: red;">*</span></span>
                                            </div>
                                            <div>
                                                <p class="font-14 mt-3 text-ex">คำแนะนำ : ขนาดรูปภาพแนะนำ 500x500
                                                    หรือรูปสี่เหลี่ยมจัตุรัส ขนาดไฟล์ไม่เกิน 2 gb สกุลไฟล์ jpg png jpeg
                                                    เท่านั้น
                                                </p>

                                                <v-file-input class="w-100" outlined dense id="uploader" accept="image/*"
                                                    v-model="content_picture" :rules="[v => !!v || 'กรุณาเลือกรูปภาพ']"
                                                    @change="onFileChange" single-line clearable clear-icon=""
                                                    label="กรุณาเลือกไฟล์รูปภาพ" required></v-file-input>
                                            </div>
                                        </v-card-text>
                                    </div>
                                </div>
                            </v-list-item>
                            <v-card-text class="p-0 mt-5">
                                <div class="d-flex align-center">
                                    <img class="mr-2" :src="base_url + `/images/icon/megaphone 4.png`" alt="Keyword"
                                        width="20" height="20" />

                                    <span class="font-16 color-title-card">คำเชิญชวน</span>
                                </div>
                                <div>
                                    <p class="font-14 mt-3 text-ex">ภาษาไทย</p>
                                    <v-text-field label="กรุณากรอกคำเชิญชวนที่จะแสดงหน้าเว็บไซต์ เป็นภาษาไทย"
                                        v-model="name_thai" outlined dense single-line :rules="name_thaiRules"
                                        :counter="120"></v-text-field>
                                </div>
                                <div>
                                    <p class="font-14 text-ex">ภาษาอังกฤษ</p>
                                    <v-text-field :rules="name_engRules" :counter="120" v-model="name_eng" outlined dense
                                        single-line
                                        label="กรุณากรอกคำเชิญชวนที่จะแสดงหน้าเว็บไซต์ เป็นภาษาอังกฤษ"></v-text-field>
                                </div>
                            </v-card-text>
                            <v-card-actions>
                                <v-card-text class="p-0 d-flex justify-center">
                                    <v-btn type="submit" @click="" class="btn-success pl-30 pr-30" color="warning" dark>
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

        </div>
    </div>
</template>

<script>
import award from '../../../api/award.js';

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
                    text: 'จัดการผู้ใช้งาน',
                    disabled: true,
                },
            ],
            search: "",
            page: 1,
            pageCount: 0,
            itemsPerPage: 10,
            headers: [
                {
                    text: 'ID',
                    align: 'center',
                    sortable: true,
                    value: 'id',
                },
                {
                    text: 'รูปภาพ', value: 'pic_path',
                    align: 'start'
                },
                {
                    text: 'ชื่อรางวัลและมาตรฐานภาษาไทย', value: 'name_thai',
                },
                {
                    text: 'ชื่อรางวัลและมาตรฐานภาษาอังกฤษ', value: 'name_eng',
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
            pages: 5,
            award_data: [],
            id_delete: null
        }
    },
    methods: {
        // Get List award
        async getList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await award.awardList(this.page, '', config).then((result) => {
                if (result.data.success === true) {
                    this.award_data = result.data.data;

                    this.desserts = result.data.data.map(item => {
                        return {
                            id: item.id,
                            pic_path: this.base_url + `/public/` + item.pic_path,
                            name_thai: item.name_thai,
                            name_eng: item.name_eng,
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
            await award.statusEdit(data, config).then((result) => {
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

        async awardAdd() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            this.loading_page = true;
            const data = new FormData()
            data.append('pic', this.content_picture)
            data.append('name_thai', this.name_thai)
            data.append('name_eng', this.name_eng)
            await award.awardAdd(data, config).then((result) => {
                if (result.data.success === true) {
                    this.dialog_add_or_edit = false
                    this.loading_page = false;
                    this.getList()
                    this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                    this.$router.push('/manageaward')
                }
            }).catch((error) => {
                if (error.response.status === 401) {
                    this.loading_page = false
                    this.$store.commit('logOutSuccess')
                    this.$router.push('/login')
                }
            })
        },

        async awardEdit() {
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
            await award.awardUpdate(data, config).then((result) => {
                if (result.data.success === true) {
                    this.dialog_add_or_edit = false
                    this.loading_page = false;
                    this.getList()
                    this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                    this.$router.push('/manageaward')
                }
            }).catch((error) => {
                if (error.response.status === 401) {
                    this.loading_page = false
                    this.$store.commit('logOutSuccess')
                    this.$router.push('/login')
                }
            })
        },

        // Delete award By ID
        async awardDelete() {

            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await award.awardDelete(this.id_delete, config).then((result) => {
                if (result.data.success === true) {
                    this.getList()
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