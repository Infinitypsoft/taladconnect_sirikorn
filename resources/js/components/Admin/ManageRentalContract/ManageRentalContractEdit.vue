<template>
    <div class="loading_all_page" v-if="loading_page === true">
        <v-progress-circular indeterminate size="70" :width="8" color="#FFBC15"></v-progress-circular>
        <p class="mt-3">กำลังโหลดข้อมูล</p>
    </div>

    <div v-else>
        <div class="container">
            <div class="d-flex justify-space-between align-items-center mt-4 mb-4">
                <v-card-text class="p-0">
                    <h1 class="font-20 m-0">จัดการสัญญาเช่าพื้นที่</h1>
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
                    <v-row class="container-title">
                        <v-col xs="12" sm="12" md="6" lg="6" xl="6">
                            <p>แก้ไขสัญญาบริการเช่าพื้นที่ในอาคาร</p>
                        </v-col>
                        <v-col class="container-title-left" xs="12" sm="12" md="6" lg="6" xl="6">

                        </v-col>
                    </v-row>
                </v-card-title>
                <v-form ref="form_contract_update" v-on:submit.prevent="contractUpdate()">
                    <div class="container d-flex justify-center">
                        <v-card class="w-1226 h-1781 d-flex justify-center" elevation="2">
                            <div class="w-925 position-relative">
                                <div
                                    style="width: 264px; height: 295px; background: #0095D2; padding-left: 23px; padding-top: 57px;">
                                    <v-img width="222" height="222"
                                        :src="this.base_url + `/images/72838c35985b53194fdf8b11a2ce8f4e.png`" />
                                </div>

                                <h1 class="fs-46 fw-500 text-black position-absolute" style="top: 226px;right: 20px;">
                                    สัญญาบริการเช่าพื้นที่ในอาคาร
                                </h1>

                                <p class="fs-18 fw-300 text-black position-absolute" style="top: 339px;">
                                    ทำที่ บริษัท อิ่มเอมบารมี จำกัด (สำนักงานใหญ่)<br />
                                    77/7 ตำบลปากเพรียว อำเภอเมืองสระบุรี จังหวัดสระบุรี 18000<br />
                                    โทร. 080-583-8888 เลขประจำตัวผู้เสียภาษี 0195564001531
                                </p>

                                <p class="fs-18 fw-300 text-black position-absolute d-flex gap-4"
                                    style="top: 464px; left: 328px;">
                                    วันที่ <span class="txt-data mr-2" style="width: 50px">
                                        <v-text-field hide-details="auto" v-model="day" @keypress="isDay($event, day)"
                                            class="label-color centered-input" flat solo label="DD"></v-text-field>
                                    </span>
                                    เดือน <span class="txt-data mr-2" style="width: 80px"><v-text-field hide-details="auto"
                                            v-model="month" class="label-color centered-input" flat solo dense
                                            label="MMMM"></v-text-field></span>
                                    พ.ศ <span class="txt-data" style="width: 100px"><v-text-field hide-details="auto"
                                            v-model="year" @keypress="isYear($event, year)" class="label-color" flat solo
                                            dense label="YYYY"></v-text-field></span>
                                </p>

                                <p class="fs-18 fw-300 text-black position-absolute d-flex gap-1" style="top: 520px;">
                                    สัญญาฉบับนี้ทำขึ้นระหว่าง
                                    <span class="txt-data ml-4" style="width: 170px">
                                        <v-text-field hide-details="auto" v-model="name_tenant" class="label-color" flat
                                            solo dense label="คำนำหน้า ชื่อ-สกุลผู้เช่า"></v-text-field>
                                    </span>
                                    ถือบัตรประชาชน
                                    <span class="txt-data ml-4" style="width: 160px">
                                        <v-text-field hide-details="auto" v-model="id_card"
                                            @keypress="isIDCard($event, id_card)" class="label-color" flat solo dense
                                            label="x-xxxx-xxxxx-xx-x"></v-text-field>
                                    </span>
                                    อายุ
                                    <span class="txt-data ml-4" style="width: 33px">
                                        <v-text-field hide-details="auto" v-model="age" @keypress="isAge($event, age)"
                                            class="label-color" flat solo dense label="xx"></v-text-field>
                                    </span>
                                    ปี อาศัยอยู่
                                </p>

                                <p class="fs-18 fw-300 text-black position-absolute d-flex gap-4" style="top: 547px;">
                                    บ้านเลขที่
                                    <span class="txt-data mr-2" style="width: 285px">
                                        <v-text-field hide-details="auto" v-model="address" class="label-color" flat solo
                                            dense label="ที่อยู่ ตำบล อำเภอ จังหวัด รหัสไปรษณีย์"></v-text-field>
                                    </span>
                                    เบอร์โทรศัพท์
                                    <span class="txt-data mr-2" style="width: 110px">
                                        <v-text-field hide-details="auto" v-model="phone"
                                            @keypress="isTelephone($event, phone)" class="label-color" flat dense solo
                                            label="xxx-xxxxxxx"></v-text-field>
                                    </span>
                                </p>

                                <p class="fs-18 fw-300 text-black position-absolute d-flex gap-4"
                                    style="top: 574px; text-indent: 4em;">
                                    ซึ่งต่อไปในสัญญานี้เรียกว่า "ผู้เช่า" ฝ่ายหนึ่ง กับ บริษัท อิ่มเอมบารมี จำกัด
                                    ต่อไปในสัญญานี้เรียกว่า "ผู้ให้เช่า" ฝ่ายหนึ่ง
                                    ทั้งสองฝ่ายตกลงทำสัญญาเช่าและสัญญาบริการ ดังมีข้อความต่อไปนี้
                                </p>

                                <p class="fs-18 fw-300 text-black position-absolute d-flex gap-4"
                                    style="top: 672px; text-indent: 4em;">
                                    ข้อ 1. ผู้ให้เช่า ตกลงให้เช่า และ ผู้เช่า ตกลงเช่าพื้นที่บางส่วน
                                    ภายในอาคารหรือสิ่งปลูกสร้างบนพื้นที่ดินโฉลดที่ดินเลขที่
                                </p>

                                <p class="fs-18 fw-300 text-black position-absolute d-flex gap-4" style="top: 699px;">
                                    6917,5705 ตำบลปากเพรียว
                                    อำเภอเมืองสระบุรี จังหวัดสระบุรี 18000 เป็นหมายเลขทะเบียน ห้องเลขที่
                                    <span class="txt-data fw-400" style="width: 135px">
                                        <v-text-field hide-details="auto" v-model="lock_number" class="label-color" flat
                                            solo dense label="หมายเลขล๊อคที่เช่า"></v-text-field>
                                    </span>
                                </p>

                                <p class="fs-18 fw-300 text-black position-absolute d-flex gap-4" style="top: 726px;">
                                    เนื้อที่ประมาณ
                                    <span class="txt-data fw-400" style="width: 20px">
                                        <v-text-field hide-details="auto" v-model="area" @keypress="isNumber($event, area)"
                                            class="label-color" flat solo dense label="xx"></v-text-field>
                                    </span>
                                    ปรากฏตามเอกสารแนบท้ายสัญญาเช่า เอกสารแนบท้ายหมายเลข 1
                                </p>
                                <p class="fs-18 fw-300 text-black position-absolute d-flex gap-4" style="top: 753px;">
                                    และถือเป็นส่วนหนึ่งของสัญญาเช่าฉบับนี้ด้วย ซึ่งต่อไปในสัญญานี้เรียกว่า "ทรัพย์ที่เช่า"
                                </p>

                                <p class="fs-18 fw-300 text-black position-absolute d-flex gap-4"
                                    style="top: 809px; text-indent: 4em;">
                                    ข้อ 2. ผู้ให้เช่า ตกลงให้ผู้เช่า เช่าพื้นที่เช่า มีกำหนดอายุ
                                    <span class="txt-data fw-400" style="width: 20px">
                                        <v-text-field hide-details="auto" v-model="age_area"
                                            @keypress="isAge($event, age_area)" class="label-color" flat solo dense
                                            label="xx"></v-text-field>
                                    </span>
                                </p>
                                <p class="fs-18 fw-300 text-black position-absolute d-flex gap-4"
                                    style="top: 809px; left: 500px;">
                                    เดือน เริ่มอายุการเช่าตั้งแต่ วันที่
                                    <span class="txt-data fw-400" style="width: 130px">
                                        <v-text-field hide-details="auto" v-model="date_renting_start" class="label-color"
                                            flat solo dense label="DD MMMM YYYY"></v-text-field>
                                    </span>
                                    และ
                                </p>

                                <p class="fs-18 fw-300 text-black position-absolute d-flex gap-2" style="top: 836px;">
                                    สิ้นสุดใน วันที่
                                    <span class="txt-data fw-400 ml-2" style="width: 130px">
                                        <v-text-field hide-details="auto" v-model="date_renting_end" class="label-color"
                                            flat solo dense label="DD MMMM YYYY"></v-text-field>
                                    </span>
                                    โดยมีวัตถุประสงค์ของการเช่า เพื่อใช้เป็นสถานที่วางจำหน่าย อันมีประเภทและชนิดสินค้า
                                </p>

                                <p class="fs-18 fw-300 text-black position-absolute " style="top: 863px;">
                                    ที่วางจำหน่ายตามที่ระบุไว้ในคำขอ <span class="fw-500">เอกสารแนบท้ายสัญญาเช่าหมายเลข
                                        2</span>
                                    ซึ่งถือว่าเป็นส่วนหนึ่งของสัญญาเช่าฉบับนี้ด้วย
                                    โดยผู้เช่าไม่เปลี่ยนแปลงประเภทสินค้าที่วางจำหน่ายตลอดอายุสัญญาเช่าที่ระบุไว้ข้างต้น
                                    หากผู้เช่าเปลี่ยนแปลงประเภทสินค้าที่วางจำหน่ายไม่ถูกต้องตรงกับคำขอ เอกสารแนบท้ายหมายเลข
                                    2
                                    ถือว่าผู้เช่าประพฤติผิดสัญญาข้อนี้ ผู้ให้เช่าใช้สิทธิบอกกเลิกสัญญาได้ทันที
                                    ผู้ให้เช่าจะต้องเป็นผู้ชำระเช่นกัน
                                </p>

                                <vue-editor class="position-absolute w-100" style="top: 992px;" v-model="html"></vue-editor>

                                <p class="fs-18 fw-300 text-black position-absolute" style="top: 1475px; left: 70px;">
                                    ลงชื่อ
                                    ..................................................................................ผู้ให้เช่า
                                </p>

                                <p class="fs-18 fw-300 text-black position-absolute" style="top: 1512px; left: 133px;">
                                    ( บริษัท อิ่มเอมบารมี จำกัด )
                                </p>

                                <p class="fs-18 fw-300 text-black position-absolute" style="top: 1645px; left: 70px;">
                                    ลงชื่อ
                                    ..................................................................................พยาน
                                </p>

                                <p class="fs-18 fw-300 text-black position-absolute" style="top: 1687px; left: 93px;">
                                    (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
                                </p>

                                <p class="fs-18 fw-300 text-black position-absolute" style="top: 1475px; left: 575px;">
                                    ลงชื่อ
                                    ..................................................................................ผู้เช่า
                                </p>

                                <p class="fs-18 fw-300 text-black position-absolute d-flex"
                                    style="top: 1512px; left: 643px;">
                                    (
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="txt-data fw-500" style="width: 180px">
                                        <v-text-field hide-details="auto" v-model="name_tenant"
                                            class="label-color centered-input" flat solo
                                            label="ชื่อ-สกุลผู้เช่า"></v-text-field>
                                    </span>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    )
                                </p>


                                <p class="fs-18 fw-300 text-black position-absolute" style="top: 1645px; left: 575px;">
                                    ลงชื่อ
                                    ..................................................................................พยาน
                                </p>

                                <p class="fs-18 fw-300 text-black position-absolute" style="top: 1687px; left: 598px;">
                                    (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
                                </p>

                            </div>

                        </v-card>
                    </div>
                    <v-card-text class="pb-6 mt-8 mb-6 ">
                        <div class="d-flex justify-center">
                            <v-btn type="submit" color="white" class="ma-2 btn-save rounded-pill pl-30 pr-30">
                                <v-icon class="fs-20" left dark>
                                    mdi-content-save
                                </v-icon>
                                บันทึกข้อมูล
                            </v-btn>
                        </div>
                    </v-card-text>
                </v-form>
            </v-card>

        </div>
    </div>
</template>

<script>
import contract from '../../../api/contract.js';
import { VueEditor } from "vue2-editor";

export default {
    components: {
        VueEditor
    },
    data() {
        return {
            loading_page: false,
            submenu: [
                {
                    text: 'จัดการสัญญาเช่าพื้นที่',
                    disabled: false,
                },
                {
                    text: 'แก้ไขสัญญา',
                    disabled: true,
                },
            ],
            html: '',
            day: null,
            month: null,
            year: null,
            name_tenant: null,
            id_card: null,
            age: null,
            address: null,
            phone: null,
            lock_number: null,
            area: null,
            age_area: null,
            date_renting_start: null,
            date_renting_end: null,
        }
    },
    methods: {
        async getList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await contract.contractList(config).then((result) => {
                if (result.data.success === true) {
                    this.get_data = result.data.data;
                    this.html = this.get_data.contract_text
                }

            }).catch((error) => {
                if (error.response.status === 401) {
                    this.loading_page = false
                    this.$store.commit('logOutSuccess')
                    this.$router.push('/login')
                }
            })
        },
        async contractUpdate() {
            if (this.$refs.form_contract_update.validate()) {
                let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.access_token}`,
                    },
                }
                let data = new FormData();

                data.append('id', this.get_data.id);
                data.append('contract_text', this.html);

                this.loading_page = true;

                await contract.contractUpdate(data, config).then((result) => {
                    if (result.data.success === true) {
                        this.loading_page = false;
                        this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                        this.$router.push('/managerentalcontract')
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

    },
    created() {
    },
    mounted() {
        this.getList()
    }
}
</script>

<style lang="scss">
.centered-input input {
    text-align: center
}

.v-text-field.centered-input .v-label {
    left: 50% !important;
    transform: translateX(-50%);

    &.v-label--active {
        transform: translateY(-18px) scale(.75) translateX(-50%);
    }
}

.label-color .v-label {
    margin-top: -8px;
    color: #0D99FF;
    opacity: 1;
}

.label-color {
    .v-input__slot {
        padding: 0 !important;
        min-height: auto !important;
        display: flex !important;
        align-items: center !important;
        text-indent: 0em;

        .v-label {
            top: 11px !important;
        }
    }
}

.label-color input {
    color: #0D99FF !important;
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

    .icon-btn-edit {
        font-size: 24px !important;
        margin-right: 10px;
    }
}

.txt-data {
    color: #0D99FF;
    font-size: 18px;
    font-weight: 500;
}
</style>