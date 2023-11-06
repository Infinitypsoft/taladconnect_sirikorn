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
                    <h1 class="font-20 m-0">จัดการคำร้อง</h1>
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
                    รายการคำร้องทั้งหมด
                </v-card-title>
                <!-- <v-card-subtitle class="mb-6">
                    <v-btn @click="linkPage('/managerenter/add')" class="btn-success pl-30 pr-30 mt-6" color="warning" dark>
                        <img :src="base_url + `/images/icon/add-friend.png`" alt="" width="20" height="20" />
                        <span>เพิ่มสมาชิกผู้เช่า</span>
                    </v-btn>
                </v-card-subtitle> -->
                <v-card-text>
                    <v-row>
                        <v-col cols=""></v-col>
                        <v-col xs="12" sm="6" md="4" lg="4" xl="4" cols="12">
                            <v-text-field hide-details="auto" color="#B8C2CC" class="input-radius" append-icon="mdi-magnify"
                                required v-model="search" placeholder="ค้นหา..." single-line outlined dense></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col xs="12" sm="12" md="12" lg="12" xl="12" cols="12">
                            <v-data-table :headers="headers" :items="desserts" :items-per-page="itemsPerPage" elevation="0"
                                :search="search" :page.sync="page" hide-default-footer @page-count="page = $event">
                                <template v-slot:item="{ item }">
                                    <tr>
                                        <td>{{ `${item.id.toString().padStart(1, '0')}` }}</td>
                                        <td>{{ item.name }}</td>
                                        <td>{{ item.detail }}</td>
                                        <td>{{ item.create }}</td>

                                        <td>
                                            <v-div v-if="item.status == 0" class="d-flex my-2">
                                                <span @click="dialogComplete(item.id)" class="review_approval_1">
                                                    <img class="mr-2" :src="base_url + `/images/icon/rotation-lock 1.png`"
                                                        alt="" width="20" height="20" />
                                                    อนุมัติคำร้อง
                                                </span>
                                                <span @click="dialogNotComplete(item.id)"
                                                    class="review_approval_1_error mx-3 ">
                                                    <img class="mr-2"
                                                        :src="base_url + `/images/icon/rotation-lock_error.png`" alt=""
                                                        width="20" height="20" />
                                                    ไม่อนุมัติคำร้อง
                                                </span>
                                            </v-div>
                                            <v-div v-else-if="item.status == 1">
                                                <span class="review_approval_2">อนุมัติแล้ว</span>
                                            </v-div>
                                            <v-div v-else class="d-flex">
                                                <span class="review_approval_3">ไม่อนุมัติ </span>
                                                <v-tooltip bottom>
                                                    <template v-slot:activator="{ on, attrs }">
                                                        <v-icon class="ml-1" color="#c7c7c7" dark v-bind="attrs" v-on="on">
                                                            mdi mdi-information-outline
                                                        </v-icon>
                                                    </template>
                                                    <span>{{ item.note }}</span>
                                                </v-tooltip>
                                            </v-div>
                                        </td>
                                    </tr>
                                </template>
                            </v-data-table>
                        </v-col>
                        <v-col xs="12" sm="12" md="6" lg="6" xl="6" cols="12">

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
            <v-dialog v-model="dialog_complete" width="500">
                <v-card>
                    <v-card-text class="d-flex flex-column align-center pb-0">
                        <img class="mt-4 mb-8" :src="base_url + `/images/exclamation.png`" alt="image list slide"
                            width="130" max-width="130" height="auto" />
                        <h3 class="mag-modal mb-8">ท่านแน่ใจใช่ไหมที่จะอนุมัติคำร้อง</h3>
                    </v-card-text>

                    <v-card-actions class="d-flex justify-center">
                        <v-btn @click="requestUpdate(id_edit, 1)" class="btn-success mb-32 mr-4 pl-30 pr-30">
                            <span>ใช่ , ฉันอนุมัติ</span>
                        </v-btn>
                        <v-btn class="btn-danger mb-32 ml-4 pl-30 pr-30" @click="dialog_complete = false">
                            <span>ปิด</span>
                        </v-btn>
                    </v-card-actions>

                </v-card>
            </v-dialog>

            <!-- Dialog Add Or Edit-->
            <v-dialog v-model="dialog_not_complete" width="1054">
                <v-card>
                    <v-card-title
                        class="text-h5 color-black fs-20 h-65 p-0 pl-30 pr-30 d-flex justify-space-between bg-F8F8F8">
                        <span>ไม่อนุมัติคำร้อง</span>
                        <v-btn @click="() => { dialog_not_complete = false }" class="p-0 m-0" width="50" height="50"
                            style="min-width: 50px !important;">
                            <img class="p-0 m-0" :src="base_url + `/images/icon/close.png`" alt="Keyword" width="20"
                                height="20" />
                        </v-btn>

                    </v-card-title>
                    <v-card class="mt-2 p-5 pt-3" elevation="0">
                        <v-card-text class="p-0 mt-5">
                            <div class="d-flex align-center">
                                <img class="mr-2" :src="base_url + `/images/icon/megaphone 4.png`" alt="Keyword" width="20"
                                    height="20" />

                                <span class="font-16 color-title-card">สาเหตุที่ไม่อนุมัติคำร้อง</span>
                            </div>
                            <div>
                                <p class="font-14 mt-3 text-ex">สาเหตุ <span class="text-red"> * </span> </p>
                                <v-text-field hide-details="auto" label="กรุณากรอกสาเหตุที่ไม่อนุมัติคำร้อง" v-model="note"
                                    outlined dense single-line :rules="rules.note" required></v-text-field>
                            </div>
                        </v-card-text>
                        <v-card-actions>
                            <v-card-text class="p-0 d-flex justify-center">
                                <v-btn @click="requestUpdate(id_edit, 2)" type="submit" class="btn-success pl-30 pr-30"
                                    color="warning" dark>
                                    <v-icon class="fs-20" left dark>
                                        mdi-content-save
                                    </v-icon>
                                    <span>บันทึกข้อมูล</span>
                                </v-btn>
                            </v-card-text>
                        </v-card-actions>
                    </v-card>
                </v-card>
            </v-dialog>

        </div>
    </div>
</template>

<script>
import request from '../../../api/request.js';

export default {
    data() {
        return {
            loading_page: false,
            alert_success: false,
            alert_message_success: '',
            alert_error: false,
            alert_message_error: '',
            dialog_complete: false,
            dialog_not_complete: false,
            content_picture: null,
            imagePreviewURL: null,
            id_edit: null,
            submenu: [
                {
                    text: 'จัดการคำร้อง',
                    disabled: true,
                },
            ],
            search: "",
            page: 1,
            itemsPerPage: 10,
            headers: [
                {
                    text: 'ลำดับ',
                    sortable: true,
                    value: 'id',
                    width: 100
                },
                {
                    text: 'ชื่อผู้ยื่นคำร้อง',
                    value: 'name',
                },
                {
                    text: 'รายละเอียดคำร้อง',
                    value: 'detail',
                },
                {
                    text: 'วันที่',
                    value: 'create',
                },
                {
                    text: 'จัดการ',
                    align: 'center',
                    width: 300
                },
            ],
            desserts: [],
            note: '',
            rules: { note: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'], },

            page: 1,
            pages: 0,
        }
    },
    methods: {
        // Get List request
        async getList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await request.requestList(this.page, 10, this.search, config).then((result) => {
                if (result.data.success === true) {
                    this.desserts = []
                    result.data.data.map(v => {
                        this.desserts = [
                            ...this.desserts,
                            {
                                id: v.id,
                                name: v.name,
                                detail: v.detail,
                                create: v.created_date,
                                status: v.status,
                                note: v.note,
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

        // async onSearch() {
        //     this.getList()
        // },

        async requestUpdate(id, status) {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            this.loading_page = true
            const data = new FormData()
            data.append('id', id)
            data.append('status', status)
            data.append('note', this.note)

            await request.requestUpdate(data, config).then((result) => {
                if (result.data.success === true) {
                    this.alert_success = true
                    this.loading_page = false
                    this.getList()
                    this.dialog_complete = false
                    this.dialog_not_complete = false
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

        async dialogComplete(id) {
            this.id_edit = id
            this.dialog_complete = true
        },

        async dialogNotComplete(id) {
            this.id_edit = id
            this.dialog_not_complete = true
        },

    },
    created() {
    },
    mounted() {
        this.getList()
    },
    watch: {
        page() {
            this.search = ''
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

.review_approval_1_error {
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    text-wrap: nowrap;
    width: 152px;
    height: 38px;
    border-radius: 20px;
    border: 1px solid #E10122;
    padding: 0 15px;

    color: #E10122;
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
