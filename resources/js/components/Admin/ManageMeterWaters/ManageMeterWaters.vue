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
          <h1 class="font-20 m-0">จัดการมิเตอร์น้ำ</h1>
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
          ข้อมูลมิเตอร์น้ำปัจจุบัน
        </v-card-title>
        <v-card-text>
          <v-row>
            <v-col cols="" v-for="building in buildingData" :key="building">
              <v-btn @click="site_id = building.id, getList()" color="success" class="no-border" width="100%" outlined>
                {{ building.site_name }}
              </v-btn>
            </v-col>
          </v-row>
          <v-row>
            <v-col xs="12" sm="6" md="8" lg="8" xl="8" cols="12"> </v-col>
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
                      <td>{{ item.block_name }}</td>
                      <td>{{ item.start_meter }}</td>
                      <td>{{ item.username }}</td>
                      <td>{{ item.updated_date }}</td>
                      <td>
                        <v-btn
                          @click="
                            (meter_id = item.id),
                              (start_meter = item.start_meter),
                              (dialog_meter_water = true),
                              (block_name = item.block_name)
                          "
                          color="#FF5B00"
                          elevation="2"
                          outlined
                          rounded
                        >
                          <v-icon class="mr-2">mdi-pencil</v-icon>
                          ปรับข้อมูลมิเตอร์</v-btn
                        >
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

      <!-- เพิ่มมิเตอร์น้ำ -->
      <v-dialog v-model="dialog_meter_water" width="1054">
        <v-card>
          <v-card-title
            class="text-h5 color-black fs-20 h-65 p-0 pl-30 pr-30 d-flex justify-space-between bg-F8F8F8"
          >
            <span>ปรับข้อมูลมิเตอร์ แผง {{block_name}}</span>
            <v-btn
              @click="
                () => {
                  dialog_meter_water = false;
                }
              "
              class="p-0 m-0"
              width="50"
              height="50"
              style="min-width: 50px !important"
            >
              <img
                class="p-0 m-0"
                :src="base_url + `/images/icon/close.png`"
                alt="Keyword"
                width="20"
                height="20"
              />
            </v-btn>
          </v-card-title>
          <v-card class="mt-2 p-5 pb-3 pt-3" elevation="0">
            <v-form ref="form_water_add" v-on:submit.prevent="update()">
              <v-list-item class="pl-0 pr-0 ml-0 mr-0">
                <div class="row-list w-100" style="gap: 50px">
                  <div
                    class="col-list d-flex flex-column justify-center align-center w-100 max-w-100"
                  >
                    <v-card-text class="p-0 mt-2">
                      <div class="d-flex align-center">
                        <img
                          class="mr-2"
                          :src="base_url + `/images/icon/water.png`"
                          alt="water"
                          width="20"
                          height="20"
                          dark
                        />
                        <span class="font-16 color-title-card"
                          >ข้อมูลมิเตอร์น้ำปัจจุบันของแผง {{block_name}}
                          <span class="text-error">*</span></span
                        >
                      </div>
                    </v-card-text>
                  </div>
                </div>
              </v-list-item>
              <v-card-text class="p-0">
                <v-row>
                  <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                    <p class="font-14 fw-500 color-707070">
                      เลขมิเตอร์ <span class="text-error">*</span>
                    </p>
                    <v-text-field
                      label="กรุณากรอกเลขมิเตอร์"
                      hide-details="auto"
                      outlined
                      v-model="start_meter"
                      :rules="[v => !!v || 'กรุณาป้อนข้อมูล']"
                      dense
                      type="text"
                      maxlength="6"
                      single-line
                    ></v-text-field>
                  </v-col>
                </v-row>
              </v-card-text>
              <v-card-actions class="d-flex justify-center">
                <v-btn
                  type="submit"
                  class="btn-success pl-30 pr-30 mt-10"
                  color="warning"
                  dark
                >
                  <v-icon class="fs-20" left dark> mdi-content-save </v-icon>
                  <span>บันทึกข้อมูล</span>
                </v-btn>
              </v-card-actions>
            </v-form>
          </v-card>
        </v-card>
      </v-dialog>
    </div>
  </div>
</template>

<script>
import market_panels from "../../../api/market_panels.js";
import meter_water from "../../../api/meter_water.js";
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
      meter_data: [],
      submenu: [
        {
          text: "จัดการมิเตอร์น้ำ",
          disabled: true,
        },
      ],
      search: "",
      itemsPerPage: 10,
      headers: [
        {
          text: "ลำดับ",
          align: "center",
          sortable: true,
          value: "id",
        },
        {
          text: "ชื่อแผง",
          value: "",
        },
        {
          text: "เลขมิเตอร์",
          value: "",
        },
        {
          text: "ผู้แก้ไขล่าสุด",
          value: "",
        },
        {
          text: "วันที่-เวลาที่แก้ไขล่าสุด",
          value: "",
        },
        {
          text: "จัดการ",
          value: "",
        },
      ],
      page: 1,
      pages: 1,
      meter_id: null,
      start_meter: null,
      block_name: null,
    };
  },
  methods: {
    // ข้อมูล อาคาร
    async buildingList() {
      let config = {
        headers: {
          Authorization: `Bearer ${this.$store.state.access_token}`,
        },
      };
      await market_panels
        .buildingList(config)
        .then((result) => {
          if (result.data.success === true) {
            this.loading_page = true;
            this.buildingData = result.data.data;
            this.site_id = result.data.data[0].id;
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
        if(this.$refs.form_water_add.validate()){
      let config = {
        headers: {
          Authorization: `Bearer ${this.$store.state.access_token}`,
        },
      };
      let data = {
        id: this.meter_id,
        start_meter: this.start_meter
      }
      await meter_water
        .update(data, config)
        .then((result) => {
          if (result.data.success === true) {
            this.loading_page = true;
            this.getList();
            this.alert_message_success = "บันทึกข้อมูลเรียบร้อย";
            this.alert_success = true;
            setTimeout(() => {this.alert_success = false, this.dialog_meter_water = false}, 2000)
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
      await meter_water
        .getList(this.page, this.search, this.site_id, config)
        .then((result) => {
          if (result.data.success === true) {
            // this.loading_page = true;
            this.meter_data = result.data.data;
            this.page = parseFloat(result.data.current_page)
            this.pages = parseFloat(result.data.pages)
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
  await  this.buildingList();
   await this.getList();
  },
  watch: {
    page() {
        this.getList()
    },
    search() {
        this.getList()
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

.review_approval_2 {
  display: flex;
  align-items: center;
  justify-content: center;
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

.no-border {
  border-top: 0px solid;
  border-left: 0px solid;
  border-right: 0px solid;
}

.no-border-all {
  border: 0px solid;
}
</style>
