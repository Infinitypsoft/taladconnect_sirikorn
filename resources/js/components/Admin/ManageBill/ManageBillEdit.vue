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
                    <h1 class="font-20 m-0">แก้ใขใบเสร็จ</h1>
                </v-card-text>
                <v-card-text class="d-flex justify-end p-0">
                    <v-breadcrumbs :items="submenu" class="p-0">
                        <template v-slot:divider>
                            <v-icon>mdi-chevron-right</v-icon>
                        </template>
                    </v-breadcrumbs>
                </v-card-text>
            </div>

            <v-card class="mb-4" elevation="2">
                <v-card-title class="justify-space-between text-card-title">
                    แก้ใขใบเสร็จ
                </v-card-title>
                <v-form ref="form_bill_update" v-on:submit.prevent="billUpdate()">
                    <v-card-text class="mt-2">
                        <div class="d-flex align-center">
                            <img class="mr-2" :src="base_url + `/images/icon/d06e425aecd9322c5e27c91f4e75cd48.png`"
                                alt="Contact" width="20" height="20" />
                            <span class="font-16 color-title-card">เลขที่ใบเสร็จ : {{ get_data.bill_id }}</span>
                        </div>
                        <div class="mt-3">
                            <v-row class="container-input-contact">
                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                    <p class="font-14 text-ex mb-4">วันที่รับเงิน <span style="color: red;">*</span></p>
                                    <!-- <v-text-field hide-details="auto" label="กรุณาเลือกวันที่รับเงิน" v-model="phone"
                                    :rules="rules.phone" outlined dense single-line required></v-text-field> -->
                                    <v-menu v-model="menu_date_receipt_money" :close-on-content-click="false"
                                        :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-text-field hide-details="auto" v-model="date_receipt_money"
                                                label="กรุณาเลือกวันที่รับเงิน" readonly v-bind="attrs" v-on="on" outlined
                                                dense single-line :rules="rules.date_receipt_money" required></v-text-field>
                                        </template>
                                        <v-date-picker v-model="date_receipt_money"
                                            @input="menu_date_receipt_money = false"></v-date-picker>
                                    </v-menu>
                                </v-col>
                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">

                                </v-col>
                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                    <p class="font-14 text-ex mb-4">ชื่อลูกค้า <span style="color: red;">*</span></p>
                                    <v-text-field hide-details="auto" label="กรุณากรอกชื่อลูกค้า" v-model="customer_name"
                                        outlined dense single-line :rules="rules.customer_name" required></v-text-field>
                                </v-col>
                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                    <p class="font-14 text-ex mb-4">เบอร์โทร</p>
                                    <v-text-field hide-details="auto" @keypress="isTelephone($event, phone)"
                                        label="กรุณากรอกเบอร์ไทร" v-model="phone" outlined dense single-line></v-text-field>
                                </v-col>
                                <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                                    <p class="font-14 text-ex mb-4">ที่อยู่</p>
                                    <v-text-field hide-details="auto" label="กรุณากรอกที่อยู่" v-model="address" outlined
                                        dense single-line></v-text-field>
                                </v-col>
                            </v-row>
                        </div>

                    </v-card-text>

                    <v-card-text>
                        <div class="d-flex align-center mb-4">
                            <img class="mr-2" :src="base_url + `/images/icon/41030928e449f8ad3b876bcb0562e308.png`"
                                alt="Contact" width="20" height="20" />
                            <span class="font-16 color-title-card">รายการใบเสร็จ</span>
                        </div>
                        <v-row>
                            <v-col xs="12" sm="12" md="12" lg="12" xl="12" cols="12">
                                <v-data-table :headers="headers" :items="desserts" :items-per-page="100" elevation="0"
                                    :page.sync="page" hide-default-footer>
                                    <template v-slot:item="{ item, index }">
                                        <tr>
                                            <td style="text-align: center;">{{ item.bill_list_id }}</td>
                                            <td>
                                                <v-text-field class="mt-2 mb-0" hide-details="auto"
                                                    label="กรุณากรอกชื่อรายการ" v-model="item.list_name" outlined dense
                                                    single-line></v-text-field>
                                            </td>
                                            <td>
                                                <v-text-field class="mt-2 mb-0" hide-details="auto"
                                                    @keypress="isDecimalInput($event, item.price_unit)"
                                                    label="กรุณากรอกราคาต่อหน่วย" v-model="item.price_unit" outlined dense
                                                    single-line v-on:keyup="() => {
                                                        item.list_total_price = parseFloat(item.price_unit === null || item.price_unit === '' ? 0 : item.price_unit) * parseFloat(item.num === null || item.num === '' ? 0 : item.num);
                                                        total_price = 0.00
                                                        desserts.map(v => {
                                                            total_price += v.list_total_price
                                                        })
                                                    }"></v-text-field>
                                            </td>
                                            <td>
                                                <v-text-field class="mt-2 mb-0" hide-details="auto" label="กรุณากรอกจำนวน"
                                                    @keypress="isNumber($event, item.num)" v-model="item.num" outlined dense
                                                    single-line v-on:keyup="() => {
                                                        item.list_total_price = parseFloat(item.price_unit === null || item.price_unit === '' ? 0 : item.price_unit) * parseFloat(item.num === null || item.num === '' ? 0 : item.num);
                                                        total_price = 0.00
                                                        desserts.map(v => {
                                                            total_price += v.list_total_price
                                                        })
                                                    }"></v-text-field>
                                            </td>
                                            <td style="text-align: center;">{{ formatPrice(item.list_total_price) }}</td>
                                        </tr>
                                        <tr v-if="desserts.length === index + 1">
                                            <td></td>
                                            <td>
                                                <v-btn @click="addList(item.bill_list_id)"
                                                    class="btn-success pl-30 pr-30 mt-0" color="warning" dark>
                                                    <img class="mr-4"
                                                        :src="base_url + `/images/icon/7f5e50f30b417aaa21ca24918d16db48.png`"
                                                        alt="" width="20" height="20" />
                                                    <span>เพิ่มรายการ</span>
                                                </v-btn>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr v-if="desserts.length === index + 1"
                                            style="border: 1px solid rgba(116, 176, 136, 0.50);background: rgba(116, 176, 136, 0.19);">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style="border: 1px solid rgba(116, 176, 136, 0.50); text-align: center;">
                                                รวมทั้งหมด</td>
                                            <td style="text-align: center;">{{ total_price }}</td>
                                        </tr>
                                    </template>

                                </v-data-table>
                            </v-col>
                            <v-col class="pb-100" xs="12" sm="12" md="12" lg="12" xl="12" cols="12">
                                <br />
                                <div class="d-flex align-items-center justify-center mt-6">
                                    <span class="fs-16 fw-500 mr-2">ผู้รับเงิน <span style="color: red;">*</span></span>
                                    <div class="d-flex flex-column align-items-center" style="margin-bottom: -100px;">
                                        <div style="width: 500px;border: 1px solid;"></div>
                                        <br />
                                        <span class="d-flex align-center gap-2 fs-16 fw-500 " style="width: 468px;">(
                                            <v-text-field class="mt-2 mb-0" hide-details="auto"
                                                label="กรุณากรอกชื่อผู้รับเงิน" v-model="payee_name" outlined dense
                                                single-line></v-text-field>
                                            )</span>
                                    </div>
                                </div>
                                <br />

                            </v-col>
                            <v-col class="text-center mb-4" xs="12" sm="12" md="12" lg="12" xl="12" cols="12">
                                <v-btn type="submit" class="btn-success pl-30 pr-30 mt-0" color="warning" dark>
                                    <img class="mr-4" :src="base_url + `/images/icon/55c73d463c95d28419bbe5a064146afc.png`"
                                        alt="" width="20" height="20" />
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
import bill from '../../../api/bill.js';

export default {
    data() {
        return {
            loading_page: false,
            alert_success: false,
            alert_message_success: '',
            alert_error: false,
            alert_message_error: '',
            dialog_delete: false,
            id_delete: null,
            submenu: [
                {
                    text: 'จัดการใบเสร็จอื่น ๆ',
                    disabled: false,
                },
                {
                    text: 'แก้ใขใบเสร็จ',
                    disabled: true,
                },
            ],
            page: 1,
            pageCount: 0,
            itemsPerPage: 100,
            headers: [
                {
                    text: 'ลำดับ',
                    align: 'center',
                    sortable: true,
                    value: 'bill_list_id',
                },
                {
                    text: 'รายการ', value: '',
                    align: 'start',
                    width: 670
                },
                {
                    text: 'ราคาต่อหน่วย', value: '',
                },
                {
                    text: 'จำนวน', value: '',
                    align: 'center',
                },
                {
                    text: 'ราคารวม', value: '',
                    align: 'center',
                }
            ],
            desserts: [],

            rules: {
                address: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                phone: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                date_receipt_money: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                customer_name: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
            },
            menu_date_receipt_money: false,
            date_receipt_money: '',
            customer_name: '',
            phone: null,
            address: null,
            payee_name: null,
            total_price: 0.00,

            get_data: {},
            id_delete: null,
            data_bill_list: [],
        }
    },
    methods: {
        // Get List award
        async getList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }

            await bill.billDetail(this.base64Decode(this.$route.query.id), config).then((result) => {
                if (result.data.success === true) {
                    this.data_bill_list = result.data.data_bill_list;
                    this.get_data = result.data.data;


                    this.date_receipt_money = this.get_data.date_receipt_money
                    this.customer_name = this.get_data.customer_name
                    this.phone = this.get_data.tel
                    this.address = this.get_data.address
                    this.payee_name = this.get_data.payee_name
                    this.total_price = parseFloat(this.get_data.total_price)
                    this.desserts = this.data_bill_list.map(item => {
                        return {
                            id: item.id,
                            bill_list_id: item.bill_list_id,
                            list_name: item.list_name,
                            price_unit: parseFloat(item.price_unit),
                            num: parseInt(item.num),
                            list_total_price: parseFloat(item.list_total_price)
                        };
                    });
                }

            }).catch((error) => {
                if (error.response.status === 401) {
                    this.loading_page = false
                    this.$store.commit('logOutSuccess')
                    this.$router.push('/login')
                }
            })
        },

        async billUpdate() {
            if (this.$refs.form_bill_update.validate()) {
                let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.access_token}`,
                    },
                }
                let data = new FormData();
                data.append('id', this.get_data.id);
                data.append('date_receipt_money', this.date_receipt_money);
                data.append('customer_name', this.customer_name);
                data.append('tel', this.phone === null ? '' : this.phone);
                data.append('address', this.address === null ? '' : this.address);
                data.append('payee_name', this.payee_name);
                data.append('total_price', this.total_price);
                var dessertsJSON = JSON.stringify(this.desserts);
                data.append('bill_lists', dessertsJSON);

                this.loading_page = true;

                await bill.billUpdate(data, config).then((result) => {
                    if (result.data.success === true) {
                        this.loading_page = false;
                        this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                        this.$router.push('/managebill')
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

        async addList(bill_list_id) {
            this.desserts = [
                ...this.desserts,
                {
                    id: null,
                    bill_list_id: bill_list_id + 1,
                    list_name: null,
                    price_unit: null,
                    num: null,
                    list_total_price: 0.00,
                },
            ]
        },

        async dialogDelete(id) {
            this.id_delete = id
            this.dialog_delete = true
        },

    },
    created() {
    },
    mounted() {
        this.getList()
    },
    // watch: {
    //     page() {
    //         this.getList()
    //     }
    // }
}
</script>

<style lang="scss"></style>
<style scoped lang="scss">
* {
    font-family: 'Kanit', sans-serif !important;
}
</style>