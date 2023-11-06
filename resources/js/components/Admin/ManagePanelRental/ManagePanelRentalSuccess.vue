<template>
    <div class="loading_all_page" v-if="loading_page === true">
        <v-progress-circular indeterminate size="70" :width="8" color="#FFBC15"></v-progress-circular>
        <p class="mt-3">กำลังโหลดข้อมูล</p>
    </div>

    <div v-else data-aos="fade-up">
        <v-slide-x-reverse-transition>
            <v-alert type="success" class="alert_all_page" v-if="alert_success === true">{{ alert_message_success
            }}</v-alert>
            <v-alert type="error" class="alert_all_page" v-if="alert_error === true">{{ alert_message_error }}</v-alert>
        </v-slide-x-reverse-transition>

        <div class="container">
            <div class="d-flex justify-space-between align-items-center mt-4 mb-4">
                <v-card-text class="p-0">
                    <h1 class="font-20 m-0">ทำสัญญาเช่าแผง</h1>
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
                    รายการเช่าแผงทั้งหมด
                </v-card-title>
                <v-card-subtitle class="mb-6">
                    <v-btn @click="linkPage('/managepanelrental/add')" class="btn-success pl-30 pr-30 mt-6" color="warning"
                        dark>
                        <img :src="base_url + `/images/icon/add-friend.png`" alt="" width="20" height="20" />
                        <span class="ml-2">สร้างการเช่าแผงใหม่</span>
                    </v-btn>
                </v-card-subtitle>
                <v-card-text>
                    <v-row class="mb-2">
                        <v-col cols="6">
                            <v-btn @click="linkPage('/managepanelrental')" color=""
                                class="no-border no-border-all color-black" width="100%" outlined> กำลังดำเนินการ </v-btn>
                        </v-col>
                        <v-col cols="6">
                            <v-btn @click="linkPage('/managepanelrentalsuccess')" color="success" class="no-border "
                                width="100%" outlined> เสร็จสิ้น </v-btn>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols=""></v-col>

                        <v-col xs="12" sm="6" md="4" lg="4" xl="4" cols="12" class="d-flex align-end">
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
                                        <td>{{ item.doc_code }}</td>
                                        <td>{{ item.tenant_name }}</td>
                                        <td>{{ item.phone }}</td>
                                        <td>{{ item.store_name }}</td>
                                        <td>{{ item.date_start }}</td>
                                        <td>{{ item.date_end }}</td>
                                        <td>{{ item.date_confirm }}</td>
                                        <td>
                                            <v-div v-if="item.status == 1">
                                                <span @click="dialogRenew(item.id)" class="review_approval_1"
                                                    style="padding-right:10px ;">
                                                    <img class="ml-2 mr-2"
                                                        :src="base_url + `/images/icon/rotation-lock 1.png`" alt=""
                                                        width="20" height="20" />
                                                    <div class="mr-2">ต่อสัญญา</div>
                                                </span>
                                            </v-div>
                                            <v-div v-else>
                                                <span class="review_approval_2">ต่อสัญญาแล้ว</span>
                                            </v-div>
                                        </td>
                                        <td>
                                            <v-btn @click="linkPage('/managepanelrental/detail')" class="ma-1 m-0 p-0"
                                                width="38" height="38" outlined large fab elevation="4" color="#0D99FF">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M16.325 14.8987L21.705 20.2787C21.8941 20.468 22.0003 20.7246 22.0002 20.9921C22.0001 21.2596 21.8937 21.5161 21.7045 21.7052C21.5153 21.8943 21.2587 22.0005 20.9912 22.0004C20.7236 22.0003 20.4671 21.894 20.278 21.7047L14.898 16.3247C13.2897 17.5704 11.2673 18.1566 9.24214 17.9641C7.21699 17.7716 5.34124 16.8148 3.99649 15.2884C2.65174 13.7619 1.939 11.7806 2.00326 9.74729C2.06753 7.71402 2.90396 5.7816 4.34242 4.34315C5.78087 2.9047 7.71329 2.06826 9.74656 2.004C11.7798 1.93973 13.7612 2.65248 15.2876 3.99723C16.814 5.34198 17.7708 7.21772 17.9634 9.24287C18.1559 11.268 17.5697 13.2905 16.324 14.8987H16.325ZM10 15.9997C11.5913 15.9997 13.1174 15.3676 14.2427 14.2424C15.3679 13.1172 16 11.591 16 9.99974C16 8.40845 15.3679 6.88232 14.2427 5.7571C13.1174 4.63189 11.5913 3.99974 10 3.99974C8.40871 3.99974 6.88259 4.63189 5.75737 5.7571C4.63215 6.88232 4.00001 8.40845 4.00001 9.99974C4.00001 11.591 4.63215 13.1172 5.75737 14.2424C6.88259 15.3676 8.40871 15.9997 10 15.9997Z"
                                                        fill="#0D99FF" />
                                                </svg>
                                            </v-btn>

                                            <v-btn class="ma-1 m-0 p-0" width="38" height="38" outlined large fab
                                                elevation="4" color="#65AB79">
                                                <v-icon>mdi-printer-outline</v-icon>
                                            </v-btn>
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

            <!-- Dialog Renew -->
            <v-dialog v-model="dialog_renew" width="500">
                <v-card>
                    <v-card-text class="d-flex flex-column align-center pb-0">
                        <img class="mt-4 mb-8" :src="base_url + `/images/exclamation.png`" alt="image list slide"
                            width="130" max-width="130" height="auto" />
                        <h3 class="mag-modal mb-8">ท่านแน่ใจใช่ไหมที่จะยืนยันการต่อสัญญา ?</h3>
                    </v-card-text>

                    <v-card-actions class="d-flex justify-center">
                        <v-btn @click="managepanelrental_renew" class="btn-success mb-32 mr-4 pl-30 pr-30">
                            <span>ใช่ , ฉันยืนยัน</span>
                        </v-btn>
                        <v-btn class="btn-danger mb-32 ml-4 pl-30 pr-30" @click="dialog_renew = false">
                            <span>ปิด</span>
                        </v-btn>
                    </v-card-actions>

                </v-card>
            </v-dialog>

        </div>
    </div>
</template>

<script>
import contract_block from '../../../api/contract_block.js';

export default {
    data() {
        return {
            type: 1,
            loading_page: false,
            alert_success: false,
            alert_message_success: '',
            alert_error: false,
            alert_message_error: '',

            id_renew: null,
            dialog_renew: false,

            submenu: [
                {
                    text: 'เช่าแผง',
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
                    value: 'id',
                },
                {
                    text: 'ผู้เช่า',
                    value: 'tenant_name',
                    align: 'start'
                },
                {
                    text: 'เบอร์โทร',
                    value: 'phone',
                },
                {
                    text: 'แผงเช่า',
                    value: 'store_name',
                },
                {
                    text: 'วันที่เริ่มต้น',
                    value: 'date_start',
                },
                {
                    text: 'วันที่สิ้นสุด',
                    value: 'date_end',
                },
                {
                    text: 'ยืนยันการเช่า',
                    value: 'confilrm',
                },
                {
                    text: 'ต่อสัญญา',
                    value: 'status',
                    align: 'center'
                },
                {
                    text: 'จัดการ',
                    value: 'manage',
                    align: 'center'
                },
            ],
            desserts: [],
            page: 1,
            pages: 0,
            get_data_all: {},
            get_data: [],
        }
    },
    methods: {
        async managepanelrental_renew() {
            window.localStorage.removeItem('managepanelrental_renew');
            window.localStorage.removeItem('managepanelrental_renew_select_block_list');
            this.$router.push(`/managepanelrental/renew?id=${this.base64Encode(this.id_renew)}`);
        },
        // Get List renter
        async getList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }

            await contract_block.contract_blockList(this.type, this.page, '', config).then((result) => {
                if (result.data.success === true) {
                    this.get_data = result.data.data;
                    this.get_data_all = result.data

                    this.desserts = result.data.data.map(item => {
                        return {
                            id: item.id,
                            doc_code: item.doc_code,
                            tenant_name: item.name,
                            phone: item.tel,
                            store_name: item.block_list_id,
                            date_start: item.date_start,
                            date_end: item.date_end,
                            confilrm: item.doc_type,
                            date_confirm: item.date_confirm,
                            status: item.status,
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

        async dialogRenew(id) {
            this.id_renew = id
            this.dialog_renew = true
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
.no-border {
    border-top: 0px solid;
    border-left: 0px solid;
    border-right: 0px solid
}

.no-border-all {
    border: 0px solid;
}

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
    width: 130px;
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

.review_copy {
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    text-wrap: nowrap;
    width: 94px;
    height: 21px;
    border-radius: 10px;
    background: linear-gradient(90deg, #707070 0%, #B7B7B7 100%);
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
