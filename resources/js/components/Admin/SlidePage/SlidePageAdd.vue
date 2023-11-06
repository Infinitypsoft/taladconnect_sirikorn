<template>
    <div class="loading_all_page" v-if="loading_page === true">
        <v-progress-circular indeterminate size="70" :width="8" color="#FFBC15"></v-progress-circular>
        <p class="mt-3">กำลังโหลดข้อมูล</p>
    </div>

    <div v-else>
        <div class="container">
            <div class="d-flex justify-space-between align-items-center mt-4 mb-4">
                <v-card-text class="p-0">
                    <h1 class="font-20 m-0">เพิ่มภาพปกสไลด์</h1>
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
                            <v-col xs="12" sm="12" md="12" lg="8" xl="8">
                                <v-card-title class="p-0 text-card-title">
                                    <p>รูปภาพปกสไลด์หน้าเว็บไซด์</p>
                                </v-card-title>
                                <div class="container-image-upload">
                                    <div class="slide-image-upload">
                                        <img class="mt-4 max-h-238 h-100" v-if="imagePreviewURL" :src="imagePreviewURL"
                                            alt="image list slide" width="100%" height="auto" style="max-width: 420px;" />
                                    </div>
                                </div>
                                <v-form ref="form_banner_add" v-on:submit.prevent="bannerAdd()">
                                    <v-card-text class="p-0 mt-8">
                                        <div class="d-flex align-center">
                                            <img class="mr-2" :src="base_url + `/images/icon/picture.png`" alt="Keyword"
                                                width="20" height="20" />

                                            <span class="font-16 color-title-card">เพิ่มรูปภาพหน้าปกสไลด์ *</span>
                                        </div>
                                        <div>
                                            <p class="font-14 mt-3 text-ex">คำแนะนำ : ขนาดรูปภาพแนะนำ 1920 x 1080
                                                หรือรูปสี่เหลี่ยมผืนผ้า ขนาดไฟล์ไม่เกิน 2 gb สกุลไฟล์ jpg png jpeg เท่านั้น
                                            </p>
                                            <v-file-input class="w-100" outlined dense id="uploader" accept="image/*"
                                                v-model="content_picture" :rules="[v => !!v || 'กรุณาเลือกรูปภาพ']"
                                                @change="onFileChange" single-line clearable clear-icon=""
                                                label="กรุณาเลือกไฟล์รูปภาพ" required></v-file-input>
                                        </div>
                                    </v-card-text>
                                    <v-card-text class="p-0">
                                        <div class="d-flex align-center">
                                            <img class="mr-2" :src="base_url + `/images/icon/megaphone.png`" alt="Keyword"
                                                width="20" height="20" />

                                            <span class="font-16 color-title-card">คำเชิญชวน</span>
                                        </div>
                                        <div>
                                            <p class="font-14 mt-3 text-ex">ภาษาไทย</p>
                                            <v-text-field label="กรุณากรอกคำเชิญชวนที่จะแสดงหน้าเว็บไซต์ เป็นภาษาไทย"
                                                v-model="title_thai" outlined dense single-line :rules="invitation_thRules"
                                                :counter="27"></v-text-field>
                                        </div>
                                        <div>
                                            <p class="font-14 text-ex">ภาษาอังกฤษ</p>
                                            <v-text-field :rules="invitation_enRules" :counter="25" v-model="title_eng"
                                                outlined dense single-line
                                                label="กรุณากรอกคำเชิญชวนที่จะแสดงหน้าเว็บไซต์ เป็นภาษาอังกฤษ"></v-text-field>
                                        </div>
                                    </v-card-text>
                                    <v-card-text class="p-0">
                                        <div class="d-flex align-center">
                                            <img class="mr-2" :src="base_url + `/images/icon/detail.png`" alt="Keyword"
                                                width="20" height="20" />

                                            <span class="font-16 color-title-card">รายละเอียด</span>
                                        </div>
                                        <div>
                                            <p class="font-14 mt-3 text-ex">ภาษาไทย</p>
                                            <v-textarea outlined single-line v-model="description_thai"
                                                label="กรุณากรอกรายละเอียดที่จะแสดงหน้าเว็บไซต์ เป็นภาษาไทย"
                                                :rules="detail_thRules" :counter="120" ></v-textarea>
                                        </div>
                                        <div>
                                            <p class="font-14 text-ex">ภาษาอังกฤษ</p>
                                            <v-textarea outlined single-line v-model="description_eng"
                                                label="กรุณากรอกรายละเอียดที่จะแสดงหน้าเว็บไซต์ เป็นภาษาอังกฤษ"
                                                :rules="detail_enRules" :counter="80"></v-textarea>
                                        </div>
                                    </v-card-text>
                                    <div class="d-flex justify-center">
                                        <v-btn type="submit" color="white" class="ma-2 btn-save rounded-pill pl-30 pr-30">
                                            <v-icon class="fs-20" left dark>
                                                mdi-content-save
                                            </v-icon>
                                            <span>บันทึกข้อมูล</span>
                                        </v-btn>
                                    </div>
                                </v-form>
                            </v-col>
                            <v-col xs="12" sm="12" md="12" lg="4" xl="4">
                                <v-card elevation="2">
                                    <div class="title-color-bar"></div>
                                    <v-carousel cycle height="267" hide-delimiter-background :show-arrows="false">
                                        <v-carousel-item v-for="(slide, i) in slides" :key="i">
                                            <v-sheet color="#D9D9D9" height="100%">
                                                <v-row class="fill-height" align="center" justify="center">
                                                    <img class="img-slide" :src="base_url + `/images/picture.png`"
                                                        height="140" alt="Picture" style="width: 140px; opacity: 0.5;" />
                                                    <v-row style="height: 100%;">
                                                        <v-col class="d-flex flex-column justify-end" style="flex: 1;"
                                                            xs="12" sm="12" md="12" lg="7" xl="7">
                                                            <span style="font-size: 20px; font-weight: 500;">*ขนาดแนะนำ 1920
                                                                x 1080</span>
                                                        </v-col>
                                                        <v-col class="d-flex flex-column  justify-center align-end" xs="12"
                                                            sm="12" md="12" lg="5" xl="5">
                                                            <h1 class="pr-3 text-carousel-title"> {{ slide }}</h1>
                                                            <span class="pr-3 text-carousel-subtitle">รายละเอียด </span>
                                                        </v-col>
                                                    </v-row>
                                                </v-row>
                                            </v-sheet>
                                        </v-carousel-item>
                                    </v-carousel>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-card>
                </v-col>
            </v-row>
        </div>
    </div>
</template>

<script>
import banner from '../../../api/banner.js';

export default {
    data() {
        return {
            loading_page: false,
            content_picture: null,
            imagePreviewURL: null,
            submenu: [
                {
                    text: 'จัดการเว็บไซต์ประชาสัมพันธ์',
                    disabled: false,
                },
                {
                    text: 'จัดการภาพปกสไลด์',
                    disabled: false,
                },
                {
                    text: 'เพิ่มภาพปกสไลด์',
                    disabled: true,
                },
            ],
            slides: [
                'คำเชิญชวน 1',
                'คำเชิญชวน 2',
                'คำเชิญชวน 3',
                'คำเชิญชวน 4',
                'คำเชิญชวน 5',
            ],
            invitation_thRules: [
                v => !!v && v.length <= 27 || 'สูงสุด 27 ตัวอักษร',
            ],
            invitation_enRules: [
                v => !!v && v.length <= 25 || 'สูงสุด 25 ตัวอักษร',
            ],
            detail_thRules: [
                v => !!v && v.length <= 120 || 'สูงสุด 120 ตัวอักษร',
            ],
            detail_enRules: [
                v => !!v && v.length <= 80 || 'สูงสุด 80 ตัวอักษร',
            ],
            title_thai: '',
            title_eng: '',
            description_thai: '',
            description_eng: '',
        }
    },
    methods: {
        async bannerAdd() {
            if (this.$refs.form_banner_add.validate()) {
                let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.access_token}`,
                    },
                }
                const data = new FormData()
                data.append('pic', this.content_picture)
                data.append('title_thai', this.title_thai)
                data.append('title_eng', this.title_eng)
                data.append('description_thai', this.description_thai)
                data.append('description_eng', this.description_eng)

                await banner.bannerAdd(data, config).then((result) => {
                    if (result.data.success === true) {
                        this.loading_page = false;
                        this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                        this.$router.push('/slide')
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

    }
}
</script>

<style scoped lang="scss">
* {
    font-family: 'Kanit', sans-serif !important;
}

.title-color-bar {
    height: 37px;
    background: #86D780;
    box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
}


.img-slide {
    position: absolute;
}

.text-carousel-title {
    color: #000;
    font-size: 35px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
}

.text-carousel-subtitle {
    color: #000;
    font-size: 16px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
}

.slide-image-upload {
    width: 419px;
    height: 238px;
    background: #D9D9D9;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container-image-upload {
    display: flex;
    justify-content: center;
}
</style>