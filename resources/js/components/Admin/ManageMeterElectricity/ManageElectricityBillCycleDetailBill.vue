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
          <h1 class="font-20 m-0">รอบบิล ID : IVW-2312</h1>
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
          <!-- รายละเอียดรอบบิล -->
          <v-card elevation="2" class="mb-6">
            <v-row class="m-0 p-4">
              <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                <v-card-title class="p-0 text-card-title">
                  <v-row class="container-title">
                    <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                      <p>รายละเอียดรอบบิล</p>
                    </v-col>
                  </v-row>
                </v-card-title>
                <v-card-text class="p-0 mt-4">
                  <div class="d-flex align-center mb-4">
                    <img
                      class="mr-2"
                      :src="base_url + `/images/icon/createbill.png`"
                      alt="Contact"
                      width="20"
                      height="20"
                    />
                    <span class="font-16 color-title-card"
                      >รอบบิล ID : {{ bill_detail.bill_code }}</span
                    >
                  </div>

                  <v-row>
                    <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                      <p class="font-16 color-707070 mb-0">
                        ชื่อรอบบิล : {{ bill_detail.bill_name }}
                      </p>
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                      <p class="font-16 color-707070 mb-0">
                        ระยะเวลาการชำระเงิน : {{ bill_detail.start_date }} -
                        {{ bill_detail.end_date }}
                      </p>
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                      <p class="font-16 color-707070 mb-0">
                        วันที่ระบบทำการแจ้งผ่านไลน์ OA อัตโนมัติ :
                        {{ bill_detail.line_noti_date }}
                      </p>
                    </v-col>
                  </v-row>
                </v-card-text>
                <v-card-text class="p-0 mt-2">
                  <div class="d-flex align-center mb-4">
                    <img
                      class="mr-2"
                      :src="base_url + `/images/icon/billvat.png`"
                      alt="Contact"
                      width="20"
                      height="20"
                    />
                    <span class="font-16 color-title-card">การคิดภาษี</span>
                  </div>
                  <v-row>
                    <v-col cols="12" xs="12" sm="6" md="6" lg="6" xl="6">
                      <p class="font-16 color-707070">
                        ภาษีมูลค่าเพิ่ม :
                        {{
                          bill_detail.vat_status == 0
                            ? "ไม่คิดภาษี"
                            : bill_detail.vat_status == 1
                            ? "ภาษีรวมใน"
                            : "ภาษีรวมนอก"
                        }}
                        {{ parseFloat(bill_detail.vat) }}%
                      </p>
                    </v-col>
                    <v-col cols="12" xs="12" sm="6" md="6" lg="6" xl="6">
                      <p class="font-16 color-707070">
                        ภาษีหัก ณ ที่จ่าย :
                        {{ parseFloat(bill_detail.charge) }}%
                      </p>
                    </v-col>
                  </v-row>
                </v-card-text>
              </v-col>
            </v-row>
          </v-card>

          <!-- ข้อมูลมิเตอร์ไฟ -->
          <v-card class="mb-6" elevation="2">
            <v-row class="m-0 p-4">
              <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                <v-card-title class="p-0 text-card-title mb-4">
                  <p>ข้อมูลมิเตอร์ไฟ</p>
                </v-card-title>
                <v-card-text class="p-0 mt-4">
                  <div class="d-flex align-center mb-4">
                    <img
                      class="mr-2"
                      :src="base_url + `/images/icon/megaphone 3.png`"
                      alt="Contact"
                      width="20"
                      height="20"
                    />
                    <span class="font-16 color-title-card"
                      >การบันทึกค่ามิเตอร์ไฟของแต่ละอาคาร</span
                    >
                  </div>

                  <v-data-table
                    :headers="headers"
                    :items="bill_detail.list"
                    :items-per-page="itemsPerPage"
                    hide-default-footer
                    @page-count="page = $event"
                  >
                    <template v-slot:item="{ item }">
                      <tr>
                        <td class="text-center">{{ item.site_name }}</td>
                        <td>
                          {{
                            item.block_total == null ? "-" : item.block_total
                          }}
                        </td>
                        <td>{{ item.block_save }}</td>
                        <td>{{ item.block_wait }}</td>
                        <td>
                          <span
                            v-if="item.status == 0 && item.block_total != null"
                            class="text-red"
                            >ยังไม่ครบ</span
                          >
                          <span
                            v-else-if="item.block_total == null"
                            class="text-red"
                            >-</span
                          >
                          <span v-else class="text-green">ครบ</span>
                        </td>
                        <td>
                          <v-btn
                         v-if="member_data.length == 0"
                            @click="
                              linkPage(
                                '/managemeterelectricity/billcycle/insertmeterelectricitybill?id=' +
                                  item.id+'&bill_id='+$route.query.id
                              )
                            "
                            class="ma-1 m-0 p-0"
                            outlined
                            large
                            elevation="4"
                            color="#60A577"
                          >
                            <v-icon>mdi-square-edit-outline</v-icon>
                            บันทึกค่ามิเตอร์ไฟ
                          </v-btn>
                          <v-btn v-else @click="linkPage('/managemeterelectricity/billcycle/insertmeterelectricitybilldetail?id='+item.id+'&bill_id='+$route.query.id)" class="ma-1 m-0 p-0" width="38" height="38" outlined large fab
                                                        elevation="4" color="#0D99FF">
                                                        <v-icon>mdi-magnify</v-icon>
                                                    </v-btn>
                        </td>
                      </tr>
                    </template>
                  </v-data-table>
                </v-card-text>
                <v-card-action>
                  <div class="d-flex justify-center mt-5">
                    <v-btn
                    v-if="member_data.length == 0"
                      @click="summary_confirm()"
                      color="white"
                      class="ma-2 btn-save rounded-pill pl-30 pr-30"
                    >
                      <v-icon class="fs-20" left dark>
                        mdi-file-document-outline
                      </v-icon>
                      <span>สรุปบิลเรียกเก็บตามผู้เช่า</span>
                    </v-btn>
                  </div>
                </v-card-action>
              </v-col>
            </v-row>
          </v-card>
          <!-- รายการบิลเรียกเก็บตามผู้เช่า -->
          <v-card elevation="2" v-if="member_data.length > 0">
            <v-row class="m-0 p-4">
              <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                <v-card-title class="p-0 text-card-title mb-4">
                  <p>รายการบิลเรียกเก็บตามผู้เช่า</p>
                </v-card-title>
                <v-card-text class="p-0 mt-4">
                  <v-row>
                    <v-col
                      xs="12"
                      sm="6"
                      md="8"
                      lg="8"
                      xl="8"
                      cols="12"
                    ></v-col>
                    <v-col xs="12" sm="6" md="4" lg="4" xl="4" cols="12">
                      <v-text-field
                        color="#B8C2CC"
                        class="br-5"
                        append-icon="mdi-magnify"
                        hide-details="auto"
                        required
                        v-model="search"
                        placeholder="ค้นหา..."
                        single-line
                        outlined
                        dense
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col xs="12" sm="12" md="12" lg="12" xl="12" cols="12">
                      <v-data-table :headers="paymentList" :items="member_data">
                        <template v-slot:item="{ item }">
                          <tr>
                            <td class="text-center">{{ item.bill_code }}</td>
                            <td>{{ item.member_name }}</td>
                            <td>{{ item.block_list }}</td>
                            <td>{{ formatPrice(item.unit_total) }}</td>
                            <td>{{ formatPrice(item.total) }}</td>
                            <td>
                              <span v-if="item.status == 0" class="status_carry"
                                >ค้างชำระ</span
                              >
                              <span v-else class="status_success"
                                >ชำระแล้ว</span
                              >
                            </td>
                            <td v-if="item.pay_status == 1">
                              จุดชำระเงินของตลาด
                            </td>
                            <td v-if="item.pay_status == 0">-</td>
                            <td v-if="item.pay_status == 2">LINE OA</td>
                            <td
                              v-if="item.noti_status == 1"
                              class="text-center"
                            >
                              <v-icon color="#62A878">mdi-check</v-icon>
                            </td>
                            <td
                              v-if="item.noti_status == 0"
                              class="text-center"
                            >
                              <v-icon color="#E60023">mdi-close</v-icon>
                            </td>
                            <td>
                              <v-btn
                                @click="
                                  linkPage(
                                    '/managemeterelectricity/billcycle/renterdetailbill?id='+item.id
                                  )
                                "
                                class="ma-1 m-0 p-0"
                                width="38"
                                height="38"
                                outlined
                                large
                                fab
                                elevation="4"
                                color="#0D99FF"
                              >
                                <v-icon>mdi-magnify</v-icon>
                              </v-btn>
                              <v-btn
                                class="ma-1 m-0 p-0"
                                width="38"
                                height="38"
                                outlined
                                large
                                fab
                                elevation="4"
                                color="#65AB79"
                              >
                                <v-icon>mdi-printer-outline</v-icon>
                              </v-btn>
                              <v-btn
                              v-if="item.status == 0"
                                @click="
                                  (member_id = item.id),
                                  (mem_code = item.bill_code),
                                    (payment_confirm = true)
                                "
                                class="ma-1 m-0 p-0"
                                width="38"
                                height="38"
                                outlined
                                large
                                fab
                                elevation="4"
                                color="#FFC829"
                              >
                                <v-icon>mdi-database-check-outline</v-icon>
                              </v-btn>
                            </td>
                          </tr>
                        </template>
                      </v-data-table>
                    </v-col>
                  </v-row>
                </v-card-text>
              </v-col>
            </v-row>
          </v-card>
        </v-col>
      </v-row>
      <!-- Dialog Delete-->
      <v-dialog v-model="payment_confirm" width="500">
        <v-card>
          <v-card-text class="d-flex flex-column align-center pb-0">
            <img
              class="mt-4 mb-8"
              :src="base_url + `/images/exclamation.png`"
              alt="image list slide"
              width="130"
              max-width="130"
              height="auto"
            />
            <h3 class="mag-modal mb-8">
              ท่านยืนยันการชำระเงินเลขที่บิล {{mem_code}} ของผู้เช่าใช่หรือไม่ ?
              ?
            </h3>
          </v-card-text>
          <v-card-actions class="d-flex justify-center">
            <v-btn
              @click="updateStatus()"
              class="btn-success mb-32 mr-4 pl-30 pr-30"
            >
              <span>ใช่ , ฉันยืนยัน</span>
            </v-btn>
            <v-btn
              class="btn-danger mb-32 ml-4 pl-30 pr-30"
              @click="payment_confirm = false"
            >
              <span>ปิด</span>
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
  </div>
</template>

<script>
import meter_electric_bill from "../../../api/meter_electric_bill.js";
import tennant_member_electric from "../../../api/tennant_member_electric.js";
export default {
  data() {
    return {
      loading_page: false,
      payment_confirm: false,
      alert_success: false,
      alert_message_success: "",
      alert_error: false,
      alert_message_error: "",
      search: "",
      submenu: [
        {
          text: "รอบบิลค่าไฟ",
          disabled: false,
        },
        {
          text: "รอบบิล ID : IVW-2312",
          disabled: true,
        },
      ],
      headers: [
        {
          text: "ชื่ออาคาร",
          align: "center",
          sortable: true,
          value: "name",
        },
        {
          text: "จำนวนแผงเรียกเก็บ",
          value: "",
        },
        {
          text: "บันทึกค่าแล้ว",
          value: "",
        },
        {
          text: "ยังไม่ได้บันทึกค่า",
          value: "",
        },
        {
          text: "สถานะ",
          value: "",
        },
        {
          text: "จัดการ",
          value: "",
        },
      ],
      paymentList: [
        {
          text: "เลขที่บิล",
          align: "center",
          sortable: true,
          value: "no",
        },
        {
          text: "ผู้เช่า",
          value: "",
        },
        {
          text: "แผงเช่า",
          value: "",
        },
        {
          text: "การใช้ไฟรวม (หน่วย)",
          value: "",
        },
        {
          text: "ค่าไฟ (บาท)",
          value: "",
        },
        {
          text: "สถานะ",
          value: "",
        },
        {
          text: "วิธีการชำระเงิน",
          value: "",
        },
        {
          text: "ได้รับการแจ้งเตือนผ่าน Line/พิมพ์ใบวางบิลแล้ว",
          value: "",
        },
        {
          text: "จัดการ",
          value: "",
        },
      ],
      bill_detail: null,
      member_data: [],
      member_id: null,
      mem_code: null,
    };
  },
  methods: {
    async getDetailById() {
      let config = {
        headers: {
          Authorization: `Bearer ${this.$store.state.access_token}`,
        },
      };
      let id = this.$route.query.id;
      await meter_electric_bill
        .getDetailById(id, config)
        .then((result) => {
          if (result.data.success === true) {
            // this.loading_page = true;
            this.bill_detail = result.data.data;
            this.submenu[1].text = result.data.data.bill_code
            let data = {
                bill_code: result.data.data.bill_code
            }
            this.$store.commit('Add_bill_code', data);
          }
        })
        .catch((error) => {
          if (error.response.status === 401) {
            this.$store.commit("logOutSuccess");
            this.$router.push("/login");
          }
        });
    },
    async summary_confirm() {
      let config = {
        headers: {
          Authorization: `Bearer ${this.$store.state.access_token}`,
        },
      };
      let id = this.$route.query.id;
      await tennant_member_electric
        .summary_confirm(id, config)
        .then((result) => {
          if (result.data.success === true) {
            this.alert_success = true;
            this.alert_message_success = "บันทึกข้อมูลเรียบร้อย";
            setTimeout(() => {
              (this.alert_success = false), window.location.reload();
            }, 2000);
          }
        })
        .catch((error) => {
          if (error.response.status === 401) {
            this.$store.commit("logOutSuccess");
            this.$router.push("/login");
          }
        });
    },
    async updateStatus() {
      let config = {
        headers: {
          Authorization: `Bearer ${this.$store.state.access_token}`,
        },
      };
      let id = this.member_id;
      await tennant_member_electric
        .updateStatus(id, config)
        .then((result) => {
          if (result.data.success === true) {
            this.alert_success = true;
            this.alert_message_success = "บันทึกข้อมูลเรียบร้อย";
            setTimeout(() => {
              (this.alert_success = false),
                this.getList(),
                (this.payment_confirm = false);
            }, 2000);
          }
        })
        .catch((error) => {
          if (error.response.status === 401) {
            this.$store.commit("logOutSuccess");
            this.$router.push("/login");
          }
        });
    },
    async getList() {
      let config = {
        headers: {
          Authorization: `Bearer ${this.$store.state.access_token}`,
        },
      };
      let id = this.$route.query.id;
      await tennant_member_electric
        .getList(id, config)
        .then((result) => {
          if (result.data.success === true) {
            // this.loading_page = true;
            this.member_data = result.data.data;
          }
        })
        .catch((error) => {
          if (error.response.status === 401) {
            this.$store.commit("logOutSuccess");
            this.$router.push("/login");
          }
        });
    },
  },
  created() {},
  mounted() {
    this.getDetailById();
    this.getList();
  },
};
</script>

<style scoped lang="scss">
* {
  font-family: "Kanit", sans-serif !important;
}

.container-title {
  @media screen and (max-width: 960px) {
    flex-direction: column;
  }
}

.status_carry {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 94px;
  height: 21px;
  border-radius: 10px;
  background: linear-gradient(90deg, #fda270 0%, #ff5b00 100%);
  padding: 0 15px;

  color: #fff;
  text-align: center;
  font-size: 12px;
  font-weight: 500;
}

.status_success {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 94px;
  height: 21px;
  border-radius: 10px;
  background: linear-gradient(90deg, #85d680 0%, #62a878 100%);
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

.text-card-title {
  p {
    margin: 0;
    padding: 0;
  }

  span {
    color: #707070;
    font-size: 12px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
  }
}

.text-domain-name {
  color: #707070;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
}

.text-last-edit {
  color: #707070;
  text-align: right;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: normal;
}

.text-search-subtitle {
  color: #707070;
  font-size: 12px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
}
</style>
