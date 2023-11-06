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
                    <h1 class="font-20 m-0">จัดการใบเสร็จอื่น ๆ</h1>
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
                    รายการใบเสร็จอื่นๆ ทั้งหมด
                </v-card-title>
                <v-row class="p-4">
                    <v-col cols="6">
                        <v-btn @click="linkPage('/managebill')" color="success" class="no-border no-border-all" width="100%"
                            outlined> ใบวางบิล </v-btn>
                    </v-col>
                    <v-col cols="6">
                        <v-btn @click="linkPage('/managebillotherreceipts')" color=""
                            class="no-border color-black" width="100%" outlined> ใบเสร็จอื่น ๆ </v-btn>
                    </v-col>
                </v-row>
                <v-card-subtitle class="mb-6">
                    <v-btn @click="linkPage('/managebill/add')" class="btn-success pl-30 pr-30" color="warning" dark>
                        <img class="mr-4" :src="base_url + `/images/icon/83cf9e48acf1e8717f415c999697e6de.png`" alt=""
                            width="20" height="20" />
                        <span>สร้างใบเสร็จใหม่</span>
                    </v-btn>
                </v-card-subtitle>
                <v-card-text>
                    <v-row>
                        <v-col xs="12" sm="6" md="8" lg="8" xl="8" cols="12">

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
                                        <td>{{ item.receipt_id }}</td>
                                        <td>{{ item.date_receipt_money }}</td>
                                        <td>{{ item.customer_name }}</td>
                                        <td>{{ item.amount }}</td>
                                        <td>{{ item.create_by }}</td>
                                        <td>
                                            <span class="custom-cancel-status" v-if="item.cancel === 1">ยกเลิก</span>
                                            <span v-else>-</span>
                                        </td>
                                        <td>
                                            <v-btn @click="linkPage(`/managebill/detail?id=${base64Encode(item.id)}`)"
                                                class="ma-1 m-0 p-0" width="38" height="38" outlined large fab elevation="4"
                                                color="#0D99FF">
                                                <v-icon>mdi-magnify</v-icon>
                                            </v-btn>
                                            <v-btn v-if="item.cancel === 0"
                                                @click="linkPage(`/managebill/edit?id=${base64Encode(item.id)}`)"
                                                class="ma-1 m-0 p-0" width="38" height="38" outlined large fab elevation="4"
                                                color="#FF5B00">
                                                <v-icon>mdi-pencil</v-icon>
                                            </v-btn>

                                            <v-btn v-if="item.cancel === 0" @click="cancelReceipt(item.id, item.receipt_id)"
                                                class="ma-1 m-0 p-0" width="38" height="38" outlined large fab elevation="4"
                                                color="#FF1E1E">
                                                <img width="20" height="20"
                                                    :src="base_url + `/images/icon/4693857f80d47bd38b37f661ed9862b1.png`"
                                                    alt="">
                                            </v-btn>

                                            <v-btn v-if="item.cancel === 0" @click="" class="ma-1 m-0 p-0" width="38"
                                                height="38" outlined large fab elevation="4" color="#65AB79">
                                                <img width="20" height="20"
                                                    :src="base_url + `/images/icon/b04158f5dde55cfec23d44515d5b2eef.png`"
                                                    alt="">
                                            </v-btn>
                                        </td>
                                    </tr>
                                </template>
                            </v-data-table>
                        </v-col>
                        <v-col xs="12" sm="12" md="6" lg="6" xl="6" cols="12">
                            <div class="text-footer-table">แสดงตั้งแต่ 1 ถึง 10 จาก {{ get_data_all.count }} รายการ</div>
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

            <!-- Dialog Delete -->
            <v-dialog v-model="dialog_cancel_receipt" width="500">
                <v-card>
                    <v-card-text class="d-flex flex-column align-center pb-0">
                        <img class="mt-4 mb-8" :src="base_url + `/images/exclamation.png`" alt="image list slide"
                            width="130" max-width="130" height="auto" />
                        <h3 class="mag-modal mb-8">ท่านแน่ใจใช่ไหมที่จะยกเลิกใบเสร็จเลขที่ {{ cancel_receipt_id }} ?</h3>
                    </v-card-text>

                    <v-card-actions class="d-flex justify-center">
                        <v-btn @click="statusEdit()" class="btn-success mb-32 mr-4 pl-30 pr-30">
                            <span>ใช่ , ฉันยืนยัน</span>
                        </v-btn>
                        <v-btn class="btn-danger mb-32 ml-4 pl-30 pr-30" @click="dialog_cancel_receipt = false">
                            <span>ไม่ใช่</span>
                        </v-btn>
                    </v-card-actions>

                </v-card>
            </v-dialog>

        </div>
    </div>
</template>

<script>
import bill from '../../../api/bill.js';

export default {
    data() {
        return {
            loading_page: false,
            alert_success: false,
            alert_message_success: '',
            alert_error: false,
            alert_message_error: '',
            dialog_cancel_receipt: false,
            id_cancel_receipt: null,
            submenu: [
                {
                    text: 'จัดการผู้ใช้งาน',
                    disabled: true,
                },
            ],
            search: "",
            itemsPerPage: 10,
            headers: [
                {
                    text: 'ID',
                    align: 'center',
                    sortable: true,
                    value: 'receipt_id',
                },
                {
                    text: 'วันที่รับเงิน', value: 'date_receipt_money',
                    align: 'start'
                },
                {
                    text: 'ชื่อลูกค้า', value: 'customer_name',
                },
                {
                    text: 'ยอดเงิน', value: 'amount',
                },
                {
                    text: 'ผู้สร้าง', value: 'create_by',
                },
                {
                    text: 'การยกเลิก', value: 'cancel',
                },
                {
                    text: 'จัดการ', value: 'manage',
                    width: 300,
                    align: 'center'
                },
            ],
            desserts: [],
            name_thaiRules: [
                v => !!v && v.length <= 120 || 'สูงสุด 120 ตัวอักษร',
            ],
            name_engRules: [
                v => !!v && v.length <= 120 || 'สูงสุด 120 ตัวอักษร',
            ],
            cancel_receipt_id: '',
            page: 1,
            pages: 0,
            get_data_all: {},
            get_data: [],
            id_cancel_receipt: null
        }
    },
    methods: {
        // Get List bill
        async getList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }

            await bill.billList(this.page, '', config).then((result) => {
                if (result.data.success === true) {
                    this.get_data_all = result.data;
                    this.get_data = result.data.data;

                    this.desserts = result.data.data.map(item => {
                        return {
                            id: item.id,
                            receipt_id: item.bill_id,
                            date_receipt_money: item.date_receipt_money,
                            customer_name: item.customer_name,
                            amount: item.total_price,
                            create_by: item.user_create_name,
                            cancel: item.status,
                        };
                    });

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

        // Status Edit
        async statusEdit(id, status) {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            this.dialog_cancel_receipt = false
            // this.loading_page = true
            const data = {
                id: this.id_cancel_receipt,
                status: 1,
            }

            await bill.statusEdit(data, config).then((result) => {
                if (result.data.success === true) {
                    this.getList()
                    // this.loading_page = false
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


        async cancelReceipt(id, cancel_receipt_id) {
            this.id_cancel_receipt = id
            this.cancel_receipt_id = cancel_receipt_id
            this.dialog_cancel_receipt = true
        },

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

.no-border {
    border-top: 0px solid;
    border-left: 0px solid;
    border-right: 0px solid
}

.no-border-all {
    border: 0px solid;
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
    cursor: pointer;
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
    cursor: pointer;
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