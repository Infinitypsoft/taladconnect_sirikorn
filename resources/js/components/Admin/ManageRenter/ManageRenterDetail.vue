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
          <h1 class="font-20 m-0">รายละเอียดสมาชิกผู้เช่า</h1>
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
          <v-card elevation="2" class="mb-6">
            <v-row class="m-0 p-4">
              <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                <v-card-title class="p-0 text-card-title">
                  <v-row class="container-title">
                    <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                      <p>รายละเอียดสมาชิกผู้เช่า</p>
                    </v-col>
                  </v-row>
                </v-card-title>
                <v-card-text class="p-0 mt-4">
                  <div class="d-flex align-center mb-4">
                    <img
                      class="mr-2"
                      :src="
                        base_url +
                        `/images/icon/843b5ac6e45d66deccc42ce990f7acc8.png`
                      "
                      alt="Contact"
                      width="20"
                      height="20"
                    />
                    <span class="font-16 color-title-card"
                      >ข้อมูลส่วนตัวของผู้เช่า</span
                    >
                  </div>

                  <v-row>
                    <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                      <p class="font-16 color-707070 mb-0">
                        ประเภทของบุคคล :
                        {{
                          get_data.tennant_type === 0
                            ? "บุคคลธรรมดา"
                            : "นิติบุคคล"
                        }}
                      </p>
                    </v-col>
                    <v-col
                      v-if="get_data.tennant_type === 0"
                      cols="12"
                      xs="12"
                      sm="12"
                      md="6"
                      lg="6"
                      xl="6"
                    >
                    </v-col>
                    <v-col
                      v-if="get_data.tennant_type === 1"
                      cols="12"
                      xs="12"
                      sm="12"
                      md="6"
                      lg="6"
                      xl="6"
                    >
                      <p class="font-16 color-707070 mb-0">
                        การคิดภาษี :
                        {{
                          get_data.vat_type === 0
                            ? "ภาษีรวมใน"
                            : get_data.vat_type === 1
                            ? "ภาษีรวมนอก"
                            : "ไม่คิดภาษี"
                        }}
                      </p>
                    </v-col>
                    <v-col
                      v-if="get_data.tennant_type === 0"
                      cols="12"
                      xs="12"
                      sm="12"
                      md="6"
                      lg="6"
                      xl="6"
                    >
                      <p class="font-16 color-707070 mb-0">
                        ชื่อผู้เช่า : {{ get_data.title_name }}
                        {{ get_data.name }}
                      </p>
                    </v-col>
                    <v-col
                      v-if="get_data.tennant_type === 1"
                      cols="12"
                      xs="12"
                      sm="12"
                      md="6"
                      lg="6"
                      xl="6"
                    >
                      <p class="font-16 color-707070 mb-0">
                        ชื่อบริษัท : {{ get_data.company_name }}
                      </p>
                    </v-col>
                    <v-col
                      v-if="get_data.tennant_type === 0"
                      cols="12"
                      xs="12"
                      sm="12"
                      md="6"
                      lg="6"
                      xl="6"
                    >
                      <p class="font-16 color-707070 mb-0">
                        เลขที่บัตรประชาชน :
                        {{ get_data.personal_id ? get_data.personal_id : "-" }}
                      </p>
                    </v-col>
                    <v-col
                      v-if="get_data.tennant_type === 1"
                      cols="12"
                      xs="12"
                      sm="12"
                      md="6"
                      lg="6"
                      xl="6"
                    >
                      <p class="font-16 color-707070 mb-0">
                        เลขประจำตัวผู้เสียภาษีอากร : {{ get_data.tax_number }}
                      </p>
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                      <p class="font-16 color-707070 mb-0">
                        อีเมล : {{ get_data.email ? get_data.email : "-" }}
                      </p>
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                      <p class="font-16 color-707070 mb-0">
                        เบอร์โทร : {{ get_data.tel ? get_data.tel : "-" }}
                      </p>
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                      <p class="font-16 color-707070">
                        ที่อยู่ :
                        {{ get_data.address ? get_data.address : "-" }}
                      </p>
                    </v-col>
                  </v-row>
                </v-card-text>
                <v-card-text class="p-0 mt-2">
                  <div class="d-flex align-center mb-4">
                    <img
                      class="mr-2"
                      :src="
                        base_url +
                        `/images/icon/26be0f1b0a70467c883a60356d5a2757.png`
                      "
                      alt="Contact"
                      width="20"
                      height="20"
                    />
                    <span class="font-16 color-title-card">การสมัครสมาชิก</span>
                  </div>

                  <v-row>
                    <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                      <p class="font-16 color-707070">
                        วิธีการสมัครสมาชิก :
                        {{
                          get_data.register_type === 0
                            ? "ช่องทาง Line"
                            : "แอดมินสมัครในระบบ"
                        }}
                      </p>
                    </v-col>
                  </v-row>
                </v-card-text>
              </v-col>
            </v-row>
          </v-card>

          <v-card elevation="2">
            <v-row class="m-0 p-4">
              <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                <v-card-title class="p-0 text-card-title mb-4">
                  <v-row class="container-title">
                    <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                      <p>ข้อมูลร้านค้า</p>
                    </v-col>
                    <v-col
                      class="container-title-left"
                      cols="12"
                      xs="12"
                      sm="12"
                      md="6"
                      lg="6"
                      xl="6"
                    >
                      <v-btn
                        @click="
                          linkPage(
                            '/managerenter/detail/add_thai?id=' +
                              $route.query.id
                          )
                        "
                        class="btn-success"
                        color="warning"
                        dark
                      >
                        <img
                          class="mr-2"
                          :src="
                            base_url +
                            `/images/icon/c6729528ce3515465ae8391ea6975234.png`
                          "
                          alt=""
                          width="20"
                          height="20"
                        />
                        <span class="fs-16 fw-500 color-F9F9F9"
                          >เพิ่มข้อมูลร้านค้า</span
                        >
                      </v-btn>
                    </v-col>
                  </v-row>
                </v-card-title>

                <v-card elevation="0">
                      <v-card flat>
                        <v-card-text
                          class="fs-18 fw-600 color-707070 pl-0 pr-0 mb-5"
                          >ข้อมูลร้านค้า</v-card-text
                        >
                        <v-card
                          elevation="2"
                          v-for="(main, index) in storeList"
                          :key="index"
                        >
                          <div class="container">
                            <v-row>
                              <v-col cols="12" class="d-flex justify-content-between">
                                <div class="p-5 bg-info border-radius">
                                  <h2>test</h2>
                                </div>
                                <div>
                                  <v-btn
                                    @click="
                                      linkPage(
                                        '/managerenter/detail/edit_thai?id=' +
                                          $route.query.id +
                                          '&store_id=' +main.id
                                      )
                                    "
                                    class="btn-edit"
                                    color="warning"
                                    dark
                                  >
                                    <v-icon
                                      class="icon-btn-edit"
                                      large
                                      color="white"
                                    >
                                      mdi-pencil
                                    </v-icon>
                                    แก้ไขร้านค้า
                                  </v-btn>
                                </div>
                              </v-col>
                            </v-row>
                            <v-row>
                              <v-col
                                cols="12"
                                xs="12"
                                sm="12"
                                md="12"
                                lg="6"
                                xl="6"
                              >
                                <template>
                                  <v-carousel class="br-23" hide-delimiters>
                                    <v-carousel-item
                                      v-for="(item, i) in main.pic_list"
                                      :key="i"
                                      :src="`${base_url}/${item.pic_path}`"
                                    ></v-carousel-item>
                                  </v-carousel>
                                </template>
                              </v-col>
                              <v-col
                                cols="12"
                                xs="12"
                                sm="12"
                                md="12"
                                lg="6"
                                xl="6"
                              >
                                <v-card-text
                                  class="fs-48 fw-600 text-black mb-70"
                                >
                                  {{ main.store_name }}
                                </v-card-text>
                                <v-card-text
                                  class="fs-18 fw-400 color-212621 mb-5"
                                >
                                  {{ main.description_short }}
                                </v-card-text>
                                <v-row class="m-0">
                                  <v-col
                                    class="d-flex flex-column"
                                    cols="12"
                                    xs="12"
                                    sm="12"
                                    md="4"
                                    lg="4"
                                    xl="4"
                                  >
                                    <span class="fs-18 fw-400 color-808080"
                                      >ประเภทร้านค้า</span
                                    >
                                    <span class="fs-18 fw-400 color-212621">{{
                                      main.store_type
                                    }}</span>
                                  </v-col>
                                  <v-col
                                    class="d-flex flex-column"
                                    cols="12"
                                    xs="12"
                                    sm="12"
                                    md="4"
                                    lg="4"
                                    xl="4"
                                  >
                                    <span class="fs-18 fw-400 color-808080"
                                      >ประเภทสินค้า</span
                                    >
                                    <span class="fs-18 fw-400 color-212621"
                                      >{{main.product_type}}</span
                                    >
                                  </v-col>
                                  <v-col
                                    class="d-flex flex-column"
                                    cols="12"
                                    xs="12"
                                    sm="12"
                                    md="4"
                                    lg="4"
                                    xl="4"
                                  >
                                    <span class="fs-18 fw-400 color-808080"
                                      >ช่วงราคา</span
                                    >
                                    <span class="fs-18 fw-400 color-212621"
                                      >{{main.storeList}} - {{main.price_max}} บาท</span
                                    >
                                  </v-col>
                                </v-row>
                                <v-col class="d-flex align-center">
                                  <span class="fs-20 mr-4 text-black"
                                    >ติดต่อร้านค้า</span
                                  >
                                  <img
                                  @click="gethref(main.location)"
                                    class="mr-2"
                                    :src="
                                      base_url +
                                      `/images/icon/78d842b942ba3a3cca875f60914d3fbd.png`
                                    "
                                    alt=""
                                    width="22"
                                    height="22"
                                  />
                                  <img
                                  @click="gethref(main.facebook_link)"
                                    class="mr-2"
                                    :src="
                                      base_url +
                                      `/images/icon/109e8f847a90d6b264d592d41db35f98.png`
                                    "
                                    alt=""
                                    width="22"
                                    height="22"
                                  />
                                  <img
                                  @click="gethref(main.line_link)"
                                    class="mr-2"
                                    :src="
                                      base_url +
                                      `/images/icon/fe16e182e34842295dbdfe5f067b9399.png`
                                    "
                                    alt=""
                                    width="22"
                                    height="22"
                                  />
                                  <img
                                  @click="gethref(main.instagram_link)"
                                    class="mr-2"
                                    :src="
                                      base_url +
                                      `/images/icon/b4d5127da4f02b43273487a9fe1ddf09.png`
                                    "
                                    alt=""
                                    width="22"
                                    height="22"
                                  />
                                  <img
                                  @click="gethref(main.tiktok_link)"
                                    class="mr-2"
                                    :src="
                                      base_url +
                                      `/images/icon/1c331126cf9e7cb1c588133294e7ea44.png`
                                    "
                                    alt=""
                                    width="22"
                                    height="22"
                                  />
                                </v-col>
                                <div>
                                  <v-btn
                                    class="ma-2"
                                    outlined
                                    style="
                                      border-radius: 5px;
                                      border: 1px solid rgba(26, 150, 212, 0.4);
                                    "
                                  >
                                    <img
                                      class="mr-2"
                                      :src="
                                        base_url +
                                        `/images/icon/600f0f2c54f9f5fa61048b4c0da0cfbf.png`
                                      "
                                      alt=""
                                      width="22"
                                      height="22"
                                    />
                                    <span class="fs-16 fw-500 color-1A96D4"
                                      >เปิดทุกวัน เวลา {{main.time_open}}-{{main.time_close}} น.</span
                                    >
                                  </v-btn>
                                  <v-btn
                                    class="ma-2 bg-E8F4FB"
                                    outlined
                                    style="
                                      border-radius: 5px;
                                      border: 1px solid rgba(26, 150, 212, 0.4);
                                    "
                                  >
                                    <img
                                      class="mr-2"
                                      :src="
                                        base_url +
                                        `/images/icon/17ddd9969c3f4dcb25c339c81e1e05c0.png`
                                      "
                                      alt=""
                                      width="22"
                                      height="22"
                                    />
                                    <span class="fs-16 fw-500 color-1A96D4"
                                      >{{main.tel}}</span
                                    >
                                  </v-btn>
                                </div>
                              </v-col>
                            </v-row>
                          </div>
                        </v-card>
                      </v-card>
                </v-card>
              </v-col>
            </v-row>
          </v-card>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script>
import tennant from "../../../api/tennant.js";
import store from "../../../api/store.js";

export default {
  data() {
    return {
      loading_page: false,
      submenu: [
        {
          text: "จัดการสมาชิกผู้เช่า",
          disabled: false,
        },
        {
          text: "รายละเอียดสมาชิกผู้เช่า",
          disabled: true,
        },
      ],
      get_data: {
        prefix_type: 1,
        tenant_name: "เมฆคินทร์ วิรัลยุพา",
        id_card: "",
        birthday: "",
        phone: "0809736947",
        address: "",
        radio_register: 0,
      },
      data_store: {
        store_name: "กุ้งซิ่งสายคลอง สระบุรี",
        store_description:
          "กุ้งเป็นๆ เนื้อหวาน ที่ร้านมีเมนูให้เลือกอร่อยเพียบ ทั้งกุ้งเผา แซลมอนดองซีอิ๊ว กุ้งดองซีอิ๊ว ทอดมันกุ้งและกุ้งเผาเเกะเเล้วทานกับข้าวญี่ปุ่นหรือสาหร่าย กินคู่กับน้ำจิ้มซีฟู้ดสุดแซ่บ",
        store_type: "ร้านอาหาร",
        product_type: "อาหารจานเดียว",
        price_min: 20,
        price_max: 410,
      },
      id: this.$route.query.id,
      getDetail: {},
      pages: 1,
      page: 1,
      active_tab: "",
      image_shop_cover: [],
      image_food_list: [],
      seo_data: {},
      keyword: `ผักสด , ผลไม้สด , ตลาดท้องถิ่น , สินค้าเกษตร , แหล่งซื้อผลไม้ ,ตลาดสดอำเภอxxxx ,ตลาดxxxx ,พืชผักสดจากสวน , ข้าวอินทรีย์ , ข้าวสารสดใหม่ , เครื่องปรุง , อาหารท้องถิ่น ,สินค้าเกษตรอินทรีย์, ตลาดชุมชน , ซื้อของฝาก , ของฝากราคาถูก ,ผลไม้ตามฤดูกาล , ตลาดขายส่ง, สินค้าสุขภาพ ,หมูสด , ไก่สด , ปลาสด , อาหารทะเล , ซื้อของฝากจังหวัดxxxxx , ขายปลีก-ส่ง , วัตถุดิบ , ประกอบอาหาร , market , fresh vegetables , fresh fruit , Local food , condiment , กินอะไรดี, ของเด็ดจังหวัด , ของขึ้นชื่อ , อาหารปรุงสุก , อาหารพร้อมทาน , ผักสวนครัว ,ผักตามฤดูกาล ,ผลไม้ตามฤดูกาล , อาหารป่า , คุณภาพสดใหม่ , แผงผัก , ซื้อสดจากเกษตรกร ,ออแกนิกส์ , การเลี้ยงสัตว์ท้องถิ่น , รสชาติสดใหม่ , ผลไม้รสชาติดี ,Farm-fresh goodness ,Gourmet foods`,
      storeList: [],
    };
  },
  methods: {
    async getList() {
      let config = {
        headers: {
          Authorization: `Bearer ${this.$store.state.access_token}`,
        },
      };
      await tennant
        .tennantDetail(this.base64Decode(this.id), config)
        .then((result) => {
          if (result.data.success === true) {
            this.get_data = result.data.data;
          }
        })
        .catch((error) => {
          if (error.response.status === 401) {
            this.loading_page = false;
            this.$store.commit("logOutSuccess");
            this.$router.push("/login");
          }
        });

      // this.image_shop_cover = [
      //     ...this.image_shop_cover,
      //     {
      //         pic_path: this.base_url + `/images/9c7ffc04896a3eb8d0005ab3a55d250e.png`,
      //     },
      //     {
      //         pic_path: this.base_url + `/images/9c7ffc04896a3eb8d0005ab3a55d250e.png`,
      //     }
      // ]
      // this.image_food_list = [
      //     ...this.image_food_list,
      //     {
      //         pic_path: this.base_url + `/images/a69e07344b465b3c2eddcbd0fb94768e.png`,
      //         menu_name: 'กุ้งหน้าชีส',
      //         price: 149,
      //         description: 'กุ้งเผา (13-14 ตัวโล) จำนวน 4 ตัวมอสซาเลลาลัส + น้ำจิ้มซีฟู้ด ลด 20 บาทเมื่อมีไลน์ของทางร้าน'
      //     },
      //     {
      //         pic_path: this.base_url + `/images/a83c92e79cd929c704f1c76b11414d08.png`,
      //         menu_name: 'กุ้งเผาถ่าน (ครึ่งกิโล)',
      //         price: 219,
      //         description: 'กุ้งเผาเต่าถ่านครึ่งกิโล น้ำจิ้มซีฟู้ด ลด 20 บาทเมื่อมีไลน์ของทางร้าน'
      //     },
      //     {
      //         pic_path: this.base_url + `/images/635156cbf2bcce330f1a728a5c81c563.png`,
      //         menu_name: 'กุ้งดองซีอิ๊ว',
      //         price: 149,
      //         description: 'กุ้งดอง (40-44 ตัวโล) 12 ตัว น้ำดองสูตรเด็ดและน้ำจิ้มซีฟู้ด'
      //     },
      //     {
      //         pic_path: this.base_url + `/images/07fa90969b82d579aaf73bb7b185edb2.png`,
      //         menu_name: 'แซลม่อนดองซีอิ๊ว',
      //         price: 239,
      //         description: 'แซลม่อนนอเวย์ 150 กรัม น้ำดองสูตรเด็ดและน้ำจิ้มซีฟู้ด'
      //     }

      // ]
    },
    async getStoreList() {
      let config = {
        headers: {
          Authorization: `Bearer ${this.$store.state.access_token}`,
        },
      };
      await store
        .getStoreList(this.base64Decode(this.id), config)
        .then((result) => {
          if (result.data.success === true) {
            this.storeList = result.data.data;
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
  mounted() {
    this.getList();
    this.getStoreList();
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
