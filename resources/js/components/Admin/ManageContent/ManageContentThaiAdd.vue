<template>
    <div class="loading_all_page" v-if="loading_page === true">
        <v-progress-circular indeterminate size="70" :width="8" color="#FFBC15"></v-progress-circular>
        <p class="mt-3">กำลังโหลดข้อมูล</p>
    </div>

    <div v-else>
        <div class="container">
            <div class="d-flex justify-space-between align-items-center mt-4 mb-4">
                <v-card-text class="p-0">
                    <h1 class="font-20 m-0">จัดการข่าวสารและกิจกรรม</h1>
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
                        <v-row class="m-0 p-2">
                            <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                                <v-card elevation="0">
                                    <v-tabs background-color="transparent" color="basil" grow v-model="active_tab">
                                        <v-tab @click="linkPage('/managecontent/thai_add')">
                                            ภาษาไทย
                                        </v-tab>
                                        <v-tab @click="linkPage('/managecontent/eng_add')">
                                            ภาษาอังกฤษ
                                        </v-tab>
                                        <v-tab @click="linkPage('/managecontent/manage_seo')">
                                            จัดการ SEO
                                        </v-tab>
                                    </v-tabs>

                                    <v-card color="basil" flat>
                                        <v-card-title class="mt-4 p-0 text-card-title">
                                            <v-row class="container-title">
                                                <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                                                    <p>ข้อมูลข่าวสารและกิจกรรมภาษาไทย</p>
                                                </v-col>
                                            </v-row>
                                        </v-card-title>
                                        <v-row>
                                            <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                                                <v-form ref="form_content_edit" v-on:submit.prevent="contentAdd()">
                                                    <v-card class="mt-2 p-5 pt-3 hfc" elevation="2">
                                                        <v-list-item three-line class="pl-0 pr-0 ml-0 mr-0">
                                                            <div class="row-list" style="gap: 50px;">
                                                                <div class="col-list image-list-slide">
                                                                    <img class="mt-4" v-if="imagePreviewURL"
                                                                        :src="imagePreviewURL" alt="image list slide"
                                                                        width="100%" height="auto"
                                                                        style="max-width: 420px;" />
                                                                </div>
                                                                <div
                                                                    class="col-list d-flex flex-column justify-center align-center">
                                                                    <v-card-text class="p-0 mt-2">
                                                                        <div class="d-flex align-center">
                                                                            <img class="mr-2"
                                                                                :src="base_url + `/images/icon/title.png`"
                                                                                alt="Title" width="20" height="20" />
                                                                            <span
                                                                                class="font-16 color-title-card">เพิ่มรูปภาพหน้าปกข่าวสารและกิจกรรม
                                                                                <span style="color: red;">*</span></span>
                                                                        </div>
                                                                        <div>
                                                                            <p class="font-14 mt-3 text-ex">คำแนะนำ :
                                                                                ขนาดรูปภาพแนะนำ 1920 x 1080
                                                                                หรือรูปสี่เหลี่ยมผืนผ้า ขนาดไฟล์ไม่เกิน 2 gb
                                                                                สกุลไฟล์ jpg png jpeg เท่านั้น</p>

                                                                            <v-file-input class="w-100" outlined dense
                                                                                id="uploader" accept="image/*"
                                                                                v-model="content_picture"
                                                                                :rules="[v => !!v || 'กรุณาเลือกรูปภาพ']"
                                                                                @change="onFileChange" single-line clearable
                                                                                clear-icon="" label="กรุณาเลือกไฟล์รูปภาพ"
                                                                                required></v-file-input>
                                                                        </div>
                                                                    </v-card-text>
                                                                </div>
                                                            </div>
                                                        </v-list-item>
                                                        <v-card-text class="p-0 mt-8">
                                                            <div class="d-flex align-center mb-2">
                                                                <img class="mr-2"
                                                                    :src="base_url + `/images/icon/megaphone 1.png`"
                                                                    alt="Keyword" width="20" height="20" />

                                                                <span
                                                                    class="font-16 color-title-card">หัวข้อข่าวสารและกิจกรรม
                                                                    <span style="color: red;">*</span></span>
                                                            </div>
                                                            <div>
                                                                <v-text-field hide-details="auto" label="กรุณากรอกหัวข้อข่าวสารและกิจกรรม"
                                                                    v-model="title_thai" outlined dense single-line
                                                                    :rules="rules.title_thai" :counter="45"></v-text-field>
                                                            </div>
                                                        </v-card-text>
                                                        <v-card-text class="p-0">
                                                            <div class="d-flex align-center mb-2">
                                                                <img class="mr-2"
                                                                    :src="base_url + `/images/icon/megaphone 2.png`"
                                                                    alt="Keyword" width="20" height="20" />

                                                                <span class="font-16 color-title-card">รายละเอียดโดยย่อ
                                                                    <span style="color: red;">*</span></span>
                                                            </div>
                                                            <div>
                                                                <v-text-field hide-details="auto" label="กรุณากรอกรายละเอียดโดยย่อ"
                                                                    v-model="sub_title_thai" outlined dense single-line
                                                                    :rules="brief_detail_topicRules"
                                                                    :counter="150"></v-text-field>
                                                            </div>
                                                        </v-card-text>
                                                        <v-card-text class="p-0">
                                                            <div class="d-flex align-center mb-2">
                                                                <img class="mr-2"
                                                                    :src="base_url + `/images/icon/megaphone 3.png`"
                                                                    alt="Keyword" width="20" height="20" />

                                                                <span
                                                                    class="font-16 color-title-card">รายละเอียดข่าวสารและกิจกรรม
                                                                    <span style="color: red;">*</span></span>
                                                            </div>
                                                            <div>
                                                                <vue-editor v-model="description_thai"></vue-editor>
                                                            </div>
                                                        </v-card-text>
                                                        <v-card-actions>
                                                            <v-card-text class="p-0 d-flex justify-center">
                                                                <v-btn type="submit" class="btn-success pl-30 pr-30"
                                                                    color="warning" dark>
                                                                    <span>บันทึกข้อมูล</span>
                                                                </v-btn>
                                                            </v-card-text>
                                                        </v-card-actions>
                                                    </v-card>
                                                </v-form>
                                            </v-col>
                                        </v-row>
                                    </v-card>
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
import { VueEditor } from "vue2-editor";
import content from '../../../api/content.js';
export default {
    components: {
        VueEditor
    },
    data() {
        return {
            loading_page: false,
            active_tab: 0,
            content_picture: null,
            imagePreviewURL: null,
            submenu: [
                {
                    text: 'จัดการเว็บไซต์ประชาสัมพันธ์',
                    disabled: false,
                },
                {
                    text: 'จัดการข่าวสารและกิจกรรม',
                    disabled: false,
                },
                {
                    text: 'เพิ่มข่าวสารและกิจกรรม',
                    disabled: true,
                },
            ],
            title_thai: '',
            sub_title_thai: '',
            description_thai: '',
            rules: {
                title_thai: [v => v.length <= 45 || 'สูงสุด 45 ตัวอักษร'],
                sub_title_thai: [v => v.length <= 150 || 'สูงสุด 150 ตัวอักษร']
            },
        }
    },
    methods: {

        async contentAdd() {
            if (this.$refs.form_content_edit.validate()) {
                this.loading_page = true;
                let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.access_token}`,
                    },
                }
                const data = new FormData()
                data.append('title_thai', this.title_thai)
                data.append('sub_title_thai', this.sub_title_thai)
                data.append('description_thai', this.description_thai)
                data.append('pic', this.content_picture)
                await content.contentAdd(data, config).then((result) => {
                    if (result.data.success === true) {
                        this.loading_page = false;
                        this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                        this.$router.push(`/managecontent/thai_edit?id=${this.base64Encode(result.data.id)}`)
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

                this.imagePreviewURL = this.base_url + '/images/image-list-slide.png'
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

.container-title {
    @media screen and (max-width: 960px) {
        flex-direction: column;
    }
}

.container-title-left {
    display: flex;
    justify-content: flex-end;

    // margin-top: 16px;
    @media screen and (max-width: 960px) {
        justify-content: start;
        margin-top: -16px;
    }

}

.text-card-title {
    p {
        margin: 0;
        padding: 0;
    }

    span {
        color: #707070;
        font-size: 12px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
    }
}

.btn-success {
    margin-top: 10px;
    border-radius: 30px;
    background: linear-gradient(90deg, #86D780 0%, #60A577 100%);
    box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);

    color: #F9F9F9;
    font-size: 16px;

}

.text-last-edit {
    color: #707070;
    // text-align: right;
    font-size: 16px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
}

.text-search-subtitle {
    color: #707070;
    font-size: 12px;
    font-style: normal;
    font-weight: 400;
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