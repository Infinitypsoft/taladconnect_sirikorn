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
                            <p>สัญญาบริการเช่าพื้นที่ในอาคาร</p>
                        </v-col>
                        <v-col class="container-title-left" xs="12" sm="12" md="6" lg="6" xl="6">
                            <v-btn @click="linkPage('/managerentalcontract/edit')" class="btn-edit radius-30"
                                color="warning" dark>
                                <v-icon class="icon-btn-edit" large color="white">
                                    mdi-pencil
                                </v-icon>
                                แก้ไขสัญญา
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-card-title>
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
                                วันที่ <span class="txt-data mr-2">DD</span>
                                เดือน <span class="txt-data mr-2">MMMM</span>
                                พ.ศ <span class="txt-data">YYYY</span>
                            </p>

                            <p class="fs-18 fw-300 text-black position-absolute" style="top: 520px;">
                                สัญญาฉบับนี้ทำขึ้นระหว่าง <span class="txt-data fw-400">คำนำหน้า ชื่อ-สกุลผู้เช่า</span>
                                ถือบัตรประชาชน <span class="txt-data fw-400">x-xxxx-xxxxx-xx-x</span> อายุ <span
                                    class="txt-data fw-400">xx</span> ปี อาศัยอยู่
                                บ้านเลขที่
                                <span class="txt-data fw-400">ที่อยู่ ตำบล อำเภอ จังหวัด รหัสไปรษณีย์ </span> เบอร์โทรศัพท์
                                <span class="txt-data fw-400">xxx-xxxxxxx</span>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                ซึ่งต่อไปในสัญญานี้เรียกว่า "ผู้เช่า" ฝ่ายหนึ่ง กับ บริษัท อิ่มเอมบารมี จำกัด
                                ต่อไปในสัญญานี้เรียกว่า "ผู้ให้เช่า" ฝ่ายหนึ่ง
                                ทั้งสองฝ่ายตกลงทำสัญญาเช่าและสัญญาบริการ ดังมีข้อความต่อไปนี้
                            </p>
                            <p class="fs-18 fw-300 text-black position-absolute" style="top: 672px;">
                                ข้อ 1. ผู้ให้เช่า ตกลงให้เช่า และ ผู้เช่า ตกลงเช่าพื้นที่บางส่วน
                                ภายในอาคารหรือสิ่งปลูกสร้างบนพื้นที่ดินโฉลดที่ดินเลขที่ 6917,5705 ตำบลปากเพรียว
                                อำเภอเมืองสระบุรี จังหวัดสระบุรี 18000 เป็นหมายเลขทะเบียน ห้องเลขที่ <span
                                    class="txt-data fw-400">หมายเลขล๊อคที่เช่า</span>
                                เนื้อที่ประมาณ <span class="txt-data fw-400">xx</span> ตารางเมตร
                                ปรากฏตามเอกสารแนบท้ายสัญญาเช่า เอกสารแนบท้ายหมายเลข 1
                                และถือเป็นส่วนหนึ่งของสัญญาเช่าฉบับนี้ด้วย ซึ่งต่อไปในสัญญานี้เรียกว่า “ทรัพย์ที่เช่า”
                            </p>
                            <p class="fs-18 fw-300 text-black position-absolute" style="top: 809px;">
                                ข้อ 2. ผู้ให้เช่า ตกลงให้ผู้เช่า เช่าพื้นที่เช่า มีกำหนดอายุ xx เดือน
                                เริ่มอายุการเช่าตั้งแต่ วันที่ <span class="txt-data fw-400">DD MMMM YYYY</span> และ
                                สิ้นสุดใน วันที่ <span class="txt-data fw-400">DD MMMM YYYY</span>
                                โดยมีวัตถุประสงค์ของการเช่า เพื่อใช้เป็นสถานที่วางจำหน่าย อันมีประเภทและชนิดสินค้า
                                ที่วางจำหน่ายตามที่ระบุไว้ในคำขอ เอกสารแนบท้ายสัญญาเช่าหมายเลข 2
                                ซึ่งถือว่าเป็นส่วนหนึ่งของสัญญาเช่าฉบับนี้ด้วย
                                โดยผู้เช่าไม่เปลี่ยนแปลงประเภทสินค้าที่วางจำหน่ายตลอดอายุสัญญาเช่าที่ระบุไว้ข้างต้น
                                หากผู้เช่าเปลี่ยนแปลงประเภทสินค้าที่วางจำหน่ายไม่ถูกต้องตรงกับคำขอ เอกสารแนบท้ายหมายเลข 2
                                ถือว่าผู้เช่าประพฤติผิดสัญญาข้อนี้ ผู้ให้เช่าใช้สิทธิบอกกเลิกสัญญาได้ทันที
                                ผู้ให้เช่าจะต้องเป็นผู้ชำระเช่นกัน
                            </p>

                            <div class="v-html-custom fs-18 fw-300 text-black position-absolute p-bottom-0"
                                style="top: 1000px;" v-html="get_data.contract_text"></div>
                            <!-- <p class="fs-18 fw-300 text-black position-absolute" style="top: 1000px;">
                                ทั้งสิ้นรวมทั้ง ผู้เช่าจะไม่ฟ้องร้องผู้ให้เช่าทั้งทางแพ่งและอาญาแต่อย่างใด
                                นอกจากนี้ผู้ให้เช่ามีสิทธิ์ริบเงินรายได้ตามสัญญานี้ได้ ทั้งหมด
                                ตลอดจนมีสิทธิ์เรียกร้องค่าเสียหายใดๆ ที่เกิดขึ้นได้อีก
                            </p>
                            <p class="fs-18 fw-300 text-black position-absolute" style="top: 1089px;">
                                ข้อ 28. หากผู้เช่ากระทำการใด ๆ อันเป็นผิดสัญญาข้อใดข้อหนึ่ง
                                ผู้ให้เช่าสามารถบอกเลิกสัญญานี้ได้โดยมิต้องบอก กล่าวล่วงหน้าแต่อย่างใด
                            </p>
                            <p class="fs-18 fw-300 text-black position-absolute" style="top: 1172px;">
                                ข้อ 29. ผู้เช่ายอมรับว่ามีหน้าที่ปฏิบัติตามสัญญาเช่าในฐานะผู้เช่า
                                และมีหน้าที่จะต้องปฏิบัติตามสัญญานี้ต่อผู้ให้เช่าด้วย
                                และถือว่าสัญญาบริการเป็นส่วนหนึ่งของสัญญาเช่า
                                ในกรณีที่สัญญาเช่าครบกำหนดอายุสัญญาหรือระงับสิ้นสุดลงก่อนไม่ ว่าด้วยเหตุใด
                                ก็ให้ถือว่าสัญญาบริการสิ้นสุดลงด้วย
                            </p>
                            <p class="fs-18 fw-300 text-black position-absolute" style="top: 1288px;">
                                สัญญานี้ ทำขึ้น 2 ฉบับ มีข้อความตรงกัน
                                คู่สัญญาทั้งสองฝ่ายได้อ่านและเข้าใจข้อความในสัญญาฉบับนี้โดยตลอด
                                แล้วเห็นว่าถูกต้องและตรงตามความประสงค์และตามเจตนารมณ์และพร้อมที่จะปฏิบัติตามสัญญาอย่างเคร่งครัดจึงได้ลงลายมือชื่อไว้เป็นหลักฐานต่อหน้าพยานและเก็บสัญญาไว้ฝ่ายละฉบับ
                            </p> -->

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

                            <p class="fs-18 fw-300 text-black position-absolute" style="top: 1512px; left: 643px;">
                                (
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="txt-data fw-500">ชื่อ-สกุลผู้เช่า</span>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                <div class="d-flex justify-end pr-3 pm-38 mt-105 ">
                    <p class="fs-18 fw-500 p-0 m-0 color-707070">แก้ไขล่าสุด โดย ดารินทร์ เครือวัลย์ วันที่ 12/10/2566 เวลา
                        13:12:50 น.
                    </p>
                </div>
            </v-card>

        </div>
    </div>
</template>

<script>
import contract from '../../../api/contract.js';

export default {
    data() {
        return {
            loading_page: false,
            submenu: [
                {
                    text: 'จัดการสัญญาเช่าพื้นที่',
                    disabled: true,
                },
            ],
            get_data: {},
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
                }

            }).catch((error) => {
                if (error.response.status === 401) {
                    this.loading_page = false
                    this.$store.commit('logOutSuccess')
                    this.$router.push('/login')
                }
            })
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
.v-html-custom {
    p {
        margin-bottom: 0 !important;
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