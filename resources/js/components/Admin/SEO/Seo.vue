<template>
    <div class="loading_all_page" v-if="loading_page === true">
        <v-progress-circular indeterminate size="70" :width="8" color="#FFBC15"></v-progress-circular>
        <p class="mt-3">กำลังโหลดข้อมูล</p>
    </div>

    <div v-else>
        <div class="container">
            <div class="d-flex justify-space-between align-items-center mt-4 mb-4">
                <v-card-text class="p-0">
                    <h1 class="font-20 m-0">จัดการ SEO</h1>
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
                                            <p>Search Engine Optimization</p>
                                        </v-col>
                                        <v-col class="container-title-left" xs="12" sm="12" md="6" lg="6" xl="6">
                                            <v-btn @click="linkPage('/seo/edit')" class="btn-edit radius-30" color="warning"
                                                dark>
                                                <v-icon class="icon-btn-edit" large color="white">
                                                    mdi-pencil
                                                </v-icon>
                                                แก้ไข SEO
                                            </v-btn>
                                        </v-col>
                                    </v-row>
                                </v-card-title>
                                <v-card-text class="p-0 mt-4">
                                    <div class="d-flex">
                                        <img class="mr-2" :src="base_url + `/images/icon/keyword.png`" alt="Keyword"
                                            width="20" height="20" />
                                        <div>
                                            <span class="font-16 color-title-card">คำค้นหา (Keyword)</span>
                                            <p class="font-16 mt-3 color-title-detail">{{ seo_data.keyword }}</p>
                                        </div>
                                    </div>
                                </v-card-text>

                                <v-card-text class="p-0 mt-2">
                                    <div class="d-flex">
                                        <img class="mr-2" :src="base_url + `/images/icon/search_engine.png`" alt=""
                                            width="20" height="20" />
                                        <div>
                                            <span class="font-16 color-title-card">การแสดงผลในเครื่องมือค้นหา (Search
                                                Engine) ภาษาไทย
                                            </span>
                                            <div class="mt-3">
                                                <div class="d-flex align-items-center">
                                                    <img class="mr-2" :src="base_url + `/images/logo_taladconnect.png`"
                                                        alt="Logo" width="30" height="30" />
                                                    <div class="text-domain-name">
                                                        <p class="font-16 m-0 ">domain name.com</p>
                                                        <span class="font-12">https://domain name.com </span>
                                                    </div>
                                                </div>
                                                <div class="mt-1">
                                                    <h3 class="font-16 color-search-title font-weight-400 m-0">
                                                        {{ seo_data.title_thai }}
                                                    </h3>
                                                    <p class="font-12 text-search-subtitle">
                                                        {{ seo_data.description_thai }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </v-card-text>

                                <v-card-text class="p-0 mt-2">
                                    <div class="d-flex">
                                        <img class="mr-2" :src="base_url + `/images/icon/search_engine.png`" alt=""
                                            width="20" height="20" />
                                        <div>
                                            <span class="font-16 color-title-card">การแสดงผลในเครื่องมือค้นหา (Search Engine) ภาษาอังกฤษ 
                                            </span>
                                            <div class="mt-3">
                                                <div class="d-flex align-items-center">
                                                    <img class="mr-2" :src="base_url + `/images/logo_taladconnect.png`"
                                                        alt="Logo" width="30" height="30" />
                                                    <div class="text-domain-name">
                                                        <p class="font-16 m-0 ">domain name.com</p>
                                                        <span class="font-12">https://domain name.com </span>
                                                    </div>
                                                </div>
                                                <div class="mt-1">
                                                    <h3 class="font-16 color-search-title font-weight-400 m-0">
                                                        {{ seo_data.title_eng }}
                                                    </h3>
                                                    <p class="font-12 text-search-subtitle">
                                                        {{ seo_data.description_eng }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </v-card-text>

                                <v-card-text class="p-0">
                                    <div class="d-flex justify-end">
                                        <p class="font-16 text-last-edit">แก้ไขล่าสุดโดย {{ seo_data.user_edit_name }}
                                            {{ seo_data.updated_date }}</p>
                                    </div>
                                </v-card-text>
                            </v-col>
                        </v-row>
                    </v-card>
                </v-col>
            </v-row>
        </div>
    </div>
</template>

<script>

import seo from '../../../api/seo';

export default {
    data() {
        return {
            loading_page: false,
            submenu: [
                {
                    text: 'จัดการเว็บไซต์ประชาสัมพันธ์',
                    disabled: false,
                },
                {
                    text: 'จัดการ SEO',
                    disabled: true,
                },
            ],
            seo_data: {},
            keyword: `ผักสด , ผลไม้สด , ตลาดท้องถิ่น , สินค้าเกษตร , แหล่งซื้อผลไม้ ,ตลาดสดอำเภอxxxx ,ตลาดxxxx ,พืชผักสดจากสวน , ข้าวอินทรีย์ , ข้าวสารสดใหม่ , เครื่องปรุง , อาหารท้องถิ่น ,สินค้าเกษตรอินทรีย์, ตลาดชุมชน , ซื้อของฝาก , ของฝากราคาถูก ,ผลไม้ตามฤดูกาล , ตลาดขายส่ง, สินค้าสุขภาพ ,หมูสด , ไก่สด , ปลาสด , อาหารทะเล , ซื้อของฝากจังหวัดxxxxx , ขายปลีก-ส่ง , วัตถุดิบ , ประกอบอาหาร , market , fresh vegetables , fresh fruit , Local food , condiment , กินอะไรดี, ของเด็ดจังหวัด , ของขึ้นชื่อ , อาหารปรุงสุก , อาหารพร้อมทาน , ผักสวนครัว ,ผักตามฤดูกาล ,ผลไม้ตามฤดูกาล , อาหารป่า , คุณภาพสดใหม่ , แผงผัก , ซื้อสดจากเกษตรกร ,ออแกนิกส์ , การเลี้ยงสัตว์ท้องถิ่น , รสชาติสดใหม่ , ผลไม้รสชาติดี ,Farm-fresh goodness ,Gourmet foods`
        }
    },
    methods: {
        async getList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await seo.seoList(config).then((result) => {
                if (result.data.success === true) {
                    this.seo_data = result.data.data
                }

            })
        },
    },
    created() {
    },
    async mounted() {
        this.loading_page = true
        await this.getList();
        this.loading_page = false
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

.text-domain-name {
    color: #707070;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.text-last-edit {
    color: #707070;
    text-align: right;
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
}</style>