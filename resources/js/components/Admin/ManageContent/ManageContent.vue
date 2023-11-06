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
                        <v-row class="m-0 p-4">
                            <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                                <v-card-title class="p-0 text-card-title">
                                    <v-row class="container-title">
                                        <v-col xs="12" sm="12" md="6" lg="6" xl="6">
                                            <p class="m-0 p-0">ข่าวสารและกิจกรรมบนเว็บไซต์</p>
                                        </v-col>
                                        <v-col class="container-title-left" xs="12" sm="12" md="6" lg="6" xl="6">
                                            <div style="width: 209px;">
                                                <v-select @change="changeLang()" class="custom-v-select"
                                                    v-model="stall_select_lang" item-value="id" item-text='name'
                                                    :items="items_select" outlined dense single-line
                                                    label="ภาษาไทย"></v-select>
                                            </div>
                                        </v-col>
                                    </v-row>
                                </v-card-title>
                                <v-card-subtitle class="p-0 mb-2">
                                    <v-btn @click="linkPage('/managecontent/thai_add')" class="btn-success pl-30 pr-30"
                                        color="warning" dark>
                                        <v-icon class="icon-btn fs-20 mr-2" large color="white">
                                            mdi-file-document-edit-outline
                                        </v-icon>
                                        <span>เพิ่มข่าวสารและกิจกรรม</span>
                                    </v-btn>
                                </v-card-subtitle>
                                <v-row>
                                    <v-col v-for="(data, i) in content_data" :key="i" xs="12" sm="12" md="6" lg="4" xl="3">
                                        <v-card class="mx-auto my-3 radius-30">
                                            <v-img height="250"
                                                :src="base_url + `/public/` + data.pic_path"></v-img>
                                            <v-card-title class="fs-20 color-black line-height-normal">{{ data.title
                                            }}</v-card-title>

                                            <v-card-text class="color-212621 fs-18 line-height-normal">
                                                <div>{{ data.sub_title }}</div>
                                            </v-card-text>

                                            <v-card-actions>
                                                <v-row class="d-flex justify-center">
                                                    <v-col xs="8" sm="8" md="9" lg="9" xl="9">
                                                        <v-card-text class="text-last-edit line-height-normal">
                                                            แก้ไขล่าสุดโดย {{ data.user_edit_name }}
                                                        </v-card-text>
                                                    </v-col>
                                                    <v-col class="d-flex justify-end align-center option-list-slide" xs="4"
                                                        sm="4" md="3" lg="3" xl="3">
                                                        <v-switch @click="statusEdit(data.id, data.status)"
                                                            v-model="data.status" inset color="#86D870"></v-switch>
                                                        <v-btn
                                                            @click="linkPage(`/managecontent/thai_edit?id=${base64Encode(data.id)}`)"
                                                            class="ma-1 m-0 p-0" width="38" height="38" outlined large fab
                                                            elevation="4" color="#FF5B00">
                                                            <v-icon>mdi-pencil</v-icon>
                                                        </v-btn>

                                                        <v-btn @click="dialogDelete(data.id)" class="ma-1 m-0 p-0"
                                                            width="38" height="38" outlined large fab elevation="4"
                                                            color="#FF1E1E">
                                                            <v-icon>mdi-trash-can</v-icon>
                                                        </v-btn>
                                                    </v-col>
                                                </v-row>
                                            </v-card-actions>
                                        </v-card>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                                        <v-pagination v-model="page" :length="pages" :total-visible="8" circle
                                            color="#86D780"></v-pagination>
                                    </v-col>
                                </v-row>
                            </v-col>
                        </v-row>
                    </v-card>
                </v-col>
            </v-row>

            <!-- Dialog Delete -->
            <v-dialog v-model="dialog_delete" width="500">
                <v-card>
                    <v-card-text class="d-flex flex-column align-center pb-0">
                        <img class="mt-4 mb-8" :src="base_url + `/images/exclamation.png`" alt="image list slide"
                            width="130" max-width="130" height="auto" />
                        <h3 class="mag-modal mb-8">ท่านแน่ใจใช่ไหม ที่จะต้องการลบข้อมูลนี้ !</h3>
                    </v-card-text>

                    <v-card-actions class="d-flex justify-center">
                        <v-btn @click="contentDelete()" class="btn-success mb-32 mr-4 pl-30 pr-30">
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
import content from '../../../api/content.js';

export default {
    data() {
        return {
            dialog_delete: false,
            loading_page: false,
            alert_success: false,
            alert_message_success: '',
            alert_error: false,
            alert_message_error: '',
            loading_page: false,
            submenu: [
                {
                    text: 'จัดการเว็บไซต์ประชาสัมพันธ์',
                    disabled: false,
                },
                {
                    text: 'จัดการข่าวสารและกิจกรรม',
                    disabled: true,
                },
            ],
            items_select: [{ id: 1, name: 'ภาษาไทย' }, { id: 2, name: 'ภาษาอังกฤษ' }],
            stall_select_lang: 1,
            switch_1: true,
            page: 1,
            pages: 8,
            content_data: [],
            id_delete: null
        }
    },
    methods: {
        // Get List Content
        async getList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await content.contentList(this.page, 8, config).then((result) => {
                if (result.data.success === true) {
                    this.content_data = []
                    result.data.data.map(v => {
                        if (this.stall_select_lang === 1) {
                            this.content_data = [
                                ...this.content_data,
                                {
                                    id: v.id,
                                    title: v.title_thai,
                                    sub_title: v.sub_title_thai,
                                    description: v.description_thai,
                                    pic: v.pic,
                                    pic_path: v.pic_path,
                                    seo_keyword: v.keyword,
                                    seo_title: v.title,
                                    seo_description: v.description,
                                    status: v.status,
                                    user_edit_name: v.user_edit_name
                                }
                            ]
                        } else {
                            this.content_data = [
                                ...this.content_data,
                                {
                                    title: v.title_eng,
                                    sub_title: v.sub_title_eng,
                                    description: v.description_eng,
                                    pic: v.pic,
                                    pic_path: v.pic_path,
                                    seo_keyword: v.keyword,
                                    seo_title: v.title,
                                    seo_description: v.description,
                                    status: v.status,
                                    user_edit_name: v.user_edit_name
                                }
                            ]
                        }
                    })
                    // this.content_data
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
            await content.statusEdit(data, config).then((result) => {
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

        // Delete By ID
        async contentDelete() {

            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await content.contentDelete(this.id_delete, config).then((result) => {
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

        async changeLang() {
            this.getList()
        }
    },
    created() {
    },
    mounted() {
        this.getList();
    },
    watch: {
        page() {
            this.getList()
        }
    }
}
</script>

<style lang="scss">
.custom-v-select {
    .v-text-field__details {
        display: none;
    }
}
</style>
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

.btn-success {
    margin-top: 10px;
    border-radius: 30px;
    background: linear-gradient(90deg, #86D780 0%, #60A577 100%);
    box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);

    color: #F9F9F9;
    font-size: 16px;

}

.text-domain-name {
    color: #707070;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
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
</style>