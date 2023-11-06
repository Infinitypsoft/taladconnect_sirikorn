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
    <div class="container">
      <div class="d-flex justify-space-between align-items-center mt-4 mb-4">
        <v-card-text class="p-0">
          <h1 class="font-20 m-0">รายละเอียดบิลเรียกเก็บ</h1>
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
                      <div class="d-flex align-items-center">
                        <p>รายละเอียดบิลเรียกเก็บ</p>
                        <span
                          v-if="bill_detail.status == 0"
                          class="status_carry ml-2"
                          >ค้างชำระ</span
                        >
                        <span v-else class="status_success text-white ml-2"
                          >ชำระแล้ว</span
                        >
                      </div>
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
                      >เลขที่บิล : {{ bill_detail.bill_code }}</span
                    >
                  </div>

                  <v-row>
                    <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                      <p class="font-16 color-707070 mb-0">
                        ผู้เช่า : {{ bill_detail.member_name }}
                      </p>
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                      <p class="font-16 color-707070 mb-0">
                        วิธีการชำระเงิน :
                        {{
                          bill_detail.pay_status == 0
                            ? "ยังไม่ได้ชำระ"
                            : bill_detail.pay_status == 1
                            ? "จุดชำระเงินของตลาด"
                            : "LINE OA"
                        }}
                      </p>
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                      <p class="font-16 color-707070 mb-0">
                        ได้รับการแจ้งเตือนผ่าน Line/พิมพ์ใบวางบิลแล้ว :
                        <v-icon
                          color="#62A878"
                          v-if="bill_detail.noti_status == 1"
                          >mdi-check</v-icon
                        ><v-icon v-else color="#E60023">mdi-close</v-icon>
                      </p>
                    </v-col>
                  </v-row>
                </v-card-text>
                <v-card-text class="p-0 mt-2">
                  <div class="d-flex align-center mb-4">
                    <img
                      class="mr-2"
                      :src="base_url + `/images/icon/store.png`"
                      alt="Contact"
                      width="20"
                      height="20"
                    />
                    <span class="font-16 color-title-card"
                      >รายการแผงที่เช่า</span
                    >
                  </div>
                  <v-row>
                    <v-col xs="12" sm="12" md="12" lg="12" xl="12" cols="12">
                      <v-data-table
                        :headers="paymentList"
                        :items="bill_detail.list"
                        :items-per-page="itemsPerPage"
                        elevation="0"
                        :search="search"
                        :page.sync="page"
                        hide-default-footer
                        @page-count="page = $event"
                      >
                        <template v-slot:item="{ item }">
                          <tr>
                            <td class="text-center">{{ item.block_name }}</td>
                            <td>{{ item.start_meter }}</td>
                            <td>{{ item.current_meter }}</td>
                            <td>
                              {{
                               formatPrice( parseInt(
                                  item.current_meter == null
                                    ? 0
                                    : item.current_meter
                                ) - parseInt(item.start_meter))
                              }}
                            </td>
                            <td>
                              {{
                                formatPrice((parseInt(
                                  item.current_meter == null
                                    ? 0
                                    : item.current_meter
                                ) -
                                  parseInt(item.start_meter)) *
                                parseFloat(item.cost_electricity_unit_rate))
                              }}
                            </td>
                          </tr>
                        </template>
                      </v-data-table>
                    </v-col>
                    <v-col
                      xs="12"
                      sm="12"
                      md="6"
                      lg="6"
                      xl="6"
                      cols="6"
                    ></v-col>
                    <v-col xs="12" sm="12" md="6" lg="6" xl="6" cols="6">
                      <div class="summary-data">
                        <span class="summary-text">รวมยอดเงินค่าน้ำ</span>
                        <span class="summary-money">{{formatPrice(total)}}</span>
                      </div>
                    </v-col>
                  </v-row>
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
import tennant_member_water from "../../../api/tennant_member_water.js";
export default {
  data() {
    return {
      loading_page: false,
      dialog_delete: false,
      search: "",
      DataList: [],
      submenu: [
        {
          text: "รอบบิลค่าน้ำ",
          disabled: false,
        },
        {
          text: "รอบบิล ID : IVW-2312",
          disabled: false,
        },
        {
          text: "รายละเอียดบิลเรียกเก็บ",
          disabled: true,
        },
      ],
      paymentList: [
        {
          text: "แผงเช่า",
          value: "",
        },
        {
          text: "เลขมิเตอร์ล่าสุด",
          value: "",
        },
        {
          text: "เลขมิเตอร์ล่าสุด",
          value: "",
        },
        {
          text: "การใช้น้ำ (หน่วย)",
          value: "",
        },
        {
          text: "ค่าน้ำต่อแผง (บาท)",
          value: "",
        },
      ],
      bill_detail: null,
      total: 0,
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
      await tennant_member_water
        .getDetailById(id, config)
        .then((result) => {
          if (result.data.success === true) {
            // this.loading_page = true;
            this.submenu[1].text = this.$store.state.bill_code;
            this.bill_detail = result.data.data;
             result.data.data.list.map((item) => {
              this.total += (parseInt(item.current_meter == null ? 0 : item.current_meter) -
                parseInt(item.start_meter)) *
                parseFloat(item.cost_electricity_unit_rate);
            });
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

.summary-data {
  border-radius: 5px;
  border: 1px solid rgba(116, 176, 136, 0.5);
  background: rgba(116, 176, 136, 0.15);
  padding: 15px 25px 14px 25px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.summary-data .summary-text,
.summary-data .summary-money {
  color: #74b088;
  font-size: 16px;
  font-weight: 700;
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

  color: #fff !important;
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
