<template>
    <div class="loading_all_page" v-if="loading_page === true">
        <v-progress-circular indeterminate size="70" :width="8" color="#FFBC15"></v-progress-circular>
        <p class="mt-3">กำลังโหลดข้อมูล</p>
    </div>

    <!-- <div v-else data-aos="fade-up"> -->
    <div v-else>
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
                    <v-btn @click="managepanelrental_add" class="btn-success pl-30 pr-30 mt-6" color="warning" dark>
                        <img :src="base_url + `/images/icon/add-friend.png`" alt="" width="20" height="20" />
                        <span class="ml-2">สร้างการเช่าแผงใหม่</span>
                    </v-btn>
                </v-card-subtitle>

                <v-card-text>
                    <v-row class="mb-2">
                        <v-col cols="6">
                            <v-btn @click="linkPage('/managepanelrental')" color="success" class="no-border" width="100%"
                                outlined> กำลังดำเนินการ </v-btn>
                        </v-col>
                        <v-col cols="6">
                            <v-btn @click="linkPage('/managepanelrentalsuccess')" color=""
                                class="no-border no-border-all color-black" width="100%" outlined> เสร็จสิ้น </v-btn>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="2">
                            <v-card class="mx-auto border-black rounded-lg" outlined>
                                <v-list-item three-line>
                                    <v-list-item-content class="py-1">
                                        <v-list-item-title class="font-18 bold ">
                                            สถานะ : กำลังเช่า
                                        </v-list-item-title>
                                        <v-list-item-subtitle>รายการ</v-list-item-subtitle>
                                    </v-list-item-content>

                                    <v-list-item-avatar>
                                        <h3> {{ get_data_all.count_renting }} </h3>
                                    </v-list-item-avatar>
                                </v-list-item>

                            </v-card>
                        </v-col>
                        <v-col cols="2">
                            <v-card class="mx-auto border-black rounded-lg" outlined>
                                <v-list-item three-line>
                                    <v-list-item-content>
                                        <v-list-item-title class="font-18 bold">
                                            สถานะ : ชำระเงิน
                                        </v-list-item-title>
                                        <v-list-item-subtitle>รายการ</v-list-item-subtitle>
                                    </v-list-item-content>

                                    <v-list-item-avatar>
                                        <h3> {{ get_data_all.count_pay }} </h3>
                                    </v-list-item-avatar>
                                </v-list-item>

                            </v-card>
                        </v-col>
                        <v-col cols="2">
                            <v-card class="mx-auto border-black rounded-lg" outlined>
                                <v-list-item three-line>
                                    <v-list-item-content>
                                        <v-list-item-title class="font-18 bold">
                                            สถานะ : เอกสารร่าง
                                        </v-list-item-title>
                                        <v-list-item-subtitle>รายการ</v-list-item-subtitle>
                                    </v-list-item-content>

                                    <v-list-item-avatar>
                                        <h3> {{ get_data_all.count_quatation }} </h3>
                                    </v-list-item-avatar>
                                </v-list-item>

                            </v-card>
                        </v-col>
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
                                        <td
                                            :style="`color: ${new Date() >= new Date(new Date(item.date_end).setDate(new Date(item.date_end).getDate() - 30)) && new Date() <= new Date(item.date_end) ? 'red !important' : 'black'} `">
                                            {{ item.date_start }}</td>
                                        <td
                                            :style="`color: ${new Date() >= new Date(new Date(item.date_end).setDate(new Date(item.date_end).getDate() - 30)) && new Date() <= new Date(item.date_end) ? 'red !important' : 'black'} `">
                                            {{ item.date_end }}</td>
                                        <td>
                                            <div v-if="item.confilrm == 0" class="d-flex my-2 ">
                                                <span @click="dialogPayment(item.id, item.total)" class="review_approval_1"
                                                    style="padding-right:10px ;">
                                                    <img class="ml-2 mr-2"
                                                        :src="base_url + `/images/icon/rotation-lock 1.png`" alt=""
                                                        width="20" height="20" />
                                                    <div class="mr-2">ยืนยันการเช่า</div>
                                                </span>
                                            </div>
                                            <div v-if="item.confilrm == 2" class="d-flex my-2 ">
                                                <span @click="dialogComplete(item.id)" class="review_approval_1"
                                                    style="padding-right:10px ;">
                                                    <img class="ml-2 mr-2"
                                                        :src="base_url + `/images/icon/rotation-lock 12.png`" alt=""
                                                        width="20" height="20" />
                                                    <div class="mr-2">ยืนยันการเซ็นต์สัญญา</div>
                                                </span>
                                            </div>
                                            <div v-else-if="item.confilrm == 1">
                                                {{ item.date_confirm }}
                                            </div>
                                        </td>
                                        <td>
                                            <div v-if="item.confilrm == 1">
                                                <span class="review_approval_2">กำลังเช่า</span>
                                            </div>
                                            <div v-if="item.confilrm == 2">
                                                <span class="review_approval_4">ชำระเงินแล้ว</span>
                                            </div>
                                            <div v-if="item.confilrm == 0">
                                                <span class="review_copy">เอกสารร่าง</span>
                                            </div>
                                        </td>
                                        <td>
                                            <v-btn
                                                @click="linkPage(`/managepanelrental/detail?id=${base64Encode(item.id)}`)"
                                                class="ma-1 m-0 p-0" width="38" height="38" outlined large fab elevation="4"
                                                color="#0D99FF">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M16.325 14.8987L21.705 20.2787C21.8941 20.468 22.0003 20.7246 22.0002 20.9921C22.0001 21.2596 21.8937 21.5161 21.7045 21.7052C21.5153 21.8943 21.2587 22.0005 20.9912 22.0004C20.7236 22.0003 20.4671 21.894 20.278 21.7047L14.898 16.3247C13.2897 17.5704 11.2673 18.1566 9.24214 17.9641C7.21699 17.7716 5.34124 16.8148 3.99649 15.2884C2.65174 13.7619 1.939 11.7806 2.00326 9.74729C2.06753 7.71402 2.90396 5.7816 4.34242 4.34315C5.78087 2.9047 7.71329 2.06826 9.74656 2.004C11.7798 1.93973 13.7612 2.65248 15.2876 3.99723C16.814 5.34198 17.7708 7.21772 17.9634 9.24287C18.1559 11.268 17.5697 13.2905 16.324 14.8987H16.325ZM10 15.9997C11.5913 15.9997 13.1174 15.3676 14.2427 14.2424C15.3679 13.1172 16 11.591 16 9.99974C16 8.40845 15.3679 6.88232 14.2427 5.7571C13.1174 4.63189 11.5913 3.99974 10 3.99974C8.40871 3.99974 6.88259 4.63189 5.75737 5.7571C4.63215 6.88232 4.00001 8.40845 4.00001 9.99974C4.00001 11.591 4.63215 13.1172 5.75737 14.2424C6.88259 15.3676 8.40871 15.9997 10 15.9997Z"
                                                        fill="#0D99FF" />
                                                </svg>
                                            </v-btn>

                                            <v-btn v-if="item.confilrm !== 1" @click="managepanelrental_edit(item.id)"
                                                class="ma-1 m-0 p-0" width="38" height="38" outlined large fab elevation="4"
                                                color="#FF5B00">
                                                <v-icon>mdi-pencil</v-icon>
                                            </v-btn>

                                            <v-btn @click="dialogDelete(item.id)" class="ma-1 m-0 p-0" width="38"
                                                height="38" outlined large fab elevation="4" color="#FF1E1E">
                                                <v-icon>mdi-note-off-outline</v-icon>
                                            </v-btn>
                                            <v-btn @click="dialogPrin(item.id)" class="ma-1 m-0 p-0" width="38" height="38"
                                                outlined large fab elevation="4" color="#65AB79">
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

            <!-- Dialog Delete -->
            <v-dialog v-model="dialog_delete" width="500">
                <v-card>
                    <v-card-text class="d-flex flex-column align-center pb-0">
                        <img class="mt-4 mb-8" :src="base_url + `/images/exclamation.png`" alt="image list slide"
                            width="130" max-width="130" height="auto" />
                        <h3 class="mag-modal mb-8">ท่านแน่ใจใช่ไหม ที่จะต้องการลบข้อมูลนี้ !</h3>
                    </v-card-text>

                    <v-card-actions class="d-flex justify-center">
                        <v-btn @click="renterDelete()" class="btn-success mb-32 mr-4 pl-30 pr-30">
                            <span>ใช่ , ฉันต้องการลบ</span>
                        </v-btn>
                        <v-btn class="btn-danger mb-32 ml-4 pl-30 pr-30" @click="dialog_delete = false">
                            <span>ไม่ใช่</span>
                        </v-btn>
                    </v-card-actions>

                </v-card>
            </v-dialog>

            <!-- Dialog Complete -->
            <v-dialog v-model="dialog_complete" width="500">
                <v-card>
                    <v-card-text class="d-flex flex-column align-center pb-0">
                        <img class="mt-4 mb-8" :src="base_url + `/images/exclamation.png`" alt="image list slide"
                            width="130" max-width="130" height="auto" />
                        <h3 class="mag-modal mb-8">ท่านแน่ใจใช่ไหมที่จะยืนยันการเช่า ?</h3>
                    </v-card-text>

                    <v-card-actions class="d-flex justify-center">
                        <v-btn @click="doc_typeUpdate(1)" class="btn-success mb-32 mr-4 pl-30 pr-30">
                            <span>ใช่ , ฉันยืนยัน</span>
                        </v-btn>
                        <v-btn class="btn-danger mb-32 ml-4 pl-30 pr-30" @click="dialog_complete = false">
                            <span>ปิด</span>
                        </v-btn>
                    </v-card-actions>

                </v-card>
            </v-dialog>

            <!-- Dialog Payment -->
            <!-- <v-dialog v-model="dialog_payment" width="500">
                <v-card>
                    <v-card-text class="d-flex flex-column align-center pb-0">
                        <img class="mt-4 mb-8" :src="base_url + `/images/exclamation.png`" alt="image list slide"
                            width="130" max-width="130" height="auto" />
                        <h3 class="mag-modal mb-8">ท่านแน่ใจใช่ไหมที่จะยืนยันการชำระเงินแล้ว ?</h3>
                    </v-card-text>

                    <v-card-actions class="d-flex justify-center">
                        <v-btn @click="doc_typeUpdate(2)" class="btn-success mb-32 mr-4 pl-30 pr-30">
                            <span>ใช่ , ฉันยืนยัน</span>
                        </v-btn>
                        <v-btn class="btn-danger mb-32 ml-4 pl-30 pr-30" @click="dialog_payment = false">
                            <span>ปิด</span>
                        </v-btn>
                    </v-card-actions>

                </v-card>
            </v-dialog> -->

            <!-- Dialog Payment-->
            <v-dialog v-model="dialog_payment" width="1054">
                <v-card>
                    <v-card-title
                        class="text-h5 color-black fs-20 h-65 p-0 pl-30 pr-30 d-flex justify-space-between bg-F8F8F8">
                        <span>ยืนยันการเช่า</span>
                        <v-btn @click="() => { dialog_payment = false }" class="p-0 m-0" width="50" height="50"
                            style="min-width: 50px !important;">
                            <img class="p-0 m-0" :src="base_url + `/images/icon/close.png`" alt="Keyword" width="20"
                                height="20" />
                        </v-btn>

                    </v-card-title>
                    <v-card class="mt-2 p-5 pt-3" elevation="0">
                        <v-form v-on:submit.prevent="doc_typeUpdate(2)">
                            <div class="d-flex align-center mb-4">
                                <img class="mr-2" :src="base_url + `/images/icon/megaphone 112.png`" alt="Keyword"
                                    width="20" height="20" />

                                <span class="font-16 color-title-card">ข้อมูลการชำระเงินเพื่อยืนยันการเช่า</span>
                            </div>

                            <v-row>
                                <v-col cols="12">
                                    <v-card outlined class="bg-green-out rounded-lg">
                                        <v-row>
                                            <v-col cols="12" class="text-center">
                                                <p class="text-green bold mt-5 mb-6 font-16">
                                                    ยอดเงินที่ต้องชำระทั้งสิ้น {{ slip_total }} บาท</p>
                                            </v-col>
                                        </v-row>
                                    </v-card>
                                </v-col>
                            </v-row>


                            <v-card-text class="p-0 mt-5">
                                <div>
                                    <p class="font-14 mt-3 text-ex">วิธีการชำระเงิน
                                        <span style="color: red;">*</span>
                                    </p>

                                    <v-radio-group hide-details="auto" v-model="radio_payment_type" row>
                                        <v-radio color="success" label="เงินโอน" :value="1"></v-radio>
                                        <v-radio color="success" label="เงินสด" :value="0"></v-radio>
                                    </v-radio-group>
                                </div>
                            </v-card-text>

                            <v-card-text class="p-0 mt-5">
                                <div>
                                    <p class="font-14 mt-3 text-ex">แนบรูปภาพหลักฐานกาชำระเงิน</p>
                                    <v-file-input class="w-100" outlined dense id="uploader" accept="image/*" multiple
                                        v-model="content_picture" @change="onFileChange" single-line clearable clear-icon=""
                                        label="กรุณาแนบรูปภาพหลักฐานกาชำระเงิน"></v-file-input>
                                </div>
                            </v-card-text>

                            <v-list-item three-line class="pl-0 pr-0 ml-0 mr-0">
                                <div v-if="content_picture.length === 0" class="row-list w-100" style="gap: 50px;">
                                    <div class="col-list image-list-slide">
                                        <img class="mt-4 object-fit-cover" v-if="imagePreviewURL" :src="imagePreviewURL"
                                            alt="image list slide" width="250" height="250" />
                                    </div>
                                </div>

                                <v-row v-else>
                                    <v-col sm="4" v-for="(file, f) in content_picture" :key="f">
                                        <!-- {{ file.name }} -->
                                        <img :ref="'file'" src="//placehold.it/400/99cc77" class="img-fluid"
                                            :title="'file' + f" />
                                    </v-col>
                                </v-row>

                            </v-list-item>
                            <v-card-text class="p-0 mt-5">
                                <div>
                                    <p class="font-14 mt-3 text-ex">หมายเหตุ</p>
                                    <v-text-field label="กรุณากรอกหมายเหตุ" v-model="slip_note" outlined dense
                                        single-line></v-text-field>
                                </div>
                            </v-card-text>
                            <v-card-actions>
                                <v-card-text class="p-0 d-flex justify-center">
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

            <!-- Dialog Print-->
            <v-dialog v-model="dialog_prin" width="1054">
                <v-card>
                    <v-card-title
                        class="text-h5 color-black fs-20 h-65 p-0 pl-30 pr-30 d-flex justify-space-between bg-F8F8F8">
                        <span>เลือกเอกสารเพื่อพิมพ์</span>
                        <v-btn @click="() => { dialog_prin = false }" class="p-0 m-0" width="50" height="50"
                            style="min-width: 50px !important;">
                            <img class="p-0 m-0" :src="base_url + `/images/icon/close.png`" alt="Keyword" width="20"
                                height="20" />
                        </v-btn>
                    </v-card-title>

                    <v-card class="mt-2 p-5 pt-3" elevation="0">
                        <v-list-item three-line class="pl-0 pr-0 ml-0 mr-0">
                            <v-row>
                                <v-col cols="12" xs="12" sm="12" md="6" lg="3" xl="3">
                                    <v-card class="d-flex flex-column align-center"
                                        style="padding: 40px 0px;border-radius: 15px;">
                                        <img class="p-0 m-0" :src="base_url + `/images/icon/modern-buildings 21.png`" alt=""
                                            width="70" height="70" />
                                        <p class="fs-16 fw-500 mt-5">ใบวางบิล</p>

                                        <span @click="" class="review_approval_1"
                                            style="padding-right:10px ;border-radius: 25px;">
                                            <img class="ml-2 mr-2" :src="base_url + `/images/icon/printer 1.png`" alt=""
                                                width="20" height="20" />
                                            <div class="mr-2">พิมพ์</div>
                                        </span>
                                    </v-card>
                                </v-col>
                                <v-col cols="12" xs="12" sm="12" md="6" lg="3" xl="3">
                                    <v-card class="d-flex flex-column align-center"
                                        style="padding: 40px 0px;border-radius: 15px;">
                                        <img class="p-0 m-0" :src="base_url + `/images/icon/modern-buildings 22.png`" alt=""
                                            width="70" height="70" />
                                        <p class="fs-16 fw-500 mt-5">ใบสัญญา</p>

                                        <span @click="" class="review_approval_1"
                                            style="padding-right:10px ;border-radius: 25px;">
                                            <img class="ml-2 mr-2" :src="base_url + `/images/icon/printer 2.png`" alt=""
                                                width="20" height="20" />
                                            <div class="mr-2">พิมพ์</div>
                                        </span>

                                    </v-card>
                                </v-col>
                                <v-col cols="12" xs="12" sm="12" md="6" lg="3" xl="3">
                                    <v-card class="d-flex flex-column align-center"
                                        style="padding: 40px 0px;border-radius: 15px;">
                                        <img class="p-0 m-0" :src="base_url + `/images/icon/modern-buildings 23.png`" alt=""
                                            width="70" height="70" />
                                        <p class="fs-16 fw-500 mt-5">ใบเสร็จ รับค่าประกัน</p>

                                        <span @click="" class="review_approval_1"
                                            style="padding-right:10px ;border-radius: 25px;">
                                            <img class="ml-2 mr-2" :src="base_url + `/images/icon/printer 2.png`" alt=""
                                                width="20" height="20" />
                                            <div class="mr-2">พิมพ์</div>
                                        </span>
                                    </v-card>
                                </v-col>
                                <v-col cols="12" xs="12" sm="12" md="6" lg="3" xl="3">
                                    <v-card class="d-flex flex-column align-center"
                                        style="padding: 40px 0px;border-radius: 15px;">
                                        <img class="p-0 m-0" :src="base_url + `/images/icon/modern-buildings 24.png`" alt=""
                                            width="70" height="70" />
                                        <p class="fs-16 fw-500 mt-5">ใบเสร็จ รับค่าเช่าล่วงหน้า</p>

                                        <span @click="" class="review_approval_1"
                                            style="padding-right:10px ;border-radius: 25px;">
                                            <img class="ml-2 mr-2" :src="base_url + `/images/icon/printer 2.png`" alt=""
                                                width="20" height="20" />
                                            <div class="mr-2">พิมพ์</div>
                                        </span>
                                    </v-card>
                                </v-col>
                            </v-row>

                        </v-list-item>
                    </v-card>
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
            type: 0,
            loading_page: false,
            alert_success: false,
            alert_message_success: '',
            alert_error: false,
            alert_message_error: '',
            dialog_delete: false,
            dialog_complete: false,
            content_picture: [],
            readers: [],
            imagePreviewURL: null,
            id_delete: null,
            id_edit: null,
            dialog_payment: false,
            dialog_prin_id: null,
            dialog_prin: false,
            check_buyed_id: null,

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
                    text: 'สถานะ',
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
            // name_thaiRules: [
            //     v => !!v && v.length <= 120 || 'สูงสุด 120 ตัวอักษร',
            // ],
            // name_engRules: [
            //     v => !!v && v.length <= 120 || 'สูงสุด 120 ตัวอักษร',
            // ],
            name_thai: '',
            name_eng: '',
            page: 1,
            pages: 0,
            get_data_all: {},
            get_data: [],
            id_delete: null,
            doc_type_id: null,
            radio_payment_type: 1,
            slip_note: null,
            slip_total: 0.00,

        }
    },
    methods: {
        // อนุมัติคำร้อง
        async doc_typeUpdate(doc_type) {
            // if (this.$refs.form_payment_add.validate()) {
            let check_buyed = false
            // this.dialog_complete = false
            this.dialog_payment = false
            this.loading_page = true;
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }

            if (doc_type === 2) {

                await contract_block.contract_blockCheckBuyed(this.doc_type_id, config).then(async (result) => {
                    if (result.data.success === false) {
                        var existingNames = '';
                        // // เพิ่ม
                        result.data.data.map(block_name => {
                            // console.log(v)
                            if (existingNames !== '') {
                                existingNames += ' , ' + block_name;
                            } else {
                                existingNames = block_name;
                            }
                        })

                        check_buyed = true

                        // this.dialog_complete = false
                        this.alertData('error', 'ทำรายการไม่สำเร็จ', existingNames + ' ถูกยืนยันการเช่าไปแล้ว');
                        this.loading_page = false;
                        return
                    }
                })

                // หากแผงไม่ซ้ำ
                if (!check_buyed) {
                    // Upload Slip
                    if (this.content_picture.length !== 0) {
                        const data_img = new FormData()

                        data_img.append('id', this.doc_type_id);

                        this.content_picture.forEach((element) => {
                            data_img.append("slip_list[]", element);
                        });
                        await contract_block.contract_blockUploadSlip(data, config).then(async (result) => {
                            if (result.data.success === true) {
                                // this.dialog_complete = false
                                // await this.getList()
                                // this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                                // this.loading_page = false;
                            } else {
                                this.loading_page = false;
                                this.alertData('error', 'ทำรายการไม่สำเร็จ', result.data.message);
                            }
                        })
                    }

                    let data = {
                        "contract_data": {
                            "id": this.doc_type_id,
                            "doc_type": doc_type,
                            "slip_note": this.slip_note,
                            "pay_type": this.radio_payment_type
                        },
                        "block_list": []
                    }

                    await contract_block.contract_blockUpdate(data, config).then(async (result) => {
                        if (result.data.success === true) {
                            // this.dialog_complete = false
                            await this.getList()
                            this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                            this.loading_page = false;
                        } else {
                            this.loading_page = false;
                            this.alertData('error', 'ทำรายการไม่สำเร็จ', result.data.message);
                        }
                    }).catch((error) => {
                        if (error.response.status === 401) {
                            this.loading_page = false
                            this.$store.commit('logOutSuccess')
                            this.$router.push('/login')
                        }
                    })
                }


            } else if (doc_type === 1) {
                this.dialog_complete = false
                await contract_block.statusEdit(this.doc_type_id, config).then(async (result) => {
                    if (result.data.success === true) {
                        // this.dialog_complete = false
                        await this.getList()
                        this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                        this.loading_page = false;
                    } else {
                        this.loading_page = false;
                        this.alertData('error', 'ทำรายการไม่สำเร็จ', result.data.message);
                    }
                }).catch((error) => {
                    if (error.response.status === 401) {
                        this.loading_page = false
                        this.$store.commit('logOutSuccess')
                        this.$router.push('/login')
                    }
                })

            }
            // }

        },
        async managepanelrental_add() {
            window.localStorage.removeItem('managepanelrental_add');
            window.localStorage.removeItem('managepanelrental_add_select_block_list');
            this.$router.push('/managepanelrental/add');
        },

        async managepanelrental_edit(id) {
            window.localStorage.removeItem('managepanelrental_edit');
            window.localStorage.removeItem('managepanelrental_edit_select_block_list');
            this.$router.push(`/managepanelrental/edit?id=${this.base64Encode(id)}`);
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
                            total: item.total,
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



        // Delete renter By ID
        async renterDelete() {

            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            // await renter.renterDelete(this.id_delete, config).then((result) => {
            //     if (result.data.success === true) {
            //         this.getList()
            //         this.dialog_delete = false
            //         this.alert_success = true
            //         this.alert_message_success = 'ลบแบนเนอร์เรียบร้อยแล้ว'
            //         setTimeout(() => this.alert_success = false, 3000)
            //     }
            // }).catch((error) => {
            //     if (error.response.status === 401) {
            //         this.loading_page = false
            //         this.$store.commit('logOutSuccess')
            //         this.$router.push('/login')
            //     }
            // })

        },
        async dialogDelete(id) {
            this.id_delete = id
            this.dialog_delete = true
        },
        async dialogComplete(id) {
            this.doc_type_id = id
            this.dialog_complete = true
        },
        async dialogPayment(id, total) {
            this.content_picture = []
            this.readers = []
            this.radio_payment_type = 1
            this.slip_note = null
            this.slip_total = total

            this.doc_type_id = id
            this.dialog_payment = true
        },

        async dialogPrin(id) {
            this.dialog_prin_id = id
            this.dialog_prin = true
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


        // async onFileChange(payload) {
        //     const file = payload
        //     let extall = "png,PNG,jpeg,JPEG,jpg,JPG";
        //     let file_ext = file.name;

        //     let ext = file_ext.split('.').pop().toLowerCase();
        //     if (parseInt(extall.indexOf(ext)) < 0) {

        //         this.imagePreviewURL = this.base_url + `/images/image-list-slide.png`
        //         this.content_picture = null
        //     } else {
        //         if (file) {

        //             this.imagePreviewURL = URL.createObjectURL(file)
        //             console.log(this.imagePreviewURL);
        //             URL.revokeObjectURL(file)
        //         } else {
        //             this.imagePreviewURL = before_image
        //         }
        //     }
        // },
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

.text-green {
    color: #60A577;
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

.review_approval_1 {
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    text-wrap: nowrap;
    // width: 112px;
    height: 38px;
    border-radius: 25px;
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

.review_approval_4 {
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    text-wrap: nowrap;
    width: 94px;
    height: 21px;
    border-radius: 10px;
    background: linear-gradient(90deg, #1A96D4 0%, #78CBFA 100%);

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
