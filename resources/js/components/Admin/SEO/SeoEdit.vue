<template>
    <div class="loading_all_page" v-if="loading_page === true">
        <v-progress-circular indeterminate size="70" :width="8" color="#FFBC15"></v-progress-circular>
        <p class="mt-3">กำลังโหลดข้อมูล</p>
    </div>

    <div v-else>
        <div class="container">
            <div class="d-flex justify-space-between align-items-center mt-4 mb-4">
                <v-card-text class="p-0">
                    <h1 class="font-20 m-0">แก้ไข SEO</h1>
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
                                <v-card-title class="p-0 justify-space-between text-card-title">
                                    Search Engine Optimization
                                </v-card-title>
                                <!-- Form SEO Edit -->
                                <v-form ref="form_seo_edit" v-on:submit.prevent="seoEdit()">
                                    <v-card-text class="p-0 mt-4">
                                        <div class="d-flex align-center">
                                            <img class="mr-2" :src="base_url + `/images/icon/keyword.png`" alt="Keyword"
                                                width="20" height="20" />

                                            <span class="font-16 color-title-card">คำค้นหา (Keyword)</span>
                                        </div>

                                        <div>
                                            <p class="font-14 mt-3 text-ex">คำแนะนำ : คำค้นหาที่ลูกค้าจะใช้สำหรับการ
                                                ค้นหาให้เจอธุรกิจของเราใน google สามารถใส่ได้ 50 คำ โดยให้คั่นด้วย ,
                                                (เครื่องหมายลูกน้ำ) เช่น ตลาดสดเชียงใหม่ , ของประจำถิ่นเชียงใหม่ ,
                                                ของฝากราคาถูกเชียงใหม่ , เชียงใหม่กินอะไรดี ,ตลาดแนะนำเชียงใหม่ ฯลฯ </p>
                                            <v-textarea solo outlined single-line flat v-model="seo_data.keyword"
                                                label="กรุณากรอกคำค้นหาที่เกี่ยวข้องกับธุรกิจ (Keyword)"></v-textarea>

                                        </div>


                                    </v-card-text>

                                    <!-- Thai -->
                                    <v-card-text class="p-0 mt-2">
                                        <div class="d-flex align-center">
                                            <img class="mr-2" :src="base_url + `/images/icon/title.png`" alt="Title"
                                                width="20" height="20" />
                                            <span class="font-16 color-title-card">รายละเอียดโดยย่อภาษาไทย (Thai title)</span>
                                        </div>
                                        <div>
                                            <p class="font-14 mt-3 text-ex">คำแนะนำ : รายละเอียดโดยย่อเปรียบเสมือนพาดหัวข่าว
                                                ถ้าในคำค้นหาทำให้ลูกค้าเจอเว็บไซด์ของเราแล้ว จะดึงดูดให้เข้ามาชมเว็บไซต์
                                                เช่น
                                                (ชื่อตลาด) รสชาติของฤดูกาล ผลไม้ ผักสด เนื้อสัตว์
                                                อาหารพร้อมรับประทานและอื่นๆอีกมากมาย ประสบการณ์ที่คุณต้องลอง </p>
                                            <v-textarea solo outlined single-line flat :counter="75"
                                                v-model="seo_data.title_thai" label="กรุณากรอกรายละเอียดโดยย่อภาษาไทย (Thai title)"
                                                :rules="[v => !!v && v.length <= 75 || 'สูงสุด 75 ตัวอักษร']"></v-textarea>
                                        </div>
                                    </v-card-text>
                                    <v-card-text class="p-0 mt-2">
                                        <div class="d-flex align-center">
                                            <img class="mr-2" :src="base_url + `/images/icon/title.png`" alt="Title"
                                                width="20" height="20" />
                                            <span class="font-16 color-title-card">รายละเอียดโดยย่อภาษาอังกฤษ (English title)</span>
                                        </div>
                                        <div>
                                            <p class="font-14 mt-3 text-ex">คำแนะนำ : รายละเอียดโดยย่อเปรียบเสมือนพาดหัวข่าว
                                                ถ้าในคำค้นหาทำให้ลูกค้าเจอเว็บไซด์ของเราแล้ว จะดึงดูดให้เข้ามาชมเว็บไซต์
                                                เช่น
                                                (ชื่อตลาด) รสชาติของฤดูกาล ผลไม้ ผักสด เนื้อสัตว์
                                                อาหารพร้อมรับประทานและอื่นๆอีกมากมาย ประสบการณ์ที่คุณต้องลอง </p>
                                            <v-textarea solo outlined single-line flat :counter="75"
                                                v-model="seo_data.title_eng" label="กรุณากรอกรายละเอียดโดยย่อภาษาอังกฤษ (English title)"
                                                :rules="[v => !!v && v.length <= 75 || 'สูงสุด 75 ตัวอักษร']"></v-textarea>
                                        </div>
                                    </v-card-text>
                                    
                                    <!-- Eng -->
                                    <v-card-text class="p-0 mt-2">
                                        <div class="d-flex align-center">
                                            <img class="mr-2" :src="base_url + `/images/icon/description.png`"
                                                alt="Description" width="20" height="20" />
                                            <span class="font-16 color-title-card">คำอธิบายภาษาไทย (Thai description)</span>
                                        </div>
                                        <div>
                                            <p class="font-14 mt-3 text-ex">คำแนะนำ : คำอธิบายที่เป็นเนื้อหาในการแนะนำธุรกิจ
                                                ภายใต้
                                                200
                                                ตัวอักษร โดยเขียนเนื้อความที่ผู้อ่านได้เข้าใจในธุรกิจของเรา
                                                ดึงดูดความน่าสนใจที่จะต้องกดเข้าเว็บไซด์ของเรามาอ่านเพิ่มเติม เช่น
                                                ยินดีต้อนรับสู่ตลาดสดที่นี้ทุกผลผลิตมีชีวิตชีวาและสดใหม่!
                                                เดินชมผลไม้สีสันจากสวนและผักสดชุบน้ำจากไร่ทุกวันที่นี่
                                                เราเสนอชุดความหลากหลายของสินค้าที่สดใหม่ที่สุด</p>
                                            <v-textarea solo outlined single-line flat :counter="300"
                                                v-model="seo_data.description_thai" label="กรุณากรอกคำอธิบายภาษาไทย (Thai description)"
                                                :rules="[v => !!v && v.length <= 300 || 'สูงสุด 300 ตัวอักษร']"></v-textarea>
                                        </div>
                                    </v-card-text>

                                    <v-card-text class="p-0 mt-2">
                                        <div class="d-flex align-center">
                                            <img class="mr-2" :src="base_url + `/images/icon/description.png`"
                                                alt="Description" width="20" height="20" />
                                            <span class="font-16 color-title-card">คำอธิบายภาษาอังกฤษ (English description)</span>
                                        </div>
                                        <div>
                                            <p class="font-14 mt-3 text-ex">คำแนะนำ : คำอธิบายที่เป็นเนื้อหาในการแนะนำธุรกิจ
                                                ภายใต้
                                                200
                                                ตัวอักษร โดยเขียนเนื้อความที่ผู้อ่านได้เข้าใจในธุรกิจของเรา
                                                ดึงดูดความน่าสนใจที่จะต้องกดเข้าเว็บไซด์ของเรามาอ่านเพิ่มเติม เช่น
                                                ยินดีต้อนรับสู่ตลาดสดที่นี้ทุกผลผลิตมีชีวิตชีวาและสดใหม่!
                                                เดินชมผลไม้สีสันจากสวนและผักสดชุบน้ำจากไร่ทุกวันที่นี่
                                                เราเสนอชุดความหลากหลายของสินค้าที่สดใหม่ที่สุด </p>
                                            <v-textarea solo outlined single-line flat :counter="300"
                                                v-model="seo_data.description_eng" label="กรุณากรอกคำอธิบายภาษาอังกฤษ (English description)"
                                                :rules="[v => !!v && v.length <= 300 || 'สูงสุด 300 ตัวอักษร']"></v-textarea>
                                        </div>


                                    </v-card-text>
                                    <v-card-text class="p-0">
                                        <div class="d-flex justify-space-between">
                                            <v-btn @click="linkPage('/seo')" color="white" class="ma-2 btn-back"
                                                elevation="1">
                                                <v-icon left dark>
                                                    mdi-chevron-left
                                                </v-icon>
                                                ย้อนกลับ
                                            </v-btn>
                                            <v-btn type="submit" color="white"
                                                class="ma-2 btn-save rounded-pill pl-30 pr-30">
                                                <v-icon class="fs-20" left dark>
                                                    mdi-content-save
                                                </v-icon>
                                                บันทึกข้อมูล
                                            </v-btn>
                                            <div style="width: 100px;"></div>
                                        </div>
                                    </v-card-text>
                                </v-form>
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
                    disabled: false,
                },
                {
                    text: 'แก้ไข SEO',
                    disabled: true,
                },
            ],
            seo_data: {
                id: Number,
                keyword: null,
                title_thai: null,
                title_eng: null,
                description_thai: null,
                description_eng: null,
            },


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

        async seoEdit() {
            if (this.$refs.form_seo_edit.validate()) {
                let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.access_token}`,
                    },
                }
                const data = {
                    id: this.seo_data.id,
                    keyword: this.seo_data.keyword,
                    title_thai: this.seo_data.title_thai,
                    description_thai: this.seo_data.description_thai,
                    title_eng: this.seo_data.title_eng,
                    description_eng: this.seo_data.description_eng,
                }
                await seo.authEditSEO(data, config).then((result) => {
                    if (result.data.success === true) {
                        this.loading_page = false;
                        this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                    }
                }).catch((error) => {
                    if (error.response.status === 401) {
                        this.loading_page = false
                        this.$store.commit('logOutSuccess')
                        this.$router.push('/login')
                    }
                })
            }
        }
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
</style>