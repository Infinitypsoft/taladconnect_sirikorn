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
                    <h1 class="font-20 m-0">รายละเอียดการเช่าแผง</h1>
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

                    <v-card elevation="2" class="mb-6">
                        <v-row class="m-0 p-4">
                            <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                                <v-card-title class="p-0 text-card-title">
                                    <v-row class="container-title">
                                        <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                                            <p>รายละเอียดการเช่าแผง</p>
                                        </v-col>
                                    </v-row>
                                </v-card-title>
                                <v-card-text class="p-0 mt-2">
                                    <div class="d-flex align-center mb-4">
                                        <img class="mr-2"
                                            :src="base_url + `/images/icon/843b5ac6e45d66deccc42ce990f7acc8.png`"
                                            alt="Contact" width="20" height="20" />
                                        <span class="font-16 color-title-card">ข้อมูลผู้เช่า</span>
                                    </div>

                                    <v-row>
                                        <v-col cols="12">
                                            <p class="font-16 color-707070 mb-0">ผู้เช่า : นายสมชาย โลกอนาคต
                                            </p>
                                        </v-col>
                                        <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                            <p class="font-16 color-707070 mb-0">เลขบัตรประชาชน/เลขประจำตัวผู้เสียภาษีอากร :
                                                {{ id_card.replace(/(\d)(\d{4})(\d{5})(\d{2})(\d)/, '$1-$2-$3-$4-$5') }}</p>
                                        </v-col>
                                        <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                            <p class="font-16 color-707070 mb-0">เบอร์โทร : {{ phone }}</p>
                                        </v-col>
                                        <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                                            <p class="font-16 color-707070">ที่อยู่ : {{ address }}</p>
                                        </v-col>
                                    </v-row>

                                    <div class="d-flex align-center mb-4 mt-5">
                                        <img class="mr-2" :src="base_url + `/images/icon/keyword_2.png`" alt="Contact"
                                            width="20" height="20" />
                                        <span class="font-16 color-title-card">ข้อมูแผงค้าที่ต้องการเช่า</span>
                                    </div>

                                    <v-row>
                                        <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                            <p class="font-16 color-707070 mb-0">รายการแผงค้า : {{ stall_lists }}
                                            </p>
                                        </v-col>
                                    </v-row>

                                </v-card-text>

                            </v-col>
                        </v-row>
                    </v-card>
                    
                    <v-card elevation="2" class="mb-6">
                        <v-row class="m-0 p-4">
                            <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                                <v-card-title class="p-0 pb-5 justify-space-between text-card-title">
                                    <v-row>
                                        <v-col cols="6">
                                            สร้างการเช่าแผงใหม่
                                        </v-col>
                                        <v-col cols="6" class=" d-flex align-start justify-end">
                                            <v-btn outlined class="btn pr-30 font-16 rounded-xl bg-green-out"
                                                color="success">
                                                <span> รวมยอดที่ต้องชำระ/ครั้ง :
                                                    {{
                                                        (parseFloat(net_price_cost_rental_rate) +
                                                            parseFloat(net_price_cost_common_rate) +
                                                            parseFloat(other_net_price))
                                                    }} บาท </span>
                                            </v-btn>
                                        </v-col>

                                        <v-col v-if="doc_type !== 1" cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                                            <v-btn @click="dialogEditDate" class="btn-edit radius-30" color="warning" dark>
                                                <v-icon class="icon-btn-edit" large color="white">
                                                    mdi-pencil
                                                </v-icon>
                                                แก้ไขวันที่การทำสัญญา
                                            </v-btn>
                                        </v-col>
                                    </v-row>

                                </v-card-title>
                                <v-card-subtitle class="p-0 mb-6">
                                    <v-row class="">
                                        <v-col cols="12">
                                            <img class="mr-2" :src="base_url + `/images/icon/megaphone 6.png`" alt=""
                                                width="20" height="20" />
                                            <span
                                                class="font-16 color-title-card">ระยะเวลาเช่าและการยอดเงินที่ต้องชำระ</span>
                                        </v-col>

                                        <v-col cols="12" lg="6" md="6">
                                            <p class="font-14 text-ex mb-0 fs-16 fw-500">วันที่เริ่มต้นสัญญา :
                                                {{ dateFormat1(date_start) }}
                                            </p>
                                        </v-col>
                                        <v-col cols="6" lg="6" md="6">
                                            <p class="font-14 text-ex mb-0 fs-16 fw-500">วันที่สิ้นสุดสัญญา :
                                                {{ dateFormat1(date_end) }}
                                            </p>
                                        </v-col>

                                        <v-col cols="12">
                                            <p class="font-14 text-ex fs-16 fw-500">อัตราค่าเช่า
                                                <span style="color: red;">*</span>
                                            </p>

                                            <v-simple-table>
                                                <template v-slot:default>
                                                    <thead>
                                                        <tr class="bg-green-out">
                                                            <th class="text-left font-16">
                                                                รายการค่าเช่า
                                                            </th>
                                                            <th class="text-center font-16">
                                                                ราคา
                                                            </th>
                                                            <th class="text-center font-16">
                                                                ส่วนลด
                                                            </th>
                                                            <th class="text-center font-16">
                                                                ราคาสุทธิ
                                                            </th>
                                                        </tr>
                                                        <tr class="bg-green-out">
                                                            <th colspan="4" class="text-left font-16">
                                                                ค่าธรรมเนียม
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr>
                                                            <td style="width: 550px;">ค่าธรรมเนียมรายปี (สัญญา 1 ปี)</td>
                                                            <td style="width: 250px; text-align: center;">
                                                                {{ formatPrice(annual_fee) }}
                                                            </td>
                                                            <td style="width: 250px; text-align: center;">
                                                                {{ formatPrice(discount_annual_fee) }}
                                                            </td>
                                                            <td style="width: 250px; text-align: center;">
                                                                {{ formatPrice(net_price_annual_fee) }}
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </template>
                                            </v-simple-table>
                                            <v-simple-table>
                                                <template v-slot:default>
                                                    <thead>
                                                        <tr class="bg-green-out">
                                                            <th class="text-left font-16">
                                                                รายการค่าเช่า
                                                            </th>
                                                            <th class="text-center font-16">
                                                                ราคา
                                                            </th>
                                                            <th class="text-center font-16">
                                                                ส่วนลด
                                                            </th>
                                                            <th class="text-center font-16">
                                                                ราคาสุทธิ
                                                            </th>
                                                        </tr>
                                                        <tr class="bg-green-out">
                                                            <th colspan="4" class="text-left font-16">
                                                                เงินประกันต่าง ๆ
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr>
                                                            <td style="width: 550px;">ประกันการเช่าและการบริการ</td>
                                                            <td style="width: 250px;text-align: center;">
                                                                {{ formatPrice(guarantee_service_rate) }}
                                                            </td>
                                                            <td style="width: 250px;text-align: center;">
                                                                {{ formatPrice(discount_guarantee_service_rate) }}
                                                            </td>
                                                            <td style="width: 250px;text-align: center;">
                                                                {{ formatPrice(net_price_guarantee_service_rate) }}
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td style="width: 550px;">ประกันมิเตอร์น้ำ</td>
                                                            <td style="width: 250px;text-align: center;">
                                                                {{ formatPrice(guarantee_water_rate) }}
                                                            </td>
                                                            <td style="width: 250px;text-align: center;">
                                                                {{ formatPrice(discount_guarantee_water_rate) }}
                                                            </td>
                                                            <td style="width: 250px;text-align: center;">
                                                                {{ formatPrice(net_price_guarantee_water_rate) }}
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td style="width: 550px;">ประกันมิเตอร์ไฟ</td>
                                                            <td style="width: 250px;text-align: center;">
                                                                {{ formatPrice(guarantee_electricity_rate) }}
                                                            </td>
                                                            <td style="width: 250px;text-align: center;">
                                                                {{ formatPrice(discount_guarantee_electricity_rate) }}
                                                            </td>
                                                            <td style="width: 250px;text-align: center;">
                                                                {{ formatPrice(net_price_guarantee_electricity_rate) }}
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td style="width: 550px;">ประกันเครื่องดูดควัน</td>
                                                            <td style="width: 250px;text-align: center;">
                                                                {{ formatPrice(guarantee_hood_rate) }}
                                                            </td>
                                                            <td style="width: 250px;text-align: center;">
                                                                {{ formatPrice(discount_guarantee_hood_rate) }}
                                                            </td>
                                                            <td style="width: 250px;text-align: center;">
                                                                {{ formatPrice(net_price_guarantee_hood_rate) }}
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </template>
                                            </v-simple-table>

                                            <v-simple-table>
                                                <template v-slot:default>
                                                    <thead>
                                                        <tr class="bg-green-out">
                                                            <th colspan="4" class="text-left font-16">
                                                                ค่าใช้จ่ายการเช่า
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr>
                                                            <td style="width: 550px;">ค่าเช่า</td>
                                                            <td style="width: 250px; text-align: center;">
                                                                {{ formatPrice(cost_rental_rate) }}
                                                            </td>
                                                            <td style="width: 250px; text-align: center;">
                                                                {{ formatPrice(discount_cost_rental_rate) }}
                                                            </td>
                                                            <td style="width: 250px; text-align: center;">
                                                                {{ formatPrice(net_price_cost_rental_rate) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 550px;">ค่าส่วนกลาง</td>
                                                            <td style="width: 250px; text-align: center;">
                                                                {{ formatPrice(cost_common_rate) }}
                                                            </td>
                                                            <td style="width: 250px; text-align: center;">
                                                                {{ formatPrice(discount_cost_common_rate) }}
                                                            </td>
                                                            <td style="width: 250px; text-align: center;">
                                                                {{ formatPrice(net_price_cost_common_rate) }}
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td style="width: 550px;">อื่น ๆ</td>
                                                            <td style="width: 250px; text-align: center;">
                                                                {{ formatPrice(other_price) }}
                                                            </td>
                                                            <td style="width: 250px; text-align: center;">
                                                                {{ formatPrice(other_price_discount) }}
                                                            </td>
                                                            <td style="width: 250px; text-align: center;">
                                                                {{ formatPrice(other_net_price) }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </template>
                                            </v-simple-table>
                                        </v-col>

                                        <v-col cols="">
                                            <span class="fs-16 fw-500 color-E60023">หมายเหตุ :
                                                ภาษีมูลค่าเพิ่มจะถูกคำนวณจากยอดรายได้ ประกอบด้วย ค่าธรรมเนียม ค่าเช่า
                                                ค่าส่วนกลาง และอื่นๆ </span>
                                        </v-col>

                                        <v-col cols="12" lg="7" md="9" sm="10">
                                            <v-card elevation="0" class="rounded-lg p-4 pt-6 pb-6 bg-border-green">
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

                                                <v-row>
                                                    <v-col cols="3">
                                                        <p class="text-green font-16">ราคาค่าประกันรวม</p>
                                                    </v-col>
                                                    <v-col cols="5" class="">
                                                    </v-col>
                                                    <v-col cols="4" class="text-center">
                                                        <p class="font-16">{{ formatPrice(total_price_insurance) }}</p>
                                                    </v-col>
                                                </v-row>

                                                <v-row>
                                                    <v-col cols="12">
                                                        <v-card outlined class="bg-green-out rounded-lg">
                                                            <v-row>
                                                                <v-col cols="6">
                                                                    <p class="text-green bold mt-5 mb-6 ml-5 font-16">
                                                                        ยอดเงินทั้งสิ้น</p>
                                                                </v-col>
                                                                <v-col cols="6">
                                                                    <p
                                                                        class="text-green bold font-16 mt-5 mb-6 text-right total-card">
                                                                        {{ formatPrice(total_amount) }}</p>
                                                                </v-col>
                                                            </v-row>
                                                        </v-card>
                                                    </v-col>
                                                </v-row>

                                            </v-card>
                                        </v-col>
                                    </v-row>

                                    <!-- <v-row> -->
                                    <!-- <v-col cols="12">
                                            <img class="mr-2" :src="base_url + `/images/icon/megaphone 6.png`" alt=""
                                                width="20" height="20" />
                                            <span
                                                class="font-16 color-title-card">รูปแบบแจ้งเตือนการส่งบิลเรียกเก็บค่าเช่าผ่านทาง
                                                Line Official</span>
                                        </v-col> -->

                                    <!--  if ปิดการส่งข้อมูลอัตโนมัติ -->
                                    <!-- <v-col v-if="line_status === 0" cols="12">
                                            <p class="font-14 text-ex fs-16 fw-500">การส่งข้อมูลอัตโนมัติ : </p>
                                            <img class="mr-2" :src="base_url + `/images/icon/on-button_5.png`" alt=""
                                                width="20" height="20" />
                                            <span class="font-16  ">ปิดการส่งข้อมูลอัตโนมัติ</span>
                                        </v-col> -->

                                    <!--  else เปิดการส่งข้อมูลอัตโนมัติ -->
                                    <!-- <v-col v-if="line_status === 1" cols="12">
                                            <p class="font-14 text-ex fs-16 fw-500">การส่งข้อมูลอัตโนมัติ : </p>
                                            <img class="mr-2" :src="base_url + `/images/icon/on-button_4.png`" alt=""
                                                width="20" height="20" />
                                            <span class="font-16  ">เปิดการส่งข้อมูลอัตโนมัติ</span>
                                        </v-col>

                                        <v-col v-if="line_status === 1" cols="6">
                                            <p class="font-16">รอบการส่งบิลเรียกเก็บ : {{ bill_sending_name }}</p>
                                        </v-col>




                                        <v-col v-if="line_status === 1 && bill_sending_status === 1" cols="6">
                                            <p class="font-16">วันที่ต้องการส่งบิลเรียกเก็บรายสัปดาห์ : {{ line_day_name }}
                                            </p>
                                        </v-col>

                                        <v-col v-if="line_status === 1 && bill_sending_status === 2" cols="6">
                                            <p class="font-16">วันที่ต้องการส่งบิลเรียกเก็บรายเดือน : {{ line_mouth_name }}
                                            </p>
                                        </v-col>

                                        <v-col v-if="line_status === 1 && bill_sending_status === 3" cols="6">
                                            <p class="font-16">วันที่ต้องการส่งบิลเรียกเก็บรายปี : วันที่
                                                {{ line_day_yaer_select_type }} เดือน {{ line_mouth_yaer_name }}
                                            </p>
                                        </v-col> -->

                                    <!-- </v-row> -->

                                </v-card-subtitle>

                            </v-col>
                        </v-row>
                    </v-card>

                    <v-card v-if="doc_type !== 0" elevation="2">
                        <v-row class="m-0 p-4">
                            <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                                <v-card-title class="p-0 pb-5 justify-space-between text-card-title">
                                    <v-row>
                                        <v-col cols="6">
                                            การยืนยันการเช่า
                                        </v-col>
                                        <v-col cols="6" class=" d-flex align-start justify-end">
                                            <v-btn outlined class="btn pr-30 font-16 rounded-xl bg-green-out"
                                                color="success">
                                                <span> ยอดเงินที่ต้องชำระทั้งสิ้น
                                                    {{
                                                        (parseFloat(net_price_cost_rental_rate) +
                                                            parseFloat(net_price_cost_common_rate) +
                                                            parseFloat(other_net_price)).toFixed(2)
                                                    }} บาท </span>
                                            </v-btn>
                                        </v-col>

                                    </v-row>

                                </v-card-title>
                                <v-card-subtitle class="p-0 mb-6">
                                    <v-row class="">
                                        <v-col cols="12">
                                            <img class="mr-2" :src="base_url + `/images/icon/megaphone 6.png`" alt=""
                                                width="20" height="20" />
                                            <span
                                                class="font-16 color-title-card">ระยะเวลาเช่าและการยอดเงินที่ต้องชำระ</span>
                                        </v-col>


                                        <v-col cols="12">
                                            <p class="font-14 text-ex mb-0 fs-16 fw-500">วิธีการชำระเงิน :
                                                {{ get_data.pay_type === 0 ? 'เงินสด' : 'เงินโอน' }}
                                            </p>
                                        </v-col>
                                        <v-col cols="12">
                                            <p class="font-14 text-ex mb-0 fs-16 fw-500">หลักฐานการชำระเงิน</p>
                                        </v-col>


                                        <v-col v-if="doc_type === 2" cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                                            <v-btn @click="dialogUploadImage" class="btn-success pl-30 pr-30"
                                                color="warning" dark>
                                                <img :src="base_url + `/images/icon/image- 132.png`" alt="" width="20"
                                                    height="20" />
                                                <span class="ml-2">อัพโหลดรูปภาพเพิ่มเติม</span>
                                            </v-btn>
                                        </v-col>
                                        <v-row>
                                            <v-col sm="2" v-for="(file, f) in get_data.slip_list" :key="f">
                                                <img :src="base_url + '/public/' + file.slip_path" class="img-fluid"
                                                    :title="'file' + f" height="250" />
                                            </v-col>
                                        </v-row>

                                        <v-col cols="">
                                            <span class="fs-16 fw-500 color-707070">หมายเหตุ : {{ get_data.slip_note }}
                                            </span>
                                        </v-col>

                                    </v-row>

                                </v-card-subtitle>

                            </v-col>
                        </v-row>
                    </v-card>
                </v-col>
            </v-row>

            <!-- Dialog Upload Image-->
            <v-dialog v-model="dialog_upload_image" width="1054">
                <v-card>
                    <v-card-title
                        class="text-h5 color-black fs-20 h-65 p-0 pl-30 pr-30 d-flex justify-space-between bg-F8F8F8">
                        <span>อัพโหลดรูปภาพเพิ่มเติม</span>
                        <v-btn @click="() => { dialog_upload_image = false }" class="p-0 m-0" width="50" height="50"
                            style="min-width: 50px !important;">
                            <img class="p-0 m-0" :src="base_url + `/images/icon/close.png`" alt="Keyword" width="20"
                                height="20" />
                        </v-btn>

                    </v-card-title>
                    <v-card class="mt-2 p-5 pt-3" elevation="0">
                        <v-form v-on:submit.prevent="slipUpload()">
                            <div class="d-flex align-center mb-4">
                                <img class="mr-2" :src="base_url + `/images/icon/megaphone 112.png`" alt="Keyword"
                                    width="20" height="20" />

                                <span class="font-16 color-title-card">รูปภาพหลักฐานที่ต้องการแนบเพิ่มเติม</span>
                            </div>

                            <v-card-text class="p-0 mt-5">
                                <div>
                                    <p class="font-14 mt-3 text-ex">แนบรูปภาพหลักฐานกาชำระเงิน (ได้หลายรูปภาพ)</p>
                                    <v-file-input class="w-100" outlined dense id="uploader" accept="image/*" multiple
                                        v-model="content_picture" @change="onFileChange" single-line clearable clear-icon=""
                                        label="กรุณาแนบรูปภาพหลักฐานกาชำระเงิน"></v-file-input>
                                </div>
                            </v-card-text>

                            <v-list-item three-line class="pl-0 pr-0 ml-0 mr-0">
                                <v-row>
                                    <v-col sm="2" v-for="(file, f) in get_data.slip_list" :key="f">
                                        <img :src="base_url + '/public/' + file.slip_path" class="img-fluid"
                                            :title="'file' + f" height="250" />
                                    </v-col>

                                    <v-col sm="2" v-for="(file, f) in content_picture" :key="f">
                                        <!-- {{ file.name }} -->
                                        <img :ref="'file'" src="//placehold.it/400/99cc77" class="img-fluid"
                                            :title="'file' + f" />
                                    </v-col>
                                </v-row>

                            </v-list-item>
                            <v-card-actions>
                                <v-card-text class="p-0 d-flex justify-center mt-4">
                                    <v-btn type="submit" class="btn-success pl-30 pr-30" color="warning" dark>
                                        <v-icon class="fs-20" left dark>
                                            mdi-content-save
                                        </v-icon>
                                        <span>บันทึกข้อมูล</span>
                                    </v-btn>
                                </v-card-text>
                            </v-card-actions>
                        </v-form>
                    </v-card>
                </v-card>
            </v-dialog>

            <!-- Dialog Edit Date -->
            <v-dialog v-model="dialog_edit_date" width="1054">
                <v-card>
                    <v-card-title
                        class="text-h5 color-black fs-20 h-65 p-0 pl-30 pr-30 d-flex justify-space-between bg-F8F8F8">
                        <span>แก้ไขวันที่การทำสัญญา</span>
                        <v-btn @click="() => { dialog_edit_date = false }" class="p-0 m-0" width="50" height="50"
                            style="min-width: 50px !important;">
                            <img class="p-0 m-0" :src="base_url + `/images/icon/close.png`" alt="Keyword" width="20"
                                height="20" />
                        </v-btn>

                    </v-card-title>
                    <v-card class="mt-2 p-5 pt-3" elevation="0">
                        <v-form v-on:submit.prevent="dateUpdate()">
                            <div class="d-flex align-center mb-4">
                                <img class="mr-2" :src="base_url + `/images/icon/megaphone 612123.png`" alt="Keyword"
                                    width="20" height="20" />

                                <span class="font-16 color-title-card">ระยะเวลาเช่าและการยอดเงินที่ต้องชำระ</span>
                            </div>

                            <v-row>
                                <v-col cols="12" lg="6" md="6">
                                    <p class="font-14 text-ex fs-16 fw-500">วันที่เริ่มต้นสัญญา
                                        <span style="color: red;">*</span>
                                    </p>

                                    <v-menu v-model="menu2" :close-on-content-click="false" :nudge-right="40"
                                        transition="scale-transition" offset-y min-width="auto">
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-text-field v-model="date_start" label="กรุณาเลือกวันที่เริ่มต้นสัญญา"
                                                outlined dense single-line :rules="rules.date_start" required v-bind="attrs"
                                                v-on="on" hide-details=""></v-text-field>
                                        </template>
                                        <v-date-picker v-model="date_start" @input="menu2 = false"></v-date-picker>
                                    </v-menu>
                                </v-col>
                                <v-col cols="6" lg="6" md="6">
                                    <p class="font-14 text-ex fs-16 fw-500">วันที่สิ้นสุดสัญญา
                                        <span style="color: red;">*</span>
                                    </p>
                                    <v-menu v-model="menu2end" :close-on-content-click="false" :nudge-right="40"
                                        transition="scale-transition" offset-y min-width="auto">
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-text-field v-model="date_end" label="กรุณาเลือกวันที่สิ้นสุดสัญญา" outlined
                                                dense single-line :rules="rules.date_end" required v-bind="attrs" v-on="on"
                                                hide-details=""></v-text-field>
                                        </template>
                                        <v-date-picker v-model="date_end" @input="menu2end = false"></v-date-picker>
                                    </v-menu>
                                </v-col>
                            </v-row>

                            <v-card-actions>
                                <v-card-text class="p-0 d-flex justify-center mt-4">
                                    <v-btn type="submit" class="btn-success pl-30 pr-30" color="warning" dark>
                                        <v-icon class="fs-20" left dark>
                                            mdi-content-save
                                        </v-icon>
                                        <span>บันทึกข้อมูล</span>
                                    </v-btn>
                                </v-card-text>
                            </v-card-actions>
                        </v-form>
                    </v-card>
                </v-card>
            </v-dialog>

        </div>
    </div>
</template>

<script>
// import stall from '../../../api/stall.js';
import contract_block from '../../../api/contract_block.js';
// import { ref } from 'vue';
export default {
    data() {
        return {
            loading_page: false,
            alert_success: false,
            alert_message_success: '',
            alert_error: false,
            alert_message_error: '',
            dialog_upload_image: false,
            dialog_edit_date: false,
            content_picture: [],
            readers: [],
            submenu: [
                {
                    text: 'ทำสัญญาเช่าแผง',
                    disabled: true,
                },
                {
                    text: 'รายละเอียดการเช่าแผง',
                    disabled: true,
                },
            ],
            site_id: null,
            buildingData: [],
            stallData: [],
            blockData: [],
            siteData: {},
            stall_select_item_id: 0,
            size_stall_on_select: null,
            arr_index_add: [],
            page: 1,
            pages: 10,
            block_name: '',
            block_color: [],
            count_index: 1,
            name: null,
            id_card: null,
            phone: null,
            price: null,
            status: false,
            select_mock: null,

            // Date
            date_start: null,
            date_end: null,
            menu2: false,
            menu2end: false,

            rules: {
                date_start: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                date_end: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
            },

            guarantee_service_rate: 0.00, //ค่าประกันการเช่าและบริการ
            guarantee_water_rate: 0.00, //อัตราค่าประกันมิเตอร์น้ำ
            guarantee_electricity_rate: 0.00, //อัตราค่าประกันมิเตอร์ไฟ
            guarantee_hood_rate: 0.00, //อัตราค่าประกันเครื่องดูดควัน
            cost_rental_rate: 0.00, //ค่าเช่า
            cost_common_rate: 0.00, //ค่าส่วนกลาง
            annual_fee: 0, // 	ค่าธรรมเนียมรายปี

            discount_guarantee_service_rate: null, //ส่วนลดค่าประกันการเช่าและบริการ
            discount_guarantee_water_rate: null, //ส่วนลดอัตราค่าประกันมิเตอร์น้ำ
            discount_guarantee_electricity_rate: null, //ส่วนลดอัตราค่าประกันมิเตอร์ไฟ
            discount_guarantee_hood_rate: null, //ส่วนลดอัตราค่าประกันเครื่องดูดควัน
            discount_cost_rental_rate: null, //ส่วนลดค่าเช่า
            discount_cost_common_rate: null, //ส่วนลดค่าส่วนกลาง
            discount_annual_fee: null, //ส่วนลดค่าธรรมเนียมรายปี

            // ราคาสทธิ
            net_price_guarantee_service_rate: 0.00,
            net_price_guarantee_water_rate: 0.00,
            net_price_guarantee_electricity_rate: 0.00,
            net_price_guarantee_hood_rate: 0.00,
            net_price_cost_rental_rate: 0.00,
            net_price_cost_common_rate: 0.00,
            net_price_annual_fee: 0.00,

            // อื่นๆ
            other_price: null,
            other_price_discount: null,
            other_net_price: 0.00,

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

            // Line
            line_status: 0,

            // รอบการส่งบิลเรียกเก็บ
            bill_sending_status: null,
            bill_sending_name: null,
            mock_line_no: [
                { id: 0, name: 'รายวัน' },
                { id: 1, name: 'รายสัปดาห์' },
                { id: 2, name: 'รายเดือน' },
                { id: 3, name: 'รายปี' },
            ],
            line_day_select_type: 0,
            line_day_name: null,
            mock_day: [
                { id: 0, day: 'วันอาทิตย์' },
                { id: 1, day: 'วันจันทร์' },
                { id: 2, day: 'วันอังคาร' },
                { id: 3, day: 'วันพุธ' },
                { id: 4, day: 'วันพฤหัสบดี' },
                { id: 5, day: 'วันศุกร์' },
                { id: 6, day: 'วันเสาร์' },
            ],
            line_mouth_select_type: 0,
            line_mouth_name: null,
            mock_mouth: [
                { id: 0, mouth: 'ทุกวันสุดท้ายของเดือน' },
                { id: 15, mouth: 'ทุกวันที่ 15 ของเดือน' },
                { id: 20, mouth: 'ทุกวันที่ 20 ของเดือน' },
                { id: 25, mouth: 'ทุกวันที่ 25 ของเดือน' },
            ],
            line_mouth_yaer_select_type: 1,
            line_mouth_yaer_name: null,
            mock_mouth_yaer: [
                { id: 1, mouthyaer: 'มกราคม' },
                { id: 2, mouthyaer: 'กุมภาพันธ์' },
                { id: 3, mouthyaer: 'มีนาคม' },
                { id: 4, mouthyaer: 'เมษายน' },
                { id: 5, mouthyaer: 'พฤษภาคม' },
                { id: 6, mouthyaer: 'มิถุนายน' },
                { id: 7, mouthyaer: 'กรกฎาคม' },
                { id: 8, mouthyaer: 'สิงหาคม' },
                { id: 9, mouthyaer: 'กันยายน' },
                { id: 10, mouthyaer: 'ตุลาคม' },
                { id: 11, mouthyaer: 'พฤศจิกายน' },
                { id: 12, mouthyaer: 'ธันวาคม' },
            ],
            line_day_yaer_select_type: 1,
            mock_day_yaer: [
                { id: 1 },
                { id: 2 },
                { id: 3 },
                { id: 4 },
                { id: 5 },
                { id: 6 },
                { id: 7 },
                { id: 8 },
                { id: 9 },
                { id: 10 },
                { id: 11 },
                { id: 12 },
                { id: 13 },
                { id: 14 },
                { id: 15 },
                { id: 16 },
                { id: 17 },
                { id: 18 },
                { id: 19 },
                { id: 20 },
                { id: 21 },
                { id: 22 },
                { id: 23 },
                { id: 24 },
                { id: 25 },
                { id: 26 },
                { id: 27 },
                { id: 28 },
                { id: 29 },
                { id: 30 },
                { id: 31 },
            ],
            id_card: null,
            phone: null,
            address: null,
            tenant_select_type: null,
            tennant_name: null,
            stall_select_type: null,

            stall_lists: '',
            get_data: {},
            total: 0.00,
            doc_type: null,
        }
    },
    methods: {

        async dateUpdate() {
            this.loading_page = true;
            this.dialog_edit_date = false;
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }

            let data = {
                "contract_data": {
                    "id": this.base64Decode(this.$route.query.id),
                    "date_start": this.date_start,
                    "date_end": this.date_end,
                },
                "block_list": []
            }

            await contract_block.contract_blockUpdate(data, config).then((result) => {
                if (result.data.success === true) {
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

        },
        async slipUpload() {
            this.dialog_upload_image = false
            this.loading_page = true;

            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }

            const data = new FormData()

            data.append('id', this.base64Decode(this.$route.query.id));

            this.content_picture.forEach((element) => {
                data.append("slip_list[]", element);
            });

            await contract_block.contract_blockUploadSlip(data, config).then(async (result) => {
                if (result.data.success === true) {
                    // this.dialog_complete = false
                    await this.getListContractBlockById()
                    this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                    this.loading_page = false;
                } else {
                    this.loading_page = false;
                    this.alertData('error', 'ทำรายการไม่สำเร็จ', result.data.message);
                }
            })

        },

        async getListContractBlockById() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }

            await contract_block.contract_blockDetail(this.base64Decode(this.$route.query.id), config).then(async (result) => {
                if (result.data.success === true) {
                    this.get_data = result.data.data;

                    this.id_card = this.get_data.personal_id
                    this.phone = this.get_data.tel
                    this.address = this.get_data.address
                    this.tenant_select_type = this.get_data.tennant_member_id
                    this.tennant_name = this.get_data.tennant_name
                    this.doc_type = this.get_data.doc_type
                    // this.stall_select_type = 1
                    this.total = this.get_data.total
                    this.date_start = this.get_data.date_start
                    this.date_end = this.get_data.date_end
                    var existingNames = this.stall_lists;
                    // เพิ่ม
                    this.get_data.block_list.map(v => {
                        if (existingNames.length > 0) {
                            existingNames += ' , ' + v.block_name;
                        } else {
                            existingNames = v.block_name;
                        }
                    })

                    this.stall_lists = existingNames;



                    this.annual_fee = this.get_data.annual_fee
                    this.guarantee_service_rate = this.get_data.insurance_cost
                    this.guarantee_water_rate = this.get_data.guarantee_water_rate
                    this.guarantee_electricity_rate = this.get_data.guarantee_electricity_rate
                    this.guarantee_hood_rate = this.get_data.guarantee_hood_rate
                    this.cost_rental_rate = this.get_data.rent_cost
                    this.cost_common_rate = this.get_data.common_fee

                    this.get_data = result.data.data;


                    this.date_start = this.get_data.date_start
                    this.date_end = this.get_data.date_end


                    this.discount_annual_fee = this.get_data.annual_fee_discount //ส่วนลดค่าธรรมเนียมรายปี
                    this.discount_guarantee_service_rate = this.get_data.insurance_discount //ส่วนลดค่าประกันการเช่าและบริการ
                    this.discount_guarantee_water_rate = this.get_data.guarantee_water_rate_discount //ส่วนลดอัตราค่าประกันมิเตอร์น้ำ
                    this.discount_guarantee_electricity_rate = this.get_data.guarantee_electricity_rate_discount //ส่วนลดอัตราค่าประกันมิเตอร์ไฟ
                    this.discount_guarantee_hood_rate = this.get_data.guarantee_hood_rate_discount //ส่วนลดอัตราค่าประกันเครื่องดูดควัน
                    this.discount_cost_rental_rate = this.get_data.rent_discount //ส่วนลดค่าเช่า
                    this.discount_cost_common_rate = this.get_data.common_fee_discount //ส่วนลดค่าส่วนกลาง

                    this.other_price = this.get_data.other_cost
                    this.other_price_discount = this.get_data.other_discount

                    this.other_net_price = (parseFloat(this.get_data.other_cost) - this.get_data.other_discount);

                    // console.log(this.other_net_price)
                    // ภาษี
                    this.tax_select_type = this.get_data.tax_status
                    this.input_tax = parseFloat(this.get_data.tax_cost);

                    // ภาษีหัก ณ ​ที่จ่าย
                    this.input_withholding_tax = this.get_data.vat_cost

                    // Line
                    this.line_status = this.get_data.line_status

                    if (this.line_status === 1 || this.line_status === true) {
                        this.bill_sending_status = this.get_data.send_type
                        this.bill_sending_name = this.mock_line_no.filter(v => v.id === this.bill_sending_status)[0].name
                        if (this.bill_sending_status === 1) {
                            this.line_day_select_type = this.get_data.date_send
                            this.line_day_name = this.mock_day.filter(v => v.id === this.line_day_select_type)[0].day
                        } else if (this.bill_sending_status === 2) {
                            this.line_mouth_select_type = this.get_data.date_send
                            this.line_mouth_name = this.mock_mouth.filter(v => v.id === this.line_mouth_select_type)[0].mouth
                        } else if (this.bill_sending_status === 3) {
                            this.line_day_yaer_select_type = this.get_data.date_send
                            this.line_mouth_yaer_select_type = this.get_data.month_send
                            this.line_mouth_yaer_name = this.mock_mouth_yaer.filter(v => v.id === this.line_mouth_yaer_select_type)[0].mouthyaer
                        }
                    }


                    this.net_price_guarantee_service_rate = (parseFloat(this.guarantee_service_rate) - this.discount_guarantee_service_rate)
                    this.net_price_guarantee_water_rate = (parseFloat(this.guarantee_water_rate) - this.discount_guarantee_water_rate)
                    this.net_price_guarantee_electricity_rate = (parseFloat(this.guarantee_electricity_rate) - this.discount_guarantee_electricity_rate)
                    this.net_price_guarantee_hood_rate = (parseFloat(this.guarantee_hood_rate) - this.discount_guarantee_hood_rate)
                    this.net_price_cost_rental_rate = (parseFloat(this.cost_rental_rate) - parseFloat(this.discount_cost_rental_rate))
                    this.net_price_cost_common_rate = (parseFloat(this.cost_common_rate) - this.discount_cost_common_rate)
                    this.net_price_annual_fee = (parseFloat(this.annual_fee) - this.discount_annual_fee)

                    await this.cal_total_price_before_tax()

                    // console.log(this.get_data)
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
                this.total_price_after_tax = parseFloat(this.total_price_before_tax)
                this.net_tax = 0.00

            } else if (this.tax_select_type === 0) { // ภาษีรวมใน

                this.input_tax = this.input_tax === 0 ? 7 : parseFloat(this.input_tax) // ค่า input

                // จำนวนเงิน = ค่าธรรมเนียมรายปี (สัญญา 1 ปี), ค่าเช่า, ค่าส่วนกลาง, อื่น ๆ
                let total_price_for_tax = parseFloat(this.net_price_annual_fee) + parseFloat(this.net_price_cost_rental_rate) + parseFloat(this.net_price_cost_common_rate) + parseFloat(this.other_net_price)

                // ราคารวมก่อนภาษี = ( จำนวนเงิน *  (100 / 100 + ภาษี ) )
                this.total_price_before_tax = (parseFloat(total_price_for_tax) * (100 / (100 + parseFloat(this.input_tax))));

                // ภาษี = จำนวนเงิน - ( จำนวนเงิน *  (100 / 100 + ภาษี ) )
                this.net_tax = (total_price_for_tax - (parseFloat(total_price_for_tax) * (100 / (100 + parseFloat(this.input_tax)))));

                // จำนวนเงินทั้งหมดหลังรวมภาษีรวมใน = จำนวนเงินทั้งหมดก่อนรวมภาษี - จำนวนเงิน + จำนวนเงินจากการคำนวณภาษีรวมใน
                this.total_price_after_tax = total_price_for_tax;

            } else if (this.tax_select_type === 1) {// ภาษีรวมนอก

                this.input_tax = this.input_tax === 0 ? 7 : parseFloat(this.input_tax) // ค่า input

                // ค่าธรรมเนียมรายปี (สัญญา 1 ปี), ค่าเช่า, ค่าส่วนกลาง, อื่น ๆ
                let total_price_for_tax = parseFloat(this.net_price_annual_fee) + parseFloat(this.net_price_cost_rental_rate) + parseFloat(this.net_price_cost_common_rate) + parseFloat(this.other_net_price)
                this.total_price_before_tax = total_price_for_tax
                this.net_tax = (parseFloat(total_price_for_tax) * (this.input_tax / 100));
                this.total_price_after_tax = (parseFloat(this.total_price_before_tax) + parseFloat(this.net_tax));
            }

            // ภาษีหัก ณ ​ที่จ่าย  
            this.input_withholding_tax = this.input_withholding_tax === 0 ? 0 : parseFloat(this.input_withholding_tax) // ค่า input
            this.net_withholding_tax = (parseFloat(this.total_price_before_tax) * (parseFloat(this.input_withholding_tax) / 100));
            this.total_withholding_tax = (parseFloat(this.total_price_after_tax) - parseFloat(this.net_withholding_tax));
            this.total_amount = (parseFloat(this.total_price_insurance) + parseFloat(this.total_withholding_tax));
        },

        // คำนวณราคารวมก่อนภาษี
        async cal_total_price_before_tax() {
            this.total_price_before_tax =
                (
                    parseFloat(this.net_price_guarantee_service_rate) +
                    parseFloat(this.net_price_guarantee_water_rate) +
                    parseFloat(this.net_price_guarantee_electricity_rate) +
                    parseFloat(this.net_price_guarantee_hood_rate) +
                    parseFloat(this.net_price_cost_rental_rate) +
                    parseFloat(this.net_price_cost_common_rate) +
                    parseFloat(this.net_price_annual_fee) +
                    parseFloat(this.other_net_price)
                );

            // คำนวณ ราคาค่าประกันรวม
            this.total_price_insurance =
                (
                    parseFloat(this.net_price_guarantee_service_rate) +
                    parseFloat(this.net_price_guarantee_water_rate) +
                    parseFloat(this.net_price_guarantee_electricity_rate) +
                    parseFloat(this.net_price_guarantee_hood_rate)
                );

            this.tax_selectChanged()
        },

        async dialogUploadImage() {
            this.content_picture = []
            this.readers = []

            this.dialog_upload_image = true
        },

        async dialogEditDate() {

            this.content_picture = []
            this.readers = []

            this.dialog_edit_date = true
        },

        onFileChange() {
            // console.log('files', this.content_picture)
            this.content_picture.forEach((file, f) => {
                this.readers[f] = new FileReader();
                this.readers[f].onloadend = (e) => {
                    let fileData = this.readers[f].result
                    let imgRef = this.$refs.file[f]
                    imgRef.src = fileData
                    // console.log(fileData)
                    // send to server here...
                }

                this.readers[f].readAsDataURL(this.content_picture[f]);
            })
        },
    },
    created() {
    },
    async mounted() {
        // this.imagePreviewURL = this.base_url + '/images/image-list-slide.png'
        await this.getListContractBlockById()
    },
}
</script>

<style lang="scss">
.table-plan {
    table {
        width: fit-content !important;
    }

    th {
        background-color: #fff !important;
        border: 0.5px solid #D9D9D9 !important;
        width: 30px !important;
        height: 30px !important;

        &:hover {
            background-color: #d5d5d5 !important;
        }
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

// .pagination_review {
//     .v-icon {
//         color: #707070 !important;
//         font-size: 16px !important;
//         font-weight: 500 !important;
//         font-family: "Kanit", sans-serif !important;
//     }

//     .v-pagination__item {
//         background: #F0F0F0 !important;
//         box-shadow: none !important;
//         color: #707070 !important;
//         font-size: 16px !important;
//         font-weight: 500 !important;
//     }

//     .v-pagination__item--active {
//         background: #86D780 !important;
//         color: #ffffff !important;
//     }

//     .v-pagination__navigation {
//         background: #F0F0F0 !important;
//         box-shadow: none !important;
//         color: #707070 !important;
//         font-size: 16px !important;
//         font-weight: 500 !important;
//     }


// }
</style>
<style scoped lang="scss">
* {
    font-family: 'Kanit', sans-serif !important;
}

// .pagination_review {
//     border-radius: 20px;
//     background: #F0F0F0 !important;
//     padding: 0 20px;
// }

// .review_approval_1 {
//     display: flex;
//     align-items: center;
//     justify-content: center;
//     cursor: pointer;
//     text-wrap: nowrap;
//     width: 112px;
//     height: 38px;
//     border-radius: 20px;
//     border: 1px solid #60A577;
//     padding: 0 15px;

//     color: #60A577;
//     font-size: 14px;
//     font-weight: 500;
// }

// .review_approval_2 {
//     display: flex;
//     align-items: center;
//     justify-content: center;
//     cursor: pointer;
//     text-wrap: nowrap;
//     width: 94px;
//     height: 21px;
//     border-radius: 10px;
//     background: linear-gradient(90deg, #85D680 0%, #62A878 100%);
//     padding: 0 15px;

//     color: #FFF;
//     text-align: center;
//     font-size: 12px;
//     font-weight: 500;
// }

// .review_approval_3 {
//     display: flex;
//     align-items: center;
//     justify-content: center;
//     cursor: pointer;
//     text-wrap: nowrap;
//     width: 94px;
//     height: 21px;
//     border-radius: 10px;
//     background: linear-gradient(90deg, #E10122 0%, #9D0A0F 100%);
//     padding: 0 15px;

//     color: #FFF;
//     text-align: center;
//     font-size: 12px;
//     font-weight: 500;
// }

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

.no-border {
    border-top: 0px solid;
    border-left: 0px solid;
    border-right: 0px solid
}

.no-border-all {
    border: 0px solid;
}

.text-green {
    color: #60A577;
}
</style>
