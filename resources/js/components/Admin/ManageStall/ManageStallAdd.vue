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
                    <h1 class="font-20 m-0">เพิ่มข้อมูลแผงค้า</h1>
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
                <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                    <v-card elevation="2">
                        <v-row class="m-0 p-4">
                            <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                                <v-card-title class="p-0 justify-space-between text-card-title">
                                    ข้อมูลแผงค้า
                                </v-card-title>

                                <v-card-text class="p-0 mt-2">
                                    <div class="d-flex align-center">
                                        <img class="mr-2" :src="base_url + `/images/icon/store.png`" alt="Contact"
                                            width="20" height="20" />
                                        <span class="font-16 color-title-card">แผงค้าและค่าธรรมเนียมรายปี</span>
                                    </div>
                                    <v-form ref="form_stall_add" v-on:submit.prevent="stallAdd()">

                                        <div class="mt-3">
                                            <v-row class="container-input-contact">
                                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                    <div class="container-image-upload">
                                                        <div class="slide-image-upload">
                                                            <img class="mt-4 max-h-250 h-100" v-if="imagePreviewURL"
                                                                :src="imagePreviewURL" alt="image list slide" width="100%"
                                                                height="auto" style="max-width: 250px;" />
                                                        </div>
                                                    </div>
                                                    <v-card-text class="p-0 mt-8">
                                                        <div class="d-flex align-center">
                                                            <img class="mr-2" :src="base_url + `/images/icon/picture.png`"
                                                                alt="" width="20" height="20" />

                                                            <span
                                                                class="font-16 color-title-card fs-16 fw-500">รูปภาพขนาดแผงค้า
                                                                <span style="color: red;">*</span></span>
                                                        </div>
                                                        <div>
                                                            <p class="font-14 mt-3 text-ex">คำแนะนำ : ขนาดรูปภาพแนะนำ
                                                                500x500
                                                                หรือรูปสี่เหลี่ยมจัตุรัส ขนาดไฟล์ไม่เกิน 2 gb สกุลไฟล์ jpg
                                                                png
                                                                jpeg เท่านั้น</p>
                                                            <v-file-input class="w-100" outlined dense id="uploader"
                                                                accept="image/*" v-model="content_picture"
                                                                :rules="[v => !!v || 'กรุณาเลือกรูปภาพ']"
                                                                @change="onFileChange" single-line clearable clear-icon=""
                                                                label="กรุณาเลือกไฟล์รูปภาพ" required></v-file-input>
                                                        </div>
                                                    </v-card-text>
                                                </v-col>

                                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                    <p class="font-14 text-ex fs-16 fw-500">ชื่อขนาดแผงค้า <span
                                                            style="color: red;">*</span>
                                                    </p>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกชื่อขนาดแผงค้า" v-model="stall_name"
                                                        :rules="rules.stall_name" outlined dense single-line
                                                        required></v-text-field>
                                                    <p class="font-14 text-ex fs-16 fw-500">ประเภทแผงค้า <span
                                                            style="color: red;">*</span>
                                                    </p>
                                                    <!-- <v-text-field hide-details="auto" label="กรุณากรอกประเภทแผงค้า" v-model="stall_type"
                                                    :rules="rules.stall_type" outlined dense single-line
                                                    required></v-text-field> -->
                                                    <v-select class="custom-v-select" v-model="stall_select_type"
                                                        item-value="id" item-text='name' :items="stall_type" outlined dense
                                                        single-line label="กรุณาเลือกประเภทแผงค้า"></v-select>

                                                    <p class="font-14 text-ex fs-16 fw-500">ขนาดแผงค้า <span
                                                            style="color: red;">*</span>
                                                    </p>
                                                    <v-row>
                                                        <v-col class="d-flex gap-19" cols="12" xs="12" sm="12" md="6" lg="6"
                                                            xl="6">
                                                            <span class="mt-2 fs-14 fw-500">ความกว้าง (เมตร)</span>
                                                            <v-text-field hide-details="auto" label="กรุณากรอกความกว้าง" v-model="stall_size_w"
                                                                :rules="rules.stall_size_w" outlined dense single-line
                                                                @keypress="isDecimalInput($event, stall_size_w)"
                                                                required></v-text-field>
                                                        </v-col>
                                                        <v-col class="d-flex gap-19" cols="12" xs="12" sm="12" md="6" lg="6"
                                                            xl="6">
                                                            <span class="mt-2 fs-14 fw-500">ความยาว (เมตร)</span>
                                                            <v-text-field hide-details="auto" label="กรุณากรอกความยาว" v-model="stall_size_h"
                                                                :rules="rules.stall_size_h" outlined dense single-line
                                                                @keypress="isDecimalInput($event, stall_size_h)"
                                                                required></v-text-field>
                                                        </v-col>
                                                    </v-row>
                                                    <v-row>
                                                        <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                            <p class="font-14 text-ex fs-16 fw-500">ค่าธรรมเนียม (สัญญา 1
                                                                ปี) <span style="color: red;">*</span></p>
                                                            <v-radio-group v-model="stall_radio_annual_fee" row>
                                                                <v-radio color="success" label="ฟรี" :value="0"></v-radio>
                                                                <v-radio color="success" label="มีค่าธรรมเนียม" :value="1"></v-radio>
                                                            </v-radio-group>
                                                            <div v-if="stall_radio_annual_fee != 0"
                                                                class="d-flex gap-4 pt-2">
                                                                <span class="mt-2 fs-14 fw-500">ค่าธรรมเนียมรายปี
                                                                    (บาท)</span>
                                                                <v-text-field hide-details="auto" label="กรุณากรอกค่าธรรมเนียมรายปี"
                                                                    v-model="stall_annual_fee"
                                                                    :rules="rules.stall_annual_fee" outlined dense
                                                                    @keypress="isDecimalInput($event, stall_annual_fee)"
                                                                    single-line required></v-text-field>
                                                            </div>
                                                        </v-col>
                                                        <v-col cols="12" xs="12" sm="12" md="3" lg="3" xl="3">
                                                            <p class="font-14 text-ex fs-16 fw-500">สีขนาดแผงค้า <span
                                                                    style="color: red;">*</span></p>
                                                            <v-text-field v-model="color_stall" hide-details="auto"
                                                                class="ma-0 pa-0" solo>
                                                                <template v-slot:append>
                                                                    <v-menu v-model="menu_stall" top nudge-bottom="105"
                                                                        nudge-left="16" :close-on-content-click="false">
                                                                        <template v-slot:activator="{ on }">
                                                                            <div :style="stall_swatchStyle" v-on="on" />
                                                                        </template>
                                                                        <v-card>
                                                                            <v-card-text class="pa-0">
                                                                                <v-color-picker v-model="color_stall"
                                                                                    flat />
                                                                            </v-card-text>
                                                                        </v-card>
                                                                    </v-menu>
                                                                </template>
                                                            </v-text-field>
                                                        </v-col>
                                                        <v-col cols="12" xs="12" sm="12" md="3" lg="3" xl="3">
                                                            <p class="font-14 text-ex fs-16 fw-500">
                                                                สีข้อความที่จะแสดงในตาราง <span style="color: red;">*</span>
                                                            </p>
                                                            <v-text-field  v-model="color_table" hide-details
                                                                class="ma-0 pa-0" solo>
                                                                <template v-slot:append>
                                                                    <v-menu v-model="menu_table" top nudge-bottom="105"
                                                                        nudge-left="16" :close-on-content-click="false">
                                                                        <template v-slot:activator="{ on }">
                                                                            <div :style="table_swatchStyle" v-on="on" />
                                                                        </template>
                                                                        <v-card>
                                                                            <v-card-text class="pa-0">
                                                                                <v-color-picker v-model="color_table"
                                                                                    flat />
                                                                            </v-card-text>
                                                                        </v-card>
                                                                    </v-menu>
                                                                </template>
                                                            </v-text-field>
                                                        </v-col>
                                                    </v-row>

                                                </v-col>

                                                <div class="d-flex align-center">
                                                    <img class="mr-2"
                                                        :src="base_url + `/images/icon/5b85b64f8d3895feb6295b31f826c873.png`"
                                                        alt="" width="20" height="20" />
                                                    <span class="font-16 color-title-card">เงินประกันต่าง ๆ</span>
                                                </div>
                                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                    <p class="font-14 text-ex fs-16 fw-500">อัตราค่าประกันการเช่าและบริการ
                                                        <span style="color: red;">*</span>
                                                    </p>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกอัตราค่าประกันการเช่าและบริการ"
                                                        v-model="stall_service_rate" :rules="rules.stall_service_rate"
                                                        @keypress="isDecimalInput($event, stall_service_rate)" outlined
                                                        dense single-line required></v-text-field>
                                                </v-col>
                                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                    <p class="font-14 text-ex fs-16 fw-500">อัตราค่าประกันมิเตอร์น้ำ <span
                                                            style="color: red;">*</span></p>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกอัตราค่าประกันมิเตอร์น้ำ"
                                                        v-model="stall_water_rate" :rules="rules.stall_water_rate" outlined
                                                        @keypress="isDecimalInput($event, stall_water_rate)" dense
                                                        single-line></v-text-field>
                                                </v-col>
                                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                    <p class="font-14 text-ex fs-16 fw-500">อัตราค่าประกันมิเตอร์ไฟ <span
                                                            style="color: red;">*</span></p>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกอัตราค่าประกันมิเตอร์ไฟ"
                                                        v-model="stall_electricity_rate"
                                                        :rules="rules.stall_electricity_rate" outlined dense
                                                        @keypress="isDecimalInput($event, stall_electricity_rate)"
                                                        single-line></v-text-field>
                                                </v-col>
                                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                    <p class="font-14 text-ex fs-16 fw-500">อัตราค่าประกันเครื่องดูดควัน
                                                        <span style="color: red;">*</span>
                                                    </p>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกอัตราค่าประกันเครื่องดูดควัน"
                                                        :rules="rules.stall_hood_rate" v-model="stall_hood_rate" outlined
                                                        @keypress="validateInput2($event, stall_hood_rate)" dense
                                                        single-line></v-text-field>
                                                </v-col>

                                                <div class="d-flex align-center">
                                                    <img class="mr-2"
                                                        :src="base_url + `/images/icon/83a1d67aef4f0062e1f53a2ac5d4d181.png`"
                                                        alt="" width="20" height="20" />
                                                    <span class="font-16 color-title-card">ค่าใช้จ่ายรายเดือน</span>
                                                </div>
                                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                    <p class="font-14 text-ex fs-16 fw-500">อัตราค่าเช่า <span style="color: red;">*</span></p>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกอัตราค่าน้ำ/ยูนิต"
                                                        :rules="rules.stall_rental_rate"
                                                        v-model="stall_rental_rate" outlined dense
                                                        @keypress="isDecimalInput($event, stall_rental_rate)"
                                                        single-line></v-text-field>
                                                </v-col>
                                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                    <p class="font-14 text-ex fs-16 fw-500">อัตราค่าส่วนกลาง <span style="color: red;">*</span></p>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกอัตราค่าส่วนกลาง"
                                                        :rules="rules.stall_common_rate"
                                                        v-model="stall_common_rate" outlined dense
                                                        @keypress="isDecimalInput($event, stall_common_rate)"
                                                        single-line></v-text-field>
                                                </v-col>
                                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                    <p class="font-14 text-ex fs-16 fw-500">อัตราค่าน้ำ/ยูนิต <span
                                                            style="color: red;">*</span></p>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกอัตราค่าน้ำ/ยูนิต"
                                                        v-model="stall_water_unit_rate" outlined
                                                        :rules="rules.stall_water_unit_rate" dense
                                                        @keypress="isDecimalInput($event, stall_water_unit_rate)"
                                                        single-line></v-text-field>
                                                </v-col>
                                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                    <p class="font-14 text-ex fs-16 fw-500">อัตราค่าไฟ/ยูนิต <span
                                                            style="color: red;">*</span></p>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกอัตราค่าไฟ/ยูนิต"
                                                        v-model="stall_electricity_unit_rate" outlined
                                                        :rules="rules.stall_electricity_unit_rate" dense
                                                        @keypress="isDecimalInput($event, stall_electricity_unit_rate)"
                                                        single-line></v-text-field>
                                                </v-col>

                                                <!-- <div class="d-flex align-center">
                                                    <img class="mr-2"
                                                        :src="base_url + `/images/icon/9243fc3450b245d83bba66b56913a5f8.png`"
                                                        alt="" width="20" height="20" />
                                                    <span class="font-16 color-title-card">ค่าอุปกรณ์พื้นฐาน
                                                        (ขึ้นอยู่กับแผงค้า)</span>
                                                </div>
                                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                    <p class="font-14 text-ex fs-16 fw-500">อัตราค่าป้ายไวนิล-ป้ายไฟ/ชุด
                                                        <span style="color: red;">*</span>
                                                    </p>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกอัตราค่าป้ายไวนิล-ป้ายไฟ/ชุด"
                                                        :rules="rules.stall_vinyl_light_set" v-model="stall_vinyl_light_set"
                                                        @keypress="validateInput($event, stall_vinyl_light_set)" outlined
                                                        dense single-line></v-text-field>
                                                </v-col>
                                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                </v-col>
                                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                    <p class="font-14 text-ex fs-16 fw-500">อัตราค่าซิงค์น้ำ <span
                                                            style="color: red;">*</span></p>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกอัตราค่าซิงค์น้ำ"
                                                        v-model="stall_water_sync_rate" outlined
                                                        :rules="rules.stall_water_sync_rate" dense
                                                        @keypress="isDecimalInput($event, stall_water_sync_rate)"
                                                        single-line></v-text-field>
                                                </v-col>
                                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                    <p class="font-14 text-ex fs-16 fw-500">อัตราค่าถังตักไขมัน <span
                                                            style="color: red;">*</span></p>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกอัตราค่าถังตักไขมัน"
                                                        v-model="stall_grease_tank_rate" outlined
                                                        :rules="rules.stall_grease_tank_rate" dense
                                                        @keypress="isDecimalInput($event, stall_grease_tank_rate)"
                                                        single-line></v-text-field>
                                                </v-col> -->
                                            </v-row>

                                            <div class="d-flex justify-center mt-4">
                                                <v-btn type="submit" color="white"
                                                    class="ma-2 btn-save rounded-pill pl-30 pr-30">
                                                    <v-icon class="fs-20" left dark>
                                                        mdi-content-save
                                                    </v-icon>
                                                    <span>บันทึกข้อมูล</span>
                                                </v-btn>
                                            </div>
                                        </div>
                                    </v-form>


                                </v-card-text>

                            </v-col>
                        </v-row>
                    </v-card>
                </v-col>
            </v-row>

        </div>
    </div>
</template>

<script>
// import stall from '../../../api/stall.js';
import stall from '../../../api/stall.js';

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
                    text: 'ตั้งค่าค่าเช่าแผง',
                    disabled: false,
                },
                {
                    text: 'เพิ่มข้อมูลแผงค้า',
                    disabled: true,
                },
            ],

            color_stall: '#D9D9D9FF',
            menu_stall: false,

            color_table: '#D9D9D9FF',
            menu_table: false,
            stall_type: [{ id: 1, name: 'แผงค่าทั่วไป' }, { id: 2, name: 'Food Conner' }],
            stall_select_type: 1,

            stall_name: '',
            stall_size_w: '',
            stall_size_h: '',
            stall_annual_fee: null,
            stall_radio_annual_fee: 0,
            stall_service_rate: '',
            stall_water_rate: '',
            stall_electricity_rate: '',
            stall_hood_rate: '',
            stall_rental_rate: '',
            stall_common_rate: '',
            stall_water_unit_rate: '',
            stall_electricity_unit_rate: '',
            stall_vinyl_light_set: '',
            stall_water_sync_rate: '',
            stall_grease_tank_rate: '',
            content_picture: null,
            imagePreviewURL: null,

            rules: {
                stall_size_w: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                stall_size_h: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                stall_annual_fee: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                stall_type: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                stall_name: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                stall_service_rate: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                stall_water_rate: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                stall_electricity_rate: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                stall_hood_rate: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                stall_rental_rate: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                stall_common_rate: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                stall_water_unit_rate: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                stall_electricity_unit_rate: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                // stall_vinyl_light_set: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                // stall_water_sync_rate: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                // stall_grease_tank_rate: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
            },
        }
    },
    methods: {
        // อัตราค่าป้ายไวนิล-ป้ายไฟ/ชุด และ อัตราค่าเช่ารวมส่วนกลาง -> สามารกรอก "100.00 - 100.00"
        // validateInput(evt, value) {
        //     evt = (evt) ? evt : window.event;
        //     let charCode = (evt.which) ? evt.which : evt.keyCode;

        //     if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode != 45 && charCode != 46) {
        //         evt.preventDefault();
        //     }
        //     // ห้ามกรอก - ซ้ำ
        //     if (value != null && value.split('-').length === 2 && charCode === 45) {
        //         evt.preventDefault();
        //     }
        //     // ห้ามกรอก - ก่อน
        //     if (value != null && value.length < 1 && charCode === 45) {
        //         evt.preventDefault();
        //     }
        //     else {
        //         return true
        //     }
        // },

        // อัตราค่าประกันเครื่องดูดควัน -> สามารกรอก "-" ได้ ตัวแรก
        validateInput2(evt, value) {
            evt = (evt) ? evt : window.event;
            let charCode = (evt.which) ? evt.which : evt.keyCode;

            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode != 45 && charCode != 46) {
                evt.preventDefault();
            }
            // ห้ามกรอก - ซ้ำ
            if (value != null && value.split('-').length === 2 && charCode === 45) {
                evt.preventDefault();
            }
            // ห้ามกรอก . ซ้ำ
            if (value != null && value.split('.').length === 2 && charCode === 46) {
                evt.preventDefault();
            }
            // กรอก - ก่อน
            if (value != null && value.length >= 1 && charCode === 45) {
                evt.preventDefault();
            }
            else {
                return true
            }
        },

        async stallAdd() {
            if (this.$refs.form_stall_add.validate()) {
                let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.access_token}`,
                    },
                }

                // let stall_center_rental_rate_min = 0.00;
                // let stall_center_rental_rate_max = 0.00;

                // let stall_vinyl_light_set_min = 0.00;
                // let stall_vinyl_light_set_max = 0.00;

                // อัตราค่าเช่ารวมส่วนกลาง
                // const stall_center_rental_rate_input = this.stall_rental_rate.replace(/\s/g, "");

                // if (stall_center_rental_rate_input.includes('-')) {
                //     const [minValue, maxValue] = stall_center_rental_rate_input.split('-');
                //     stall_center_rental_rate_min = parseFloat(minValue.replace(/,/g, ''));
                //     stall_center_rental_rate_max = parseFloat(maxValue.replace(/,/g, ''));
                // } else {
                //     stall_center_rental_rate_min = stall_center_rental_rate_input;
                // }

                // อัตราค่าป้ายไวนิล-ป้ายไฟ/ชุด
                // const stall_vinyl_light_set_input = this.stall_vinyl_light_set.replace(/\s/g, "");

                // if (stall_vinyl_light_set_input.includes('-')) {
                //     const [minValue, maxValue] = stall_vinyl_light_set_input.split('-');
                //     stall_vinyl_light_set_min = parseFloat(minValue.replace(/,/g, ''));
                //     stall_vinyl_light_set_max = parseFloat(maxValue.replace(/,/g, ''));
                // } else {
                //     stall_vinyl_light_set_min = stall_vinyl_light_set_input;
                // }

                let data = new FormData();
                data.append('name', this.stall_name);
                data.append('type', this.stall_select_type);
                data.append('pic', this.content_picture);
                data.append('size_w', this.stall_size_w);
                data.append('size_h', this.stall_size_h);
                data.append('radio_annual_fee', this.stall_radio_annual_fee);
                data.append('annual_fee', this.stall_annual_fee !== null ? this.stall_annual_fee : 0);
                data.append('color_stall', this.color_stall);
                data.append('color_table', this.color_table);
                data.append('guarantee_service_rate', this.stall_service_rate);
                data.append('guarantee_water_rate', this.stall_water_rate);
                data.append('guarantee_electricity_rate', this.stall_electricity_rate);
                data.append('guarantee_hood_rate', this.stall_hood_rate);

                // data.append('cost_center_rental_rate_min', stall_center_rental_rate_min);
                // data.append('cost_center_rental_rate_max', stall_center_rental_rate_max);

                data.append('cost_rental_rate', this.stall_rental_rate);
                data.append('cost_common_rate', this.stall_common_rate);
                data.append('cost_water_unit_rate', this.stall_water_unit_rate);
                data.append('cost_electricity_unit_rate', this.stall_electricity_unit_rate);

                // data.append('vinyl_light_set_min', stall_vinyl_light_set_min);
                // data.append('vinyl_light_set_max', stall_vinyl_light_set_max);
                // data.append('water_sync_rate', this.stall_water_sync_rate);
                // data.append('grease_tank_rate', this.stall_grease_tank_rate);

                this.loading_page = true;

                await stall.stallAdd(data, config).then((result) => {
                    if (result.data.success === true) {
                        this.loading_page = false;
                        this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                        this.$router.push('/managestall')
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


        async onFileChange(payload) {
            const file = payload
            let extall = "png,PNG,jpeg,JPEG,jpg,JPG";
            let file_ext = file.name;

            let ext = file_ext.split('.').pop().toLowerCase();
            if (parseInt(extall.indexOf(ext)) < 0) {

                this.imagePreviewURL = this.base_url + `/images/image250.png`
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
            this.imagePreviewURL = this.base_url + '/images/image250.png'
        },
    },
    created() {
    },
    mounted() {
        this.imagePreviewURL = this.base_url + '/images/image250.png'

    },
    computed: {
        stall_swatchStyle() {
            const { color_stall, menu_stall } = this
            return {
                backgroundColor: color_stall,
                cursor: 'pointer',
                height: '30px',
                width: '30px',
                borderRadius: menu_stall ? '50%' : '4px',
                transition: 'border-radius 200ms ease-in-out'
            }
        },
        table_swatchStyle() {
            const { color_table, menu_table } = this
            return {
                backgroundColor: color_table,
                cursor: 'pointer',
                height: '30px',
                width: '30px',
                borderRadius: menu_table ? '50%' : '4px',
                transition: 'border-radius 200ms ease-in-out'
            }
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