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
          <h1 class="font-20 m-0">รอบบิลค่าไฟ</h1>
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
          รายการรอบบิลทั้งหมด
        </v-card-title>
        <v-card-subtitle class="mb-6">
          <v-btn
            @click="linkPage('/managemeterelectricity/billcycle/add')"
            class="btn-success pl-30 pr-30 mt-6"
            dark
          >
            <img
              :src="base_url + `/images/icon/waterbill.png`"
              alt=""
              width="20"
              height="20"
            />
            <span>สร้างรอบบิลใหม่</span>
          </v-btn>
        </v-card-subtitle>
        <v-card-text>
          <v-row>
            <v-col xs="12" sm="6" md="8" lg="8" xl="8" cols="12"></v-col>
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
              <v-simple-table>
                <template v-slot:default>
                  <thead>
                    <tr>
                      <th class="text-left" v-for="item in headers" :key="item">
                        {{ item.text }}
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in meter_data" :key="item">
                      <td class="text-center">{{ index + 1 }}</td>
                      <td>{{ item.bill_code }}</td>
                      <td>{{ item.bill_name }}</td>
                      <td>{{ formatPrice(item.total) }}</td>
                      <td>{{ formatPrice(item.total_paid) }}</td>
                      <td>{{ formatPrice(item.total_overdue) }}</td>
                      <td>{{ item.username }}</td>
                      <td>
                        <span v-if="item.status == 0" class="status_draft"
                          >เอกสารร่าง</span
                        >
                        <span v-if="item.status == 1" class="status_carry"
                          >ดำเนินการ</span
                        >
                        <span v-if="item.status == 2" class="status_success"
                          >สำเร็จ</span
                        >
                        <span v-if="item.status == 3" class="status_danger"
                          >ยกเลิก</span
                        >
                      </td>
                      <td>
                        <v-btn
                        v-if="item.status == 0"
                        @click="updateStatus(item.id)"
                          class="ma-1 m-0 p-0"
                          width="38"
                          height="38"
                          outlined
                          large
                          fab
                          elevation="4"
                          color="#65AB79"
                        >
                          <v-icon>mdi-file-document-check-outline</v-icon>
                        </v-btn>
                        <v-btn
                        @click="linkPage('/managemeterelectricity/billcycle/detailbill?id='+item.id)"
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
                        v-if="item.status == 0"
                        @click="getdelete(item.id)"
                          class="ma-1 m-0 p-0"
                          width="38"
                          height="38"
                          outlined
                          large
                          fab
                          elevation="4"
                          color="#FF1E1E"
                        >
                          <v-icon>mdi-text-box-remove-outline</v-icon>
                        </v-btn>
                      </td>
                    </tr>
                  </tbody>
                </template>
              </v-simple-table>
            </v-col>
            <v-col
              xs="12"
              sm="12"
              md="6"
              lg="6"
              xl="6"
              cols="12"
              class="d-flex align-items-center"
            >
              <div class="text-footer-table">
                แสดงตั้งแต่ 1 ถึง 10 จาก 12 รายการ
              </div>
            </v-col>
            <v-col xs="12" sm="12" md="6" lg="6" xl="6" cols="12">
              <div class="d-flex align-items-center justify-end">
                <v-pagination
                  class="pagination_review"
                  v-model="page"
                  :length="pages"
                  prev-icon="< ก่อน"
                  next-icon="ต่อไป >"
                  color="#86D780"
                  navigation-color="#F0F0F0"
                  flat
                  circle
                ></v-pagination>
              </div>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>
    </div>
  </div>
</template>

<script>
import meter_electric_bill from "../../../api/meter_electric_bill.js";
export default {
  data() {
    return {
      dialog_detail: false,
      loading_page: false,
      alert_success: false,
      alert_message_success: "",
      alert_error: false,
      alert_message_error: "",
      dialog_meter_water: false,
      buildingData: [],
      submenu: [
        {
          text: "รอบบิลค่าไฟ",
          disabled: true,
        },
      ],
      search: "",
      itemsPerPage: 10,
      headers: [
        {
          text: "ID",
          align: "center",
          sortable: true,
          value: "id",
        },
        {
          text: "รอบบิล",
          value: "",
        },
        {
          text: "ระยะเวลาการชำระเงิน",
          value: "",
        },
        {
          text: "ยอดรวม",
          value: "",
        },
        {
          text: "ชำระแล้ว",
          value: "",
        },
        {
          text: "ค้างชำระ",
          value: "",
        },
        {
          text: "ผู้สร้างรอบบิล",
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
      page: 1,
      pages: 0,
      meter_id: null,
      start_meter: null,
      block_name: null,
      meter_data: [],
    };
  },
  methods: {
    async getdelete(id) {
      let config = {
        headers: {
          Authorization: `Bearer ${this.$store.state.access_token}`,
        },
      };
      await meter_electric_bill
        .delete(id, config)
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
    async updateStatus(id) {
        let config = {
          headers: {
            Authorization: `Bearer ${this.$store.state.access_token}`,
          },
        };

        await meter_electric_bill
          .updateStatus(id, config)
          .then((result) => {
            if (result.data.success === true) {
              this.loading_page = true;
              this.getList();
              this.alert_message_success = "บันทึกข้อมูลเรียบร้อย";
              this.alert_success = true;
              setTimeout(() => {
                (this.alert_success = false),
                  (this.dialog_meter_electricity = false);
              }, 2000);
              this.loading_page = false;
            }
          })
          .catch((error) => {
            if (error.response.status === 401) {
              this.loading_page = false;
              this.$store.commit("logOutSuccess");
              this.$router.push("/login");
            }
          });

    },
    async update() {
      if (this.$refs.form_electric_add.validate()) {
        let config = {
          headers: {
            Authorization: `Bearer ${this.$store.state.access_token}`,
          },
        };
        let data = {
          id: this.meter_id,
          start_meter: this.start_meter,
        };
        await meter_electric_bill
          .update(data, config)
          .then((result) => {
            if (result.data.success === true) {
              this.loading_page = true;
              this.getList();
              this.alert_message_success = "บันทึกข้อมูลเรียบร้อย";
              this.alert_success = true;
              setTimeout(() => {
                (this.alert_success = false),
                  (this.dialog_meter_electricity = false);
              }, 2000);
              this.loading_page = false;
            }
          })
          .catch((error) => {
            if (error.response.status === 401) {
              this.loading_page = false;
              this.$store.commit("logOutSuccess");
              this.$router.push("/login");
            }
          });
      }
    },
    async getList() {
      let config = {
        headers: {
          Authorization: `Bearer ${this.$store.state.access_token}`,
        },
      };
      await meter_electric_bill
        .getList(this.page, this.search, config)
        .then((result) => {
          if (result.data.success === true) {
            // this.loading_page = true;
            this.meter_data = result.data.data;
            this.page = parseFloat(result.data.current_page);
            this.pages = parseFloat(result.data.pages);
            this.loading_page = false;
          }
        })
        .catch((error) => {
          if (error.response.status === 401) {
            this.loading_page = false;
            this.$store.commit("logOutSuccess");
            this.$router.push("/login");
          }
        });
    },
  },
  created() {},
  async mounted() {
    this.getList();
  },
  watch: {
    page() {
         this.getList();
    },
    search() {
         this.getList();
    },
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

.status_draft {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 94px;
  height: 21px;
  border-radius: 10px;
  background: linear-gradient(90deg, #707070 0%, #b7b7b7 100%);
  padding: 0 15px;

  color: #fff;
  text-align: center;
  font-size: 12px;
  font-weight: 500;
}

.status_danger {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 94px;
  height: 21px;
  border-radius: 10px;
  background: linear-gradient(90deg, #ff6a6a 0%, #ff0000 100%);
  padding: 0 15px;

  color: #fff;
  text-align: center;
  font-size: 12px;
  font-weight: 500;
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

.no-border {
  border-top: 0px solid;
  border-left: 0px solid;
  border-right: 0px solid;
}

.no-border-all {
  border: 0px solid;
}
</style>
