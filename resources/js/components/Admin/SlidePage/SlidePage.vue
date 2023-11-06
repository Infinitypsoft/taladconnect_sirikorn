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
                    <h1 class="font-20 m-0">จัดการภาพปกสไลด์</h1>
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
                        <v-row class="m-0 p-4 screen-column-960">
                            <v-col cols="12" xs="12" sm="12" md="12" lg="8" xl="8">
                                <v-card-title class="p-0 text-card-title">
                                    <p>รูปภาพปกสไลด์หน้าเว็บไซด์</p>
                                </v-card-title>
                                <v-card-subtitle class="p-0 mb-4">
                                    <v-btn @click="linkPage('/slide/add')" class="btn-success pl-30 pr-30" color="warning"
                                        dark>
                                        <v-icon class="icon-btn fs-20 mr-2" large color="white">
                                            mdi-image-plus
                                        </v-icon>
                                        <span>เพิ่มรูปภาพ</span>
                                    </v-btn>
                                </v-card-subtitle>

                                <v-card v-for="(data, i) in banner_data" class="mt-2" elevation="2" :key="i">

                                    <v-list-item three-line>
                                        <div class="row-list">
                                            <div class="col-list image-list-slide max-w-419 w-100">
                                                <img class="mt-4 object-fit-cover max-w-419 w-100"
                                                    :src="base_url + '/public/' + data.pic_path" alt="image list slide"
                                                    width="100%" max-width="419" max-height="238" height="238" />
                                            </div>
                                            <div class="col-list ml-4">
                                                <v-list-item-content class="card-content">
                                                    <v-list-item-title class="text-item-title">
                                                        คำเชิญชวน
                                                    </v-list-item-title>
                                                    <v-list-item-subtitle class="text-item-detail">
                                                        ภาษาไทย : {{ data.title_thai }}
                                                    </v-list-item-subtitle>
                                                    <v-list-item-subtitle class="text-item-detail">
                                                        ภาษาอังกฤษ : {{ data.title_eng }}
                                                    </v-list-item-subtitle>
                                                    <v-list-item-title class="text-item-title">
                                                        รายละเอียด
                                                    </v-list-item-title>
                                                    <v-list-item-subtitle class="text-item-detail">
                                                        ภาษาไทย : {{ data.description_thai }}
                                                    </v-list-item-subtitle>
                                                    <v-list-item-subtitle class="text-item-detail">
                                                        ภาษาอังกฤษ : {{ data.description_eng }}
                                                    </v-list-item-subtitle>
                                                </v-list-item-content>
                                            </div>
                                        </div>
                                    </v-list-item>

                                    <v-card-actions class="d-flex align-center m-0 mt-4">
                                        <v-row class="screen-column-960">
                                            <v-col xs="12" sm="12" md="9" lg="9" xl="9">
                                                <v-card-text class="text-last-edit">
                                                    แก้ไขล่าสุดโดย {{ data.user_edit_name }} {{ data.updated_date }}
                                                </v-card-text>
                                            </v-col>
                                            <v-col class="d-flex justify-end align-center option-list-slide" xs="12" sm="12"
                                                md="3" lg="3" xl="3">
                                                <v-switch v-model="data.status" @click="statusEdit(data.id, data.status)"
                                                    inset color="#86D870"></v-switch>
                                                <v-btn @click="linkPage(`/slide/edit?id=${base64Encode(data.id)}`)"
                                                    class="ma-1 m-0 p-0" width="38" height="38" outlined large fab
                                                    elevation="4" color="#FF5B00">
                                                    <v-icon>mdi-pencil</v-icon>
                                                </v-btn>

                                                <v-btn class="ma-1 m-0 p-0" width="38" height="38" outlined large fab
                                                    elevation="4" color="#FF1E1E" @click="dialogDelete(data.id)">
                                                    <v-icon>mdi-trash-can</v-icon>
                                                </v-btn>
                                            </v-col>
                                        </v-row>
                                    </v-card-actions>
                                </v-card>

                                <v-pagination class="mt-3" v-model="page" :length="pages" :total-visible="3" circle
                                    color="#86D780" navigation-color="#F0F0F0"></v-pagination>

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

            <v-dialog v-model="dialog" width="500">
                <v-card>
                    <v-card-text class="d-flex flex-column align-center pb-0">
                        <img class="mt-4 mb-8" :src="base_url + `/images/exclamation.png`" alt="image list slide"
                            width="130" max-width="130" height="auto" />
                        <h3 class="mag-modal mb-8">ท่านแน่ใจใช่ไหม
                            ที่จะต้องการลบข้อมูลนี้ !</h3>
                    </v-card-text>
                    <v-form class="mt-3" ref="banner_delete" @submit.prevent="bannerDelete()">
                        <v-card-actions class="d-flex justify-center">
                            <v-btn type="submit" class="btn-success mb-32 mr-4 pl-30 pr-30">
                                <v-icon class="mr-2 fs-20" dark>
                                    mdi mdi-check
                                </v-icon>
                                <span>ใช่ , ฉันต้องการลบ</span>
                            </v-btn>
                            <v-btn class="btn-danger mb-32 ml-4 pl-30 pr-30" @click="dialog = false">
                                <v-icon class="mr-2 fs-20" dark>
                                    mdi mdi-close
                                </v-icon>
                                <span>ไม่ใช่ </span>
                            </v-btn>
                        </v-card-actions>
                    </v-form>
                </v-card>
            </v-dialog>
        </div>
    </div>
</template>

<script>
import banner from '../../../api/banner.js';

export default {
    data() {
        return {
            dialog: false,
            loading_page: false,
            alert_success: false,
            alert_message_success: '',
            alert_error: false,
            alert_message_error: '',
            submenu: [
                {
                    text: 'จัดการเว็บไซต์ประชาสัมพันธ์',
                    disabled: false,
                },
                {
                    text: 'จัดการภาพปกสไลด์',
                    disabled: true,
                },
            ],
            switch1: true,
            slides: [
                'คำเชิญชวน 1',
                'คำเชิญชวน 2',
                'คำเชิญชวน 3',
                'คำเชิญชวน 4',
                'คำเชิญชวน 5',
            ],
            page: 1,
            pages: 3,
            banner_data: [],
            id_delete: null
        }
    },
    methods: {

        // Get List Banner
        async getList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await banner.bannerList(this.page, '', config).then((result) => {
                if (result.data.success === true) {
                    this.banner_data = result.data.data;
                    this.pages = result.data.pages;
                    this.page = parseInt(result.data.current_page);
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
            await banner.statusEdit(data, config).then((result) => {
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

        // Delete Banner By ID
        async bannerDelete() {
            
                let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.access_token}`,
                    },
                }
                await banner.bannerDelete(this.id_delete, config).then((result) => {
                    if (result.data.success === true) {
                        this.getList()
                        this.dialog = false
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
        dialogDelete(id){
            this.id_delete = id
            this.dialog = true
        }
    },
    created() {
    },
    mounted() {
        this.getList()
    },
    watch: {
        page() {
            this.getList()
        }
    }
}
</script>



<style scoped lang="scss">
* {
    font-family: 'Kanit', sans-serif !important;
}


.text-last-edit {
    color: #707070;
    font-size: 16px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;

    @media screen and (max-width: 960px) {
        & {
            padding-bottom: 0;
        }
    }
}

.text-item-title {
    color: #60A577;
    font-size: 16px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
}

.text-item-detail {
    color: #707070;
    font-size: 14px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
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

.option-list-slide {
    @media screen and (max-width: 960px) {
        justify-content: center !important;
    }
}

.card-content {
    gap: 10px;
}
</style>