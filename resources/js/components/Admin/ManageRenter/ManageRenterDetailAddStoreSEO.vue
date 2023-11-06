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
          <h1 class="font-20 m-0">เพิ่มข้อมูลร้านค้า</h1>
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
            <v-row class="m-0 p-2">
              <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                <v-card elevation="0">
                  <v-tabs
                    background-color="transparent"
                    color="basil"
                    grow
                    v-model="active_tab"
                  >
                    <v-tab
                      @click="
                        linkPage(
                          '/managerenter/detail/edit_thai?id=' +
                            $route.query.id +
                            '&store_id=' +
                            $route.query.store_id
                        )
                      "
                    >
                      ภาษาไทย
                    </v-tab>
                    <v-tab
                      @click="
                        linkPage(
                          '/managerenter/detail/add_eng?id=' +
                            $route.query.id +
                            '&store_id=' +
                            $route.query.store_id
                        )
                      "
                    >
                      ภาษาอังกฤษ
                    </v-tab>
                    <v-tab
                      @click="
                        linkPage(
                          '/managerenter/detail/add_seo?id=' +
                            $route.query.id +
                            '&store_id=' +
                            $route.query.store_id
                        )
                      "
                    >
                      จัดการ SEO
                    </v-tab>
                  </v-tabs>

                  <v-card color="basil" flat>
                    <v-card-text class="fs-18 fw-600 color-707070 pl-0 pr-0"
                      >Search Engine Optimization</v-card-text
                    >
                    <v-row>
                      <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                        <v-card class="mt-2 p-5 pt-3" elevation="2">
                          <v-form ref="input_form" @submit.prevent="update()">
                            <v-card-text class="p-0 mt-4">
                              <div class="d-flex align-center">
                                <img
                                  class="mr-2"
                                  :src="base_url + `/images/icon/keyword.png`"
                                  alt="Keyword"
                                  width="20"
                                  height="20"
                                />

                                <span class="font-16 color-title-card"
                                  >คำค้นหา (Keyword)</span
                                >
                              </div>

                              <div>
                                <p class="font-14 mt-3 text-ex">
                                  คำแนะนำ : คำค้นหาที่ลูกค้าจะใช้สำหรับการ
                                  ค้นหาให้เจอธุรกิจของเราใน google สามารถใส่ได้
                                  50 คำ โดยให้คั่นด้วย , (เครื่องหมายลูกน้ำ)
                                  เช่น ตลาดสดเชียงใหม่ , ของประจำถิ่นเชียงใหม่ ,
                                  ของฝากราคาถูกเชียงใหม่ , เชียงใหม่กินอะไรดี
                                  ,ตลาดแนะนำเชียงใหม่ ฯลฯ
                                </p>
                                <v-textarea
                                  solo
                                  outlined
                                  single-line
                                  flat
                                  label="กรุณากรอกคำค้นหาที่เกี่ยวข้องกับธุรกิจ (Keyword)"
                                  v-model="data_seo.keyword"
                                ></v-textarea>
                              </div>
                            </v-card-text>
                            <v-card-text class="p-0 mt-2">
                              <div class="d-flex align-center">
                                <img
                                  class="mr-2"
                                  :src="base_url + `/images/icon/title.png`"
                                  alt="Title"
                                  width="20"
                                  height="20"
                                />
                                <span class="font-16 color-title-card"
                                  >รายละเอียดโดยย่อ (Title)</span
                                >
                              </div>
                              <div>
                                <p class="font-14 mt-3 text-ex">
                                  คำแนะนำ :
                                  รายละเอียดโดยย่อเปรียบเสมือนพาดหัวข่าว
                                  ถ้าในคำค้นหาทำให้ลูกค้าเจอเว็บไซด์ของเราแล้ว
                                  จะดึงดูดให้เข้ามาชมเว็บไซต์ เช่น (ชื่อตลาด)
                                  รสชาติของฤดูกาล ผลไม้ ผักสด เนื้อสัตว์
                                  อาหารพร้อมรับประทานและอื่นๆอีกมากมาย
                                  ประสบการณ์ที่คุณต้องลอง
                                </p>
                                <v-textarea
                                  solo
                                  outlined
                                  single-line
                                  flat
                                  :counter="75"
                                  label="กรุณากรอกรายละเอียดโดยย่อ (Title)"
                                  :rules="rule_textarea_title"
                                  v-model="data_seo.title"
                                ></v-textarea>
                              </div>
                            </v-card-text>
                            <v-card-text class="p-0 mt-2">
                              <div class="d-flex align-center">
                                <img
                                  class="mr-2"
                                  :src="
                                    base_url + `/images/icon/description.png`
                                  "
                                  alt="Description"
                                  width="20"
                                  height="20"
                                />
                                <span class="font-16 color-title-card"
                                  >คำอธิบาย (Description)</span
                                >
                              </div>
                              <div>
                                <p class="font-14 mt-3 text-ex">
                                  คำแนะนำ :
                                  คำอธิบายที่เป็นเนื้อหาในการแนะนำธุรกิจ ภายใต้
                                  200 ตัวอักษร
                                  โดยเขียนเนื้อความที่ผู้อ่านได้เข้าใจในธุรกิจของเรา
                                  ดึงดูดความน่าสนใจที่จะต้องกดเข้าเว็บไซด์ของเรามาอ่านเพิ่มเติม
                                  เช่น
                                  ยินดีต้อนรับสู่ตลาดสดที่นี้ทุกผลผลิตมีชีวิตชีวาและสดใหม่!
                                  เดินชมผลไม้สีสันจากสวนและผักสดชุบน้ำจากไร่ทุกวันที่นี่
                                  เราเสนอชุดความหลากหลายของสินค้าที่สดใหม่ที่สุด
                                </p>
                                <v-textarea
                                  solo
                                  outlined
                                  single-line
                                  flat
                                  :counter="300"
                                  label="กรุณากรอกคำอธิบาย (Description)"
                                  :rules="rule_textarea_description"
                                  v-model="data_seo.seo_description"
                                ></v-textarea>
                              </div>
                            </v-card-text>

                            <v-card-actions>
                              <v-row>
                                <v-col
                                  class="d-flex justify-start"
                                  cols="12"
                                  xs="12"
                                  sm="12"
                                  md="4"
                                  lg="4"
                                  xl="4"
                                >
                                  <v-btn
                                    @click="toEngAdd"
                                    color="white"
                                    class="ma-2 btn-back"
                                    elevation="1"
                                  >
                                    <v-icon left dark>
                                      mdi-chevron-left
                                    </v-icon>
                                    ย้อนกลับ
                                  </v-btn>
                                </v-col>
                                <v-col
                                  class="d-flex justify-center"
                                  cols="12"
                                  xs="12"
                                  sm="12"
                                  md="4"
                                  lg="4"
                                  xl="4"
                                >
                                  <v-btn
                                    type="submit"
                                    class="btn-success pl-30 pr-30"
                                    color="warning"
                                    dark
                                  >
                                    <span>บันทึกข้อมูล</span>
                                  </v-btn>
                                </v-col>
                                <v-col
                                  class="d-flex justify-center"
                                  cols="12"
                                  xs="12"
                                  sm="12"
                                  md="4"
                                  lg="4"
                                  xl="4"
                                >
                                </v-col>
                              </v-row>
                            </v-card-actions>
                          </v-form>
                        </v-card>
                      </v-col>
                    </v-row>
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
import content from "../../../api/content.js";
import store_api from "../../../api/store.js";
export default {
  data() {
    return {
      loading_page: false,
      active_tab: 2,
      submenu: [
        {
          text: "จัดการสมาชิกผู้เช่า",
          disabled: false,
        },
        {
          text: "รายละเอียดสมาชิกผู้เช่า",
          disabled: false,
        },
        {
          text: "เพิ่มข้อมูลร้านค้า",
          disabled: true,
        },
      ],
      keyword: "",
      title: "",
      description: "",
      rule_textarea_title: [(v) => v.length <= 75 || "สูงสุด 75 ตัวอักษร"],
      rule_textarea_description: [
        (v) => v.length <= 300 || "สูงสุด 300 ตัวอักษร",
      ],
      data_seo: {},
    };
  },
  methods: {
    async getStoreById() {
      let config = {
        headers: {
          Authorization: `Bearer ${this.$store.state.access_token}`,
        },
      };
      let id = this.$route.query.store_id;
      await store_api.getStoreById(id, config).then((result) => {
        if (result.data.success === true) {
          this.data_seo = result.data.data;
        }
      });
    },
    async update() {
      let config = {
        headers: {
          Authorization: `Bearer ${this.$store.state.access_token}`,
        },
      };
      let data = new FormData();
      data.append("id", this.$route.query.store_id);
      data.append("keyword", this.data_seo.keyword);
      data.append("title", this.data_seo.title);
      data.append("seo_description", this.data_seo.seo_description);

      await store_api.updateEng(data, config).then((result) => {
        if (result.data.success === true) {
          this.store_id = result.data.id;
          this.alertData("success", "สำเร็จ", "บันทึกข้อมูลเรียบร้อย");
        }
      });
    },
    toEngAdd() {
      const setAddObject = {
        keyword: this.keyword,
        title: this.title,
        description: this.description,
      };
      window.localStorage.setItem("seoAddObject", JSON.stringify(setAddObject));
      this.$router.push("/managecontent/eng_add");

      // localStorage.removeItem('thaiAddObject');
      // localStorage.removeItem('engAddObject');
      // localStorage.removeItem('seoAddObject');
    },

    async contentAdd() {
      if (this.$refs.form_banner_add.validate()) {
        let config = {
          headers: {
            Authorization: `Bearer ${this.$store.state.access_token}`,
          },
        };

        let getAddObject_th = window.localStorage.getItem("thaiAddObject");
        const data_th = JSON.parse(getAddObject_th);
        let getAddObject_en = window.localStorage.getItem("engAddObject");
        const data_en = JSON.parse(getAddObject_en);

        const data = new FormData();
        data.append("title_thai", data_th.topic);
        data.append("sub_title_thai", data_th.brief_detail_topic);
        data.append("description_thai", data_th.html);
        // data.append('pic_thai', this.description_thai)

        data.append("title_eng", data_en.topic);
        data.append("sub_title_eng", data_en.brief_detail_topic);
        data.append("description_eng", data_en.html);
        // data.append('pic_eng', this.description_thai)

        data.append("keyword", this.keyword);
        data.append("title", this.title);
        data.append("description", this.description);

        await content
          .contentAdd(data, config)
          .then((result) => {
            if (result.data.success === true) {
              this.loading_page = false;
              this.alertData(
                "success",
                "ทำรายการเสร็จสิ้น",
                "ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว"
              );
              this.$router.push("/slide");
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
  },
  created() {},
  mounted() {
    let getAddObject = window.localStorage.getItem("seoAddObject");
    if (getAddObject) {
      const data = JSON.parse(getAddObject);
      this.keyword = data.keyword;
      this.title = data.title;
      this.description = data.description;
    }
    this.getStoreById();
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

.container-title-left {
  display: flex;
  justify-content: flex-end;

  // margin-top: 16px;
  @media screen and (max-width: 960px) {
    justify-content: start;
    margin-top: -16px;
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

.btn-success {
  margin-top: 10px;
  border-radius: 30px;
  background: linear-gradient(90deg, #86d780 0%, #60a577 100%);
  box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);

  color: #f9f9f9;
  font-size: 16px;
}

.text-last-edit {
  color: #707070;
  // text-align: right;
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
