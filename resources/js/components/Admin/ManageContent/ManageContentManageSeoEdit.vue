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
                                        <v-tab @click="linkPage(`/managecontent/thai_edit?id=${$route.query.id}`)">
                                            ภาษาไทย
                                        </v-tab>
                                        <v-tab @click="linkPage(`/managecontent/eng_edit?id=${$route.query.id}`)">
                                            ภาษาอังกฤษ
                                        </v-tab>
                                        <v-tab @click="linkPage(`/managecontent/manage_seo_edit?id=${$route.query.id}`)">
                                            จัดการ SEO
                                        </v-tab>
                                    </v-tabs>

                                    <v-card color="basil" flat>
                                        <v-card-title class="mt-4 p-0 text-card-title">
                                            <v-row class="container-title">
                                                <v-col xs="12" sm="12" md="5" lg="6" xl="6">
                                                    <p>Search Engine Optimization</p>
                                                </v-col>
                                                <v-col class="text-end container-title-left" xs="12" sm="12" md="7" lg="6"
                                                    xl="6">
                                                    <p class="fs-16 fw-500 color-707070">แก้ไขล่าสุดโดย {{
                                                        get_data.user_edit_name }}
                                                        {{ get_data.updated_date }}</p>
                                                </v-col>
                                            </v-row>
                                        </v-card-title>
                                        <v-row>
                                            <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                                                <v-form ref="form_content_update" v-on:submit.prevent="contentUpdate()">
                                                    <v-card class="mt-2 p-5 pt-3" elevation="2">
                                                        <v-card-text class="p-0 mt-4">
                                                            <div class="d-flex align-center">
                                                                <img class="mr-2"
                                                                    :src="base_url + `/images/icon/keyword.png`"
                                                                    alt="Keyword" width="20" height="20" />

                                                                <span class="font-16 color-title-card">คำค้นหา
                                                                    (Keyword)</span>
                                                            </div>

                                                            <div>
                                                                <p class="font-14 mt-3 text-ex">คำแนะนำ :
                                                                    คำค้นหาที่ลูกค้าจะใช้สำหรับการ
                                                                    ค้นหาให้เจอธุรกิจของเราใน google สามารถใส่ได้ 50 คำ
                                                                    โดยให้คั่นด้วย ,
                                                                    (เครื่องหมายลูกน้ำ) เช่น ตลาดสดเชียงใหม่ ,
                                                                    ของประจำถิ่นเชียงใหม่ ,
                                                                    ของฝากราคาถูกเชียงใหม่ , เชียงใหม่กินอะไรดี
                                                                    ,ตลาดแนะนำเชียงใหม่ ฯลฯ </p>
                                                                <v-textarea solo outlined single-line flat
                                                                    label="กรุณากรอกคำค้นหาที่เกี่ยวข้องกับธุรกิจ (Keyword)"
                                                                    v-model="get_data.keyword"></v-textarea>

                                                            </div>


                                                        </v-card-text>
                                                        <v-card-text class="p-0 mt-2">
                                                            <div class="d-flex align-center">
                                                                <img class="mr-2" :src="base_url + `/images/icon/title.png`"
                                                                    alt="Title" width="20" height="20" />
                                                                <span class="font-16 color-title-card">รายละเอียดโดยย่อ
                                                                    (Title)</span>
                                                            </div>
                                                            <div>
                                                                <p class="font-14 mt-3 text-ex">คำแนะนำ :
                                                                    รายละเอียดโดยย่อเปรียบเสมือนพาดหัวข่าว
                                                                    ถ้าในคำค้นหาทำให้ลูกค้าเจอเว็บไซด์ของเราแล้ว
                                                                    จะดึงดูดให้เข้ามาชมเว็บไซต์
                                                                    เช่น
                                                                    (ชื่อตลาด) รสชาติของฤดูกาล ผลไม้ ผักสด เนื้อสัตว์
                                                                    อาหารพร้อมรับประทานและอื่นๆอีกมากมาย
                                                                    ประสบการณ์ที่คุณต้องลอง
                                                                </p>
                                                                <v-textarea solo outlined single-line flat :counter="75"
                                                                    label="กรุณากรอกรายละเอียดโดยย่อ (Title)"
                                                                    :rules="rule_textarea_title"
                                                                    v-model="get_data.title"></v-textarea>
                                                            </div>


                                                        </v-card-text>
                                                        <v-card-text class="p-0 mt-2">
                                                            <div class="d-flex align-center">
                                                                <img class="mr-2"
                                                                    :src="base_url + `/images/icon/description.png`"
                                                                    alt="Description" width="20" height="20" />
                                                                <span class="font-16 color-title-card">คำอธิบาย
                                                                    (Description)</span>
                                                            </div>
                                                            <div>
                                                                <p class="font-14 mt-3 text-ex">คำแนะนำ :
                                                                    คำอธิบายที่เป็นเนื้อหาในการแนะนำธุรกิจ
                                                                    ภายใต้
                                                                    200
                                                                    ตัวอักษร
                                                                    โดยเขียนเนื้อความที่ผู้อ่านได้เข้าใจในธุรกิจของเรา
                                                                    ดึงดูดความน่าสนใจที่จะต้องกดเข้าเว็บไซด์ของเรามาอ่านเพิ่มเติม
                                                                    เช่น
                                                                    ยินดีต้อนรับสู่ตลาดสดที่นี้ทุกผลผลิตมีชีวิตชีวาและสดใหม่!
                                                                    เดินชมผลไม้สีสันจากสวนและผักสดชุบน้ำจากไร่ทุกวันที่นี่
                                                                    เราเสนอชุดความหลากหลายของสินค้าที่สดใหม่ที่สุด </p>
                                                                <v-textarea solo outlined single-line flat :counter="300"
                                                                    label="กรุณากรอกคำอธิบาย (Description)"
                                                                    :rules="rule_textarea_description"
                                                                    v-model="get_data.description"></v-textarea>
                                                            </div>


                                                        </v-card-text>

                                                        <v-card-text class="p-0">
                                                            <div class="d-flex justify-center">
                                                                <v-btn type="submit" color="white"
                                                                    class="ma-2 btn-save rounded-pill pl-30 pr-30">
                                                                    <v-icon class="fs-20" left dark>
                                                                        mdi-content-save
                                                                    </v-icon>
                                                                    บันทึกข้อมูล
                                                                </v-btn>
                                                            </div>
                                                        </v-card-text>
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
import content from '../../../api/content.js';

export default {
    data() {
        return {
            loading_page: false,
            active_tab: 2,
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
                    text: 'แก้ไขข่าวสารและกิจกรรม',
                    disabled: true,
                },
            ],
            get_data: {},
        }
    },
    methods: {
        async getList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }

            await content.contentDetail(this.base64Decode(this.$route.query.id), config).then((result) => {
                if (result.data.success === true) {
                    this.get_data = result.data.data;
                }
            })
        },
        async contentUpdate() {
            if (this.$refs.form_content_update.validate()) {
                this.loading_page = true;
                let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.access_token}`,
                    },
                }

                const data = new FormData()
                data.append('id', this.get_data.id)
                data.append('keyword', this.get_data.keyword)
                data.append('title', this.get_data.title)
                data.append('description', this.get_data.description)

                await content.contentUpdate(data, config).then((result) => {
                    if (result.data.success === true) {
                        this.loading_page = false;
                        this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                        this.$router.push('/managecontent')
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
}</style>