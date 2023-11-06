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
          <h1 class="font-20 m-0">บัมทึกค่ามิเตอร์ไฟ</h1>
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
                <v-card-title class="p-0 text-card-title mb-4">
                  <p>ข้อมูลมิเตอร์ไฟ</p>
                </v-card-title>
                <v-card-text class="p-0 mt-4">
                  <div class="d-flex align-center mb-4">
                    <img
                      class="mr-2"
                      :src="base_url + `/images/icon/store.png`"
                      alt="Contact"
                      width="20"
                      height="20"
                    />
                    <span class="font-16 color-title-card"
                      >รายการแผงอาคาร A</span
                    >
                  </div>

                  <v-data-table
                    :headers="headers"
                    :items="bill_detail"
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
                        <td class="text-center">
                          {{
                            formatPrice(parseInt(
                              item.current_meter == null
                                ? 0
                                : item.current_meter
                            ) - parseInt(item.start_meter))
                          }}
                        </td>
                        <td class="text-center">
                          ({{ item.cost_electricity_unit_rate }})
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
import meter_electric_bill from "../../../api/meter_electric_bill.js";
export default {
  data() {
    return {
      loading_page: false,
      submenu: [
        {
          text: "รอบบิลค่าไฟ",
          disabled: false,
        },
        {
          text: "รอบบิล ID : IVW-2312",
          disabled: false,
        },
        {
          text: "บันทึกค่ามิเตอร์ไฟ",
          disabled: true,
        },
      ],
      headers: [
        {
          text: "ชื่อแผง",
          align: "center",
          sortable: true,
          value: "name",
        },
        {
          text: "เลขมิเตอร์ล่าสุด",
          value: "",
        },
        {
          text: "เลขมิเตอร์ปัจจุบัน",
          value: "",
        },
        {
          text: "การใช้ไฟ (หน่วย)",
          value: "",
          align: "center",
        },
        {
          text: "ค่าไฟต่อแผง (บาท)",
          value: "",
          align: "center",
        },
      ],
      bill_detail: [],
    };
  },
  methods: {
    async getDetailSaveMeterById() {
      let config = {
        headers: {
          Authorization: `Bearer ${this.$store.state.access_token}`,
        },
      };
      let id = this.$route.query.id;
      let bill_id = this.$route.query.bill_id;
      await meter_electric_bill
        .getDetailSaveMeterById(id, bill_id, config)
        .then((result) => {
          if (result.data.success === true) {
            // this.loading_page = true;
            this.submenu[1].text = result.data.data.bill_code
            this.bill_detail = result.data.data;
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
    this.getDetailSaveMeterById();
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

.status_not_yed {
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
