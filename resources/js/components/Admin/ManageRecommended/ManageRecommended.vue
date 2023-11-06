<template>
    <div class="loading_all_page" v-if="loading_page === true">
        <v-progress-circular indeterminate size="70" :width="8" color="#FFBC15"></v-progress-circular>
        <p class="mt-3">กำลังโหลดข้อมูล</p>
    </div>

    <!-- <div v-else data-aos="fade-up"> -->
    <div v-else>
        <v-slide-x-reverse-transition>
            <v-alert type="success" class="alert_all_page" v-if="alert_success === true">{{ alert_message_success
            }}</v-alert>
            <v-alert type="error" class="alert_all_page" v-if="alert_error === true">{{ alert_message_error }}</v-alert>
        </v-slide-x-reverse-transition>

        <div class="container">
            <div class="d-flex justify-space-between align-items-center mt-4 mb-4">
                <v-card-text class="p-0">
                    <h1 class="font-20 m-0">จัดการร้านค้าแนะนำ/ร้านดังประจำตลาด</h1>
                </v-card-text>
                <v-card-text class="d-flex justify-end p-0">
                    <v-breadcrumbs :items="submenu" class="p-0">
                        <template v-slot:divider>
                            <v-icon>mdi-chevron-right</v-icon>
                        </template>
                    </v-breadcrumbs>
                </v-card-text>
            </div>


            <v-card elevation="2" class="mb-6">
                <v-card-title class="justify-space-between text-card-title">
                    รายการร้านค้าแนะนำ/ร้านดังประจำตลาด
                </v-card-title>
                <v-form ref="form_recommended_update" v-on:submit.prevent="saveRecommended()">
                    <v-card-text>

                        <div v-for="(item, i) in get_data" :key="item.id" class="row-list w-100 mb-4" style="gap: 10px;">
                            <div class=" image-list-slide">
                                <div class="d-flex mb-4">
                                    <img class="mr-2" :src="base_url + `/images/icon/store.png`" alt="Contact" width="20"
                                        height="20" />

                                    <span class="font-16 fw-500 color-title-card">ร้านที่ {{ i + 1 }}</span>
                                </div>
                                <v-img v-if="item.store_id === null" class="mr-2" :src="base_url + `/images/420x240.png`"
                                    alt="Contact" width="420" height="240" />
                                <v-img v-else class="mr-2" :src="base_url + '/public/' + item.pic_path" alt="Contact"
                                    width="420" height="240" />
                            </div>
                            <div class="col-list d-flex flex-column justify-center align-center w-100">
                                <v-card-text class="p-0 mt-2 w-100">
                                    <p class="font-16 fw-500 text-ex mb-4">ชื่อร้านค้าแนะนำ/ร้านดังประจำตลาด ร้านที่ {{ i +
                                        1
                                    }}</p>

                                    <v-select class="custom-v-select w-100" v-model="shop_select[i]" hide-details="auto"
                                        item-value="id" item-text='name' :items="shop_lists" outlined dense single-line
                                        :label="`กรุณาเลือกชื่อร้านค้าแนะนำ/ร้านดังประจำตลาด ร้านที่ ${i + 1}`"
                                        @change="shop_selectChanged(item.id, item.store_id, shop_select[i], i)"
                                        required></v-select>
                                </v-card-text>
                            </div>
                        </div>


                    </v-card-text>

                    <v-card-text>

                        <v-row class="text-center">
                            <v-col cols="12">
                                <v-btn type="submit" class="btn-success pl-30 pr-30" dark>
                                    <v-icon class="fs-20" left dark>
                                        mdi-content-save
                                    </v-icon>
                                    <span>บันทึกข้อมูล</span>
                                </v-btn>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-form>
            </v-card>

        </div>
    </div>
</template>

<script>
import recommended from '../../../api/recommended.js';

export default {
    data() {
        return {
            loading_page: false,
            alert_success: false,
            alert_message_success: '',
            alert_error: false,
            alert_message_error: '',
            content_picture: null,
            imagePreviewURL: null,
            submenu: [
                {
                    text: 'จัดการเว็บไซต์ประชาสัมพันธ์',
                    disabled: false,
                },
                {
                    text: 'จัดการร้านค้าแนะนำ/ร้านดังประจำตลาด',
                    disabled: true,
                },
            ],


            get_data: [],

            get_data_select: [],
            shop_lists: [],
            shop_select: [],

            is_not_empty_id: []

        }
    },
    methods: {

        async shop_selectChanged(id, old_store_id, new_store_id, index) {
            // console.log(id, old_store_id, new_store_id)

            if (this.is_not_empty_id.includes(new_store_id)) {
                // console.log(`store_id ${new_store_id} อยู่ใน this.is_not_empty_id`);
                this.shop_select[index] = old_store_id;
                this.alertData('error', 'ทำรายการไม่สำเร็จ', 'ร้านค้านี้ถูกเลือกไปแล้ว');
            } else {
                this.get_data_select.map(v => {
                    if (v.id === new_store_id) {
                        this.get_data.map(j => {
                            if (j.id === id) {

                                j.store_id = new_store_id
                                j.pic_path = v.pic_path
                                j.store_name = v.store_name

                                this.is_not_empty_id = [
                                    ...this.is_not_empty_id,
                                    new_store_id
                                ]

                                this.is_not_empty_id = this.is_not_empty_id.filter(v => v !== old_store_id)

                                return
                            }
                        })
                    }
                })

            }

        },

        async saveRecommended() {
            if (this.$refs.form_recommended_update.validate()) {
                this.loading_page = true;
                let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.access_token}`,
                    },
                }
                const outputArray = this.get_data.map(item => ({
                    id: item.id,
                    store_id: item.store_id
                }));
                let data = {
                    "list": outputArray
                }

                await recommended.recommendedUpdate(data, config).then(async (result) => {
                    if (result.data.success === true) {
                        await this.getList()
                        this.loading_page = false;
                        this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                    }
                }).catch((error) => {
                    if (error.response.status === 401) {
                        this.loading_page = false;
                        this.$store.commit('logOutSuccess');
                        this.$router.push('/login');
                    }
                })

            }

        },

        // Get getListSelect
        async getListSelect() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }

            await recommended.getListSelect(config).then((result) => {
                if (result.data.success === true) {
                    this.get_data_select = result.data.data;

                    this.shop_lists = this.get_data_select.map(v => {
                        return {
                            id: v.id,
                            name: v.store_name
                        }
                    })
                }

            }).catch((error) => {
                if (error.response.status === 401) {
                    this.loading_page = false
                    this.$store.commit('logOutSuccess')
                    this.$router.push('/login')
                }
            })
        },

        // Get List 
        async getList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }


            await recommended.getList(config).then((result) => {
                if (result.data.success === true) {
                    this.get_data = result.data.data;
                    this.is_not_empty_id = this.get_data
                        .map(v => v.store_id)
                        .filter(store_id => store_id !== null);

                    this.shop_select = this.get_data
                        .map(v => v.store_id)
                        .filter(store_id => store_id !== null);

                    this.get_data.map(v => {
                        return {
                            id: v.id,
                            name: v.store_name
                        }
                    })

                }

            }).catch((error) => {
                if (error.response.status === 401) {
                    this.loading_page = false
                    this.$store.commit('logOutSuccess')
                    this.$router.push('/login')
                }
            })
        },

    },
    created() {
    },
    async mounted() {
        await this.getList()
        await this.getListSelect()
        // await this.shop_listFilter()
    },

}
</script>

<style lang="scss"></style>
<style scoped lang="scss">
* {
    font-family: 'Kanit', sans-serif !important;
}


.row-list {
    display: flex;
    justify-content: flex-start;
    width: 100% !important;

    @media screen and (max-width: 960px) {
        flex-direction: column;

        .image-list-slide {
            display: flex;
            flex-direction: column;
            width: 100% !important;
            max-width: 100% !important;
        }
    }

    .col-list {
        width: 100% !important;
        max-width: 100% !important;
        // max-width: fit-content;
    }
}
</style>
