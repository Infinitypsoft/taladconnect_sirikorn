<template>
    <div class="loading_all_page" v-if="loading_page === true">
        <v-progress-circular indeterminate size="70" :width="8" color="#FFBC15"></v-progress-circular>
        <p class="mt-3">กำลังโหลดข้อมูล</p>
    </div>

    <div v-else>
        <div class="container">
            <div class="d-flex justify-space-between align-items-center mt-4 mb-4">
                <v-card-text class="p-0">
                    <h1 class="font-20 m-0">จัดการภาพแกลลอรี่</h1>
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
                                <v-card-title class="p-0 text-card-title">
                                    <v-row class="container-title">
                                        <v-col xs="12" sm="12" md="6" lg="6" xl="6">
                                            <p>รูปภาพแกลลอรี่</p>
                                        </v-col>
                                    </v-row>
                                </v-card-title>
                                <v-card-subtitle class="p-0 mb-2">
                                    <v-btn v-if="gallery_pic_data[0].pic_path === null" @click="linkPage('/managegallery/add')"
                                        class="btn-success pl-30 pr-30" color="warning" dark>
                                        <v-icon class="icon-btn fs-20 mr-2" large color="white">
                                            mdi-image-plus
                                        </v-icon>
                                        <span>เพิ่มข้อมูลแกลอรี่</span>
                                    </v-btn>
                                    <v-btn v-else @click="linkPage('/managegallery/add')" class="btn-edit pl-30 pr-30"
                                        color="warning" dark>
                                        <v-icon class="icon-btn fs-20 mr-2" large color="white">
                                            mdi-image-plus
                                        </v-icon>
                                        <span>แก้ไขข้อมูลแกลอรี่</span>
                                    </v-btn>
                                </v-card-subtitle>

                                <v-row class="pt-25">
                                    <v-col class="pt-0 d-flex justify-center" xs="12" sm="12" md="12" lg="12" xl="12">
                                        <v-card-title class="pt-0 d-flex flex-column">
                                            <h1 class="fs-48 fw-600 mb-0 pb-0 color-black">
                                                {{ gallery_info_data.title_thai ? gallery_info_data.title_thai : 'รูปภาพแกลลอรี่' }}</h1>
                                            <p class="fs-18 fw-400 pt-5 color-212621">
                                                {{ gallery_info_data.description_thai ? gallery_info_data.description_thai : 'รายละเอียดแกลลอรี่' }}</p>
                                        </v-card-title>
                                    </v-col>

                                </v-row>
                                <div class="container">
                                    <v-row>
                                        <v-col class="p-1 m-0" cols="12" xs="12" sm="12" md="4" lg="4" xl="4">
                                            <div class="pb-2">
                                                <v-img v-if="gallery_pic_data[0].pic_path" width="100%" height="245"
                                                    :src="base_url + '/public/' + gallery_pic_data[0].pic_path"></v-img>
                                                <v-img v-else width="100%" height="245"
                                                    :src="base_url + `/images/gallery/01.png`"></v-img>

                                            </div>
                                            <div class="pb-2">
                                                <v-img v-if="gallery_pic_data[1].pic_path" width="100%" height="500"
                                                    :src="base_url + '/public/' + gallery_pic_data[1].pic_path"></v-img>
                                                <v-img v-else width="100%" height="500"
                                                    :src="base_url + `/images/gallery/02.png`"></v-img>
                                            </div>
                                            <div class="pb-2">
                                                <v-img v-if="gallery_pic_data[2].pic_path" width="100%" height="245"
                                                    :src="base_url + '/public/' + gallery_pic_data[2].pic_path"></v-img>
                                                <v-img v-else width="100%" height="245"
                                                    :src="base_url + `/images/gallery/03.png`"></v-img>
                                            </div>
                                        </v-col>
                                        <v-col class="p-1" cols="12" xs="12" sm="12" md="4" lg="4" xl="4">
                                            <div class="pb-2">
                                                <v-img v-if="gallery_pic_data[3].pic_path" width="100%" height="500"
                                                    :src="base_url + '/public/' + gallery_pic_data[3].pic_path"></v-img>
                                                <v-img v-else width="100%" height="500"
                                                    :src="base_url + `/images/gallery/04.png`"></v-img>
                                            </div>
                                            <div class="pb-2">
                                                <v-img v-if="gallery_pic_data[4].pic_path" width="100%" height="500"
                                                    :src="base_url + '/public/' + gallery_pic_data[4].pic_path"></v-img>
                                                <v-img v-else width="100%" height="500"
                                                    :src="base_url + `/images/gallery/05.png`"></v-img>
                                            </div>
                                        </v-col>
                                        <v-col class="p-1" cols="12" xs="12" sm="12" md="4" lg="4" xl="4">
                                            <div class="pb-2">
                                                <v-img v-if="gallery_pic_data[5].pic_path" width="100%" height="245"
                                                    :src="base_url + '/public/' + gallery_pic_data[5].pic_path"></v-img>
                                                <v-img v-else width="100%" height="245"
                                                    :src="base_url + `/images/gallery/06.png`"></v-img>
                                            </div>
                                            <div class="pb-2">
                                                <v-img v-if="gallery_pic_data[6].pic_path" width="100%" height="245"
                                                    :src="base_url + '/public/' + gallery_pic_data[6].pic_path"></v-img>
                                                <v-img v-else width="100%" height="245"
                                                    :src="base_url + `/images/gallery/07.png`"></v-img>
                                            </div>
                                            <div class="pb-2">
                                                <v-img v-if="gallery_pic_data[7].pic_path" width="100%" height="245"
                                                    :src="base_url + '/public/' + gallery_pic_data[7].pic_path"></v-img>
                                                <v-img v-else width="100%" height="245"
                                                    :src="base_url + `/images/gallery/08.png`"></v-img>
                                            </div>
                                            <div class="pb-2">
                                                <v-img v-if="gallery_pic_data[8].pic_path" width="100%" height="245"
                                                    :src="base_url + '/public/' + gallery_pic_data[8].pic_path"></v-img>
                                                <v-img v-else width="100%" height="245"
                                                    :src="base_url + `/images/gallery/09.png`"></v-img>
                                            </div>
                                        </v-col>
                                    </v-row>
                                </div>
                            </v-col>
                        </v-row>
                    </v-card>
                </v-col>
            </v-row>

            <v-dialog v-model="dialog" width="500">
                <v-card>
                    <v-card-text class="d-flex flex-column align-center pb-0">
                        <img class="mt-4 mb-8" :src="base_url + `/images/exclamation.png`" alt="image list slide"
                            width="130" max-width="130" height="auto" />
                        <h3 class="mag-modal mb-1">ท่านแน่ใจใช่ไหม
                            ที่จะต้องการลบข้อมูลนี้ !</h3>
                    </v-card-text>

                    <v-card-actions class="d-flex justify-center">
                        <v-btn class="btn-success mb-32 mr-4 pl-30 pr-30">
                            <span>ใช่ , ฉันต้องการลบ</span>
                        </v-btn>
                        <v-btn class="btn-danger mb-32 ml-4 pl-30 pr-30" @click="dialog = false">
                            <span>ไม่ใช่ </span>
                        </v-btn>
                    </v-card-actions>

                </v-card>
            </v-dialog>
        </div>
    </div>
</template>

<script>
import gallery from '../../../api/gallery.js';

export default {
    data() {
        return {
            dialog: false,
            loading_page: false,
            submenu: [
                {
                    text: 'จัดการเว็บไซต์ประชาสัมพันธ์',
                    disabled: false,
                },
                {
                    text: 'จัดการภาพแกลลอรี่',
                    disabled: true,
                },
            ],
            gallery_pic_data: [],
            gallery_info_data: {},

        }
    },
    methods: {
        async getList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await gallery.galleryList(config).then((result) => {
                if (result.data.success === true) {
                    this.gallery_pic_data = result.data.data;
                    this.gallery_info_data = result.data.data_info;
                }

            })
        }
    },
    created() {
    },
    mounted() {
        this.getList()
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

.text-domain-name {
    color: #707070;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.text-search-subtitle {
    color: #707070;
    font-size: 12px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}
</style>