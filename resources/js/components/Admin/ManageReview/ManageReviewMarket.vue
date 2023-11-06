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
                    <h1 class="font-20 m-0">จัดการรีวิว</h1>
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
                    รีวิวตลาดทั้งหมด
                </v-card-title>

                <v-card class="p-4" elevation="0">
                    <v-tabs background-color="transparent" grow v-model="active_tab">
                        <v-tab @click="linkPage('/managereviewmarket?review_type=0')">
                            รีวิวตลาด
                        </v-tab>
                        <v-tab @click="linkPage('/managereviewstore?review_type=1')">
                            รีวิวร้านค้า
                        </v-tab>
                    </v-tabs>
                </v-card>

                <v-card-text>
                    <v-row>
                        <v-col xs="12" sm="6" md="8" lg="8" xl="8" cols="12">
                            <!-- <v-btn-toggle v-model="toggle_exclusive" borderless class="br-10">

                            </v-btn-toggle> -->
                        </v-col>
                        <v-col xs="12" sm="6" md="4" lg="4" xl="4" cols="12">
                            <v-text-field color="#B8C2CC" class="input-radius" append-icon="mdi-magnify" hide-details="auto"
                                required v-model="search" placeholder="ค้นหา..." single-line outlined dense></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col xs="12" sm="12" md="12" lg="12" xl="12" cols="12">
                            <v-data-table :headers="headers" :items="desserts" :items-per-page="itemsPerPage" elevation="0"
                                :search="search" :page.sync="page" hide-default-footer @page-count="page = $event">

                                <template v-slot:item="{ item }">
                                    <tr>
                                        <td>{{ item.id }}</td>
                                        <td>{{ item.name }}</td>
                                        <td><v-rating v-model="item.rating" color="#FFC107" background-color="#FFC107"
                                                half-increments hover large></v-rating></td>
                                        <td>{{ item.comment }}</td>
                                        <td><span @click="() => { dialog = true; id_update = item.id; }"
                                                class="review_approval_1" v-if="item.review_approval == 0">
                                                <img class="mr-2" :src="base_url + `/images/icon/rotation-lock 1.png`"
                                                    alt="" width="20" height="20" />
                                                อนุมัติรีวิว
                                            </span>
                                            <span class="review_approval_2"
                                                v-else-if="item.review_approval == 1">อนุมัติแล้ว</span>
                                            <span class="review_approval_3" v-else>ไม่อนุมัติ</span>
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
                                <v-pagination class="pagination_review" v-model="page" :length="pages" prev-icon="< ก่อน"
                                    next-icon="ต่อไป >" color="#86D780" navigation-color="#F0F0F0" flat
                                    circle></v-pagination>
                            </div>
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>


            <!-- Dialog Delete-->
            <v-dialog v-model="dialog" width="500">
                <v-card>
                    <v-card-text class="d-flex flex-column align-center pb-0">
                        <img class="mt-4 mb-8" :src="base_url + `/images/exclamation.png`" alt="image list slide"
                            width="130" max-width="130" height="auto" />
                        <h3 class="mag-modal mb-8">ท่านต้องการอนุมัติรีวิวหรือไม่?</h3>
                    </v-card-text>

                    <v-card-actions class="d-flex justify-center">
                        <v-btn class="btn-success mb-32 mr-4 pl-30 pr-30" @click="approvalUpdate(id_update, 1)">
                            <span>ใช่ , ฉันอนุมัติ</span>
                        </v-btn>
                        <v-btn class="btn-danger mb-32 ml-4 pl-30 pr-30" @click="approvalUpdate(id_update, 2)">
                            <span>ไม่ใช่ , ฉันไม่อนุมัติ</span>
                        </v-btn>
                    </v-card-actions>

                </v-card>
            </v-dialog>
        </div>
    </div>
</template>

<script>
import review from '../../../api/review.js';

export default {
    data() {
        return {
            active_tab: 0,
            loading_page: false,
            dialog: false,
            alert_success: false,
            alert_message_success: '',
            alert_error: false,
            alert_message_error: '',
            submenu: [
                {
                    text: 'จัดการรีวิว',
                    disabled: true,
                },
            ],
            search: "",
            pages: 0,
            page: 1,
            pageCount: 0,
            itemsPerPage: 10,
            headers: [
                {
                    text: 'ลำดับ',
                    align: 'start',
                    sortable: true,
                    value: 'id',
                },
                { text: 'ชื่อที่ต้องการแสดง', value: 'name' },
                { text: 'คะแนนโดยรวม', value: 'rating' },
                { text: 'ความคิดเห็นของลูกค้า', value: 'comment' },
                { text: 'การอนุมัติรีวิว', value: 'review_approval' },
            ],
            id_update: null,
            desserts: [],
        }
    },
    methods: {

        // Get List review
        async getList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            let review_type = this.$route.query.review_type ? this.$route.query.review_type : 0
            await review.reviewList(this.page, 10, review_type, config).then((result) => {
                if (result.data.success === true) {
                    this.desserts = []
                    result.data.data.map(v => {
                        this.desserts = [
                            ...this.desserts,
                            {
                                id: v.id,
                                name: v.name,
                                rating: parseFloat(v.rating),
                                comment: v.comment,
                                review_approval: v.review_approval,
                            },
                        ]
                    })

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

        async approvalUpdate(id, review_approval) {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await review.reviewUpdate({ id, review_approval }, config).then((result) => {
                if (result.data.success === true) {
                    this.alert_success = true
                    this.getList()
                    this.dialog = false;
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
    // cursor: pointer;
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
    // cursor: pointer;
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