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
                    <h1 class="font-20 m-0">แก้ใขการเช่าแผง</h1>
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
                                <v-card-title class="p-0 pb-5 justify-space-between text-card-title">
                                    <v-row>
                                        <v-col cols="6">
                                            แก้ใขการเช่าแผง
                                        </v-col>
                                        <v-col cols="6" class=" d-flex align-start justify-end">
                                            <v-btn @click="linkPage(`/managepanelrental/renew?id=${$route.query.id}`)"
                                                outlined class="btn pr-30 font-16 rounded-xl " color="success">
                                                <span> <v-icon>mdi-chevron-left</v-icon> ย้อนกลับ</span>
                                            </v-btn>
                                        </v-col>
                                    </v-row>
                                </v-card-title>
                                <v-form ref="form_panelrental_add" v-on:submit.prevent="savePanelRental()">

                                    <v-card-subtitle class="p-0 mb-6">
                                        <v-row class="">
                                            <v-col cols="12">
                                                <img class="mr-2" :src="base_url + `/images/icon/megaphone 6.png`" alt=""
                                                    width="20" height="20" />
                                                <span
                                                    class="font-16 color-title-card">ระยะเวลาเช่าและการยอดเงินที่ต้องชำระ</span>
                                            </v-col>
                                            <v-col cols="12" lg="6" md="6">
                                                <p class="font-14 text-ex fs-16 fw-500">วันที่เริ่มต้นสัญญา
                                                    <span style="color: red;">*</span>
                                                </p>

                                                <v-menu v-model="menu2" :close-on-content-click="false" :nudge-right="40"
                                                    transition="scale-transition" offset-y min-width="auto">
                                                    <template v-slot:activator="{ on, attrs }">
                                                        <v-text-field v-model="date_start"
                                                            label="กรุณาเลือกวันที่เริ่มต้นสัญญา" outlined dense single-line
                                                            :rules="rules.date_start" required v-bind="attrs" v-on="on"
                                                            hide-details=""></v-text-field>
                                                    </template>
                                                    <v-date-picker v-model="date_start"
                                                        @input="menu2 = false"></v-date-picker>
                                                </v-menu>
                                            </v-col>
                                            <v-col cols="6" lg="6" md="6">
                                                <p class="font-14 text-ex fs-16 fw-500">วันที่สิ้นสุดสัญญา </p>
                                                <v-menu v-model="menu2end" :close-on-content-click="false" :nudge-right="40"
                                                    transition="scale-transition" offset-y min-width="auto">
                                                    <template v-slot:activator="{ on, attrs }">
                                                        <v-text-field v-model="date_end"
                                                            label="กรุณาเลือกวันที่สิ้นสุดสัญญา" outlined dense single-line
                                                            :rules="rules.date_end" required v-bind="attrs" v-on="on"
                                                            hide-details=""></v-text-field>
                                                    </template>
                                                    <v-date-picker v-model="date_end"
                                                        @input="menu2end = false"></v-date-picker>
                                                </v-menu>
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
                                                            <!-- ค่าธรรมเนียมรายปี (สัญญา 1 ปี) -->
                                                            <tr>
                                                                <td style="width: 550px;">ค่าธรรมเนียมรายปี (สัญญา 1 ปี)
                                                                </td>
                                                                <td style="width: 250px; text-align: center;">
                                                                    {{ formatPrice(annual_fee) }}
                                                                </td>
                                                                <td style="width: 250px; text-align: center;">
                                                                    <v-text-field hide-details="auto"
                                                                        placeholder="กรุณากรอกส่วนลด" class="my-3 mt-5"
                                                                        v-model="discount_annual_fee" outlined dense
                                                                        single-line
                                                                        @keypress="isDecimalInput($event, discount_annual_fee)"
                                                                        v-on:keyup="() => {
                                                                            net_price_annual_fee = (annual_fee - discount_annual_fee).toFixed(2)
                                                                            cal_total_price_before_tax();
                                                                        }" required></v-text-field>
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
                                                                <th colspan="4" class="text-left font-16">
                                                                    เงินประกันต่าง ๆ
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 550px;">ค่าประกันการเช่าและบริการ</td>
                                                                <td style="width: 250px;text-align: center;">
                                                                    {{ formatPrice(guarantee_service_rate) }}
                                                                </td>
                                                                <td style="width: 250px;text-align: center;">
                                                                    <v-text-field hide-details="auto"
                                                                        placeholder="กรุณากรอกส่วนลด" class="my-3 mt-5"
                                                                        v-model="discount_guarantee_service_rate" outlined
                                                                        dense
                                                                        @keypress="isDecimalInput($event, discount_guarantee_service_rate)"
                                                                        single-line v-on:keyup="() => {
                                                                            net_price_guarantee_service_rate = (guarantee_service_rate - discount_guarantee_service_rate).toFixed(2)
                                                                            cal_total_price_before_tax();
                                                                        }" required></v-text-field>
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
                                                                    <v-text-field hide-details="auto"
                                                                        placeholder="กรุณากรอกส่วนลด" class="my-3 mt-5"
                                                                        v-model="discount_guarantee_water_rate" outlined
                                                                        dense
                                                                        @keypress="isDecimalInput($event, discount_guarantee_water_rate)"
                                                                        single-line v-on:keyup="() => {
                                                                            net_price_guarantee_water_rate = (guarantee_water_rate - discount_guarantee_water_rate).toFixed(2)
                                                                            cal_total_price_before_tax();
                                                                        }" required></v-text-field>
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
                                                                    <v-text-field hide-details="auto"
                                                                        placeholder="กรุณากรอกส่วนลด" class="my-3 mt-5"
                                                                        v-model="discount_guarantee_electricity_rate"
                                                                        outlined
                                                                        @keypress="isDecimalInput($event, discount_guarantee_electricity_rate)"
                                                                        dense single-line v-on:keyup="() => {
                                                                            net_price_guarantee_electricity_rate = (guarantee_electricity_rate - discount_guarantee_electricity_rate).toFixed(2)
                                                                            cal_total_price_before_tax();
                                                                        }" required></v-text-field>
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
                                                                    <v-text-field hide-details="auto"
                                                                        placeholder="กรุณากรอกส่วนลด" class="my-3 mt-5"
                                                                        v-model="discount_guarantee_hood_rate" outlined
                                                                        dense
                                                                        @keypress="isDecimalInput($event, discount_guarantee_hood_rate)"
                                                                        single-line v-on:keyup="() => {
                                                                            net_price_guarantee_hood_rate = (guarantee_hood_rate - discount_guarantee_hood_rate).toFixed(2)
                                                                            cal_total_price_before_tax();
                                                                        }" required></v-text-field>
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

                                                            <!-- ค่าเช่า -->
                                                            <tr>
                                                                <td style="width: 550px;">ค่าเช่า</td>
                                                                <td style="width: 250px; text-align: center;">
                                                                    {{ formatPrice(cost_rental_rate) }}
                                                                </td>
                                                                <td style="width: 250px; text-align: center;">
                                                                    <v-text-field hide-details="auto"
                                                                        placeholder="กรุณากรอกส่วนลด" class="my-3 mt-5"
                                                                        v-model="discount_cost_rental_rate" outlined dense
                                                                        @keypress="isDecimalInput($event, discount_cost_rental_rate)"
                                                                        single-line v-on:keyup="() => {
                                                                            net_price_cost_rental_rate = (cost_rental_rate - discount_cost_rental_rate).toFixed(2)
                                                                            cal_total_price_before_tax();
                                                                        }" required></v-text-field>
                                                                </td>
                                                                <td style="width: 250px; text-align: center;">
                                                                    {{ formatPrice(net_price_cost_rental_rate) }}
                                                                </td>
                                                            </tr>
                                                            <!-- ค่าส่วนกลาง -->
                                                            <tr>
                                                                <td style="width: 550px;">ค่าส่วนกลาง</td>
                                                                <td style="width: 250px; text-align: center;">
                                                                    {{ formatPrice(cost_common_rate) }}
                                                                </td>
                                                                <td style="width: 250px; text-align: center;">
                                                                    <v-text-field hide-details="auto"
                                                                        placeholder="กรุณากรอกส่วนลด" class="my-3 mt-5"
                                                                        v-model="discount_cost_common_rate" outlined dense
                                                                        @keypress="isDecimalInput($event, discount_cost_common_rate)"
                                                                        single-line v-on:keyup="() => {
                                                                            net_price_cost_common_rate = (cost_common_rate - discount_cost_common_rate).toFixed(2)
                                                                            cal_total_price_before_tax();
                                                                        }" required></v-text-field>
                                                                </td>
                                                                <td style="width: 250px; text-align: center;">
                                                                    {{ formatPrice(net_price_cost_common_rate) }}
                                                                </td>
                                                            </tr>

                                                            <!-- อื่น ๆ -->
                                                            <tr>
                                                                <td style="width: 550px;">อื่น ๆ</td>
                                                                <td style="width: 250px; text-align: center;">
                                                                    <v-text-field hide-details="auto"
                                                                        placeholder="กรุณากรอกราคา" class="my-3 mt-5"
                                                                        v-model="other_price" outlined dense single-line
                                                                        @keypress="isDecimalInput($event, other_price)"
                                                                        v-on:keyup="() => {
                                                                            other_net_price = (other_price - other_price_discount).toFixed(2)
                                                                            cal_total_price_before_tax();
                                                                        }" required></v-text-field>
                                                                </td>
                                                                <td style="width: 250px; text-align: center;">
                                                                    <v-text-field hide-details="auto"
                                                                        placeholder="กรุณากรอกส่วนลด" class="my-3 mt-5"
                                                                        v-model="other_price_discount" outlined dense
                                                                        @keypress="isDecimalInput($event, other_price_discount)"
                                                                        single-line v-on:keyup="() => {
                                                                            other_net_price = (other_price - other_price_discount).toFixed(2);
                                                                            cal_total_price_before_tax();
                                                                        }" required></v-text-field>
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

                                            <!-- ภาษี -->
                                            <v-col cols="12" lg="7" md="9" sm="10">
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
                                                            <v-select class="custom-v-select" v-model="tax_select_type"
                                                                hide-details="auto" item-value="id" item-text='name'
                                                                :items="tax_type" outlined dense style="width:150px"
                                                                @change="tax_selectChanged" single-line
                                                                label="กรุณาเลือกภาษี"></v-select>
                                                            <p class="mb-0 font-16"> &nbsp; % &nbsp; </p>
                                                            <v-text-field hide-details="auto" placeholder="0" class=""
                                                                style="width:50px" v-model="input_tax" outlined dense
                                                                :disabled="tax_select_type === 2"
                                                                @keypress="isDecimalInput($event, input_tax)"
                                                                @input="tax_selectChanged" single-line
                                                                required></v-text-field>
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
                                                                style="width:50px;max-width: 50px;"
                                                                v-model="input_withholding_tax" outlined dense single-line
                                                                @keypress="isDecimalInput($event, input_withholding_tax)"
                                                                @input="tax_selectChanged" required></v-text-field>
                                                            <p class="mb-0 font-16"> &nbsp; % &nbsp; </p>
                                                        </v-col>
                                                        <v-col cols="4"
                                                            class="text-center d-flex align-center justify-center">
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

                                                    <v-row>
                                                        <v-col cols="3" class="d-flex align-center">
                                                            <p class="mb-0 text-green font-16"> ราคาค่าประกันรวม </p>
                                                        </v-col>
                                                        <v-col cols="5" class="d-flex align-center">

                                                        </v-col>
                                                        <v-col cols="4"
                                                            class="text-center d-flex align-center justify-center">
                                                            <p class="mb-0 font-16">{{ formatPrice(total_price_insurance) }}</p>
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

                                        <!-- Line -->
                                        <!-- <v-row>
                                            <v-col cols="12">
                                                <img class="mr-2" :src="base_url + `/images/icon/megaphone 6.png`" alt=""
                                                    width="20" height="20" />
                                                <span
                                                    class="font-16 color-title-card">รูปแบบแจ้งเตือนการส่งบิลเรียกเก็บค่าเช่าผ่านทาง
                                                    Line Official</span>
                                            </v-col>
                                            <v-col cols="4">
                                                <p class="font-14 text-ex fs-16 fw-500">การส่งข้อมูลอัตโนมัติ
                                                    <span style="color: red;">*</span>
                                                </p>
                                                <v-switch v-model="line_status" hide-details="" label="ส่งอัตโนมัติ" inset
                                                    color="#86D870"></v-switch>
                                            </v-col>
                                        </v-row> -->

                                        <!-- line data -->
                                        <!-- <v-row class="" v-if="line_status === 1 || line_status === true">
                                            <v-col cols="12" lg="6" md="6">
                                                <p class="font-14 text-ex fs-16 fw-500">รอบการส่งบิลเรียกเก็บ
                                                    <span style="color: red;">*</span>
                                                </p>
                                                <v-select class="custom-v-select" v-model="bill_sending_status"
                                                    hide-details="auto" item-value="id" item-text='name'
                                                    :items="mock_line_no" outlined dense single-line
                                                    label="กรุณาเลือก"></v-select>
                                            </v-col>
                                            <v-col cols="" v-if="bill_sending_status == 1">
                                                <p class="font-14 text-ex fs-16 fw-500">
                                                    วันที่ต้องการส่งบิลเรียกเก็บรายสัปดาห์
                                                    <span style="color: red;">*</span>
                                                </p>
                                                <v-select class="custom-v-select" v-model="line_day_select_type"
                                                    hide-details="auto" item-value="id" item-text='day' :items="mock_day"
                                                    outlined dense single-line label="กรุณาเลือก"></v-select>
                                            </v-col>

                                            <v-col cols="" v-if="bill_sending_status == 2">
                                                <p class="font-14 text-ex fs-16 fw-500">วันที่ต้องการส่งบิลเรียกเก็บรายเดือน
                                                    <span style="color: red;">*</span>
                                                </p>
                                                <v-select class="custom-v-select" v-model="line_mouth_select_type"
                                                    hide-details="auto" item-value="id" item-text='mouth'
                                                    :items="mock_mouth" outlined dense single-line
                                                    label="กรุณาเลือก"></v-select>
                                            </v-col>
                                            <v-col cols="" v-if="bill_sending_status == 3">
                                                <p class="font-14 text-ex fs-16 fw-500">วันที่ต้องการส่งบิลเรียกเก็บรายปี
                                                    <span style="color: red;">*</span>
                                                </p>
                                                <v-select class="custom-v-select" v-model="line_day_yaer_select_type"
                                                    hide-details="auto" item-value="id" item-text='id'
                                                    :items="mock_day_yaer" outlined dense single-line
                                                    label="วันที่"></v-select>
                                            </v-col>
                                            <v-col cols="" v-if="bill_sending_status == 3">
                                                <p class="font-14 text-ex fs-16 fw-500">วันที่ต้องการส่งบิลเรียกเก็บรายปี
                                                    <span style="color: red;">*</span>
                                                </p>
                                                <v-select class="custom-v-select" v-model="line_mouth_yaer_select_type"
                                                    hide-details="auto" item-value="id" item-text='mouthyaer'
                                                    :items="mock_mouth_yaer" outlined dense single-line
                                                    label="เดือน"></v-select>
                                            </v-col>
                                        </v-row> -->
                                    </v-card-subtitle>
                                    <v-card-text>

                                        <v-row class="text-center">
                                            <v-col cols="12">
                                                <v-btn type="submit" class="btn-success pl-30 pr-30 mt-10" dark>
                                                    <v-icon class="fs-20" left dark>
                                                        mdi-content-save
                                                    </v-icon>
                                                    <span>บันทึกข้อมูล</span>
                                                </v-btn>
                                            </v-col>
                                        </v-row>
                                    </v-card-text>
                                </v-form>

                            </v-col>
                        </v-row>
                    </v-card>
                </v-col>
            </v-row>
        </div>
    </div>
</template>

<script>
import contract_block from '../../../api/contract_block.js';
export default {
    data() {
        return {
            loading_page: false,
            alert_success: false,
            alert_message_success: '',
            alert_error: false,
            alert_message_error: '',
            dialog_block_add_or_edit: false,
            building_add_or_edit: false,
            prefix_select_type: 0,
            submenu: [
                {
                    text: 'ทำสัญญาเช่าแผง',
                    disabled: true,
                },
                {
                    text: 'สร้างการเช่าแผงใหม่',
                    disabled: true,
                },
            ],
            site_id: null,
            buildingData: [],
            stallData: [],
            blockData: [],
            siteData: {},
            select_block_list: null,
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

            // Date
            date_start: null,
            date_end: null,
            menu2: false,
            menu2end: false,

            tennant_member_id: null,
            tennant_name: null,
            personal_id: null,
            tel: null,
            address: null,

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

            desserts: [],

            desserts_other: [],

            rules: {
                date_start: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                date_end: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
            },
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
            mock_line_no: [
                { id: 0, name: 'รายวัน' },
                { id: 1, name: 'รายสัปดาห์' },
                { id: 2, name: 'รายเดือน' },
                { id: 3, name: 'รายปี' },
            ],
            line_day_select_type: 0,
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
            mock_mouth: [
                { id: 0, mouth: 'ทุกวันสุดท้ายของเดือน' },
                { id: 15, mouth: 'ทุกวันที่ 15 ของเดือน' },
                { id: 20, mouth: 'ทุกวันที่ 20 ของเดือน' },
                { id: 25, mouth: 'ทุกวันที่ 25 ของเดือน' },
            ],
            line_mouth_yaer_select_type: 1,
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
        }
    },
    methods: {
        async getListContractBlockById() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }

            await contract_block.contract_blockDetail(this.base64Decode(this.$route.query.id), config).then((result) => {
                if (result.data.success === true) {
                    this.get_data = result.data.data;


                    this.date_start = this.get_data.date_start
                    this.date_end = this.get_data.date_end

                    this.annual_fee = this.get_data.annual_fee

                    this.discount_annual_fee = parseFloat(this.get_data.annual_fee_discount) === 0 ? null : parseFloat(this.get_data.annual_fee_discount) //ส่วนลดค่าธรรมเนียมรายปี
                    this.discount_guarantee_service_rate = parseFloat(this.get_data.insurance_discount) === 0 ? null : parseFloat(this.get_data.insurance_discount) //ส่วนลดค่าประกันการเช่าและบริการ
                    this.discount_guarantee_water_rate = parseFloat(this.get_data.guarantee_water_rate_discount) === 0 ? null : parseFloat(this.get_data.guarantee_water_rate_discount) //ส่วนลดอัตราค่าประกันมิเตอร์น้ำ
                    this.discount_guarantee_electricity_rate = parseFloat(this.get_data.guarantee_electricity_rate_discount) === 0 ? null : parseFloat(this.get_data.guarantee_electricity_rate_discount) //ส่วนลดอัตราค่าประกันมิเตอร์ไฟ
                    this.discount_guarantee_hood_rate = parseFloat(this.get_data.guarantee_hood_rate_discount) === 0 ? null : parseFloat(this.get_data.guarantee_hood_rate_discount) //ส่วนลดอัตราค่าประกันเครื่องดูดควัน
                    this.discount_cost_rental_rate = parseFloat(this.get_data.rent_discount) === 0 ? null : parseFloat(this.get_data.rent_discount) //ส่วนลดค่าเช่า
                    this.discount_cost_common_rate = parseFloat(this.get_data.common_fee_discount) === 0 ? null : parseFloat(this.get_data.common_fee_discount) //ส่วนลดค่าส่วนกลาง

                    this.other_price = parseFloat(this.get_data.other_cost) === 0 ? null : parseFloat(this.get_data.other_cost)
                    this.other_price_discount = parseFloat(this.get_data.other_discount) === 0 ? null : parseFloat(this.get_data.other_discount)

                    this.other_net_price = (parseFloat(this.get_data.other_cost) - this.get_data.other_discount).toFixed(2);

                    // ภาษี
                    this.tax_select_type = this.get_data.tax_status
                    this.input_tax = this.get_data.tax_cost

                    // ภาษีหัก ณ ​ที่จ่าย
                    this.input_withholding_tax = this.get_data.vat_cost

                    // Line
                    this.line_status = this.get_data.line_status

                    if (this.line_status === 1 || this.line_status === true) {
                        this.bill_sending_status = this.get_data.send_type

                        if (this.bill_sending_status === 1) {
                            this.line_day_select_type = this.get_data.date_send
                        } else if (this.bill_sending_status === 2) {
                            this.line_mouth_select_type = this.get_data.date_send
                        } else if (this.bill_sending_status === 3) {
                            this.line_day_yaer_select_type = this.get_data.date_send
                            this.line_mouth_yaer_select_type = this.get_data.month_send
                        }
                    }

                }
            }).catch((error) => {
                if (error.response.status === 401) {
                    this.loading_page = false
                    this.$store.commit('logOutSuccess')
                    this.$router.push('/login')
                }
            })


        },

        // async savePanelRental() {
        //     if (this.$refs.form_panelrental_add.validate()) {

        //         this.loading_page = true;
        //         let config = {
        //             headers: {
        //                 Authorization: `Bearer ${this.$store.state.access_token}`,
        //             },
        //         }
        //         // console.log(this.line_status === 1 || this.line_status === true)
        //         // console.log(this.bill_sending_status)
        //         let data = {
        //             "contract_data": {
        //                 "id": this.get_data.id,
        //                 "old_contract_id": 0,
        //                 "tennant_member_id": this.tennant_member_id,
        //                 "tennant_name": this.tennant_name,
        //                 "personal_id": this.personal_id,
        //                 "tel": this.tel,
        //                 "address": this.address,
        //                 "date_start": this.date_start,
        //                 "date_end": this.date_end,
        //                 "annual_fee": this.annual_fee === null || this.annual_fee === "" ? 0 : this.annual_fee,
        //                 "annual_fee_discount": this.discount_annual_fee === null || this.discount_annual_fee === "" ? 0 : this.discount_annual_fee,
        //                 "insurance_cost": this.guarantee_service_rate === null || this.guarantee_service_rate === "" ? 0 : this.guarantee_service_rate,
        //                 "insurance_discount": this.discount_guarantee_service_rate === null || this.discount_guarantee_service_rate === "" ? 0 : this.discount_guarantee_service_rate,
        //                 "guarantee_water_rate": this.guarantee_water_rate === null || this.guarantee_water_rate === "" ? 0 : this.guarantee_water_rate,
        //                 "guarantee_water_rate_discount": this.discount_guarantee_water_rate === null || this.discount_guarantee_water_rate === "" ? 0 : this.discount_guarantee_water_rate,
        //                 "guarantee_electricity_rate": this.guarantee_electricity_rate === null || this.guarantee_electricity_rate === "" ? 0 : this.guarantee_electricity_rate,
        //                 "guarantee_electricity_rate_discount": this.discount_guarantee_electricity_rate === null || this.discount_guarantee_electricity_rate === "" ? 0 : this.discount_guarantee_electricity_rate,
        //                 "guarantee_hood_rate": this.guarantee_hood_rate === null || this.guarantee_hood_rate === "" ? 0 : this.guarantee_hood_rate,
        //                 "guarantee_hood_rate_discount": this.discount_guarantee_hood_rate === null || this.discount_guarantee_hood_rate === "" ? 0 : this.discount_guarantee_hood_rate,
        //                 "rent_cost": this.cost_rental_rate === null || this.cost_rental_rate === "" ? 0 : this.cost_rental_rate,
        //                 "rent_discount": this.discount_cost_rental_rate === null || this.discount_cost_rental_rate === "" ? 0 : this.discount_cost_rental_rate,
        //                 "common_fee": this.cost_common_rate === null || this.cost_common_rate === "" ? 0 : this.cost_common_rate,
        //                 "common_fee_discount": this.discount_cost_common_rate === null || this.discount_cost_common_rate === "" ? 0 : this.discount_cost_common_rate,
        //                 "other_cost": this.other_price === null || this.other_price === "" ? 0 : this.other_price,
        //                 "other_discount": this.other_price_discount === null || this.other_price_discount === "" ? 0 : this.other_price_discount,
        //                 "tax_status": this.tax_select_type,
        //                 "tax_cost": this.input_tax,
        //                 "vat_cost": this.input_withholding_tax,
        //                 "total": this.total_amount,
        //                 "line_status": this.line_status,

        //                 "send_type": this.line_status === 1 || this.line_status === true ? this.bill_sending_status : 0,
        //                 "date_send":
        //                     this.line_status === 1 || this.line_status === true
        //                         ?
        //                         this.bill_sending_status === 1 ? this.line_day_select_type :
        //                             this.bill_sending_status === 2 ? this.line_mouth_select_type :
        //                                 this.bill_sending_status === 3 ? this.line_day_yaer_select_type : null
        //                         : null,

        //                 "month_send": this.line_status === 1 || this.line_status === true && this.bill_sending_status === 3 ? this.line_mouth_yaer_select_type : null
        //             },
        //             "block_list": JSON.parse(this.select_block_list)
        //         }

        //         await contract_block.contract_blockUpdate(data, config).then((result) => {
        //             if (result.data.success === true) {
        //                 this.loading_page = false;
        //                 window.localStorage.removeItem('managepanelrental_edit');
        //                 window.localStorage.removeItem('managepanelrental_edit_select_block_list');
        //                 this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
        //                 this.$router.push('/managepanelrental');
        //             }
        //         }).catch((error) => {
        //             if (error.response.status === 401) {
        //                 this.loading_page = false;
        //                 this.$store.commit('logOutSuccess');
        //                 this.$router.push('/login');
        //             }
        //         })

        //     }

        // },
        async savePanelRental() {
            if (this.$refs.form_panelrental_add.validate()) {

                this.loading_page = true;
                let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.access_token}`,
                    },
                }
                const newData = JSON.parse(this.select_block_list).map(item => {
                    return {
                        ...item,
                        id: null
                    };
                });
                let data = {
                    "contract_data": {
                        "old_contract_id": this.base64Decode(this.$route.query.id),
                        "tennant_member_id": this.tennant_member_id,
                        "tennant_name": this.tennant_name,
                        "personal_id": this.personal_id,
                        "tel": this.tel,
                        "address": this.address,
                        "date_start": this.date_start,
                        "date_end": this.date_end,
                        "annual_fee": this.annual_fee === null ? 0 : this.annual_fee,
                        "annual_fee_discount": this.discount_annual_fee === null ? 0 : this.discount_annual_fee,
                        "insurance_cost": this.guarantee_service_rate === null ? 0 : this.guarantee_service_rate,
                        "insurance_discount": this.discount_guarantee_service_rate === null ? 0 : this.discount_guarantee_service_rate,
                        "guarantee_water_rate": this.guarantee_water_rate === null ? 0 : this.guarantee_water_rate,
                        "guarantee_water_rate_discount": this.discount_guarantee_water_rate === null ? 0 : this.discount_guarantee_water_rate,
                        "guarantee_electricity_rate": this.guarantee_electricity_rate === null ? 0 : this.guarantee_electricity_rate,
                        "guarantee_electricity_rate_discount": this.discount_guarantee_electricity_rate === null ? 0 : this.discount_guarantee_electricity_rate,
                        "guarantee_hood_rate": this.guarantee_hood_rate === null ? 0 : this.guarantee_hood_rate,
                        "guarantee_hood_rate_discount": this.discount_guarantee_hood_rate === null ? 0 : this.discount_guarantee_hood_rate,
                        "rent_cost": this.cost_rental_rate === null ? 0 : this.cost_rental_rate,
                        "rent_discount": this.discount_cost_rental_rate === null ? 0 : this.discount_cost_rental_rate,
                        "common_fee": this.cost_common_rate === null ? 0 : this.cost_common_rate,
                        "common_fee_discount": this.discount_cost_common_rate === null ? 0 : this.discount_cost_common_rate,
                        "other_cost": this.other_price === null ? 0 : this.other_price,
                        "other_discount": this.other_price_discount === null ? 0 : this.other_price_discount,
                        "tax_status": this.tax_select_type,
                        "tax_cost": this.input_tax,
                        "vat_cost": this.input_withholding_tax,
                        "total": this.total_amount,
                        "line_status": this.line_status,

                        "status": 0,



                        "send_type": this.line_status === 1 || this.line_status === true ? this.bill_sending_status : 0,
                        "date_send":
                            this.line_status === 1 || this.line_status === true
                                ?
                                this.bill_sending_status === 1 ? this.line_day_select_type :
                                    this.bill_sending_status === 2
                                        ? this.line_mouth_select_type :
                                        this.bill_sending_status === 3 ?
                                            this.line_day_yaer_select_type : null
                                : null,

                        "month_send": this.line_status === 1 || this.line_status === true && this.bill_sending_status === 3 ? this.line_mouth_yaer_select_type : null
                    },
                    "block_list": newData
                }

                await contract_block.contract_blockAdd(data, config).then((result) => {
                    if (result.data.success === true) {
                        this.loading_page = false;
                        window.localStorage.removeItem('managepanelrental_renew');
                        window.localStorage.removeItem('managepanelrental_renew_select_block_list');
                        this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                        this.$router.push('/managepanelrental');
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

        // คำนวณภาษี
        async tax_selectChanged() {
            if (this.tax_select_type === 2) { // ไม่คิดภาษี

                this.input_tax = 0
                this.total_price_after_tax = parseFloat(this.total_price_before_tax)
                this.net_tax = 0.00

            } else if (this.tax_select_type === 0) { // ภาษีรวมใน

                this.input_tax = this.input_tax === 0 || this.input_tax === '' ? 7 : parseFloat(this.input_tax) // ค่า input

                // จำนวนเงิน = ค่าธรรมเนียมรายปี (สัญญา 1 ปี), ค่าเช่า, ค่าส่วนกลาง, อื่น ๆ
                let total_price_for_tax = parseFloat(this.net_price_annual_fee) + parseFloat(this.net_price_cost_rental_rate) + parseFloat(this.net_price_cost_common_rate) + parseFloat(this.other_net_price)

                // ราคารวมก่อนภาษี = ( จำนวนเงิน *  (100 / 100 + ภาษี ) )
                this.total_price_before_tax = (parseFloat(total_price_for_tax) * (100 / (100 + parseFloat(this.input_tax)))).toFixed(2);

                // ภาษี = จำนวนเงิน - ( จำนวนเงิน *  (100 / 100 + ภาษี ) )
                this.net_tax = (total_price_for_tax - (parseFloat(total_price_for_tax) * (100 / (100 + parseFloat(this.input_tax))))).toFixed(2);

                // จำนวนเงินทั้งหมดหลังรวมภาษีรวมใน = จำนวนเงินทั้งหมดก่อนรวมภาษี - จำนวนเงิน + จำนวนเงินจากการคำนวณภาษีรวมใน
                this.total_price_after_tax = total_price_for_tax.toFixed(2);

            } else if (this.tax_select_type === 1) {// ภาษีรวมนอก

                this.input_tax = this.input_tax === 0 || this.input_tax === '' ? 7 : parseFloat(this.input_tax) // ค่า input

                // ค่าธรรมเนียมรายปี (สัญญา 1 ปี), ค่าเช่า, ค่าส่วนกลาง, อื่น ๆ
                let total_price_for_tax = parseFloat(this.net_price_annual_fee) + parseFloat(this.net_price_cost_rental_rate) + parseFloat(this.net_price_cost_common_rate) + parseFloat(this.other_net_price)
                this.total_price_before_tax = total_price_for_tax
                this.net_tax = (parseFloat(total_price_for_tax) * (this.input_tax / 100)).toFixed(2);
                this.total_price_after_tax = (parseFloat(this.total_price_before_tax) + parseFloat(this.net_tax)).toFixed(2);
            }

            // ภาษีหัก ณ ​ที่จ่าย  
            this.input_withholding_tax = this.input_withholding_tax === 0 || this.input_withholding_tax === '' ? 0 : parseFloat(this.input_withholding_tax) // ค่า input
            this.net_withholding_tax = (parseFloat(this.total_price_before_tax) * (parseFloat(this.input_withholding_tax) / 100)).toFixed(2);
            this.total_withholding_tax = (parseFloat(this.total_price_after_tax) - parseFloat(this.net_withholding_tax)).toFixed(2);
            this.total_amount = (parseFloat(this.total_price_insurance) + parseFloat(this.total_withholding_tax)).toFixed(2);
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
                ).toFixed(2);

            // คำนวณ ราคาค่าประกันรวม
            this.total_price_insurance =
                (
                    parseFloat(this.net_price_guarantee_service_rate) +
                    parseFloat(this.net_price_guarantee_water_rate) +
                    parseFloat(this.net_price_guarantee_electricity_rate) +
                    parseFloat(this.net_price_guarantee_hood_rate)
                ).toFixed(2);

            this.tax_selectChanged()
        }
    },
    created() {
    },
    async mounted() {
        await this.getListContractBlockById() // ข้อมูลทั้งหมด
        // this.imagePreviewURL = this.base_url + '/images/image-list-slide.png'
        let managepanelrental_renew = window.localStorage.getItem("managepanelrental_renew");
        this.select_block_list = window.localStorage.getItem("managepanelrental_renew_select_block_list");
        if (managepanelrental_renew) {
            const data = JSON.parse(managepanelrental_renew)
            this.personal_id = data.id_card
            this.tel = data.phone
            this.address = data.address
            this.tennant_member_id = data.tenant_select_type
            this.tennant_name = data.tennant_name

            this.annual_fee = parseFloat(data.annual_fee).toFixed(2)
            this.guarantee_service_rate = parseFloat(data.guarantee_service_rate).toFixed(2)
            this.guarantee_water_rate = parseFloat(data.guarantee_water_rate).toFixed(2)
            this.guarantee_electricity_rate = parseFloat(data.guarantee_electricity_rate).toFixed(2)
            this.guarantee_hood_rate = parseFloat(data.guarantee_hood_rate).toFixed(2)
            this.cost_rental_rate = parseFloat(data.cost_rental_rate).toFixed(2)
            this.cost_common_rate = parseFloat(data.cost_common_rate).toFixed(2)

            this.net_price_guarantee_service_rate = (parseFloat(data.guarantee_service_rate) - this.discount_guarantee_service_rate).toFixed(2)
            this.net_price_guarantee_water_rate = (parseFloat(data.guarantee_water_rate) - this.discount_guarantee_water_rate).toFixed(2)
            this.net_price_guarantee_electricity_rate = (parseFloat(data.guarantee_electricity_rate) - this.discount_guarantee_electricity_rate).toFixed(2)
            this.net_price_guarantee_hood_rate = (parseFloat(data.guarantee_hood_rate) - this.discount_guarantee_hood_rate).toFixed(2)
            this.net_price_cost_rental_rate = (parseFloat(data.cost_rental_rate) - this.discount_cost_rental_rate).toFixed(2)
            this.net_price_cost_common_rate = (parseFloat(data.cost_common_rate) - this.discount_cost_common_rate).toFixed(2)
            this.net_price_annual_fee = (parseFloat(data.annual_fee) - this.discount_annual_fee).toFixed(2)

            this.cal_total_price_before_tax()
        }

        // this.loopList()
    },
}
</script>

<style lang="scss">
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
