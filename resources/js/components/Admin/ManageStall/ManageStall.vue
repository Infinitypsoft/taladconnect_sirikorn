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
                    <h1 class="font-20 m-0">ตั้งค่าค่าเช่าแผง</h1>
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
                                    รายการค่าเช่าแผงทั้งหมด
                                </v-card-title>
                                <v-card-subtitle class="p-0 mb-40">
                                    <v-btn @click="linkPage('/managestall/add')" class="btn-success pl-30 pr-30 mt-6"
                                        color="warning" dark>
                                        <img class="mr-2"
                                            :src="base_url + `/images/icon/c6729528ce3515465ae8391ea6975234.png`" alt=""
                                            width="20" height="20" />
                                        <span>เพิ่มข้อมูลแผงค้า</span>
                                    </v-btn>
                                </v-card-subtitle>

                                <v-data-table :headers="headers" :items="desserts" item-key="name" group-by="category"
                                    :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" class="elevation-0"
                                    :custom-filter="filterSearchbar" hide-default-header :search="search"
                                    hide-default-footer :items-per-page="100">
                                    <template v-slot:top>
                                        <v-row>
                                            <v-col class="d-flex gap-2" xs="12" sm="12" md="7" lg="7" xl="7" cols="12">
                                            </v-col>
                                            <v-col class="d-flex gap-2" xs="12" sm="12" md="5" lg="5" xl="5" cols="12">
                                                <span class="font-16 fw-500 color-707070 mt-1">ค้นหา :</span>
                                                <v-text-field hide-details="auto" v-model="search" outlined dense
                                                    single-line class="mx-4"></v-text-field>
                                            </v-col>
                                        </v-row>
                                    </template>
                                    <template v-slot:header="{ props }">
                                        <thead class="v-data-table-header">
                                            <tr>
                                                <!-- <th :style="`background: ${item.color}; text-align: ${item.align};`"
                                                    v-for="item in props.headers" @click="toggleOrder">  -->
                                                <th :style="`background: ${item.color}; text-align: ${item.align};`"
                                                    v-for="item in props.headers">
                                                    <span class="fs-16 fw-500 color-707070">{{ item.text }}</span>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th :style="`background: ${item.color}; text-align: ${item.align}; ${item.border}`"
                                                    v-for="item in props.headers">
                                                    <span class="fs-16 fw-500 color-707070">{{ item.stall_size }}</span>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th :style="`background: ${item.color}; text-align: ${item.align};`"
                                                    v-for="item in props.headers">
                                                    <span class="fs-16 fw-500 color-707070">{{ item.stall_size_data
                                                    }}</span>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th :style="`background: #fff; text-align: ${item.align}; border: none;`"
                                                    v-for="item in props.headers">
                                                    <span v-if="item.option" class="fs-16 fw-500 color-707070">{{
                                                        item.option }}</span>
                                                    <div v-else class="d-flex justify-center align-center">
                                                        <v-switch v-model="item.status"
                                                            @click="statusEdit(item.id, item.status)" inset
                                                            color="#86D870"></v-switch>
                                                        <v-btn
                                                            @click="linkPage(`/managestall/edit?id=${base64Encode(item.id)}`)"
                                                            class="ma-1 m-0 p-0" width="38" height="38" outlined large fab
                                                            elevation="4" color="#FF5B00">
                                                            <v-icon>mdi-pencil</v-icon>
                                                        </v-btn>

                                                        <v-btn @click="dialogDelete(item.id)" class="ma-1 m-0 p-0"
                                                            width="38" height="38" outlined large fab elevation="4"
                                                            color="#FF1E1E">
                                                            <v-icon>mdi-trash-can</v-icon>
                                                        </v-btn>
                                                    </div>
                                                </th>
                                            </tr>

                                            <tr>
                                                <th :style="`background: #F8F8F8; text-align: ${item.align}; border: none; padding: 15px;`"
                                                    v-for="item in props.headers">
                                                    <span v-if="item.image" class="fs-16 fw-500 color-707070">{{ item.image
                                                    }}</span>
                                                    <img v-else-if="item.pic_path" class="mr-2" :src="item.pic_path" alt=""
                                                        width="250" height="250" />
                                                    <img v-else class="mr-2" :src="base_url + '/public/images/img_ex.png'"
                                                        alt="" width="250" height="250" />
                                                </th>
                                            </tr>

                                            <tr>
                                                <th :style="`background: #fff; text-align: ${item.align}; border: none; padding: 15px;`"
                                                    v-for="item in props.headers">
                                                    <span v-if="item.fee" class="fs-16 fw-500"
                                                        :style="`color:${item.fee_color}`">{{ item.fee_data
                                                        }}</span>
                                                    <span v-else class="fs-16 fw-500 color-DD0322">{{ item.fee_data
                                                    }}</span>
                                                </th>
                                            </tr>

                                        </thead>
                                    </template>
                                    <template v-slot:group.header="{ items }">
                                        <th class="fs-16 fw-500 bg-E5F0E8" :colspan="numBlankHeaders">
                                            {{ items[0].category_name }}
                                        </th>
                                    </template>
                                    <template v-slot:item="{ item }">
                                        <tr v-if="item.category_title">
                                            <td class="twn"><span class="fs-16 fw-500">{{ item.category_title }}</span></td>
                                            <td class="text-align-center" v-for="(data, i) in item.item">
                                                <span class="fs-16 fw-500" :style="`color: ${color_item[i]};`">
                                                    {{ data }}
                                                </span>
                                            </td>
                                        </tr>
                                    </template>
                                </v-data-table>
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
                        <v-btn @click="stallDelete()" class="btn-success mb-32 mr-4 pl-30 pr-30">
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
import stall from '../../../api/stall.js';

export default {
    data() {
        return {
            loading_page: false,
            alert_success: false,
            alert_message_success: '',
            alert_error: false,
            alert_message_error: '',
            dialog_add_or_edit: false,
            dialog_delete: false,
            content_picture: null,
            imagePreviewURL: null,
            id_delete: null,
            id_edit: null,
            submenu: [
                {
                    text: 'ตั้งค่าค่าเช่าแผง',
                    disabled: true,
                },
            ],
            search: "",
            page: 1,
            pageCount: 0,
            // itemsPerPage: 10,
            sortDesc: false,
            numBlankHeaders: 5,
            color_item: [],
            sortBy: [{ key: 'category', order: 'desc' }],
            headers: [
                {
                    text: 'ค่าใช้จ่าย',
                    value: 'name',
                    stall_size: 'ขนาดแผงค้า',
                    option: 'จัดการ',
                    image: 'รูปถาพ',
                    fee: 'ค่าธรรมเนียม (สัญญา 1 ปี)',
                    align: 'start',
                    groupable: false,
                    color: '#E5F0E8',
                    border: 'border-bottom: 1px solid rgb(229, 240, 232);',
                },
                {
                    text: 'Category',
                    value: 'category',
                    align: 'right',
                },

            ],
            desserts: [
                {
                    category: 'guarantee',
                    category_name: 'เงินประกันต่าง ๆ (ได้คืนเมื่ออยู่ครบสัญญา 1 ปี)',
                },
                {
                    category: 'guarantee',
                    category_title: 'ประกันการเช่าและบริการ',
                    item: [],
                },
                {
                    category: 'guarantee',
                    category_title: 'ประกันมิเตอร์น้ำ',
                    item: []
                },
                {
                    category: 'guarantee',
                    category_title: 'ประกันมิเตอร์ไฟ',
                    item: []
                },
                {
                    category: 'guarantee',
                    category_title: 'ประกันเครื่องดูดควัน',
                    item: []
                },

                {
                    category: 'expenses',
                    category_name: 'ค่าใช้จ่ายรายเดือน',
                },
                {
                    category: 'expenses',
                    category_title: 'ค่าเช่า',
                    item: []
                },
                {
                    category: 'expenses',
                    category_title: 'ค่าส่วนกลาง',
                    item: []
                },
                {
                    category: 'expenses',
                    category_title: 'ค่าน้ำ/ยูนิต',
                    item: []
                },
                {
                    category: 'expenses',
                    category_title: 'ค่าไฟ/ยูนิต',
                    item: []
                },

                // {
                //     category: 'cost',
                //     category_name: 'ค่าอุปกรณ์พื้นฐาน (ขึ้นอยู่กับแผงค้า)',
                // },
                // {
                //     category: 'cost',
                //     category_title: 'ค่าป้ายไวนิล-ป้ายไฟ/ชุด',
                //     item: []
                // },
                // {
                //     category: 'cost',
                //     category_title: 'ค่าซิงค์น้ำ',
                //     item: []
                // },
                // {
                //     category: 'cost',
                //     category_title: 'ค่าถังตักไขมัน',
                //     item: []
                // },

            ],
            id_delete: null
        }
    },
    methods: {
        // toggleOrder() {
        //     this.sortDesc = !this.sortDesc
        // },
        // nextSort() {
        //     let index = this.headers.findIndex(h => h.value === this.sortBy)
        //     index = (index + 1) % this.headers.length
        //     this.sortBy = this.headers[index].value
        // },


        filterSearchbar(value, search, item) {
            return Object.values(item).some(v => v && v.toString().toLowerCase().includes(search))
        },

        // Get List stall
        async getList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await stall.stallList(this.page, '', config).then((result) => {
                if (result.data.success === true) {
                    this.color_item = [];
                    this.headers = [
                        {
                            text: 'ค่าใช้จ่าย',
                            value: 'name',
                            stall_size: 'ขนาดแผงค้า',
                            option: 'จัดการ',
                            image: 'รูปถาพ',
                            fee: 'ค่าธรรมเนียม (สัญญา 1 ปี)',
                            align: 'start',
                            groupable: false,
                            color: '#E5F0E8',
                            border: 'border-bottom: 1px solid rgb(229, 240, 232);',
                        },
                        {
                            text: 'Category',
                            value: 'category',
                            align: 'right',
                        },

                    ]
                    this.desserts = [
                        {
                            category: 'guarantee',
                            category_name: 'เงินประกันต่าง ๆ (ได้คืนเมื่ออยู่ครบสัญญา 1 ปี)',
                        },
                        {
                            category: 'guarantee',
                            category_title: 'ประกันการเช่าและบริการ',
                            item: [],
                        },
                        {
                            category: 'guarantee',
                            category_title: 'ประกันมิเตอร์น้ำ',
                            item: []
                        },
                        {
                            category: 'guarantee',
                            category_title: 'ประกันมิเตอร์ไฟ',
                            item: []
                        },
                        {
                            category: 'guarantee',
                            category_title: 'ประกันเครื่องดูดควัน',
                            item: []
                        },

                        {
                            category: 'expenses',
                            category_name: 'ค่าใช้จ่ายรายเดือน',
                        },
                        {
                            category: 'expenses',
                            category_title: 'ค่าเช่า',
                            item: []
                        },
                        {
                            category: 'expenses',
                            category_title: 'ค่าส่วนกลาง',
                            item: []
                        },
                        {
                            category: 'expenses',
                            category_title: 'ค่าน้ำ/ยูนิต',
                            item: []
                        },
                        {
                            category: 'expenses',
                            category_title: 'ค่าไฟ/ยูนิต',
                            item: []
                        },

                        // {
                        //     category: 'cost',
                        //     category_name: 'ค่าอุปกรณ์พื้นฐาน (ขึ้นอยู่กับแผงค้า)',
                        // },
                        // {
                        //     category: 'cost',
                        //     category_title: 'ค่าป้ายไวนิล-ป้ายไฟ/ชุด',
                        //     item: []
                        // },
                        // {
                        //     category: 'cost',
                        //     category_title: 'ค่าซิงค์น้ำ',
                        //     item: []
                        // },
                        // {
                        //     category: 'cost',
                        //     category_title: 'ค่าถังตักไขมัน',
                        //     item: []
                        // },

                    ]
                    result.data.data.map(item => {
                        this.numBlankHeaders += 1;

                        this.color_item = [
                            ...this.color_item,
                            item.color_table
                        ]
                        this.headers = [
                            ...this.headers,
                            {
                                id: item.id,
                                text: item.name,
                                value: 'size_s',
                                stall_size: item.type,
                                stall_size_data: `${parseFloat(item.size_w).toString()} x ${parseFloat(item.size_h).toString()} ม.`,
                                status: item.status,
                                pic_path: this.base_url + `/public/` + item.pic_path,
                                fee: item.radio_annual_fee,
                                fee_data: item.radio_annual_fee === 0 ? 'ฟรี' : item.annual_fee,
                                fee_color: item.color_table,
                                align: 'center',
                                color: item.color_stall,
                            }
                        ]
                        const data_item = [
                            null,
                            item.guarantee_service_rate,
                            item.guarantee_water_rate,
                            item.guarantee_electricity_rate,
                            item.guarantee_hood_rate === '-' ? item.guarantee_hood_rate : parseFloat(item.guarantee_hood_rate).toFixed(2),
                            null,
                            // `${item.cost_center_rental_rate_min} - ${item.cost_center_rental_rate_max}`,
                            item.cost_rental_rate,
                            item.cost_common_rate,
                            item.cost_water_unit_rate,
                            item.cost_electricity_unit_rate,
                            // null,
                            // `${item.vinyl_light_set_min} - ${item.vinyl_light_set_max}`,
                            // item.water_sync_rate,
                            // item.grease_tank_rate,
                        ]
                        this.desserts.map((data, i) => {
                            if (data.item) {
                                this.desserts[i].item = [
                                    ...this.desserts[i].item,
                                    data_item[i]
                                ]
                            }
                        })
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
            await stall.statusEdit(data, config).then((result) => {
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
        async stallDelete() {

            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await stall.stallDelete(this.id_delete, config).then((result) => {
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

        async onFileChange(payload) {
            const file = payload
            let extall = "png,PNG,jpeg,JPEG,jpg,JPG";
            let file_ext = file.name;

            let ext = file_ext.split('.').pop().toLowerCase();
            if (parseInt(extall.indexOf(ext)) < 0) {

                this.imagePreviewURL = this.base_url + `/images/image-list-slide.png`
                this.content_picture = null
            } else {
                if (file) {

                    this.imagePreviewURL = URL.createObjectURL(file)
                    console.log(this.imagePreviewURL);
                    URL.revokeObjectURL(file)
                } else {
                    this.imagePreviewURL = before_image
                }
            }
        },
        async onFileRemove() {
            this.content_picture = null
            this.imagePreviewURL = this.base_url + '/images/image-list-slide.png'
        },
    },
    created() {
    },
    mounted() {
        this.imagePreviewURL = this.base_url + '/images/image-list-slide.png'
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
// Custom Co;or Border Table
.v-data-table thead th {
    border: 1px solid rgba(116, 176, 136, 0.50);
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
