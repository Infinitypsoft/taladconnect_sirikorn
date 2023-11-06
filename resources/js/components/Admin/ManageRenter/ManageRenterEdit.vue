<template>
    <div class="loading_all_page" v-if="loading_page === true">
        <v-progress-circular indeterminate size="70" :width="8" color="#FFBC15"></v-progress-circular>
        <p class="mt-3">กำลังโหลดข้อมูล</p>
    </div>

    <div v-else data-aos="fade-up">
        <v-slide-x-reverse-transition>
            <v-alert type="success" class="alert_all_page" v-if="alert_success === true">{{ alert_message_success
            }}</v-alert>
            <v-alert type="error" class="alert_all_page" v-if="alert_error === true">{{ alert_message_error }}</v-alert>
        </v-slide-x-reverse-transition>

        <div class="container">
            <div class="d-flex justify-space-between align-items-center mt-4 mb-4">
                <v-card-text class="p-0">
                    <h1 class="font-20 m-0">เพิ่มสมาชิกผู้เช่า</h1>
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
                                    ข้อมูลสมาชิกผู้เช่า
                                </v-card-title>
                                <br />
                                <v-card-text class="p-0">

                                    <v-form ref="form_tennant_update" v-on:submit.prevent="tennantUpdate()">

                                        <div class="mt-3">
                                            <v-row class="container-input-contact">

                                                <div class="d-flex align-center">
                                                    <img class="mr-2"
                                                        :src="base_url + `/images/icon/843b5ac6e45d66deccc42ce990f7acc8.png`"
                                                        alt="" width="20" height="20" />
                                                    <span class="font-16 color-title-card">ข้อมูลส่วนตัวของผู้เช่า{{
                                                        radio_tennant_type }}</span>
                                                </div>

                                                <v-col v-if="radio_tennant_type === 0" cols="12" xs="12" sm="12" md="12"
                                                    lg="12" xl="12">
                                                    <p class="font-14 text-ex fs-16 fw-500">ประเภทของบุคคล <span
                                                            style="color: red;">*</span></p>
                                                    <v-radio-group v-model="radio_tennant_type" row>
                                                        <v-radio color="success" label="บุคคลธรรมดา" :value="0"></v-radio>
                                                        <v-radio color="success" label="นิติบุคคล" :value="1"></v-radio>
                                                    </v-radio-group>
                                                </v-col>

                                                <v-col v-if="radio_tennant_type === 0" cols="12" xs="12" sm="12" md="2"
                                                    lg="2" xl="2">
                                                    <p class="font-14 text-ex fs-16 fw-500">คำนำหน้า
                                                        <span style="color: red;">*</span>
                                                    </p>
                                                    <v-select hide-details="auto" class="custom-v-select"
                                                        v-model="prefix_select_type" item-value="id" item-text='name'
                                                        :items="prefix_type" outlined dense single-line
                                                        label="กรุณาเลือกคำนำหน้า"></v-select>
                                                </v-col>
                                                <v-col v-if="radio_tennant_type === 0" cols="12" xs="12" sm="12" md="4"
                                                    lg="4" xl="4">
                                                    <p class="font-14 text-ex fs-16 fw-500">ชื่อผู้เช่า
                                                        <span style="color: red;">*</span>
                                                    </p>
                                                    <v-text-field hide-details="auto" label="กรุณาชื่อผู้เช่า"
                                                        v-model="tenant_name" outlined dense single-line></v-text-field>
                                                </v-col>

                                                <v-col v-if="radio_tennant_type === 0" cols="12" xs="12" sm="12" md="6"
                                                    lg="6" xl="6">
                                                    <p class="font-14 text-ex fs-16 fw-500">เลขที่บัตรประชาชน</p>
                                                    <v-text-field hide-details="auto" label="x-xxxx-xxxxx-xx-x"
                                                        v-model="id_card" :counter="13"
                                                        @keypress="isIDCard($event, id_card)" :rules="rules.id_card"
                                                        outlined dense single-line></v-text-field>
                                                </v-col>


                                                <v-col v-if="radio_tennant_type === 1" cols="12" xs="12" sm="12" md="6"
                                                    lg="6" xl="6">
                                                    <p class="font-14 text-ex fs-16 fw-500">ประเภทของบุคคล <span
                                                            style="color: red;">*</span></p>
                                                    <v-radio-group v-model="radio_tennant_type" row>
                                                        <v-radio color="success" label="บุคคลธรรมดา" :value="0"></v-radio>
                                                        <v-radio color="success" label="นิติบุคคล" :value="1"></v-radio>
                                                    </v-radio-group>
                                                </v-col>

                                                <v-col v-if="radio_tennant_type === 1" cols="12" xs="12" sm="12" md="6"
                                                    lg="6" xl="6">
                                                    <p class="font-14 text-ex fs-16 fw-500">การคิดภาษี <span
                                                            style="color: red;">*</span></p>
                                                    <v-radio-group v-model="radio_taxation_type" row>
                                                        <v-radio color="success" label="ภาษีรวมใน" :value="0"></v-radio>
                                                        <v-radio color="success" label="ภาษีรวมนอก" :value="1"></v-radio>
                                                        <v-radio color="success" label="ไม่คิดภาษี" :value="2"></v-radio>
                                                    </v-radio-group>
                                                </v-col>

                                                <v-col v-if="radio_tennant_type === 1" cols="12" xs="12" sm="12" md="6"
                                                    lg="6" xl="6">
                                                    <p class="font-14 text-ex fs-16 fw-500">ชื่อบริษัท <span
                                                            style="color: red;">*</span></p>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกชื่อบริษัท"
                                                        v-model="company_name" :rules="rules.company_name" outlined dense
                                                        single-line></v-text-field>
                                                </v-col>

                                                <v-col v-if="radio_tennant_type === 1" cols="12" xs="12" sm="12" md="6"
                                                    lg="6" xl="6">
                                                    <p class="font-14 text-ex fs-16 fw-500">เลขประจำตัวผู้เสียภาษีอากร <span
                                                            style="color: red;">*</span></p>
                                                    <v-text-field hide-details="auto"
                                                        label="กรุณากรอกเลขประจำตัวผู้เสียภาษีอากร" v-model="tax_id"
                                                        :rules="rules.tax_id" @keypress="isIDCard($event, tax_id)" outlined
                                                        dense single-line :counter="13"></v-text-field>
                                                </v-col>

                                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                    <p class="font-14 text-ex fs-16 fw-500">อีเมล</p>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกอีเมล" v-model="email"
                                                        @keypress="isEmail($event)" :rules="[rulesEmail.email]" outlined
                                                        dense single-line></v-text-field>
                                                </v-col>

                                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                    <p class="font-14 text-ex fs-16 fw-500">เบอร์โทร
                                                        <span style="color: red;">*</span>
                                                    </p>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกเบอร์โทร"
                                                        :rules="rules.phone" :counter="10" v-model="phone" outlined dense
                                                        single-line @keypress="isTelephone($event, phone)"
                                                        required></v-text-field>
                                                </v-col>
                                                <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                                                    <p class="font-14 text-ex fs-16 fw-500">ที่อยู่</p>
                                                    <v-text-field hide-details="auto" label="กรุณากรอกที่อยุ่"
                                                        v-model="address" outlined :rules="rules.address" dense
                                                        single-line></v-text-field>
                                                </v-col>

                                                <div class="d-flex align-center">
                                                    <img class="mr-2"
                                                        :src="base_url + `/images/icon/26be0f1b0a70467c883a60356d5a2757.png`"
                                                        alt="Contact" width="20" height="20" />
                                                    <span class="font-16 color-title-card">การสมัครสมาชิก</span>
                                                </div>
                                                <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                    <p class="font-14 text-ex fs-16 fw-500">วิธีการสมัครสมาชิก <span
                                                            style="color: red;">*</span></p>
                                                    <v-radio-group v-model="radio_register" row>
                                                        <v-radio color="success" label="ช่องทาง Line" :value="0"></v-radio>
                                                        <v-radio color="success" label="แอดมินสมัครในระบบ"
                                                            :value="1"></v-radio>
                                                    </v-radio-group>
                                                </v-col>
                                            </v-row>

                                            <div class="d-flex justify-center">
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
import tennant from '../../../api/tennant.js';

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
            prefix_type: [{ id: 1, name: 'นาย' }, { id: 2, name: 'นาง' }],
            prefix_select_type: 0,
            tenant_name: '',
            id_card: '',
            phone: '',
            address: '',

            radio_register: 0,
            radio_tennant_type: 0,
            radio_taxation_type: 0,

            company_name: '',
            tax_id: '',
            email: '',

            rules: {
                prefix: [val => (val || 0).length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                prefix_select_type: [val => val || 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                tenant_name: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                phone: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                company_name: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
                tax_id: [val => (val || '').length > 0 || 'ต้องระบุข้อมูลในช่องนี้'],
            },
        }
    },
    methods: {
        async getList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await tennant.tennantDetail(this.base64Decode(this.$route.query.id), config).then((result) => {
                if (result.data.success === true) {
                    this.get_data = result.data.data

                    this.radio_tennant_type = this.get_data.tennant_type
                    this.company_name = this.get_data.company_name
                    this.prefix_select_type = this.prefix_type.filter(v => v.name === this.get_data.title_name)[0].id
                    this.tenant_name = this.get_data.name
                    this.id_card = this.get_data.personal_id
                    this.tax_id = this.get_data.tax_number
                    this.radio_taxation_type = this.get_data.vat_type
                    this.email = this.get_data.email
                    this.phone = this.get_data.tel
                    this.address = this.get_data.address
                    this.radio_register = this.get_data.register_type
                }
            })
        },
        async tennantUpdate() {
            if (this.$refs.form_tennant_update.validate()) {
                let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.access_token}`,
                    },
                }
                let data = new FormData();

                data.append('id', this.get_data.id);
                data.append('tennant_type', this.radio_tennant_type);
                data.append('company_name', this.company_name === null ? '' : this.company_name);
                if (this.prefix_select_type !== 0) {
                    data.append('title_name', this.prefix_type.filter(v => v.id === this.prefix_select_type)[0].name);
                }
                data.append('name', this.tenant_name === null ? '' : this.tenant_name);
                data.append('personal_id', this.id_card === null ? '' : this.id_card);
                data.append('tax_number', this.tax_id === null ? '' : this.tax_id);
                data.append('vat_type', this.radio_taxation_type);
                data.append('email', this.email === null ? '' : this.email);
                data.append('tel', this.phone === null ? '' : this.phone);
                data.append('address', this.address === null ? '' : this.address);
                data.append('register_type', this.radio_register);

                this.loading_page = true;

                await tennant.tennantUpdate(data, config).then((result) => {
                    if (result.data.success === true) {
                        this.loading_page = false;
                        this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                        this.$router.push('/managerenter')
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
    },

}
</script>

<style lang="scss"></style>

<style scoped lang="scss">
* {
    font-family: 'Kanit', sans-serif !important;
}
</style>
