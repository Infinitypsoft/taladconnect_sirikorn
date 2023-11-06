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
                    <h1 class="font-20 m-0">รายละเอียดใบเสร็จ</h1>
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
                <v-card-title v-if="get_data.status === 1" class="text-card-title">
                    รายละเอียดใบเสร็จ
                    <span class="custom-cancel-status ml-4">ยกเลิก</span>
                </v-card-title>

                <v-card-text class="mt-2">
                    <div class="d-flex align-center">
                        <img class="mr-2" :src="base_url + `/images/icon/d06e425aecd9322c5e27c91f4e75cd48.png`"
                            alt="Contact" width="20" height="20" />
                        <span class="font-16 color-title-card">เลขที่ใบเสร็จ : {{ get_data.bill_id }}</span>
                    </div>
                    <div class="mt-3">
                        <v-row class="container-input-contact">
                            <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                <p class="font-16 fw-500 text-ex mb-0">วันที่รับเงิน : {{
                                    dateFormat1(get_data.date_receipt_money) }}</p>
                            </v-col>
                            <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">

                            </v-col>
                            <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                <p class="font-16 fw-500 text-ex mb-0">ชื่อลูกค้า : {{ get_data.customer_name }}</p>
                            </v-col>
                            <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                <p class="font-16 fw-500 text-ex mb-0">เบอร์โทร : {{ get_data.tel === null ? '-' :
                                    get_data.tel }}</p>
                            </v-col>
                            <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                                <p class="font-16 fw-500 text-ex mb-0">ที่อยู่ : {{ get_data.address === null ? '-' :
                                    get_data.address }}</p>
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
                            <v-data-table :headers="headers" :items="desserts" :items-per-page="itemsPerPage" elevation="0"
                                :page.sync="page" hide-default-footer @page-count="pageCount = $event">
                                <template v-slot:item="{ item, index }">
                                    <tr>
                                        <td style="text-align: center;">{{ item.bill_list_id }}</td>
                                        <td>
                                            {{ item.list_name }}
                                        </td>
                                        <td>
                                            {{ formatPrice(item.price_unit) }}
                                        </td>
                                        <td>
                                            {{ item.num }}
                                        </td>
                                        <td style="text-align: center;">{{ formatPrice(item.list_total_price) }}</td>
                                    </tr>
                                    <!-- <tr v-if="desserts.length === index + 1"
                                        style="border: 1px solid rgba(116, 176, 136, 0.50);background: rgba(116, 176, 136, 0.19);">
                                        <td style="text-align: center;" colspan="3">{{ THBText(get_data.total_price) }}ถ้วน</td>
                                        <td style="border: 1px solid rgba(116, 176, 136, 0.50); text-align: center;">
                                            รวมทั้งหมด</td>
                                        <td style="text-align: center;">{{ formatPrice(get_data.total_price) }}</td>
                                    </tr> -->
                                </template>

                            </v-data-table>
                        </v-col>

                        <v-col cols="">
                        </v-col>

                        <v-col cols="12" lg="7" md="9" sm="10">
                            <v-card elevation="0" class="rounded-lg p-4 pt-6 pb-6 bg-border-green mb-6">
                                <v-row>
                                    <v-col cols="3">
                                        <p class="text-green font-16 mb-0">ราคารวม</p>
                                    </v-col>
                                    <v-col cols="5">
                                        <p class="font-16  mb-0">ราคารวมก่อนภาษี</p>

                                    </v-col>
                                    <v-col cols="4" class="text-center ">
                                        <p class="font-16  mb-0">{{ formatPrice(total_price_before_tax) }}</p>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="">
                                    </v-col>
                                    <v-col cols="5" class="d-flex align-center">
                                        <p v-if="tax_select_type === 2" class="mb-0  font-16">ไม่คิดภาษี {{
                                            input_tax }}% </p>
                                        <p v-if="tax_select_type === 0" class="mb-0  font-16">ภาษีรวมใน {{
                                            input_tax }}% </p>
                                        <p v-if="tax_select_type === 1" class="mb-0  font-16">ภาษีรวมนอก {{
                                            input_tax }}% </p>
                                    </v-col>
                                    <v-col cols="4" class="text-center">
                                        <p class="font-16">{{ formatPrice(net_tax) }}</p>
                                    </v-col>
                                </v-row>

                                <v-row>
                                    <v-col cols="3">

                                    </v-col>
                                    <v-col cols="5" class="">
                                        <p class="text-green font-16">ราคารวมหลังภาษี</p>
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
                                        <p class="mb-0  font-16">ภาษีหัก ณ ​ที่จ่าย
                                            {{ formatPrice(input_withholding_tax) }}%
                                        </p>
                                    </v-col>

                                    <v-col cols="4" class="text-center d-flex align-center justify-center">
                                        <p class="mb-0 font-16">{{ formatPrice(net_withholding_tax) }}</p>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="3" class="d-flex align-center">

                                    </v-col>
                                    <v-col cols="5" class="d-flex align-center">
                                        <p class="mb-0 text-green font-16"> ราคารวมหลังหักภาษี ณ ที่จ่าย
                                        </p>
                                    </v-col>
                                    <v-col cols="4" class="text-center">
                                        <p class="font-16">{{ formatPrice(total_withholding_tax) }}</p>
                                    </v-col>

                                    <v-divider style="border-color: #D9D9D9 !important;"></v-divider>

                                </v-row>
<!-- 
                                <v-row>
                                    <v-col cols="3">
                                        <p class="text-green font-16">ราคาค่าประกันรวม</p>
                                    </v-col>
                                    <v-col cols="5" class="">
                                    </v-col>
                                    <v-col cols="4" class="text-center">
                                        <p class="font-16">{{ formatPrice(total_price_insurance) }}</p>
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
                        <!-- <v-col class="pb-100" xs="12" sm="12" md="12" lg="12" xl="12" cols="12">
                            <br />
                            <div class="d-flex align-items-center justify-center mt-6">
                                <span class="fs-16 fw-500 mr-2">ผู้รับเงิน <span style="color: red;">*</span></span>
                                <div class="d-flex flex-column align-items-center" style="margin-bottom: -100px;">
                                    <div style="width: 500px;border: 1px solid;"></div>
                                    <br />
                                    <span class="d-flex align-center gap-2 fs-16 fw-500 ">( {{ get_data.payee_name }} )</span>
                                </div>
                            </div>
                            <br />
                        </v-col> -->
                    </v-row>
                </v-card-text>
            </v-card>

        </div>
    </div>
</template>

<script>
import bill from '../../../api/bill.js';
// import award from '../../../api/award.js';

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
                    
                    this.tax_select_type = this.get_data.tax_status
                    this.input_tax = this.get_data.tax_cost
                    this.input_withholding_tax = this.get_data.vat_cost
                    


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
        async cal_total_price_before_tax() {
            // this.total_price_before_tax = total_price
            this.tax_selectChanged()
        }

    },
    created() {
    },
    async mounted() {
        await this.getList()
        await this.cal_total_price_before_tax()
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