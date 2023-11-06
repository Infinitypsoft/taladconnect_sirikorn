<template>
  <div class="loading_all_page" v-if="loading_page === true">
    <v-progress-circular
      indeterminate
      size="70"
      :width="8"
      color="#FFBC15"
    ></v-progress-circular>
    <p class="mt-3">กำลังโหลดข้อมูล</p>
  </div>

  <div v-else>
    <v-slide-x-reverse-transition>
      <v-alert
        type="success"
        class="alert_all_page"
        v-if="alert_success === true"
        >{{ alert_message_success }}</v-alert
      >
      <v-alert
        type="error"
        class="alert_all_page"
        v-if="alert_error === true"
        >{{ alert_message_error }}</v-alert
      >
    </v-slide-x-reverse-transition>

    <div class="container">
      <div class="d-flex justify-space-between align-items-center mt-4 mb-4">
        <v-card-text class="p-0">
          <h1 class="font-20 m-0">สร้างรอบบิลใหม่</h1>
        </v-card-text>
        <v-card-text class="d-flex justify-end p-0">
          <v-breadcrumbs :items="submenu" class="p-0">
            <template v-slot:divider>
              <v-icon>mdi-chevron-right</v-icon>
            </template>
          </v-breadcrumbs>
        </v-card-text>
      </div>

      <v-card class="mb-6" elevation="2">
        <v-card-title class="justify-space-between text-card-title">
          รายละเอียดรอบบิล
        </v-card-title>
        <v-form ref="form_save" v-on:submit.prevent="create()">
          <v-card-text class="mt-3">
            <v-row class="container-input-contact">
              <div class="d-flex align-center mt-5">
                <img
                  class="mr-2"
                  :src="base_url + `/images/icon/createbill.png`"
                  alt=""
                  width="20"
                  height="20"
                />
                <span class="font-16 color-title-card"
                  >รอบบิล ID : {{ bill_code }}</span
                >
              </div>

              <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                <p class="font-14 text-ex fs-16 fw-500">
                  ชื่อรอบบิล
                  <span style="color: red">*</span>
                </p>
                <v-text-field
                  hide-details="auto"
                  label="กรุณากรอกชื่อรอบบิล"
                  v-model="bill_name"
                  :rules="[(v) => !!v || 'กรุณากรอกชื่อรอบบิล']"
                  outlined
                  dense
                  single-line
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                <p class="font-14 text-ex fs-16 fw-500">
                  ระยะเวลาการชำระเงิน
                  <span style="color: red">*</span>
                </p>
              </v-col>
              <v-col cols="12" xs="12" sm="12" md="2" lg="1" xl="1">
                <p class="font-14 text-ex fs-16 fw-500">
                  วันที่เริ่มต้น
                  <span style="color: red">*</span>
                </p>
              </v-col>

              <v-col cols="12" xs="12" sm="12" md="4" lg="5" xl="5">
                <v-menu
                  v-model="menu2"
                  :close-on-content-click="false"
                  :nudge-right="40"
                  transition="scale-transition"
                  offset-y
                  min-width="auto"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      v-model="start_date"
                      label="กรุณาเลือกวันที่เริ่มต้น"
                      outlined
                      dense
                      single-line
                      :rules="[(v) => !!v || 'กรุณาเลือกวันที่']"
                      required
                      v-bind="attrs"
                      v-on="on"
                      hide-details=""
                    ></v-text-field>
                  </template>
                  <v-date-picker
                    v-model="start_date"
                    @input="menu2 = false"
                  ></v-date-picker>
                </v-menu>
              </v-col>
              <v-col cols="12" xs="12" sm="12" md="2" lg="1" xl="1">
                <p class="font-14 text-ex fs-16 fw-500">
                  วันที่สิ้นสุด
                  <span style="color: red">*</span>
                </p>
              </v-col>

              <v-col cols="12" xs="12" sm="12" md="4" lg="5" xl="5">
                <v-menu
                  v-model="menu2end"
                  :close-on-content-click="false"
                  :nudge-right="40"
                  transition="scale-transition"
                  offset-y
                  min-width="auto"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      v-model="end_date"
                      label="กรุณาเลือกวันที่สิ้นสุด"
                      outlined
                      dense
                      single-line
                      :rules="[(v) => !!v || 'กรุณาเลือกวันที่']"
                      required
                      v-bind="attrs"
                      v-on="on"
                      hide-details=""
                    ></v-text-field>
                  </template>
                  <v-date-picker
                    v-model="end_date"
                    @input="menu2end = false"
                  ></v-date-picker>
                </v-menu>
              </v-col>
              <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                <p class="font-14 text-ex fs-16 fw-500">
                  วันที่ระบบทำการแจ้งผ่านไลน์ OA อัตโนมัติ
                  <span style="color: red">*</span>
                </p>
                <v-menu
                  v-model="menuline"
                  :close-on-content-click="false"
                  :nudge-right="40"
                  transition="scale-transition"
                  offset-y
                  min-width="auto"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      v-model="line_noti_date"
                      label="กรุณาเลือกวันที่สิ้นสุด"
                      outlined
                      dense
                      single-line
                      required
                      v-bind="attrs"
                      v-on="on"
                      hide-details=""
                    ></v-text-field>
                  </template>
                  <v-date-picker
                    v-model="line_noti_date"
                    @input="menuline = false"
                  ></v-date-picker>
                </v-menu>
              </v-col>
            </v-row>
            <!-- การคิดภาษี -->
            <v-row>
              <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                <div class="d-flex align-center mt-5">
                  <img
                    class="mr-2"
                    :src="base_url + `/images/icon/billvat.png`"
                    alt=""
                    width="20"
                    height="20"
                  />
                  <span class="font-16 color-title-card">การคิดภาษี</span>
                </div>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                <v-row>
                  <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                    <p class="font-14 text-ex fs-16 fw-500 mt-5">
                      ภาษีมูลค่าเพิ่ม
                      <span style="color: red">*</span>
                    </p>
                    <div class="d-flex align-items-center">
                      <p class="font-14 text-ex fs-16 fw-500 ma-2">ภาษี</p>
                      <v-select
                        class="custom-v-select ma-2"
                        item-value="id"
                        item-text="name"
                        v-model="vat_status"
                        :items="[
                          { id: 0, name: 'ไม่คิดภาษี' },
                          { id: 1, name: 'ภาษีรวมใน' },
                          { id: 2, name: 'ภาษีรวมนอก' },
                        ]"
                        hide-details="auto"
                        label="กรุณาเลือกภาษี"
                        outlined
                        dense
                        single-line
                        required
                      ></v-select>
                      <v-text-field
                        hide-details="auto"
                        :rules="[(v) => !!v || 'กรุณากรอกจำนวน %']"
                        prepend-icon="mdi-percent-outline"
                        v-model="vat"
                        outlined
                        dense
                        single-line
                        required
                      ></v-text-field>
                    </div>
                  </v-col>
                </v-row>
              </v-col>
              <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                <v-row>
                  <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                    <p class="font-14 text-ex fs-16 fw-500 mt-5">
                      ภาษีหัก ณ ที่จ่าย
                    </p>
                    <div class="d-flex align-items-center">
                      <p class="font-14 text-ex fs-16 fw-500 ma-2">
                        ภาษีหัก ณ ​ที่จ่าย
                      </p>
                      <v-text-field
                        hide-details="auto"
                        :rules="[(v) => !!v || 'กรุณากรอกจำนวน %']"
                        v-model="charge"
                        append-outer-icon="mdi-percent-outline"
                        outlined
                        dense
                        single-line
                        required
                      >
                      </v-text-field>
                    </div>
                  </v-col>
                </v-row>
              </v-col>
            </v-row>
            <div class="d-flex justify-center">
              <v-btn
                color="white"
                type="submit"
                class="ma-2 btn-save rounded-pill pl-30 pr-30"
              >
                <v-icon class="fs-20" left dark>
                  mdi-file-document-check-outline
                </v-icon>
                <span>สร้างรอบบิล</span>
              </v-btn>
            </div>
          </v-card-text>
        </v-form>
      </v-card>
    </div>
  </div>
</template>

<script>
import meter_water_bill from "../../../api/meter_water_bill.js";
export default {
  data() {
    return {
      loading_page: false,
      alert_success: false,
      alert_message_success: "",
      alert_error: false,
      alert_message_error: "",
      date_start: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      date_end: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      date_line: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      menu2: false,
      menu2end: false,
      menuline: false,
      bill_name: null,
      start_date: null,
      end_date: null,
      line_noti_date: null,
      vat_status: null,
      vat: null,
      charge: null,

      submenu: [
        {
          text: "รอบบิลค่าไฟ",
          disabled: false,
        },
        {
          text: "สร้างรอบบิลใหม่",
          disabled: true,
        },
      ],
      bill_code: null,
    };
  },
  methods: {
    async checkBillCode() {
      let config = {
        headers: {
          Authorization: `Bearer ${this.$store.state.access_token}`,
        },
      };
      await meter_water_bill
        .checkBillCode(config)
        .then((result) => {
          if (result.data.success === true) {
            // this.loading_page = true;
            this.bill_code = result.data.data.bill_code;
          }
        })
        .catch((error) => {
          if (error.response.status === 401) {
            this.$store.commit("logOutSuccess");
            this.$router.push("/login");
          }
        });
    },
    async create() {
      if (this.$refs.form_save.validate()) {
        let config = {
          headers: {
            Authorization: `Bearer ${this.$store.state.access_token}`,
          },
        };
        let data = {
          bill_name: this.bill_name,
          start_date: this.start_date,
          end_date: this.end_date,
          line_noti_date: this.line_noti_date,
          vat_status: this.vat_status,
          vat: this.vat,
          charge: this.charge,
        };
        await meter_water_bill
          .create(data, config)
          .then((result) => {
            if (result.data.success === true) {
              // this.loading_page = true;
              this.alert_success = true;
              this.alert_message_success = "บันทึกข้อมูลเรียบร้อย";
              setTimeout(() => {
                (this.alert_success = false),
                  this.$router.push("/managemeterwater/billcycle");
              }, 2000);
            }
          })
          .catch((error) => {
            if (error.response.status === 401) {
              this.$store.commit("logOutSuccess");
              this.$router.push("/login");
            }
          });
      }
    },
  },
  created() {},
  mounted() {
    this.checkBillCode();
  },
  watch: {
    page() {},
  },
};
</script>

<style lang="scss">
.pagination_review {
  .v-icon {
    color: #707070 !important;
    font-size: 16px !important;
    font-weight: 500 !important;
    font-family: "Kanit", sans-serif !important;
  }

  .v-pagination__item {
    background: #f0f0f0 !important;
    box-shadow: none !important;
    color: #707070 !important;
    font-size: 16px !important;
    font-weight: 500 !important;
  }

  .v-pagination__item--active {
    background: #86d780 !important;
    color: #ffffff !important;
  }

  .v-pagination__navigation {
    background: #f0f0f0 !important;
    box-shadow: none !important;
    color: #707070 !important;
    font-size: 16px !important;
    font-weight: 500 !important;
  }
}
</style>
<style scoped lang="scss">
* {
  font-family: "Kanit", sans-serif !important;
}

.role_admin {
  height: 21px;
  font-size: 12px;
  border-radius: 10px;
  background: linear-gradient(90deg, #e8bd4b 0%, #d19a3b 100%) !important;
}

.role_emp {
  height: 21px;
  font-size: 12px;
  border-radius: 10px;
  background: linear-gradient(90deg, #707070 0%, #1e1e1e 100%) !important;
}

.pagination_review {
  border-radius: 20px;
  background: #f0f0f0 !important;
  padding: 0 20px;
}

.review_approval_2 {
  width: 94px;
  height: 21px;
  border-radius: 10px;
  background: linear-gradient(90deg, #e8bd4b 0%, #d19a3b 100%);
  padding: 0 15px;

  color: #fff;
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
  background: linear-gradient(90deg, #707070 0%, #1e1e1e 100%);
  padding: 0 15px;

  color: #fff;
  text-align: center;
  font-size: 12px;
  font-weight: 500;
}

.btn-edit {
  background: linear-gradient(270deg, #ff5b00 0%, #ffc700 53.65%);
  box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);

  color: #f9f9f9;
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
  border: 1px solid var(--primary-button, #86d780) !important;
  box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);

  color: #60a577;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: normal;
}
</style>
