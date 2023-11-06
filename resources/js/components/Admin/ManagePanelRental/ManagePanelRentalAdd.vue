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
            <v-row>
                <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                    <v-card elevation="2">
                        <v-row class="m-0 p-4">
                            <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                                <v-card-title class="p-0 pb-5 justify-space-between text-card-title">
                                    สร้างการเช่าแผงใหม่
                                </v-card-title>
                                <v-form ref="form_panelrental_add" v-on:submit.prevent="persist">
                                    <v-card-subtitle class="p-0 mb-6">
                                        <v-row class="">
                                            <v-col cols="12">
                                                <img class="mr-2"
                                                    :src="base_url + `/images/icon/a97d9bb00d624b994fee78c2738c1c8e.png`"
                                                    alt="" width="20" height="20" />
                                                <span class="font-16 color-title-card">ข้อมูลผู้เช่า</span>
                                            </v-col>
                                            <v-col cols="12" xs="12" sm="12" md="12" lg="5" xl="6">
                                                <p class="font-14 text-ex fs-16 fw-500">ผู้เช่า
                                                    <span style="color: red;">*</span>
                                                </p>
                                                <v-select class="custom-v-select" v-model="tenant_select_type"
                                                    hide-details="auto" item-value="id" item-text='name'
                                                    :items="tenant_lists" outlined dense single-line
                                                    label="กรุณาเลือกผู้เช่า" @change="tenant_selectChanged"
                                                    :rules="rules.tenant_select_type" required></v-select>
                                            </v-col>
                                            <v-col cols="12" xs="12" sm="12" md="6" lg="4" xl="3">
                                                <p class="font-14 text-ex fs-16 fw-500">
                                                    เลขบัตรประชาชน/เลขประจำตัวผู้เสียภาษีอากร
                                                    <span style="color: red;">*</span>
                                                </p>
                                                <v-text-field hide-details="auto" label="x-xxxx-xxxxx-xx-x"
                                                    v-model="id_card" :counter="13" @keypress="isIDCard($event, id_card)"
                                                    :rules="rules.id_card" outlined dense single-line
                                                    required></v-text-field>
                                            </v-col>
                                            <v-col cols="12" xs="12" sm="12" md="6" lg="3">
                                                <p class="font-14 text-ex fs-16 fw-500">เบอร์โทร
                                                    <span style="color: red;">*</span>
                                                </p>
                                                <v-text-field hide-details="auto" label="กรุณากรอกเบอร์โทร"
                                                    :rules="rules.phone" :counter="10" v-model="phone" outlined dense
                                                    single-line @keypress="isTelephone($event, phone)"
                                                    required></v-text-field>
                                            </v-col>
                                            <v-col cols="12">
                                                <p class="font-14 text-ex fs-16 fw-500">ที่อยู่
                                                    <span style="color: red;">*</span>
                                                </p>
                                                <v-text-field hide-details="auto" label="กรุณากรอกที่อยู่" v-model="address"
                                                    outlined dense single-line required></v-text-field>
                                            </v-col>
                                        </v-row>
                                        <v-row class="">
                                            <v-col cols="12">
                                                <img class="mr-2"
                                                    :src="base_url + `/images/icon/a97d9bb00d624b994fee78c2738c1c8e.png`"
                                                    alt="" width="20" height="20" />
                                                <span class="font-16 color-title-card">ข้อมูแผงค้าที่ต้องการเช่า</span>
                                            </v-col>
                                            <v-col cols="12" lg="12" md="12">
                                                <p class="font-14 text-ex fs-16 fw-500">รายการแผงค้า
                                                    <span style="color: red;">*</span>
                                                </p>
                                                <v-select class="custom-v-select" v-model="stall_select_type"
                                                    hide-details="auto" item-value="id" item-text='name'
                                                    :items="stall_lists" outlined dense single-line
                                                    label="กรุณาเลือกแผงค้า"></v-select>
                                            </v-col>
                                        </v-row>

                                    </v-card-subtitle>
                                    <v-card-text>
                                        <v-row class="mb-2">
                                            <!-- Loop ปุ่มเลือก อาคาร -->
                                            <v-col cols="" v-for="(building, i) in buildingData" :key="i">
                                                <v-btn @click="onClickBuilding(building.id)" color="success"
                                                    :class="site_id === building.id ? 'no-border font-18' : 'no-border-all font-18'"
                                                    width="100%" outlined>
                                                    {{ building.site_name }}
                                                </v-btn>
                                            </v-col>
                                        </v-row>

                                        <!-- Loop สร้างตารางแผง -->
                                        <template>
                                            <v-simple-table class="table-plan-show" style="border: 1px solid #d7d7d7;">
                                                <template v-slot:default>
                                                    <tbody>
                                                        <tr v-for="_, index_long in siteData.long" :key="index_long">
                                                            <th v-for="_, index_width in siteData.width" :key="index_width"
                                                                :ref="index_long + '|' + index_width">
                                                                <!-- Your cell content here -->
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </template>
                                            </v-simple-table>
                                        </template>

                                        <v-row class="text-center">
                                            <v-col cols="12">
                                                <v-btn :disabled="select_block_list.length === 0" type="submit" outlined
                                                    class="btn pl-30 pr-30 mt-6 font-16 rounded-xl" color="success">
                                                    <span>ถัดไป ></span>
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
import stall from '../../../api/stall.js';
import tennant from '../../../api/tennant.js';
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
            dialog_block_add_or_edit: false,
            submenu: [
                {
                    text: 'ทำสัญญาเช่าแผง',
                    disabled: false,
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
            stall_select_item_id: 0,
            size_stall_on_select: null,
            arr_index_add: [],
            page: 1,
            pages: 10,
            block_name: '',
            block_color: [],
            count_index: 1,
            id_card: null,
            phone: null,
            address: null,
            rules: {
                phone: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                id_card: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                tenant_select_type: [val => !!val || 'ต้องระบุข้อมูลในช่องนี้'],
            },

            // ผู้เช่า
            tenant_data: [],
            tenant_select_type: 0,
            tennant_name: null,
            tenant_lists: [],
            vat_type: 0,

            // รายการแผงค้า
            stall_select_type: 0,
            stall_lists: [
                { id: 1, name: '' }
            ],
            select_block_list: [],

            // ภาษี
            annual_fee: 0, // 	ค่าธรรมเนียมรายปี
            guarantee_service_rate: 0.00, //ค่าประกันการเช่าและบริการ
            guarantee_water_rate: 0.00, //อัตราค่าประกันมิเตอร์น้ำ
            guarantee_electricity_rate: 0.00, //อัตราค่าประกันมิเตอร์ไฟ
            guarantee_hood_rate: 0.00, //อัตราค่าประกันเครื่องดูดควัน
            cost_rental_rate: 0.00, //ค่าเช่า
            cost_common_rate: 0.00, //ค่าส่วนกลาง

        }
    },
    methods: {

        // Get List renter
        async getListRenter() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await tennant.tennantList(this.page, '', config).then((result) => {
                if (result.data.success === true) {
                    this.tenant_data = result.data.data;
                    // this.vat_type = 
                    this.tenant_lists = result.data.data.map(item => {
                        return {
                            id: item.id,
                            name: item.name !== null ? item.name : item.company_name,
                        }
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

        // เลือก ผู้เช่า
        async tenant_selectChanged(value) {
            this.tenant_data.map(v => {
                if (v.id === value) {
                    this.id_card = v.tennant_type === 0 ? v.personal_id : v.tax_number
                    this.phone = v.tel === null ? '-' : v.tel
                    this.address = v.address === null ? '-' : v.address
                    this.tennant_name = v.tennant_type === 0 ? v.name : v.company_name
                    this.vat_type = v.vat_type
                    return
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


        // เลือก บล็อกแผง
        async selectBlock(
            cellKey,
            block_id,
            block_name,
            stall_size_id,
            stall_size_name,
            annual_fee,
            cost_rental_rate,
            cost_common_rate,
            guarantee_service_rate,
            guarantee_water_rate,
            guarantee_electricity_rate,
            guarantee_hood_rate,
        ) {

            var yElement = document.getElementById(`${cellKey}-y`);
            var nElement = document.getElementById(`${cellKey}-n`);

            if (nElement.style.display === 'flex') {
                //เพิ่ม
                this.annual_fee += annual_fee
                this.cost_rental_rate += cost_rental_rate
                this.cost_common_rate += cost_common_rate
                this.guarantee_service_rate += guarantee_service_rate
                this.guarantee_water_rate += guarantee_water_rate
                this.guarantee_electricity_rate += guarantee_electricity_rate
                this.guarantee_hood_rate += guarantee_hood_rate

                // 
                this.select_block_list = [
                    ...this.select_block_list,
                    {
                        "block_id": block_id,
                        "block_name": block_name,
                        "stall_size_id": stall_size_id,
                        "stall_size_name": stall_size_name,
                        "annual_fee": annual_fee,
                        "insurance_cost": guarantee_service_rate,
                        "guarantee_water_rate": guarantee_water_rate,
                        "guarantee_electricity_rate": guarantee_electricity_rate,
                        "guarantee_hood_rate": guarantee_hood_rate,
                        "rent_cost": cost_rental_rate,
                        "common_fee": cost_common_rate,
                    }
                ]


                nElement.style.display = "none";
                yElement.style.display = "flex";
            } else {
                //ลบ
                this.annual_fee -= annual_fee
                this.cost_rental_rate -= cost_rental_rate
                this.cost_common_rate -= cost_common_rate
                this.guarantee_service_rate -= guarantee_service_rate
                this.guarantee_water_rate -= guarantee_water_rate
                this.guarantee_electricity_rate -= guarantee_electricity_rate
                this.guarantee_hood_rate -= guarantee_hood_rate

                // 
                this.select_block_list = this.select_block_list.filter(v => v.block_id !== block_id)

                nElement.style.display = "flex";
                yElement.style.display = "none";

            }

            var existingNames = this.stall_lists[0].name;
            if (!existingNames.includes(block_name)) {
                if (existingNames.length > 0) {
                    existingNames += ' , ' + block_name;
                } else {
                    existingNames = block_name;
                }
                this.stall_lists[0].name = existingNames;
            } else {
                var namesArray = existingNames.split(' , ');
                if (namesArray.includes(block_name)) {
                    namesArray = namesArray.filter(name => name !== block_name);
                    existingNames = namesArray.join(' , ');
                    this.stall_lists[0].name = existingNames;
                }
            }

            if (existingNames.length > 0) {
                this.stall_select_type = 1
            } else {
                this.stall_select_type = 0
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
                let firstCellKeyresultArray = resultArray[0]
                resultArray.map((cellKey, i) => {
                    if (this.$refs[cellKey]) {
                        const cell = this.$refs[cellKey][0];

                        // บล็อกถูกเลือกไปแล้ว
                        if (data.tennant_member_id !== null || data.status === 3) {
                            cell.style.setProperty('background-color', "#F8F8F8", 'important');
                            return
                        }

                        if (i === 0) {
                            cell.innerHTML = `
                            <div id="${firstCellKeyresultArray}-y" style="display: none;align-items: center; justify-content: center;">
                                <img src="${this.base_url}/images/icon/is_check.png" width="22" height="22" title="" style="border-radius: 4px; "/>
                            </div>
                            <div id="${firstCellKeyresultArray}-n" style="display: flex;align-items: center; justify-content: center;">
                                <img src="${this.base_url}/images/icon/none_check.png" width="22" height="22" title="" style="border-radius: 4px; "/>
                            </div>
                            `
                        }

                        cell.addEventListener('click', () => {
                            this.selectBlock(
                                firstCellKeyresultArray,
                                data.id, // id ตาราง block
                                data.block_name,
                                data.stall_size_id, // 	id ตาราง stall
                                data.name, // ชื่อ ขนาดแผง ณ ตอนเช่า

                                parseFloat(data.annual_fee), //ค่าธรรมเนียม (สัญญา)
                                parseFloat(data.cost_rental_rate), //ค่าเช่า
                                parseFloat(data.cost_common_rate), //ค่าส่วนกลาง

                                parseFloat(data.guarantee_service_rate), //ประกันการเช่าและบริการ
                                parseFloat(data.guarantee_water_rate), //ประกันมิเตอร์น้ำ
                                parseFloat(data.guarantee_electricity_rate), //ประกันมิเตอร์ไฟ
                                parseFloat(data.guarantee_hood_rate), //ประกันเครื่องดูดควัน
                            )
                        });

                        cell.style.setProperty('background-color', data.color_stall, 'important');
                    }
                })
                var namesArray = this.stall_lists[0].name.split(' , ')
                namesArray.map(name => {
                    if (name === data.block_name) {
                        document.getElementById(`${firstCellKeyresultArray}-n`).style.display = "none";
                        document.getElementById(`${firstCellKeyresultArray}-y`).style.display = "flex";
                    }
                })
            })
            this.loading_page = false
        },
        persist() {
            if (this.$refs.form_panelrental_add.validate()) {
                const setAddObject = {
                    id_card: this.id_card,
                    phone: this.phone,
                    address: this.address,
                    tenant_select_type: this.tenant_select_type,
                    tennant_name: this.tennant_name,
                    vat_type: this.vat_type,
                    stall_select_type: this.stall_select_type,
                    stall_lists_name: this.stall_lists[0].name,

                    annual_fee: this.annual_fee,
                    guarantee_service_rate: this.guarantee_service_rate,
                    guarantee_water_rate: this.guarantee_water_rate,
                    guarantee_electricity_rate: this.guarantee_electricity_rate,
                    guarantee_hood_rate: this.guarantee_hood_rate,
                    cost_rental_rate: this.cost_rental_rate,
                    cost_common_rate: this.cost_common_rate,
                }

                window.localStorage.setItem("managepanelrental_add", JSON.stringify(setAddObject));
                window.localStorage.setItem("managepanelrental_add_select_block_list", JSON.stringify(this.select_block_list));
                this.$router.push('/managepanelrental/addsteptwo')
            }
        },
    },
    created() {
    },
    async mounted() {
        this.imagePreviewURL = this.base_url + '/images/image-list-slide.png'
        this.loading_page = true
        await this.stallList() // ข้อมูล ขนาดแผง
        this.loading_page = true
        await this.buildingList() // ข้อมูล อาคาร
        this.loading_page = true
        await this.siteList() // ข้อมูล อาคาร โดย ID
        this.loading_page = true
        this.getListRenter()
        this.loading_page = true
        // annual_fee ค่าธรรมเนียมรายปี
        // annual_fee_discount 	ส่วนลดค่าธรรมเนียมรายปี
        // "guarantee_service_rate": 100.00,//ค่าประกันการเช่าและบริการ
        // "insurance_discount": 10.00, //ส่วนลดค่าประกันการเช่าและบริการ
        // guarantee_water_rate อัตราค่าประกันมิเตอร์น้ำ
        // guarantee_water_rate_discount ส่วนลดอัตราค่าประกันมิเตอร์น้ำ
        // guarantee_electricity_rate อัตราค่าประกันมิเตอร์ไฟ
        // guarantee_electricity_rate_discount ส่วนลดอัตราค่าประกันมิเตอร์ไฟ
        // guarantee_hood_rate อัตราค่าประกันเครื่องดูดควัน
        // guarantee_hood_rate_discount ส่วนลดอัตราค่าประกันเครื่องดูดควัน
        // "cost_rental_rate": 500.00, // ส่วนลดค่าเช่า
        // "rent_discount": 50.00, // ส่วนลดค่าเช่า
        // "cost_common_rate": 50.00,  // ค่าส่วนกลาง
        // "cost_common_rate_discount": 5.00, // ส่วนลดค่าส่วนกลาง
        // "other_cost": 20.00, // ค่าอื่นๆ
        // "other_discount": 2.00, // ส่วนลดค่าอื่นๆ
        // "tax_status": 1, // 1 = ไม่คิดภาษี 2 = คิดภาษี 3 = ภาษีรวมนอก
        // "tax_cost": 3, // เปอเซนภาษี
        // "vat_cost": 7,// ภาษีหัก ณ ที่จ่าย
        // "total": 705.50, // ยอดเงินทั้งหมด
        // "line_status": 1, //	0 = ไม่ส่งอัตโนมัติ 1 = ส่งอัตโนมัติ
        // "send_type": 0, // รอบการส่งบิลเรียกเก็บ 0 = รายวัน | 1 = รายสัปดาห์ | 2 = รายเดือน | 3 = รายปี
        // "date_send": 1, // send_type = 1 ใช้เงื่อนไขอันนี้เช็ค 0 = วันอาทิตย์ 1 = จันทร์ ... 6 = วันเสาร์ | send_type = 2 ใช้เงื่อนไขอันนี้เช็ค วันที่ 15,20,25 0 คือ วันสุดท้ายของเดือน | send_type = 3 เก็บวันที่
        // "month_send": 2 // send_type = 3 จะเก็บเดือน
        // doc_type	ชนิดเอกสาร (0 = เอกสารร่าง, 1 = ยืนยันการเช่า)
        // date_confirm วันที่ที่คอนฟิม ยืนยันการเช่า

        let managepanelrental_add = window.localStorage.getItem("managepanelrental_add");
        if (managepanelrental_add) {
            const data = JSON.parse(managepanelrental_add)
            this.vat_type = data.vat_type
            this.id_card = data.id_card
            this.phone = data.phone
            this.address = data.address
            this.tenant_select_type = data.tenant_select_type
            this.tennant_name = data.tennant_name
            this.stall_select_type = data.stall_select_type
            this.stall_lists[0].name = data.stall_lists_name

            this.annual_fee = data.annual_fee
            this.guarantee_service_rate = data.guarantee_service_rate
            this.guarantee_water_rate = data.guarantee_water_rate
            this.guarantee_electricity_rate = data.guarantee_electricity_rate
            this.guarantee_hood_rate = data.guarantee_hood_rate
            this.cost_rental_rate = data.cost_rental_rate
            this.cost_common_rate = data.cost_common_rate
        }
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
