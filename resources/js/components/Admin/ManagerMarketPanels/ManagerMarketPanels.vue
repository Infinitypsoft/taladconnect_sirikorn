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
                    <h1 class="font-20 m-0">จัดการแผงตลาด</h1>
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
                                    ขนาดแผง
                                </v-card-title>
                                <v-card-subtitle class="p-0 mb-6">
                                    <v-row class="">

                                        <!-- Loop แสดง ขนาดแผง -->
                                        <v-col cols="12" xs="12" sm="12" md="6" lg="3" xl="3"
                                            v-for="(stallData, i) in stallData" :key="i">
                                            <v-card class="mx-auto" elevation="2" outlined>
                                                <v-list-item three-line>
                                                    <v-list-item-avatar class="rounded-lg" tile size="70"
                                                        :color="stallData.color_stall">
                                                        <v-icon class="" x-large>
                                                            mdi mdi-store
                                                        </v-icon>
                                                    </v-list-item-avatar>
                                                    <v-list-item-content>
                                                        <v-list-item-title class="text-h5 ">
                                                            <p class="mb-0 font-bold">{{ stallData.name }}</p>
                                                            <p class="font-16">ขนาด {{ stallData.size_w }}x{{
                                                                stallData.size_h }}
                                                                เมตร</p>
                                                        </v-list-item-title>
                                                    </v-list-item-content>
                                                </v-list-item>
                                            </v-card>
                                        </v-col>
                                        <v-col cols="12">
                                            <p class="font-18 font-bold mb-0 ml-1 mt-10 gray" color="">
                                                รูปแบบพื้นที่ให้เช่าทั้งหมด</p>
                                        </v-col>
                                    </v-row>
                                    <v-btn @click="dialog_building_add = true" class="btn-success pl-30 pr-30 mt-6" dark>
                                        <v-icon>mdi mdi-store</v-icon>
                                        <span>เพิ่มอาคาร</span>
                                    </v-btn>
                                    <v-row class="mt-5">
                                        <v-col cols="4" lg="2" md="2" class="d-flex align-center">
                                            <v-avatar class="mr-2" color="success" size="20"> </v-avatar>
                                            <span class="font-bold font-16">ว่างให้เช่า</span>
                                        </v-col>
                                        <v-col cols="4" lg="2" md="2" class="d-flex align-center">
                                            <v-avatar class="mr-2" color="warning" size="20"> </v-avatar>
                                            <span class="font-bold font-16">ปล่อยเช่าแล้ว</span>
                                        </v-col>
                                        <v-col cols="4" lg="2" md="2" class="d-flex align-center">
                                            <v-avatar class="mr-2" color="info" size="20"> </v-avatar>
                                            <span class="font-bold font-16">ปล่อยเช่าแล้วควบแผง</span>
                                        </v-col>
                                        <v-col cols="4" lg="2" md="2" class="d-flex align-center">
                                            <v-avatar class="mr-2" color="error" size="20"> </v-avatar>
                                            <span class="font-bold font-16">ไม่เปิดให้เช่า</span>
                                        </v-col>
                                    </v-row>
                                </v-card-subtitle>
                                <v-card-text>
                                    <v-row>
                                        <!-- Loop ปุ่มเลือก อาคาร -->
                                        <v-col cols="" v-for="(building, i) in buildingData" :key="i">
                                            <v-btn @click="onClickBuilding(building.id)" color="success"
                                                :class="site_id === building.id ? 'no-border' : 'no-border-all'"
                                                width="100%" outlined> {{
                                                    building.site_name }} </v-btn>
                                        </v-col>
                                    </v-row>
                                    <v-row class="mb-4">
                                        <v-col v-if="is_building_edit" cols="12" class="d-flex justify-space-between">
                                            <v-btn @click="is_block_delete_all ? onClickBlockDeleteAll() : ''"
                                                :class="is_block_delete_all ? 'btn-delete radius-30 mt-0' : 'btn-delete-disabled radius-30 mt-0'">
                                                <v-icon class="icon-btn" large color="white">
                                                    mdi-trash-can
                                                </v-icon>
                                                ลบแผงเช่าทั้งหมด
                                            </v-btn>
                                            <v-btn @click="is_building_edit = false" class="btn-back radius-30 mt-0">
                                                <v-icon left dark>
                                                    mdi-chevron-left
                                                </v-icon>
                                                ย้อนกลับ
                                            </v-btn>
                                        </v-col>
                                        <v-col v-else-if="buildingData.length > 0" cols="12">
                                            <v-btn @click="onClickBuildingEdit()" class="btn-edit radius-30 mt-0">
                                                <v-icon class="icon-btn" large color="white">
                                                    mdi-pencil
                                                </v-icon>
                                                แก้ไขข้อมูลผังอาคาร
                                            </v-btn>
                                        </v-col>
                                    </v-row>

                                    <!-- Loop สร้างตารางแผง -->
                                    <template>
                                        <v-simple-table :class="is_building_edit ? 'table-plan-edit' : 'table-plan-show'"
                                            style="border: 1px solid #d7d7d7;">
                                            <template v-slot:default>
                                                <tbody>
                                                    <tr v-for="_, index_long in siteData.long" :key="index_long">
                                                        <th v-for="_, index_width in siteData.width" :key="index_width"
                                                            @click="is_building_edit ? selectBlock(index_long + '|' + index_width) : ''"
                                                            :ref="index_long + '|' + index_width">
                                                            <!-- Your cell content here -->
                                                        </th>
                                                    </tr>
                                                </tbody>
                                            </template>
                                        </v-simple-table>
                                    </template>

                                    <v-row v-if="is_building_edit" class="text-center">
                                        <v-col cols="12">
                                            <v-btn :disabled="arr_index_add.length === 0"
                                                @click="dialogBlockAddOrEdit(null, '', 0, '-', 0, false, 1)"
                                                class="btn-success pl-30 pr-30 mt-6" color="warning" dark>
                                                <v-icon>mdi mdi-map-plus</v-icon>
                                                <span>เพิ่มแผงในพื้นที่อาคาร</span>
                                            </v-btn>
                                        </v-col>
                                    </v-row>
                                </v-card-text>
                            </v-col>
                        </v-row>
                    </v-card>
                </v-col>
            </v-row>

            <!-- เพิ่มแผงในพื้นที่อาคาร -->
            <v-dialog v-model="dialog_block_add_or_edit" width="1054">
                <v-card>
                    <v-card-title
                        class="text-h5 color-black fs-20 h-65 p-0 pl-30 pr-30 d-flex justify-space-between bg-F8F8F8">
                        <span>เพิ่มแผงในพื้นที่อาคาร</span>
                        <v-btn @click="() => { dialog_block_add_or_edit = false }" class="p-0 m-0" width="50" height="50"
                            style="min-width: 50px !important;">
                            <img class="p-0 m-0" :src="base_url + `/images/icon/close.png`" alt="Keyword" width="20"
                                height="20" />
                        </v-btn>
                    </v-card-title>
                    <v-card class="mt-2 p-5 pb-3 pt-3" elevation="0">
                        <v-form ref="form_block_add" v-on:submit.prevent="blockAddOrEdit()">
                            <v-list-item class="pl-0 pr-0 ml-0 mr-0">
                                <div class="row-list w-100" style="gap: 50px;">
                                    <div class="col-list d-flex flex-column justify-center align-center w-100 max-w-100">
                                        <v-card-text class="p-0 mt-2">
                                            <div class="d-flex align-center">
                                                <img class="mr-2" :src="base_url + `/images/icon/megaphonebook.png`"
                                                    alt="megaphonebook" width="20" height="20" dark />
                                                <span
                                                    class="font-16 color-title-card">ข้อมูลแผงที่ต้องการเพิ่มในพื้นที่อาคาร
                                                    <span class="text-error">*</span></span>
                                            </div>
                                        </v-card-text>
                                    </div>
                                </div>
                            </v-list-item>
                            <v-card-text class="p-0">
                                <v-row>
                                    <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                                        <p class="font-14 fw-500 color-707070">ชื่อแผง <span class="text-error">*</span></p>
                                        <v-text-field label="กรุณากรอกชื่อแผง" v-model="block_name" hide-details="auto"
                                            outlined dense single-line :rules="[v => !!v || 'ต้องระบุข้อมูลในช่องนี้']"
                                            required></v-text-field>
                                    </v-col>
                                    <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                        <p class="font-14 fw-500 color-707070">ขนาดแผง <span class="text-error">*</span></p>
                                        <v-select @change="setSizeSelectStall()" class="custom-v-select"
                                            v-model="stall_select_item_id" :items="stallData" item-value="id"
                                            item-text='name' hide-details="auto" outlined dense single-line
                                            :rules="[v => !!v || 'ต้องระบุข้อมูลในช่องนี้']" required
                                            label="กรุณาเลือกขนาดแผง">
                                        </v-select>

                                    </v-col>
                                    <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                        <p class="font-14 fw-500 color-707070">รายละเอียดแผง</p>
                                        <p class="fs-14 fw-500 mt-6 mb-0 color-707070" v-if="text_size_stall_on_select">{{
                                            text_size_stall_on_select }}</p>
                                        <p class="fs-14 fw-500 mt-6 mb-0 color-707070" v-else>-</p>
                                    </v-col>
                                </v-row>
                            </v-card-text>
                            <v-list-item v-if="arr_index_add.length === 0" class="pl-0 pr-0 ml-0 mr-0">
                                <div class="row-list w-100" style="gap: 50px;">
                                    <div class="col-list d-flex flex-column justify-center align-center w-100 max-w-100">
                                        <v-card-text class="p-0 mt-2">
                                            <div class="d-flex align-center">
                                                <img class="mr-2" :src="base_url + `/images/icon/store.png`" alt="store"
                                                    width="20" height="20" dark />
                                                <span class="font-16 color-title-card">สถานะการเปิดให่เช่าแผง
                                                    <span class="text-error">*</span></span>
                                            </div>
                                        </v-card-text>
                                    </div>
                                </div>
                            </v-list-item>
                            <v-card-text v-if="arr_index_add.length === 0" class="p-0">
                                <v-row>
                                    <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                                        <p class="font-14 fw-500 color-707070">การเปิดเช่าแผง <span
                                                class="text-error">*</span></p>
                                        <v-switch :disabled="!is_block_empty" v-model="stall_switch_open" inset
                                            color="#86D870"></v-switch>
                                    </v-col>
                                </v-row>
                            </v-card-text>
                            <v-card-actions class="d-flex justify-center">
                                <v-btn type="submit" class="btn-success pl-30 pr-30 mt-10" color="warning" dark>
                                    <v-icon class="fs-20" left dark>
                                        mdi-content-save
                                    </v-icon>
                                    <span>บันทึกข้อมูล</span>
                                </v-btn>
                            </v-card-actions>
                        </v-form>
                    </v-card>
                </v-card>
            </v-dialog>

            <!-- เพิ่มอาคาร -->
            <v-dialog v-model="dialog_building_add" width="1054">
                <v-card>
                    <v-card-title
                        class="text-h5 color-black fs-20 h-65 p-0 pl-30 pr-30 d-flex justify-space-between bg-F8F8F8">
                        <span>เพิ่มอาคาร</span>
                        <v-btn @click="() => { dialog_building_add = false }" class="p-0 m-0" width="50" height="50"
                            style="min-width: 50px !important;">
                            <img class="p-0 m-0" :src="base_url + `/images/icon/close.png`" alt="Keyword" width="20"
                                height="20" />
                        </v-btn>
                    </v-card-title>
                    <v-card class="mt-2 p-5 pb-3 pt-3" elevation="0">
                        <v-form ref="form_site_add" v-on:submit.prevent="buildingAdd()">
                            <v-list-item class="pl-0 pr-0 ml-0 mr-0">
                                <div class="row-list w-100" style="gap: 50px;">
                                    <div class="col-list d-flex flex-column justify-center align-center w-100 max-w-100">
                                        <v-card-text class="p-0 mt-2">
                                            <div class="d-flex align-center">
                                                <img class="mr-2" :src="base_url + `/images/icon/megaphonebook.png`"
                                                    alt="megaphonebook" width="20" height="20" dark />
                                                <span class="font-16 color-title-card">ข้อมูลอาคารที่ต้องการเพิ่ม</span>
                                            </div>
                                        </v-card-text>
                                    </div>
                                </div>
                            </v-list-item>
                            <v-card-text class="p-0">
                                <v-row>
                                    <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                                        <p class="font-14 mt-3 text-ex">ชื่ออาคาร <span class="text-error">*</span></p>
                                        <v-text-field label="กรุณากรอกชื่ออาคาร" v-model="site_name"
                                            :rules="[v => !!v || 'กรุณากรอกชื่ออาคาร']" hide-details="auto" outlined dense
                                            single-line required></v-text-field>
                                    </v-col>
                                    <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                        <p class="font-14 mt-3 text-ex">ความกว้าง (เมตร) <span class="text-error">*</span>
                                        </p>
                                        <v-text-field label="กรุณากรอกความกว้าง (เมตร)" v-model="width"
                                            @keypress="isNumberOnly($event, width)"
                                            :rules="[v => !!v || 'กรุณากรอกความกว้าง (เมตร)']" hide-details="auto" outlined
                                            dense single-line required></v-text-field>
                                    </v-col>
                                    <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                        <p class="font-14 mt-3 text-ex">ความยาว (เมตร) <span class="text-error">*</span></p>
                                        <v-text-field label="กรุณากรอกความยาว (เมตร)"
                                            :rules="[v => !!v || 'กรุณากรอกความยาว (เมตร)']" v-model="long"
                                            @keypress="isNumberOnly($event, long)" hide-details="auto" outlined dense
                                            single-line required></v-text-field>
                                    </v-col>
                                </v-row>
                            </v-card-text>
                            <v-card-actions class="d-flex justify-center">
                                <v-btn type="submit" class="btn-success pl-30 pr-30 mt-10" dark>
                                    <v-icon class="fs-20" left dark>
                                        mdi-content-save
                                    </v-icon>
                                    <span>บันทึกข้อมูล</span>
                                </v-btn>
                            </v-card-actions>
                        </v-form>
                    </v-card>
                </v-card>
            </v-dialog>

            <!-- Dialog Delete All-->
            <v-dialog v-model="dialog_block_delete_all" width="500">
                <v-card>
                    <v-card-text class="d-flex flex-column align-center pb-0">
                        <img class="mt-4 mb-8" :src="base_url + `/images/exclamation.png`" alt="image list slide"
                            width="130" max-width="130" height="auto" />
                        <h3 class="mag-modal mb-8">ท่านแน่ใจใช่ไหม ที่จะต้องการลบแผงเช่าทั้งหมด !</h3>
                    </v-card-text>

                    <v-card-actions class="d-flex justify-center">
                        <v-btn @click="blockDeleteAll()" class="btn-success mb-32 mr-4 pl-30 pr-30">
                            <span>ใช่ , ฉันต้องการลบ</span>
                        </v-btn>
                        <v-btn class="btn-danger mb-32 ml-4 pl-30 pr-30" @click="dialog_block_delete_all = false">
                            <span>ไม่ใช่</span>
                        </v-btn>
                    </v-card-actions>

                </v-card>
            </v-dialog>

            <!-- Dialog Delete By ID-->
            <v-dialog v-model="dialog_block_delete_by_id" width="500">
                <v-card>
                    <v-card-text class="d-flex flex-column align-center pb-0">
                        <img class="mt-4 mb-8" :src="base_url + `/images/exclamation.png`" alt="image list slide"
                            width="130" max-width="130" height="auto" />
                        <h3 class="mag-modal mb-8">ท่านแน่ใจใช่ไหม ที่จะต้องการลบแผงเช่า {{ block_name }} !</h3>
                    </v-card-text>

                    <v-card-actions class="d-flex justify-center">
                        <v-btn @click="blockDeleteById()" class="btn-success mb-32 mr-4 pl-30 pr-30">
                            <span>ใช่ , ฉันต้องการลบ</span>
                        </v-btn>
                        <v-btn class="btn-danger mb-32 ml-4 pl-30 pr-30" @click="dialog_block_delete_by_id = false">
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
import block from '../../../api/block.js';
import market_panels from '../../../api/market_panels.js';
// import { ref } from 'vue';
export default {
    data() {
        return {
            loading_page: false,

            alert_success: false,
            alert_message_success: '',
            alert_error: false,
            alert_message_error: '',

            dialog_block_delete_all: false,
            dialog_block_delete_by_id: false,
            block_delete_by_id: null,

            dialog_block_add_or_edit: false,
            dialog_block_add_or_edit_id: null,
            dialog_building_add: false,

            is_building_edit: false,
            building_edit_id: null,

            is_block_delete_all: false,
            block_delete_all_site_id: null,

            stall_switch_open: 1,
            is_block_empty: false,

            submenu: [
                {
                    text: 'จัดการสมาชิกผู้เช่า',
                    disabled: true,
                },
            ],
            site_id: null,
            buildingData: [],
            stallData: [],
            siteData: {},
            stall_select_item_id: 0,
            text_size_stall_on_select: null,

            // building
            site_name: null,
            width: null,
            long: null,

            arr_index_add: [],
            page: 1,
            pages: 10,
            block_name: '',
            block_status: 0,
            block_color: [],
            count_index: 1
        }
    },
    methods: {

        // เพิ่ม อาคาร
        async buildingAdd() {
            if (this.$refs.form_site_add.validate()) {
                this.loading_page = true
                let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.access_token}`,
                    },
                }
                const data = {
                    site_name: this.site_name,
                    width: this.width,
                    long: this.long,
                }
                await market_panels.buildingAdd(data, config).then(async (result) => {
                    if (result.data.success === true) {
                        this.loading_page = false
                        this.dialog_building_add = false
                        this.site_name = null
                        this.width = null
                        this.long = null

                        await this.buildingList() // ข้อมูล อาคาร
                        await this.stallList() // ข้อมูล ขนาดแผง
                        await this.siteList() // ข้อมูล อาคาร โดย ID
                        await this.getActiveColor() // สร้างสี บล็อก

                        this.is_building_edit = false

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
        },

        // เพิ่ม แผง
        async blockAddOrEdit() {
            if (this.$refs.form_block_add.validate()) {
                this.loading_page = true
                let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.access_token}`,
                    },
                }

                let data = new FormData();
                data.append('site_id', this.site_id);
                data.append('block_name', this.block_name);
                data.append('stall_size_id', this.stall_select_item_id);
                data.append('detail', this.text_size_stall_on_select);

                if (this.stall_switch_open === false && this.block_status === 0) {
                    data.append('status', 3);
                } else if (this.stall_switch_open === true && this.block_status === 3) {
                    data.append('status', 0);
                }

                if (this.dialog_block_add_or_edit_id) {
                    data.append('id', this.dialog_block_add_or_edit_id);

                    await block.blockUpdate(data, config).then(async (result) => {
                        if (result.data.success === true) {
                            this.dialog_block_add_or_edit = false

                            this.arr_index_add = []
                            this.stall_select_item_id = 0
                            this.text_size_stall_on_select = null
                            this.block_name = null

                            await this.siteList()
                            await this.getActiveColor()
                            this.loading_page = false
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
                    // สร้างฟังก์ชันเรียงข้อมูล
                    function customSort(a, b) {
                        const [aNum, aIndex] = a.split('|').map(Number);
                        const [bNum, bIndex] = b.split('|').map(Number);

                        // กำหนดลำดับตามตัวเลขแรก (aNum)
                        if (aNum < bNum) return -1;
                        if (aNum > bNum) return 1;

                        // ถ้าตัวเลขแรกเท่ากัน ให้กำหนดลำดับตามตัวเลขที่สอง (aIndex)
                        if (aIndex < bIndex) return -1;
                        if (aIndex > bIndex) return 1;

                        return 0; // ถ้า a และ b เท่ากัน
                    }

                    // เรียงลำดับอาร์เรย์
                    const sortedArray = this.arr_index_add.sort(customSort);

                    data.append('arr_index', sortedArray);

                    await block.blockAdd(data, config).then(async (result) => {
                        if (result.data.success === true) {
                            this.loading_page = false
                            this.dialog_block_add_or_edit = false

                            this.arr_index_add = []
                            this.stall_select_item_id = 0
                            this.text_size_stall_on_select = null
                            this.block_name = null

                            await this.siteList()
                            await this.getActiveColor()
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
        // ลบ แผง ทั้งหมด
        async blockDeleteAll() {
            this.loading_page = true
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }

            await block.blockDeleteAll({ id: this.block_delete_all_site_id }, config).then(async (result) => {
                if (result.data.success === true) {
                    this.loading_page = false
                    this.dialog_block_delete_all = false
                    this.is_block_delete_all = false
                    this.arr_index_add = []
                    this.stall_select_item_id = 0
                    this.text_size_stall_on_select = null
                    this.block_name = null

                    await this.siteList()
                    await this.getActiveColor()
                    this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');

                }
            }).catch((error) => {
                if (error.response.status === 401) {
                    this.loading_page = false
                    this.$store.commit('logOutSuccess')
                    this.$router.push('/login')
                }
            })
        },

        // ลบ แผง By ID
        async blockDeleteById() {
            this.loading_page = true
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await block.blockDelete(this.block_delete_by_id, config).then(async (result) => {
                if (result.data.success === true) {
                    this.loading_page = false
                    this.is_block_delete_all = false
                    this.arr_index_add = []
                    this.stall_select_item_id = 0
                    this.text_size_stall_on_select = null
                    this.block_name = null

                    this.block_delete_by_id = null
                    this.dialog_block_delete_by_id = false

                    await this.siteList()
                    await this.getActiveColor()
                    this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');

                }
            }).catch((error) => {
                if (error.response.status === 401) {
                    this.loading_page = false
                    this.$store.commit('logOutSuccess')
                    this.$router.push('/login')
                }
            })
        },

        // ข้อมูล ขนาดแผง
        async stallList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await stall.stallList(this.page, '', config).then((result) => {
                if (result.data.success === true) {
                    this.stallData = result.data.data
                }
            })
        },



        // ข้อมูล อาคาร
        async buildingList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await market_panels.buildingList(config).then((result) => {
                if (result.data.success === true) {
                    this.buildingData = result.data.data;
                    this.site_id = result.data.data[0].id
                }

            }).catch((error) => {
                if (error.response.status === 401) {
                    this.loading_page = false
                    this.$store.commit('logOutSuccess')
                    this.$router.push('/login')
                }
            })
        },

        // ข้อมูล อาคาร โดย ID
        async siteList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            this.loading_page = true

            await market_panels.siteList(this.site_id, config).then((result) => {
                if (result.data.success === true) {
                    this.siteData = result.data.data;
                    this.siteData.long = parseFloat(result.data.data.long) * 2
                    this.siteData.width = parseFloat(result.data.data.width) * 2
                    this.loading_page = false
                }
            }).catch((error) => {
                if (error.response.status === 401) {
                    this.loading_page = false
                    this.$store.commit('logOutSuccess')
                    this.$router.push('/login')
                }
            })
        },

        async onClickBuilding(id) {
            this.site_id = id
            this.siteData = {}
            this.is_block_delete_all = false;
            await this.siteList() // ข้อมูล อาคาร โดย ID
            await this.getActiveColor() // สร้างสี บล็อก
        },

        async onClickBuildingEdit() {
            this.building_edit_id = this.site_id
            this.is_building_edit = true
        },

        async onClickBlockDeleteAll() {
            this.block_delete_all_site_id = this.site_id
            this.is_block_delete_all = true
            this.dialog_block_delete_all = true
        },

        async onClickBlockDeleteByID(id, block_name) {
            this.block_delete_by_id = id
            this.dialog_block_delete_by_id = true
            this.block_name = block_name
        },

        async dialogBlockAddOrEdit(id, block_name, stall_size_id, detail, status, is_block_empty, status_id) {
            this.dialog_block_add_or_edit = true
            this.dialog_block_add_or_edit_id = id
            this.block_name = block_name
            this.stall_select_item_id = stall_size_id
            this.text_size_stall_on_select = detail
            this.stall_switch_open = status
            this.is_block_empty = is_block_empty
            this.block_status = status_id
        },

        // เลือก บล็อกแผง
        async selectBlock(cellKey) {
            const cell = this.$refs[cellKey][0];
            if (cell.style.backgroundColor === 'rgb(134, 215, 128)') {
                // ลบ
                this.arr_index_add = this.arr_index_add.filter(item => item !== cellKey);
                cell.style.removeProperty('background-color');
                cell.style.removeProperty('background-image');
                cell.style.removeProperty('background-position');
            } else if (cell.style.backgroundColor === '') {
                // เพิ่ม
                this.arr_index_add.push(cellKey)
                cell.style.setProperty('background-color', '#86D780', 'important');
                cell.style.setProperty('background-image', `url("${this.base_url}/images/icon/check.png")`, 'important');
                cell.style.setProperty('background-position', 'center', 'important');
            }

        },

        // 
        async setSizeSelectStall() {
            this.stallData.map(v => {
                if (v.id === this.stall_select_item_id) {
                    this.text_size_stall_on_select = `ขนาด ${parseFloat(v.size_w).toString()}x${parseFloat(v.size_h).toString()} เมตร `
                    return
                }
            })
        },

        // สร้างสี บล็อก
        async getActiveColor() {
            this.loading_page = true
            this.siteData.block_list.map(data => {
                const sanitizedString = data.arr_index.replace(/"/g, ''); // Remove the double quotes
                const resultArray = sanitizedString.split(',');
                resultArray.map((cellKey, i) => {
                    if (this.$refs[cellKey]) {
                        const cell = this.$refs[cellKey][0];

                        // Icon Status
                        if (i === 0) {
                            if (data.status === 0) {
                                cell.innerHTML = `
                                    <div style="display: flex;align-items: center; justify-content: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 22" fill="none">
                                        <circle cx="11" cy="11" r="11" fill="url(#paint0_linear_277_99)"/>
                                        <defs>
                                            <linearGradient id="paint0_linear_277_99" x1="22" y1="11" x2="0" y2="11" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#65AB79"/>
                                            <stop offset="1" stop-color="#81D180"/>
                                            </linearGradient>
                                        </defs>
                                        </svg>
                                    </div>
                                `;
                                this.is_block_delete_all = true;
                            } else if (data.status === 1) {
                                cell.innerHTML = `
                                    <div style="display: flex;align-items: center; justify-content: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 22" fill="none">
                                            <circle cx="11" cy="11" r="11" fill="url(#paint0_linear_277_102)"/>
                                            <defs>
                                            <linearGradient id="paint0_linear_277_102" x1="22" y1="11" x2="0" y2="11" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FF7101"/>
                                            <stop offset="1" stop-color="#FFC301"/>
                                            </linearGradient>
                                            </defs>
                                        </svg>
                                    </div>
                                `;
                            } else if (data.status === 2) {
                                cell.innerHTML = `
                                    <div style="display: flex;align-items: center; justify-content: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 22" fill="none">
                                        <circle cx="11" cy="11" r="11" fill="url(#paint0_linear_277_108)"/>
                                        <defs>
                                            <linearGradient id="paint0_linear_277_108" x1="22" y1="11" x2="0" y2="11" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#0F00B6"/>
                                            <stop offset="1" stop-color="#9DA7FC"/>
                                            </linearGradient>
                                        </defs>
                                        </svg>
                                    </div>
                                `;
                            } else if (data.status === 3) {
                                cell.innerHTML = `
                                    <div style="display: flex;align-items: center; justify-content: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 22" fill="none">
                                        <circle cx="11" cy="11" r="11" fill="url(#paint0_linear_277_105)"/>
                                        <defs>
                                            <linearGradient id="paint0_linear_277_105" x1="22" y1="11" x2="0" y2="11" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#A90A13"/>
                                            <stop offset="1" stop-color="#DD0322"/>
                                            </linearGradient>
                                        </defs>
                                        </svg>
                                    </div>
                                `;
                                this.is_block_delete_all = true;
                            }
                            cell.style.setProperty('background-position', 'center', 'important');
                        }

                        // ปล่อยเช่าแล้วควบแผง <img src="${this.base_url}/images/icon/info.png" title=""/>
                        if (i === 1) {
                            cell.innerHTML = `
                                <div class="custom-tooltip-hover" style="display: flex;align-items: center; justify-content: center; position: relative;">
                                    <svg width="22" height="22"  fill="#D9D9D9" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z" />
                                    </svg>
                                    <span class="custom-tooltip">เช่า G12,G25</span>
                                </div>
                            `;
                        }
                        // ชื่อแผง
                        if (i === 2) {
                            cell.innerHTML = `
                                <div style="position: relative;display: flex;align-items: center;">
                                    <span style="position: absolute; font-size:14px;">${data.block_name}</span>
                                </div>
                            `;
                        }

                        cell.addEventListener('click', () => {
                            if (!this.is_building_edit) {
                                this.dialogBlockAddOrEdit(data.id, data.block_name, data.stall_size_id, data.detail, data.status === 3 ? 0 : 1, data.status === 0 || data.status === 3, data.status)
                            } else if (data.status != 1 && data.status != 2) {
                                this.onClickBlockDeleteByID(data.id, data.block_name)
                            }
                        });

                        cell.style.setProperty('background-color', data.color_stall, 'important');
                    }
                })
            })
            this.loading_page = false
        }
    },
    created() {
    },
    async mounted() {
        this.imagePreviewURL = this.base_url + '/images/image-list-slide.png'
        this.loading_page = true
        await this.stallList() // ข้อมูล ขนาดแผง
        await this.buildingList() // ข้อมูล อาคาร
        await this.siteList() // ข้อมูล อาคาร โดย ID
        this.getActiveColor() // สร้างสี บล็อก
        this.loading_page = false
    },
}
</script>

<style lang="scss">
.custom-tooltip {
    position: absolute;
    border-radius: 5px;
    border: 1px solid #F8F8F8;
    background: #FFF;
    box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
    padding: 12px;
    z-index: 1;
    bottom: -48px;
    left: 8px;

    color: #707070;
    font-size: 12px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    text-wrap: nowrap;
    display: none;

    &:hover {
        display: block !important;
    }
}

.custom-tooltip-hover {
    &:hover {
        .custom-tooltip {
            display: block !important;
        }
        fill: #eaeaea;
    }
}

.table-plan-show {
    table {
        width: fit-content !important;
    }

    tbody {
        border: 0.5px solid #949494;
    }

    th {
        background-color: #fff !important;

        border: none !important;
        width: 30px !important;
        height: 30px !important;
        min-width: 30px !important;
        padding: 0 !important;

    }
}

.table-plan-edit {
    table {
        width: fit-content !important;
    }

    th {
        background-color: #fff !important;

        border: 0.5px solid #D9D9D9 !important;
        width: 30px !important;
        height: 30px !important;
        min-width: 30px !important;
        padding: 0 !important;

        &:hover {
            background-color: #d5d5d5 !important;
        }
    }
}
</style>
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

    .icon-btn {
        font-size: 24px !important;
        margin-right: 10px;
    }
}

.btn-delete {
    background: linear-gradient(90deg, #E20122 0%, #960B0C 100%);
    box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);

    color: #F9F9F9;
    font-size: 16px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;

    .icon-btn {
        font-size: 24px !important;
        margin-right: 10px;
    }
}

.btn-delete-disabled {
    background: #D9D9D9 !important;
    box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);

    color: #F9F9F9 !important;
    font-size: 16px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;

    .icon-btn {
        font-size: 24px !important;
        margin-right: 10px;
    }
}

.btn-back {
    border-radius: 30px;
    border: 1px solid var(--primary-button, #86D780) !important;
    box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
    background: #fff !important;

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
</style>
