<template>
    <div class="loading_all_page" v-if="loading_page === true">
        <v-progress-circular indeterminate size="70" :width="8" color="#FFBC15"></v-progress-circular>
        <p class="mt-3">กำลังโหลดข้อมูล</p>
    </div>

    <div v-else>
        <div class="container">
            <div class="d-flex justify-space-between align-items-center mt-4 mb-4">
                <v-card-text class="p-0">
                    <h1 class="font-20 m-0">จัดการช่องทางติดต่อ</h1>
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
                    <v-form ref="form_contact_save" v-on:submit.prevent="contactSave()">
                        <v-card elevation="2">
                            <v-row class="m-0 p-4">
                                <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                                    <v-card-title class="p-0 justify-space-between text-card-title">
                                        ข้อมูลช่องทางการติดต่อ
                                    </v-card-title>

                                    <v-list-item three-line class="pl-0 pr-0 ml-0 mr-0">
                                        <div class="row-list" style="gap: 50px;">
                                            <div class="col-list image-list-slide">
                                                <v-img class="mt-4" v-if="imagePreviewURL" :src="imagePreviewURL"
                                                    alt="image list slide" width="160" height="160" />
                                            </div>
                                            <div class="col-list d-flex flex-column justify-center align-center">
                                                <v-card-text class="p-0 mt-2">
                                                    <div class="d-flex align-center">
                                                        <img class="mr-2" :src="base_url + `/images/icon/title.png`"
                                                            alt="Title" width="20" height="20" />
                                                        <span class="font-16 color-title-card">เพิ่มรูปภาพโลโก้
                                                            <span style="color: red;">*</span></span>
                                                    </div>
                                                    <div>
                                                        <p class="font-14 mt-3 text-ex">คำแนะนำ : ขนาดรูปภาพแนะนำ 1000 x
                                                            1000
                                                            หรือรูปสี่เหลี่ยมจตุรัส ขนาดไฟล์ไม่เกิน 2 gb สกุลไฟล์ jpg png
                                                            jpeg
                                                            เท่านั้น </p>

                                                        <v-file-input hide-details="auto" class="w-100" outlined dense
                                                            id="uploader" accept="image/*" v-model="content_picture"
                                                            :rules="[v => !!v || 'กรุณาเลือกรูปภาพ']" @change="onFileChange"
                                                            single-line clearable clear-icon="" label="กรุณาเลือกไฟล์รูปภาพ"
                                                            required></v-file-input>
                                                    </div>
                                                </v-card-text>
                                            </div>
                                        </div>
                                    </v-list-item>

                                    <v-card-text class="p-0 mt-6">
                                        <div class="d-flex align-center">
                                            <img class="mr-2" :src="base_url + `/images/icon/contact2.png`" alt="Contact"
                                                width="20" height="20" />
                                            <span class="font-16 color-title-card">ข้อมูลตลาด</span>
                                        </div>
                                        <div class="mt-3">
                                            <v-row class="container-input-contact">
                                                <v-col xs="12" sm="12" md="6" lg="6" xl="6">
                                                    <p class="font-14 text-ex">ชื่อตลาด (ภาษาไทย) <span
                                                            style="color: red;">*</span></p>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกชื่อตลาดภาษาไทย"
                                                        :rules="rules.market_name_thai" v-model="market_name_thai" outlined
                                                        dense single-line required></v-text-field>
                                                </v-col>
                                                <v-col xs="12" sm="12" md="6" lg="6" xl="6">
                                                    <p class="font-14 text-ex">ชื่อตลาด (ภาษาอังกฤษ) <span
                                                            style="color: red;">*</span></p>
                                                    <v-text-field hide-details="auto" :rules="rules.market_name_eng"
                                                        label="กรุณากรอกชื่อตลาดภาษาอังกฤษ" v-model="market_name_eng"
                                                        outlined dense single-line required></v-text-field>
                                                </v-col>
                                                <v-col xs="12" sm="12" md="6" lg="6" xl="6">
                                                    <p class="font-14 text-ex">ชื่อบริษัท/ตลาด / หจก <span
                                                            style="color: red;">*</span></p>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกข้อมูล"
                                                        v-model="company_name" :rules="rules.company_name" outlined dense
                                                        single-line required></v-text-field>
                                                </v-col>
                                                <v-col xs="12" sm="12" md="6" lg="6" xl="6">
                                                    <p class="font-14 text-ex">เลขประจำตัวผู้เสียภาษี <span
                                                            style="color: red;">*</span></p>
                                                    <v-text-field hide-details="auto"
                                                        label="กรุณากรอกเลขประจำตัวผู้เสียภาษี"
                                                        v-model="identification_number" :rules="rules.identification_number"
                                                        outlined dense single-line required></v-text-field>
                                                </v-col>
                                            </v-row>
                                        </div>


                                    </v-card-text>

                                    <v-card-text class="p-0 mt-4">
                                        <div class="d-flex align-center">
                                            <img class="mr-2" :src="base_url + `/images/icon/address.png`" alt="Address"
                                                width="20" height="20" />

                                            <span class="font-16 color-title-card">ที่อยู่ </span>
                                        </div>
                                        <div class="mt-3">
                                            <v-row>
                                                <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                                                    <div class="d-flex align-center mb-2">
                                                        <span class="font-16 color-707070">ภาษาไทย
                                                            <span style="color: red;">*</span>
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <v-text-field hide-details="auto" label="กรุณากรอกที่อยู่"
                                                            v-model="address_thai" outlined single-line
                                                            :rules="rules.address_thai" required></v-text-field>
                                                    </div>
                                                </v-col>
                                                <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">

                                                    <div class="d-flex align-center mb-2">
                                                        <span class="font-16 color-707070">ภาษาอังกฤษ</span>
                                                    </div>
                                                    <div>
                                                        <v-text-field hide-details="auto" label="กรุณากรอกที่อยู่"
                                                            v-model="address_eng" outlined single-line
                                                            :rules="rules.address_eng"></v-text-field>
                                                    </div>
                                                </v-col>
                                                <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">

                                                    <div class="d-flex align-center mb-2">
                                                        <span class="font-16 color-707070">ลิงค์ตำแหน่งที่ตั้ง</span>
                                                    </div>
                                                    <div>
                                                        <v-text-field hide-details="auto"
                                                            label="กรุณากรอกลิงค์ตำแหน่งที่ตั้ง" v-model="address_link"
                                                            outlined dense single-line
                                                            :rules="rules.address_link"></v-text-field>
                                                    </div>
                                                </v-col>
                                            </v-row>
                                        </div>

                                    </v-card-text>

                                    <v-card-text class="p-0 mt-8">
                                        <div class="d-flex align-center mb-2">
                                            <img class="mr-2"
                                                :src="base_url + `/images/icon/3455ae7f9735a4c5b195648353ccfbcb.png`" alt=""
                                                width="20" height="20" />
                                            <span class="font-16 color-title-card">ช่องทางการติดต่อ</span>
                                        </div>
                                        <v-row>
                                            <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                <div class="d-flex align-center mb-2">
                                                    <span class="font-16 color-707070">เบอร์โทร <span
                                                            style="color: red;">*</span></span>
                                                </div>
                                                <div>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกเบอร์โทร"
                                                        v-model="phone" @keypress="isTelephone($event, phone)" outlined
                                                        dense single-line :rules="rules.phone" required></v-text-field>
                                                </div>
                                            </v-col>
                                            <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                <div class="d-flex align-center mb-2">
                                                    <span class="font-16 color-707070">อีเมล
                                                    </span>
                                                </div>
                                                <div>
                                                    <v-text-field hide-details="auto" type="email"
                                                        @keypress="isEmail($event)" :rules="[rulesEmail.email]"
                                                        label="กรุณากรอกอีเมล" v-model="email" outlined dense
                                                        single-line></v-text-field>
                                                </div>
                                            </v-col>

                                            <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                <div class="d-flex align-center mb-2">
                                                    <span class="font-16 color-707070">เฟสบุ๊ค </span>
                                                </div>
                                                <div>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกเฟสบุ๊ค"
                                                        v-model="facebook" outlined dense single-line
                                                        :rules="rules.facebook"></v-text-field>
                                                </div>
                                            </v-col>
                                            <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                <div class="d-flex align-center mb-2">
                                                    <span class="font-16 color-707070">ลิงค์เฟสบุ๊ค </span>
                                                </div>
                                                <div>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกลิงค์เฟสบุ๊ค"
                                                        v-model="facebook_link" outlined dense single-line
                                                        :rules="rules.facebook_link"></v-text-field>
                                                </div>
                                            </v-col>
                                            <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                <div class="d-flex align-center mb-2">
                                                    <span class="font-16 color-707070">ไลน์ไอดี </span>
                                                </div>
                                                <div>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกไลน์ไอดี"
                                                        v-model="id_line" outlined dense single-line
                                                        :rules="rules.id_line"></v-text-field>
                                                </div>
                                            </v-col>
                                            <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                <div class="d-flex align-center mb-2">
                                                    <span class="font-16 color-707070">ลิงค์ไลน์ไอดี </span>
                                                </div>
                                                <div>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกลิงค์ไลน์ไอดี"
                                                        v-model="id_line_link" outlined dense single-line
                                                        :rules="rules.id_line_link"></v-text-field>
                                                </div>
                                            </v-col>
                                            <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                <div class="d-flex align-center mb-2">
                                                    <span class="font-16 color-707070">อินสตราแกรม </span>
                                                </div>
                                                <div>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกอินสตราแกรม"
                                                        v-model="instagram" outlined dense single-line
                                                        :rules="rules.instagram"></v-text-field>
                                                </div>
                                            </v-col>
                                            <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                <div class="d-flex align-center mb-2">
                                                    <span class="font-16 color-707070">ลิงค์อินสตราแกรม
                                                    </span>
                                                </div>
                                                <div>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกลิงค์อินสตราแกรม"
                                                        v-model="instagram_link" outlined dense single-line
                                                        :rules="rules.instagram_link"></v-text-field>
                                                </div>
                                            </v-col>
                                            <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                <div class="d-flex align-center mb-2">
                                                    <span class="font-16 color-707070">ติ๊กต็อก </span>
                                                </div>
                                                <div>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกติ๊กต็อก"
                                                        v-model="tiktok" outlined dense single-line
                                                        :rules="rules.tiktok"></v-text-field>
                                                </div>
                                            </v-col>
                                            <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                <div class="d-flex align-center mb-2">
                                                    <span class="font-16 color-707070">ลิงค์ติ๊กต็อก </span>
                                                </div>
                                                <div>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกลิงค์ติ๊กต็อก"
                                                        v-model="tiktok_link" outlined dense single-line
                                                        :rules="rules.tiktok_link"></v-text-field>
                                                </div>
                                            </v-col>
                                        </v-row>
                                    </v-card-text>

                                    <v-card-text class="p-0 mt-8">
                                        <v-row>
                                            <v-col cols="12">
                                                <img class="mr-2" :src="base_url + `/images/icon/megaphone 6.png`" alt=""
                                                    width="20" height="20" />
                                                <span
                                                    class="font-16 color-title-card">รูปแบบแจ้งเตือนการส่งบิลเรียกเก็บค่าเช่าผ่านทาง
                                                    Line Official</span>
                                            </v-col>

                                            <!--  if ปิดการส่งข้อมูลอัตโนมัติ -->
                                            <v-col v-if="line_status === 0" cols="12">
                                                <p class="font-14 text-ex fs-16 fw-500">การส่งข้อมูลอัตโนมัติ : </p>
                                                <img class="mr-2" :src="base_url + `/images/icon/on-button_5.png`" alt=""
                                                    width="20" height="20" />
                                                <span class="font-16  ">ปิดการส่งข้อมูลอัตโนมัติ</span>
                                            </v-col>

                                            <!--  else เปิดการส่งข้อมูลอัตโนมัติ -->
                                            <v-col v-if="line_status === 1" cols="12">
                                                <p class="font-14 text-ex fs-16 fw-500">การส่งข้อมูลอัตโนมัติ : </p>
                                                <img class="mr-2" :src="base_url + `/images/icon/on-button_4.png`" alt=""
                                                    width="20" height="20" />
                                                <span class="font-16  ">เปิดการส่งข้อมูลอัตโนมัติ</span>
                                            </v-col>

                                            <v-col v-if="line_status === 1" cols="6">
                                                <p class="font-16">รอบการส่งบิลเรียกเก็บ : {{ bill_sending_name }}</p>
                                            </v-col>


                                            <v-col v-if="line_status === 1 && bill_sending_status === 1" cols="6">
                                                <p class="font-16">วันที่ต้องการส่งบิลเรียกเก็บรายสัปดาห์ : {{ line_day_name
                                                }}
                                                </p>
                                            </v-col>

                                            <v-col v-if="line_status === 1 && bill_sending_status === 2" cols="6">
                                                <p class="font-16">วันที่ต้องการส่งบิลเรียกเก็บรายเดือน : {{ line_mouth_name
                                                }}
                                                </p>
                                            </v-col>

                                            <v-col v-if="line_status === 1 && bill_sending_status === 3" cols="6">
                                                <p class="font-16">วันที่ต้องการส่งบิลเรียกเก็บรายปี : วันที่
                                                    {{ line_day_yaer_select_type }} เดือน {{ line_mouth_yaer_name }}
                                                </p>
                                            </v-col>
                                        </v-row>

                                    </v-card-text>
                                    <v-card-text class="p-0 mt-8">
                                        <v-row>
                                            <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                                                <div class="d-flex align-center mb-2">
                                                    <span class="font-16 color-707070">หมายเหตุท้ายใบวางบิล </span>
                                                </div>
                                                <div>
                                                    <v-textarea solo outlined single-line flat v-model="billing_notes"
                                                        label="กรุณากรอกหมายเหตุท้ายใบวางบิล"></v-textarea>
                                                </div>
                                            </v-col>
                                        </v-row>
                                        <div class="d-flex justify-center">
                                            <v-btn type="submit" color="white"
                                                class="ma-2 btn-save rounded-pill pl-30 pr-30">
                                                <v-icon class="fs-20" left dark>
                                                    mdi-content-save
                                                </v-icon>
                                                บันทึกข้อมูล
                                            </v-btn>
                                        </div>
                                    </v-card-text>
                                </v-col>
                            </v-row>
                        </v-card>
                    </v-form>
                </v-col>
            </v-row>
        </div>
    </div>
</template>

<script>
import contact from '../../../api/contact.js';

export default {
    data() {
        return {
            loading_page: false,
            content_picture: null,
            imagePreviewURL: null,
            submenu: [
                {
                    text: 'จัดการเว็บไซต์ประชาสัมพันธ์',
                    disabled: false,
                },
                {
                    text: 'จัดการช่องทางติดต่อ',
                    disabled: true,
                },
            ],
            get_data: {},

            market_name_thai: "",
            market_name_eng: "",
            company_name: "",
            identification_number: "",

            address_thai: '',
            address_eng: '',
            address_link: '',

            phone: "",
            email: "",
            facebook: '',
            facebook_link: '',
            id_line: '',
            id_line_link: '',
            instagram: '',
            instagram_link: '',
            tiktok: '',
            tiktok_link: '',

            // Line
            line_status: 0, //	0 = ไม่ส่งอัตโนมัติ 1 = ส่งอัตโนมัติ
            bill_sending_name: null,
            bill_sending_status: null,
            line_day_name: null,
            line_mouth_name: null,
            line_day_yaer_select_type: null,
            line_mouth_yaer_name: null,
            billing_notes: '',

            rules: {
                address: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                phone: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                address_thai: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                market_name_thai: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                market_name_eng: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                company_name: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                identification_number: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                tel: [v => !!v || 'กรุณากรอกเบอร์โทร'],
            },

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
        }
    },
    methods: {
        // Get List contact
        async getList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await contact.contactList(this.page, '', config).then((result) => {
                if (result.data.success === true) {
                    this.get_data = result.data.data;

                    this.market_name_thai = this.get_data.market_name_thai;
                    this.market_name_eng = this.get_data.market_name_eng;
                    this.company_name = this.get_data.company_name;
                    this.identification_number = this.get_data.identification_number;
                    this.address_thai = this.get_data.address_thai;
                    this.address_eng = this.get_data.address_eng;
                    this.address_link = this.get_data.address_link;
                    this.phone = this.get_data.phone;
                    this.email = this.get_data.email;
                    this.facebook = this.get_data.facebook;
                    this.facebook_link = this.get_data.facebook_link;
                    this.id_line = this.get_data.id_line;
                    this.id_line_link = this.get_data.id_line_link;
                    this.instagram = this.get_data.instagram;
                    this.instagram_link = this.get_data.instagram_link;
                    this.tiktok = this.get_data.tiktok;
                    this.tiktok_link = this.get_data.tiktok_link;

                    this.get_data = {
                        ...this.get_data,
                        pic_path: { name: this.get_data.pic_path }
                    }

                    this.content_picture = { name: this.get_data.pic_path.name }

                    if (this.get_data.pic_path.name) {
                        this.imagePreviewURL = this.base_url + `/public/` + this.get_data.pic_path.name
                    } else {
                        this.imagePreviewURL = this.base_url + '/images/160-160.png'

                    }

                    this.pages = result.data.pages;
                    this.page = parseInt(result.data.current_page);

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

                    this.billing_notes = this.get_data.bill_notes_at_end
                }

            }).catch((error) => {
                if (error.response.status === 401) {
                    this.loading_page = false
                    this.$store.commit('logOutSuccess')
                    this.$router.push('/login')
                }
            })
        },

        async contactSave() {
            if (this.$refs.form_contact_save.validate()) {
                this.loading_page = true;
                let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.access_token}`,
                    },
                }

                let data = new FormData();
                data.append('pic', this.content_picture ? this.content_picture : '');
                data.append('market_name_thai', this.market_name_thai ? this.market_name_thai : '');
                data.append('market_name_eng', this.market_name_eng ? this.market_name_eng : '');
                data.append('company_name', this.company_name ? this.company_name : '');
                data.append('identification_number', this.identification_number ? this.identification_number : '');
                data.append('address_thai', this.address_thai ? this.address_thai : '');
                data.append('address_eng', this.address_eng ? this.address_eng : '');
                data.append('address_link', this.address_link ? this.address_link : '');
                data.append('phone', this.phone ? this.phone : '');
                data.append('email', this.email ? this.email : '');
                data.append('facebook', this.facebook ? this.facebook : '');
                data.append('facebook_link', this.facebook_link ? this.facebook_link : '');
                data.append('id_line', this.id_line ? this.id_line : '');
                data.append('id_line_link', this.id_line_link ? this.id_line_link : '');
                data.append('instagram', this.instagram ? this.instagram : '');
                data.append('instagram_link', this.instagram_link ? this.instagram_link : '');
                data.append('tiktok', this.tiktok ? this.tiktok : '');
                data.append('tiktok_link', this.tiktok_link ? this.tiktok_link : '');

                if (this.get_data.id) {
                    // Update
                    data.append('id', this.get_data.id);
                    await contact.contactUpdate(data, config).then((result) => {
                        if (result.data.success === true) {
                            this.loading_page = false;
                            this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                        }
                    }).catch((error) => {
                        if (error.response.status === 401) {
                            this.loading_page = false
                            this.$store.commit('logOutSuccess')
                            this.$router.push('/login')
                        }
                    })
                } else {
                    // Create
                    await contact.contactAdd(data, config).then((result) => {
                        if (result.data.success === true) {
                            this.loading_page = false;
                            this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                        }
                    }).catch((error) => {
                        if (error.response.status === 401) {
                            this.loading_page = false
                            this.$store.commit('logOutSuccess')
                            this.$router.push('/login')
                        }
                    })
                }

            }
        },
        async onFileChange(payload) {
            const file = payload
            let extall = "png,PNG,jpeg,JPEG,jpg,JPG";
            let file_ext = file.name;

            let ext = file_ext.split('.').pop().toLowerCase();
            if (parseInt(extall.indexOf(ext)) < 0) {

                this.imagePreviewURL = this.base_url + '/images/160-160.png'
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
            this.imagePreviewURL = this.base_url + '/images/160-160.png'
        },
    },
    created() {
    },
    mounted() {
        this.imagePreviewURL = this.base_url + '/images/160-160.png'
        this.getList()
    }
}
</script>

<style scoped lang="scss">
* {
    font-family: 'Kanit', sans-serif !important;
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