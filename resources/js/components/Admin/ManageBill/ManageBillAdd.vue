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
                    <h1 class="font-20 m-0">สร้างใบเสร็จใหม่</h1>
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
                    สร้างใบเสร็จใหม่
                </v-card-title>

                <v-form ref="form_bill_add" v-on:submit.prevent="billAdd()">
                    <v-card-text class="mt-2">
                        <div class="d-flex align-center">
                            <img class="mr-2" :src="base_url + `/images/icon/d06e425aecd9322c5e27c91f4e75cd48.png`"
                                alt="Contact" width="20" height="20" />
                            <span class="font-16 color-title-card">เลขที่ใบเสร็จ : {{ get_bill_id }}</span>
                        </div>
                        <div class="mt-3">
                            <v-row class="container-input-contact">
                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                    <p class="font-14 text-ex mb-4">วันที่รับเงิน <span style="color: red;">*</span></p>
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
                                <v-data-table :headers="headers" :items="desserts" :items-per-page="itemsPerPage"
                                    elevation="0" :page.sync="page" hide-default-footer>
                                    <template v-slot:item="{ item }">
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
                                                        item.list_total_price = item.price_unit * item.num;
                                                        total_price = 0.00
                                                        desserts.map(v => {
                                                            total_price += v.list_total_price
                                                        })
                                                        cal_total_price_before_tax(total_price)
                                                    }"></v-text-field>
                                            </td>
                                            <td>
                                                <v-text-field class="mt-2 mb-0" hide-details="auto" label="กรุณากรอกจำนวน"
                                                    @keypress="isNumber($event, item.num)" v-model="item.num" outlined dense
                                                    single-line v-on:keyup="() => {
                                                        item.list_total_price = item.price_unit * item.num;
                                                        total_price = 0.00
                                                        desserts.map(v => {
                                                            total_price += v.list_total_price
                                                        })
                                                        cal_total_price_before_tax(total_price)
                                                    }"></v-text-field>
                                            </td>
                                            <td style="text-align: center;">{{ formatPrice(item.list_total_price) }}</td>
                                        </tr>
                                        <tr v-if="desserts.length === item.bill_list_id">
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
                                        <!-- <tr v-if="desserts.length === item.bill_list_id"
                                            style="border: 1px solid rgba(116, 176, 136, 0.50);background: rgba(116, 176, 136, 0.19);">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style="border: 1px solid rgba(116, 176, 136, 0.50); text-align: center;">
                                                รวมทั้งหมด</td>
                                            <td style="text-align: center;">{{ formatPrice(total_price_before_tax) }}</td>
                                        </tr> -->
                                    </template>

                                </v-data-table>
                            </v-col>
                            <!-- <v-col class="pb-100" xs="12" sm="12" md="12" lg="12" xl="12" cols="12">
                                <br />
                                <div class="d-flex align-items-center justify-center mt-6">
                                    <span class="fs-16 fw-500 mr-2">ผู้รับเงิน <span style="color: red;">*</span></span>
                                    <div class="d-flex flex-column align-items-center" style="margin-bottom: -100px;">
                                        <div style="width: 500px;border: 1px solid;"></div>
                                        <br />
                                        <span class="d-flex align-center gap-2 fs-16 fw-500 " style="width: 468px;">(
                                            <v-text-field class="mt-2 mb-0" hide-details="auto"
                                                label="กรุณากรอกชื่อผู้รับเงิน" v-model="payee_name" outlined dense
                                                single-line :rules="rules.payee_name" required></v-text-field>
                                            )</span>
                                    </div>
                                </div>
                                <br />

                            </v-col> -->

                            <v-col cols="">
                            </v-col>
                            <!-- ภาษี -->
                            <v-col cols="12" lg="6" md="9" sm="10">
                                <v-card elevation="0" class="rounded-lg p-4 pt-6 pb-6 bg-border-green">
                                    <v-row>
                                        <v-col cols="3">
                                            <p class="text-green font-16 mb-0">ราคาค่าเช่ารวม</p>
                                        </v-col>
                                        <v-col cols="5">
                                            <p class="font-16  mb-0">ราคารวมก่อนภาษี</p>

                                        </v-col>
                                        <v-col cols="4" class="text-center ">
                                            <p class="font-16  mb-0">{{ formatPrice(total_price_before_tax) }}</p>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="3">
                                        </v-col>
                                        <v-col cols="5" class="d-flex align-center">
                                            <p class="mb-0 font-16">ภาษี &nbsp; &nbsp; </p>
                                            <v-select class="custom-v-select" v-model="tax_select_type" hide-details="auto"
                                                item-value="id" item-text='name' :items="tax_type" outlined dense
                                                style="width:150px" @change="tax_selectChanged" single-line
                                                label="กรุณาเลือกภาษี"></v-select>
                                            <p class="mb-0 font-16"> &nbsp; % &nbsp; </p>
                                            <v-text-field hide-details="auto" placeholder="0" class="" style="width:50px"
                                                v-model="input_tax" outlined dense :disabled="tax_select_type === 2"
                                                @keypress="isDecimalInput($event, input_tax)" @input="tax_selectChanged"
                                                single-line required></v-text-field>
                                        </v-col>
                                        <v-col cols="4" class="text-center">
                                            <p class="font-16">{{ formatPrice(net_tax) }}</p>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="3">

                                        </v-col>
                                        <v-col cols="5" class="">
                                            <p class="text-green font-16">ราคารวมภาษี</p>
                                        </v-col>
                                        <v-col cols="4" class="text-center">
                                            <p class="font-16">{{ formatPrice(total_price_after_tax) }}</p>
                                        </v-col>

                                        <v-divider style="border-color: #D9D9D9 !important;"></v-divider>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="3" class="d-flex align-center">
                                            <p class="mb-0 text-green font-16"> ภาษีหัก ณ ที่จ่าย </p>
                                        </v-col>
                                        <v-col cols="5" class="d-flex align-center">
                                            <p class="mb-0 font-16">ภาษีหัก ณ ​ที่จ่าย &nbsp; &nbsp; </p>
                                            <v-text-field hide-details="auto" placeholder="0" class=""
                                                style="width:50px;max-width: 50px;" v-model="input_withholding_tax" outlined
                                                dense single-line @keypress="isDecimalInput($event, input_withholding_tax)"
                                                @input="tax_selectChanged" required></v-text-field>
                                            <p class="mb-0 font-16"> &nbsp; % &nbsp; </p>
                                        </v-col>
                                        <v-col cols="4" class="text-center d-flex align-center justify-center">
                                            <p class="mb-0 font-16">{{ formatPrice(net_withholding_tax) }}</p>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="3">

                                        </v-col>
                                        <v-col cols="5" class="">
                                            <p class="text-green font-16">ราคารวมหลังหักภาษี ณ ที่จ่าย</p>
                                        </v-col>
                                        <v-col cols="4" class="text-center">
                                            <p class="font-16">{{ formatPrice(total_withholding_tax) }}</p>
                                        </v-col>

                                        <v-divider style="border-color: #D9D9D9 !important;"></v-divider>
                                    </v-row>

                                    <!-- <v-row>
                                        <v-col cols="3" class="d-flex align-center">
                                            <p class="mb-0 text-green font-16"> ราคาค่าประกันรวม </p>
                                        </v-col>
                                        <v-col cols="5" class="d-flex align-center">

                                        </v-col>
                                        <v-col cols="4" class="text-center d-flex align-center justify-center">
                                            <p class="mb-0 font-16">{{ formatPrice(total_price_insurance) }}</p>
                                        </v-col>
                                    </v-row> -->
                                    <v-row>
                                        <v-col cols="12">
                                            <v-card outlined class="bg-green-out rounded-lg">
                                                <v-row>
                                                    <v-col cols="6">
                                                        <p class="text-green bold mt-5 mb-6 ml-5 font-16">
                                                            ยอดเงินทั้งสิ้น</p>
                                                    </v-col>
                                                    <v-col cols="6">
                                                        <p class="text-green bold font-16 mt-5 mb-6 text-right total-card">
                                                            {{ formatPrice(total_amount) }}</p>
                                                    </v-col>
                                                </v-row>
                                            </v-card>
                                        </v-col>
                                    </v-row>

                                </v-card>
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
            submenu: [
                {
                    text: 'จัดการใบเสร็จอื่น ๆ',
                    disabled: false,
                },
                {
                    text: 'สร้างใบเสร็จใหม่',
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
            desserts: [
                {
                    bill_list_id: 1,
                    list_name: null,
                    price_unit: null,
                    num: null,
                    list_total_price: 0.00
                },
                {
                    bill_list_id: 2,
                    list_name: null,
                    price_unit: null,
                    num: null,
                    list_total_price: 0.00
                },
                {
                    bill_list_id: 3,
                    list_name: null,
                    price_unit: null,
                    num: null,
                    list_total_price: 0.00
                },
                {
                    bill_list_id: 4,
                    list_name: null,
                    price_unit: null,
                    num: null,
                    list_total_price: 0.00
                },
                {
                    bill_list_id: 5,
                    list_name: null,
                    price_unit: null,
                    num: null,
                    list_total_price: 0.00
                },
            ],

            rules: {
                address: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                phone: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                date_receipt_money: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                customer_name: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                payee_name: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
            },
            menu_date_receipt_money: false,
            date_receipt_money: null,
            customer_name: null,
            phone: null,
            address: null,
            payee_name: null,
            total_price: 0.00,
            get_data: [],
            get_bill_id: '',

            // ราคารวมก่อนภาษี
            total_price_before_tax: 0.00,
            // ค่าภาษี
            input_tax: 0.00,
            // ภาษี ที่แสดง
            net_tax: 0.00,
            // ราคารวมหลังภาษี
            total_price_after_tax: 0.00,

            // ภาษีหัก ณ ​ที่จ่าย
            input_withholding_tax: 0.00,
            net_withholding_tax: 0.00,
            total_withholding_tax: 0.00,

            // ราคาค่าประกันรวม
            total_price_insurance: 0.00,

            // ยอดเงินทั้งสิ้น
            total_amount: 0.00,

            tax_select_type: 2,
            tax_type: [
                { id: 2, name: 'ไม่คิดภาษี' },
                { id: 0, name: 'ภาษีรวมใน' },
                { id: 1, name: 'ภาษีรวมนอก' }
            ],

        }
    },
    methods: {
        async billGetId() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await bill.billGetId(config).then((result) => {
                if (result.data.success === true) {
                    this.get_bill_id = result.data.bill_id
                }
            })

        },
        async billAdd() {
            if (this.$refs.form_bill_add.validate()) {
                let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.access_token}`,
                    },
                }
                let data = new FormData();
                data.append('date_receipt_money', this.date_receipt_money);
                data.append('customer_name', this.customer_name);
                data.append('tel', this.phone);
                data.append('address', this.address);
                data.append('payee_name', this.payee_name);
                data.append('total_price', this.total_price_after_tax);

                data.append('tax_status', this.tax_select_type);
                data.append('tax_cost', this.input_tax);
                data.append('vat_cost', this.input_withholding_tax);
                
                



                var dessertsJSON = JSON.stringify(this.desserts);
                data.append('bill_lists', dessertsJSON);

                this.loading_page = true;

                await bill.billAdd(data, config).then((result) => {
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

        async addList(id) {
            this.desserts = [
                ...this.desserts,
                {
                    bill_list_id: id + 1,
                    list_name: null,
                    price_unit: null,
                    num: null,
                    list_total_price: 0.00
                },
            ]
        },

        // คำนวณภาษี
        async tax_selectChanged() {
            if (this.tax_select_type === 2) { // ไม่คิดภาษี

                this.input_tax = 0
                this.total_price_before_tax = parseFloat(this.total_price)
                this.total_price_after_tax = parseFloat(this.total_price)
                this.net_tax = 0.00

            } else if (this.tax_select_type === 0) { // ภาษีรวมใน

                this.input_tax = this.input_tax === 0 || this.input_tax === '' ? 7 : parseFloat(this.input_tax) // ค่า input

                // จำนวนเงิน = ค่าธรรมเนียมรายปี (สัญญา 1 ปี), ค่าเช่า, ค่าส่วนกลาง, อื่น ๆ
                let total_price_for_tax = parseFloat(this.total_price)

                // ราคารวมก่อนภาษี = ( จำนวนเงิน *  (100 / 100 + ภาษี ) )
                this.total_price_before_tax = (parseFloat(total_price_for_tax) * (100 / (100 + parseFloat(this.input_tax))));

                // ภาษี = จำนวนเงิน - ( จำนวนเงิน *  (100 / 100 + ภาษี ) )
                this.net_tax = (total_price_for_tax - (parseFloat(total_price_for_tax) * (100 / (100 + parseFloat(this.input_tax)))));

                // จำนวนเงินทั้งหมดหลังรวมภาษีรวมใน = จำนวนเงินทั้งหมดก่อนรวมภาษี - จำนวนเงิน + จำนวนเงินจากการคำนวณภาษีรวมใน
                this.total_price_after_tax = total_price_for_tax;

            } else if (this.tax_select_type === 1) {// ภาษีรวมนอก

                this.input_tax = this.input_tax === 0 || this.input_tax === '' ? 7 : parseFloat(this.input_tax) // ค่า input

                // ค่าธรรมเนียมรายปี (สัญญา 1 ปี), ค่าเช่า, ค่าส่วนกลาง, อื่น ๆ
                let total_price_for_tax = parseFloat(this.total_price)
                this.total_price_before_tax = total_price_for_tax
                this.net_tax = (parseFloat(total_price_for_tax) * (this.input_tax / 100));
                this.total_price_after_tax = (parseFloat(this.total_price_before_tax) + parseFloat(this.net_tax));
            }

            // ภาษีหัก ณ ​ที่จ่าย  
            this.input_withholding_tax = this.input_withholding_tax === 0 || this.input_withholding_tax === '' ? 0 : parseFloat(this.input_withholding_tax) // ค่า input
            this.net_withholding_tax = (parseFloat(this.total_price_before_tax) * (parseFloat(this.input_withholding_tax) / 100));
            this.total_withholding_tax = (parseFloat(this.total_price_after_tax) - parseFloat(this.net_withholding_tax));
            this.total_amount = (parseFloat(this.total_price_insurance) + parseFloat(this.total_withholding_tax));
        },

        // คำนวณราคารวมก่อนภาษี
        async cal_total_price_before_tax(total_price) {
            this.total_price_before_tax = total_price
            // this.total_price_before_tax =
            //     (
            //         parseFloat(this.net_price_guarantee_service_rate) +
            //         parseFloat(this.net_price_guarantee_water_rate) +
            //         parseFloat(this.net_price_guarantee_electricity_rate) +
            //         parseFloat(this.net_price_guarantee_hood_rate) +
            //         parseFloat(this.net_price_cost_rental_rate) +
            //         parseFloat(this.net_price_cost_common_rate) +
            //         parseFloat(this.net_price_annual_fee) +
            //         parseFloat(this.other_net_price)
            //     );

            // // คำนวณ ราคาค่าประกันรวม
            // this.total_price_insurance =
            //     (
            //         parseFloat(this.net_price_guarantee_service_rate) +
            //         parseFloat(this.net_price_guarantee_water_rate) +
            //         parseFloat(this.net_price_guarantee_electricity_rate) +
            //         parseFloat(this.net_price_guarantee_hood_rate)
            //     );

            this.tax_selectChanged()
        }
    },
    created() {
    },
    mounted() {
        this.billGetId();
    },

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

.bold {
    font-weight: bold !important;
}

.total-card {
    right: 11%;
    position: absolute;
}

.bg-green-out {
    background-color: #74b08830 !important;
    border: 1px solid #74b088bd !important;
}

.bg-border-green {
    border: 1px solid #74B088 !important;
}

.mb-0 {
    margin-bottom: 0px !important;
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

.text-green {
    color: #60A577;
}
</style>