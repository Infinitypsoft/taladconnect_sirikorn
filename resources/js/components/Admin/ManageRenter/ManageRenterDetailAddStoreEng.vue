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

                  <v-card flat>
                    <v-card-text class="fs-18 fw-600 color-707070 pl-0 pr-0"
                      >ข้อมูลร้านค้า</v-card-text
                    >
                    <v-row>
                      <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                        <v-card class="mt-2 p-5 pt-3 hfc" elevation="2">
                          <v-form ref="input_form" @submit.prevent="update()">
                            <v-list-item three-line class="pl-0 pr-0 ml-0 mr-0">
                              <v-row>
                                <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                                  <div class="d-flex align-center mb-6 mt-4">
                                    <img
                                      class="mr-2"
                                      :src="
                                        base_url +
                                        `/images/icon/7c8b2dadbe7bf9cb258f37644bc39d48.png`
                                      "
                                      alt=""
                                      width="20"
                                      height="20"
                                    />
                                    <span
                                      class="font-16 fw-500 color-title-card"
                                      >รายละเอียดร้านค้า</span
                                    >
                                  </div>
                                  <img
                                    v-if="data_eng.pic_path"
                                    :src="base_url + '/' + data_eng.pic_path"
                                    alt="image list slide"
                                    width="100%"
                                    height="auto"
                                    style="max-width: 420px"
                                  />
                                </v-col>
                                <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                                  <v-card-text class="p-0 mt-2">
                                    <div class="d-flex align-center">
                                      <span class="font-16 color-707070"
                                        >รูปภาพปกร้านค้า
                                        <span style="color: red">*</span></span
                                      >
                                    </div>
                                  </v-card-text>
                                </v-col>
                                <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                                  <v-row>
                                    <v-col
                                      v-for="(item, i) in data_eng.pic_list"
                                      :key="i"
                                      cols="12"
                                      xs="12"
                                      sm="12"
                                      md="4"
                                      lg="4"
                                      xl="4"
                                      class="d-dlex justify-center"
                                    >
                                      <div class="d-flex align-center">
                                        <img
                                          v-if="item.pic_path"
                                          :src="base_url + '/' + item.pic_path"
                                          alt="image list slide"
                                          width="100%"
                                          height="auto"
                                          style="max-width: 420px"
                                        />

                                        <img
                                          v-else
                                          :src="imagePreviewURLArr[i]"
                                          alt="image list slide"
                                          width="100%"
                                          height="auto"
                                          style="max-width: 420px"
                                        />
                                      </div>
                                      <br />
                                    </v-col>
                                  </v-row>
                                </v-col>
                              </v-row>
                            </v-list-item>
                            <v-row>
                              <v-col>
                                <v-card-text class="p-0 mt-8">
                                  <div class="d-flex align-center mb-2">
                                    <span class="font-16 color-707070"
                                      >ชื่อร้านค้า
                                      <span style="color: red">*</span></span
                                    >
                                  </div>
                                  <div>
                                    <v-text-field
                                      hide-details="auto"
                                      label="กรุณากรอกชื่อร้านค้า"
                                      v-model="data_eng.store_name_eng"
                                      outlined
                                      dense
                                      single-line
                                      :rules="store_nameRules"
                                    ></v-text-field>
                                  </div>
                                </v-card-text>
                              </v-col>
                              <v-col>
                                <v-card-text class="p-0">
                                  <div class="d-flex align-center mb-2">
                                    <span class="font-16 color-707070"
                                      >เลือกล๊อตที่ตั้งร้านค้า
                                      <span style="color: red">*</span></span
                                    >
                                  </div>
                                  <div>
                                    <v-select
                                      class="custom-v-select"
                                      v-model="data_eng.block_list"
                                      item-value="id"
                                      item-text="block_name"
                                      :items="block_select_box"
                                      outlined
                                      dense
                                      multiple
                                      single-line
                                      label="กรุณาเลือกล๊อตที่ตั้งร้านค้า"
                                      disabled
                                    ></v-select>
                                  </div>
                                </v-card-text>
                              </v-col>
                            </v-row>
                            <br />
                            <v-row>
                              <v-col xs="12" sm="12" md="6" lg="6" xl="6">
                                <v-card-text class="p-0">
                                  <div class="d-flex align-center mb-2">
                                    <span class="font-16 color-707070"
                                      >ประเภทร้านค้า
                                      <span style="color: red">*</span></span
                                    >
                                  </div>
                                  <div>
                                    <v-select
                                      class="custom-v-select"
                                      v-model="data_eng.store_type_eng"
                                      item-value="name"
                                      item-text="name"
                                      :items="store_type_list"
                                      outlined
                                      dense
                                      single-line
                                      label="กรุณาเลือกประเภทร้านค้า"
                                    ></v-select>
                                  </div>
                                </v-card-text>
                              </v-col>
                              <v-col xs="12" sm="12" md="6" lg="6" xl="6">
                                <v-card-text class="p-0">
                                  <div class="d-flex align-center mb-2">
                                    <span class="font-16 color-707070"
                                      >ประเภทสินค้า
                                      <span style="color: red">*</span></span
                                    >
                                  </div>
                                  <div>
                                    <v-select
                                      class="custom-v-select"
                                      v-model="data_eng.product_type_eng"
                                      item-value="name"
                                      item-text="name"
                                      :items="product_type_list"
                                      outlined
                                      dense
                                      single-line
                                      multiple
                                      label="กรุณาเลือกประเภทสินค้า"
                                    ></v-select>
                                  </div>
                                </v-card-text>
                              </v-col>
                              <v-col xs="12" sm="12" md="6" lg="6" xl="6">
                                <p class="font-14 text-ex fs-16 fw-500">
                                  ช่วงราคา <span style="color: red">*</span>
                                </p>
                                <v-row>
                                  <v-col
                                    class="d-flex gap-19"
                                    cols="12"
                                    xs="12"
                                    sm="12"
                                    md="6"
                                    lg="6"
                                    xl="6"
                                  >
                                    <span
                                      class="mt-2 fs-14 fw-500 color-707070 twn"
                                      >ราคาเริ่มต้น (บาท)</span
                                    >
                                    <v-text-field
                                      hide-details="auto"
                                      label="กรุณากรอกราคาเริ่มต้น (บาท)"
                                      v-model="data_eng.price_min"
                                      :rules="rules.price_min"
                                      outlined
                                      dense
                                      single-line
                                      required
                                    ></v-text-field>
                                  </v-col>
                                  <v-col
                                    class="d-flex gap-19"
                                    cols="12"
                                    xs="12"
                                    sm="12"
                                    md="6"
                                    lg="6"
                                    xl="6"
                                  >
                                    <span
                                      class="mt-2 fs-14 fw-500 color-707070 twn"
                                      >ราคาสูงสุด (บาท)</span
                                    >
                                    <v-text-field
                                      hide-details="auto"
                                      label="กรุณากรอกราคาสูงสุด (บาท)"
                                      v-model="data_eng.price_max"
                                      :rules="rules.price_max"
                                      outlined
                                      dense
                                      single-line
                                      required
                                    ></v-text-field>
                                  </v-col>
                                </v-row>
                              </v-col>
                              <v-col xs="12" sm="12" md="6" lg="6" xl="6">
                                <p class="font-14 text-ex fs-16 fw-500">
                                  เวลาเปิด-ปิด <span style="color: red">*</span>
                                </p>
                                <v-row>
                                  <v-col
                                    class="d-flex gap-19"
                                    cols="12"
                                    xs="12"
                                    sm="12"
                                    md="6"
                                    lg="6"
                                    xl="6"
                                  >
                                    <span
                                      class="mt-2 fs-14 fw-500 color-707070 twn"
                                      >เวลาเปิด</span
                                    >
                                    <v-text-field
                                      hide-details="auto"
                                      label="กรุณาเลือกเวลาเปิด"
                                      v-model="data_eng.time_open"
                                      :rules="rules.time_open"
                                      outlined
                                      dense
                                      single-line
                                      required
                                    ></v-text-field>
                                  </v-col>
                                  <v-col
                                    class="d-flex gap-19"
                                    cols="12"
                                    xs="12"
                                    sm="12"
                                    md="6"
                                    lg="6"
                                    xl="6"
                                  >
                                    <span
                                      class="mt-2 fs-14 fw-500 color-707070 twn"
                                      >เวลาปิด</span
                                    >
                                    <v-text-field
                                      hide-details="auto"
                                      label="กรุณาเลือกเวลาปิด"
                                      v-model="data_eng.time_close"
                                      :rules="rules.time_close"
                                      outlined
                                      dense
                                      single-line
                                      required
                                    ></v-text-field>
                                  </v-col>
                                </v-row>
                              </v-col>
                            </v-row>
                            <v-card-text class="p-0 mt-8">
                              <div class="d-flex align-center mb-2">
                                <img
                                  class="mr-2"
                                  :src="
                                    base_url +
                                    `/images/icon/3455ae7f9735a4c5b195648353ccfbcb.png`
                                  "
                                  alt=""
                                  width="20"
                                  height="20"
                                />
                                <span class="font-16 color-title-card"
                                  >คำอธิบายร้านค้าโดยย่อ
                                  <span style="color: red">*</span>
                                </span>
                              </div>
                              <div>
                                <v-text-field
                                  hide-details="auto"
                                  label="กรุณากรอกคำอธิบายร้านค้าโดยย่อ"
                                  v-model="data_eng.description_short"
                                  outlined
                                  dense
                                  single-line
                                  :rules="rules.store_description"
                                  :counter="250"
                                ></v-text-field>
                              </div>
                            </v-card-text>

                            <v-card-text class="p-0 mt-8">
                              <div class="d-flex align-center mb-2">
                                <img
                                  class="mr-2"
                                  :src="
                                    base_url +
                                    `/images/icon/3455ae7f9735a4c5b195648353ccfbcb.png`
                                  "
                                  alt=""
                                  width="20"
                                  height="20"
                                />
                                <span class="font-16 color-title-card"
                                  >ช่องทางการติดต่อ
                                  <span style="color: red">*</span>
                                </span>
                              </div>
                              <v-row>
                                <v-col
                                  cols="12"
                                  xs="12"
                                  sm="12"
                                  md="6"
                                  lg="6"
                                  xl="6"
                                >
                                  <div class="d-flex align-center mb-2">
                                    <span class="font-16 color-707070"
                                      >เบอร์โทร
                                      <span style="color: red">*</span></span
                                    >
                                  </div>
                                  <div>
                                    <v-text-field
                                      hide-details="auto"
                                      label="กรุณากรอกเบอร์โทร"
                                      v-model="data_eng.tel"
                                      outlined
                                      dense
                                      single-line
                                      :rules="rules.store_phone"
                                    ></v-text-field>
                                  </div>
                                </v-col>
                                <v-col
                                  cols="12"
                                  xs="12"
                                  sm="12"
                                  md="6"
                                  lg="6"
                                  xl="6"
                                >
                                  <div class="d-flex align-center mb-2">
                                    <span class="font-16 color-707070"
                                      >ลิงค์ตำแหน่งที่ตั้ง
                                      <span style="color: red">*</span></span
                                    >
                                  </div>
                                  <div>
                                    <v-text-field
                                      hide-details="auto"
                                      label="กรุณากรอกลิงค์ตำแหน่งที่ตั้ง"
                                      v-model="data_eng.location"
                                      outlined
                                      dense
                                      single-line
                                      :rules="rules.location_link"
                                    ></v-text-field>
                                  </div>
                                </v-col>
                                <v-col
                                  cols="12"
                                  xs="12"
                                  sm="12"
                                  md="6"
                                  lg="6"
                                  xl="6"
                                >
                                  <div class="d-flex align-center mb-2">
                                    <span class="font-16 color-707070"
                                      >เฟสบุ๊ค
                                      <span style="color: red">*</span></span
                                    >
                                  </div>
                                  <div>
                                    <v-text-field
                                      hide-details="auto"
                                      label="กรุณากรอกเฟสบุ๊ค"
                                      v-model="data_eng.facebook"
                                      outlined
                                      dense
                                      single-line
                                      :rules="rules.facebook"
                                    ></v-text-field>
                                  </div>
                                </v-col>
                                <v-col
                                  cols="12"
                                  xs="12"
                                  sm="12"
                                  md="6"
                                  lg="6"
                                  xl="6"
                                >
                                  <div class="d-flex align-center mb-2">
                                    <span class="font-16 color-707070"
                                      >ลิงค์เฟสบุ๊ค
                                      <span style="color: red">*</span></span
                                    >
                                  </div>
                                  <div>
                                    <v-text-field
                                      hide-details="auto"
                                      label="กรุณากรอกลิงค์เฟสบุ๊ค"
                                      v-model="data_eng.facebook_link"
                                      outlined
                                      dense
                                      single-line
                                      :rules="rules.facebook_link"
                                    ></v-text-field>
                                  </div>
                                </v-col>
                                <v-col
                                  cols="12"
                                  xs="12"
                                  sm="12"
                                  md="6"
                                  lg="6"
                                  xl="6"
                                >
                                  <div class="d-flex align-center mb-2">
                                    <span class="font-16 color-707070"
                                      >ไลน์ไอดี
                                      <span style="color: red">*</span></span
                                    >
                                  </div>
                                  <div>
                                    <v-text-field
                                      hide-details="auto"
                                      label="กรุณากรอกไลน์ไอดี"
                                      v-model="data_eng.line"
                                      outlined
                                      dense
                                      single-line
                                      :rules="rules.id_line"
                                    ></v-text-field>
                                  </div>
                                </v-col>
                                <v-col
                                  cols="12"
                                  xs="12"
                                  sm="12"
                                  md="6"
                                  lg="6"
                                  xl="6"
                                >
                                  <div class="d-flex align-center mb-2">
                                    <span class="font-16 color-707070"
                                      >ลิงค์ไลน์ไอดี
                                      <span style="color: red">*</span></span
                                    >
                                  </div>
                                  <div>
                                    <v-text-field
                                      hide-details="auto"
                                      label="กรุณากรอกลิงค์ไลน์ไอดี"
                                      v-model="data_eng.line_link"
                                      outlined
                                      dense
                                      single-line
                                      :rules="rules.id_line_link"
                                    ></v-text-field>
                                  </div>
                                </v-col>
                                <v-col
                                  cols="12"
                                  xs="12"
                                  sm="12"
                                  md="6"
                                  lg="6"
                                  xl="6"
                                >
                                  <div class="d-flex align-center mb-2">
                                    <span class="font-16 color-707070"
                                      >อินสตราแกรม
                                      <span style="color: red">*</span></span
                                    >
                                  </div>
                                  <div>
                                    <v-text-field
                                      hide-details="auto"
                                      label="กรุณากรอกอินสตราแกรม"
                                      v-model="data_eng.instagram"
                                      outlined
                                      dense
                                      single-line
                                      :rules="rules.instagram"
                                    ></v-text-field>
                                  </div>
                                </v-col>
                                <v-col
                                  cols="12"
                                  xs="12"
                                  sm="12"
                                  md="6"
                                  lg="6"
                                  xl="6"
                                >
                                  <div class="d-flex align-center mb-2">
                                    <span class="font-16 color-707070"
                                      >ลิงค์อินสตราแกรม
                                      <span style="color: red">*</span></span
                                    >
                                  </div>
                                  <div>
                                    <v-text-field
                                      hide-details="auto"
                                      label="กรุณากรอกลิงค์อินสตราแกรม"
                                      v-model="data_eng.instagram_link"
                                      outlined
                                      dense
                                      single-line
                                      :rules="rules.instagram_link"
                                    ></v-text-field>
                                  </div>
                                </v-col>
                                <v-col
                                  cols="12"
                                  xs="12"
                                  sm="12"
                                  md="6"
                                  lg="6"
                                  xl="6"
                                >
                                  <div class="d-flex align-center mb-2">
                                    <span class="font-16 color-707070"
                                      >ติ๊กต็อก
                                      <span style="color: red">*</span></span
                                    >
                                  </div>
                                  <div>
                                    <v-text-field
                                      hide-details="auto"
                                      label="กรุณากรอกติ๊กต็อก"
                                      v-model="data_eng.tiktok"
                                      outlined
                                      dense
                                      single-line
                                      :rules="rules.tiktok"
                                    ></v-text-field>
                                  </div>
                                </v-col>
                                <v-col
                                  cols="12"
                                  xs="12"
                                  sm="12"
                                  md="6"
                                  lg="6"
                                  xl="6"
                                >
                                  <div class="d-flex align-center mb-2">
                                    <span class="font-16 color-707070"
                                      >ลิงค์ติ๊กต็อก
                                      <span style="color: red">*</span></span
                                    >
                                  </div>
                                  <div>
                                    <v-text-field
                                      hide-details="auto"
                                      label="กรุณากรอกลิงค์ติ๊กต็อก"
                                      v-model="data_eng.tiktok_link"
                                      outlined
                                      dense
                                      single-line
                                      :rules="rules.tiktok_link"
                                    ></v-text-field>
                                  </div>
                                </v-col>
                              </v-row>
                            </v-card-text>
                            <v-card-text class="p-0 mt-4">
                              <div class="d-flex align-center mb-2">
                                <img
                                  class="mr-2"
                                  :src="
                                    base_url +
                                    `/images/icon/7c8b2dadbe7bf9cb258f37644bc39d48.png`
                                  "
                                  alt=""
                                  width="20"
                                  height="20"
                                />

                                <span class="font-16 color-title-card"
                                  >เมนูอาหารแนะนำ
                                  <span style="color: red">*</span></span
                                >
                              </div>
                              <div>
                                <v-row>
                                  <v-col
                                    cols="12"
                                    xs="12"
                                    sm="12"
                                    md="6"
                                    lg="6"
                                    xl="6"
                                  >
                                    <img
                                      class="mt-4"
                                      v-if="data_eng.product_1_pic_path"
                                      :src="
                                        base_url +
                                        '/' +
                                        data_eng.product_1_pic_path
                                      "
                                      alt="image list slide"
                                      width="100%"
                                      height="auto"
                                      style="max-width: 420px"
                                    />

                                    <v-card-text class="p-0 mt-6">
                                      <div class="d-flex align-center">
                                        <span class="font-16 color-707070"
                                          >รูปภาพเมนูอาหารแนะนำเมนูที่ 1
                                          <span style="color: red"
                                            >*</span
                                          ></span
                                        >
                                      </div>
                                    </v-card-text>
                                  </v-col>

                                  <v-col
                                    cols="12"
                                    xs="12"
                                    sm="12"
                                    md="6"
                                    lg="6"
                                    xl="6"
                                  >
                                    <div class="d-flex align-center mb-2">
                                      <span class="font-16 color-707070"
                                        >ชื่อเมนูอาหารแนะนำเมนูที่ 1
                                        <span style="color: red">*</span></span
                                      >
                                    </div>
                                    <div>
                                      <v-text-field
                                        hide-details="auto"
                                        label="กรุณากรอกชื่อเมนูอาหารแนะนำเมนูที่ 2"
                                        v-model="data_eng.product_1_name_eng"
                                        outlined
                                        dense
                                        single-line
                                        :rules="rules.tiktok_link"
                                        :counter="50"
                                      ></v-text-field>
                                    </div>
                                    <div class="d-flex align-center mb-2">
                                      <span class="font-16 color-707070"
                                        >ราคาอาหาร
                                        <span style="color: red">*</span></span
                                      >
                                    </div>
                                    <div>
                                      <v-text-field
                                        hide-details="auto"
                                        label="กรุณากรอกราคาอาหาร"
                                        v-model="data_eng.product_1_price"
                                        outlined
                                        dense
                                        single-line
                                        :rules="rules.tiktok_link"
                                      ></v-text-field>
                                    </div>
                                    <br />

                                    <div class="d-flex align-center mb-2">
                                      <span class="font-16 color-707070"
                                        >คำอธิบายเมนูโดยย่อ
                                        <span style="color: red">*</span></span
                                      >
                                    </div>
                                    <div>
                                      <v-textarea
                                        label="กรุณากรอกคำอธิบายเมนูโดยย่อ"
                                        v-model="
                                          data_eng.product_1_description_eng
                                        "
                                        outlined
                                        dense
                                        single-line
                                        :rules="rules.tiktok_link"
                                      ></v-textarea>
                                    </div>
                                  </v-col>
                                </v-row>
                                <v-row>
                                  <v-col
                                    cols="12"
                                    xs="12"
                                    sm="12"
                                    md="6"
                                    lg="6"
                                    xl="6"
                                  >
                                    <img
                                      class="mt-4"
                                      v-if="data_eng.product_2_pic_path"
                                      :src="
                                        base_url +
                                        '/' +
                                        data_eng.product_2_pic_path
                                      "
                                      alt="image list slide"
                                      width="100%"
                                      height="auto"
                                      style="max-width: 420px"
                                    />

                                    <v-card-text class="p-0 mt-6">
                                      <div class="d-flex align-center">
                                        <span class="font-16 color-707070"
                                          >รูปภาพเมนูอาหารแนะนำเมนูที่ 2
                                          <span style="color: red"
                                            >*</span
                                          ></span
                                        >
                                      </div>
                                    </v-card-text>
                                  </v-col>

                                  <v-col
                                    cols="12"
                                    xs="12"
                                    sm="12"
                                    md="6"
                                    lg="6"
                                    xl="6"
                                  >
                                    <div class="d-flex align-center mb-2">
                                      <span class="font-16 color-707070"
                                        >ชื่อเมนูอาหารแนะนำเมนูที่ 2
                                        <span style="color: red">*</span></span
                                      >
                                    </div>
                                    <div>
                                      <v-text-field
                                        hide-details="auto"
                                        label="กรุณากรอกชื่อเมนูอาหารแนะนำเมนูที่ 2"
                                        v-model="data_eng.product_2_name_eng"
                                        outlined
                                        dense
                                        single-line
                                        :rules="rules.tiktok_link"
                                        :counter="50"
                                      ></v-text-field>
                                    </div>

                                    <div class="d-flex align-center mb-2">
                                      <span class="font-16 color-707070"
                                        >ราคาอาหาร
                                        <span style="color: red">*</span></span
                                      >
                                    </div>
                                    <div>
                                      <v-text-field
                                        hide-details="auto"
                                        label="กรุณากรอกราคาอาหาร"
                                        v-model="data_eng.product_2_price"
                                        outlined
                                        dense
                                        single-line
                                        :rules="rules.tiktok_link"
                                      ></v-text-field>
                                    </div>
                                    <br />

                                    <div class="d-flex align-center mb-2">
                                      <span class="font-16 color-707070"
                                        >คำอธิบายเมนูโดยย่อ
                                        <span style="color: red">*</span></span
                                      >
                                    </div>
                                    <div>
                                      <v-textarea
                                        label="กรุณากรอกคำอธิบายเมนูโดยย่อ"
                                        v-model="
                                          data_eng.product_2_description_eng
                                        "
                                        outlined
                                        dense
                                        single-line
                                        :rules="rules.tiktok_link"
                                      ></v-textarea>
                                    </div>
                                  </v-col>
                                </v-row>
                                <v-row>
                                  <v-col
                                    cols="12"
                                    xs="12"
                                    sm="12"
                                    md="6"
                                    lg="6"
                                    xl="6"
                                  >
                                    <img
                                      class="mt-4"
                                      v-if="data_eng.product_3_pic_path"
                                      :src="
                                        base_url +
                                        '/' +
                                        data_eng.product_3_pic_path
                                      "
                                      alt="image list slide"
                                      width="100%"
                                      height="auto"
                                      style="max-width: 420px"
                                    />

                                    <v-card-text class="p-0 mt-6">
                                      <div class="d-flex align-center">
                                        <span class="font-16 color-707070"
                                          >รูปภาพเมนูอาหารแนะนำเมนูที่ 3
                                          <span style="color: red"
                                            >*</span
                                          ></span
                                        >
                                      </div>
                                    </v-card-text>
                                  </v-col>

                                  <v-col
                                    cols="12"
                                    xs="12"
                                    sm="12"
                                    md="6"
                                    lg="6"
                                    xl="6"
                                  >
                                    <div class="d-flex align-center mb-2">
                                      <span class="font-16 color-707070"
                                        >ชื่อเมนูอาหารแนะนำเมนูที่ 3
                                        <span style="color: red">*</span></span
                                      >
                                    </div>
                                    <div>
                                      <v-text-field
                                        hide-details="auto"
                                        label="กรุณากรอกชื่อเมนูอาหารแนะนำเมนูที่ 3"
                                        v-model="data_eng.product_3_name_eng"
                                        outlined
                                        dense
                                        single-line
                                        :rules="rules.tiktok_link"
                                        :counter="50"
                                      ></v-text-field>
                                    </div>

                                    <div class="d-flex align-center mb-2">
                                      <span class="font-16 color-707070"
                                        >ราคาอาหาร
                                        <span style="color: red">*</span></span
                                      >
                                    </div>
                                    <div>
                                      <v-text-field
                                        hide-details="auto"
                                        label="กรุณากรอกราคาอาหาร"
                                        v-model="data_eng.product_3_price"
                                        outlined
                                        dense
                                        single-line
                                        :rules="rules.tiktok_link"
                                      ></v-text-field>
                                    </div>
                                    <br />

                                    <div class="d-flex align-center mb-2">
                                      <span class="font-16 color-707070"
                                        >คำอธิบายเมนูโดยย่อ
                                        <span style="color: red">*</span></span
                                      >
                                    </div>
                                    <div>
                                      <v-textarea
                                        label="กรุณากรอกคำอธิบายเมนูโดยย่อ"
                                        v-model="
                                          data_eng.product_3_description_eng
                                        "
                                        outlined
                                        dense
                                        single-line
                                        :rules="rules.tiktok_link"
                                      ></v-textarea>
                                    </div>
                                  </v-col>
                                </v-row>
                                <v-row>
                                  <v-col
                                    cols="12"
                                    xs="12"
                                    sm="12"
                                    md="6"
                                    lg="6"
                                    xl="6"
                                  >
                                    <img
                                      class="mt-4"
                                      v-if="data_eng.product_4_pic_path"
                                      :src="
                                        base_url +
                                        '/' +
                                        data_eng.product_4_pic_path
                                      "
                                      alt="image list slide"
                                      width="100%"
                                      height="auto"
                                      style="max-width: 420px"
                                    />

                                    <v-card-text class="p-0 mt-6">
                                      <div class="d-flex align-center">
                                        <span class="font-16 color-707070"
                                          >รูปภาพเมนูอาหารแนะนำเมนูที่ 4
                                          <span style="color: red"
                                            >*</span
                                          ></span
                                        >
                                      </div>
                                    </v-card-text>
                                  </v-col>

                                  <v-col
                                    cols="12"
                                    xs="12"
                                    sm="12"
                                    md="6"
                                    lg="6"
                                    xl="6"
                                  >
                                    <div class="d-flex align-center mb-2">
                                      <span class="font-16 color-707070"
                                        >ชื่อเมนูอาหารแนะนำเมนูที่ 4
                                        <span style="color: red">*</span></span
                                      >
                                    </div>
                                    <div>
                                      <v-text-field
                                        hide-details="auto"
                                        label="กรุณากรอกชื่อเมนูอาหารแนะนำเมนูที่ 3"
                                        v-model="data_eng.product_4_name_eng"
                                        outlined
                                        dense
                                        single-line
                                        :rules="rules.tiktok_link"
                                        :counter="50"
                                      ></v-text-field>
                                    </div>

                                    <div class="d-flex align-center mb-2">
                                      <span class="font-16 color-707070"
                                        >ราคาอาหาร
                                        <span style="color: red">*</span></span
                                      >
                                    </div>
                                    <div>
                                      <v-text-field
                                        hide-details="auto"
                                        label="กรุณากรอกราคาอาหาร"
                                        v-model="data_eng.product_4_price"
                                        outlined
                                        dense
                                        single-line
                                        :rules="rules.tiktok_link"
                                      ></v-text-field>
                                    </div>
                                    <br />

                                    <div class="d-flex align-center mb-2">
                                      <span class="font-16 color-707070"
                                        >คำอธิบายเมนูโดยย่อ
                                        <span style="color: red">*</span></span
                                      >
                                    </div>
                                    <div>
                                      <v-textarea
                                        label="กรุณากรอกคำอธิบายเมนูโดยย่อ"
                                        v-model="
                                          data_eng.product_4_description_eng
                                        "
                                        outlined
                                        dense
                                        single-line
                                        :rules="rules.tiktok_link"
                                      ></v-textarea>
                                    </div>
                                  </v-col>
                                </v-row>
                              </div>
                            </v-card-text>
                            <v-card-text class="p-0">
                              <div class="d-flex align-center mb-2">
                                <img
                                  class="mr-2"
                                  :src="
                                    base_url + `/images/icon/megaphone 3.png`
                                  "
                                  alt=""
                                  width="20"
                                  height="20"
                                />

                                <span class="font-16 color-title-card"
                                  >รายละเอียดร้านค้า
                                  <span style="color: red">*</span></span
                                >
                              </div>
                              <div>
                                <vue-editor
                                  v-model="data_eng.description_eng"
                                ></vue-editor>
                              </div>
                            </v-card-text>
                            <v-card-actions>
                              <v-card-text class="p-0 d-flex justify-center">
                                <v-btn
                                  type="submit"
                                  @click="persist"
                                  class="btn-success pl-30 pr-30"
                                  color="warning"
                                  dark
                                >
                                  <span>บันทึกข้อมูล</span>
                                </v-btn>
                              </v-card-text>
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
import { VueEditor } from "vue2-editor";
import store_api from "../../../api/store.js";
export default {
  components: {
    VueEditor,
  },
  data() {
    return {
      loading_page: false,
      active_tab: 1,
      content_picture: null,
      imagePreviewURL: null,
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
      store_type_list: [
        { id: 1, name: "Food" },
        { id: 2, name: "Drinks&Beverages" },
        { id: 3, name: "Bakery" },
        { id: 4, name: "Fresh" },
        { id: 5, name: "Clothes&Beauty" },
        { id: 6, name: "Grocery store" },
      ],
      product_type_list: [
        { id: 1, name: "Thai Food" },
        { id: 2, name: "Japanese Food" },
        { id: 3, name: "Noodles" },
        { id: 4, name: "Rice Dishes" },
        { id: 5, name: "Seafood" },
        { id: 6, name: "Thai Dessert" },
        { id: 7, name: "Bakery" },
        { id: 8, name: "Thai Street Snacks" },
        { id: 9, name: "Dessert" },
        { id: 10, name: "Skewer Food" },
        { id: 11, name: "Western Food" },
        { id: 12, name: "Drinks&Beverages" },
        { id: 13, name: "Isaan Food" },
        { id: 14, name: "Northern Food" },
        { id: 15, name: "A La Carte" },
        { id: 16, name: "2-3 Entree Plate" },
      ],
      select_store_type: 0,
      select_product_type: 0,
      rules: {
        price_min: [
          (val) => (val || "").length > 0 || "ต้องระบุข้อมูลในช่องนี้",
        ],
        price_max: [
          (val) => (val || "").length > 0 || "ต้องระบุข้อมูลในช่องนี้",
        ],
        time_open: [
          (val) => (val || "").length > 0 || "ต้องระบุข้อมูลในช่องนี้",
        ],
        time_close: [
          (val) => (val || "").length > 0 || "ต้องระบุข้อมูลในช่องนี้",
        ],
        store_phone: [
          (val) => (val || "").length > 0 || "ต้องระบุข้อมูลในช่องนี้",
        ],
        store_description: [(v) => v.length <= 250 || "สูงสุด 250 ตัวอักษร"],
        location_link: [
          (val) => (val || "").length > 0 || "ต้องระบุข้อมูลในช่องนี้",
        ],
        facebook: [
          (val) => (val || "").length > 0 || "ต้องระบุข้อมูลในช่องนี้",
        ],
        facebook_link: [
          (val) => (val || "").length > 0 || "ต้องระบุข้อมูลในช่องนี้",
        ],
        id_line: [(val) => (val || "").length > 0 || "ต้องระบุข้อมูลในช่องนี้"],
        id_line_link: [
          (val) => (val || "").length > 0 || "ต้องระบุข้อมูลในช่องนี้",
        ],
        instagram: [
          (val) => (val || "").length > 0 || "ต้องระบุข้อมูลในช่องนี้",
        ],
        instagram_link: [
          (val) => (val || "").length > 0 || "ต้องระบุข้อมูลในช่องนี้",
        ],
        tiktok: [(val) => (val || "").length > 0 || "ต้องระบุข้อมูลในช่องนี้"],
        tiktok_link: [
          (val) => (val || "").length > 0 || "ต้องระบุข้อมูลในช่องนี้",
        ],
      },
      html: "",
      hide: {
        strikethrough: true,
        table: true,
      },

      price_min: null,
      price_max: null,
      time_open: null,
      time_close: null,
      store_description: "",
      store_phone: "",
      location_link: "",
      facebook: "",
      facebook_link: "",
      id_line: "",
      id_line_link: "",
      instagram: "",
      instagram_link: "",
      tiktok: "",
      tiktok_link: "",
      block_select_box: [],
      store_id: null,
      data_eng: {},
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
          this.data_eng = result.data.data;
          this.data_eng.product_type_eng =
            this.data_eng.product_type_eng == null
              ? []
              : this.data_eng.product_type_eng;
          this.data_eng.block_list = this.data_eng.block_list.map((o) => {
            this.block_select_box.push({
              id: o.block_id,
              block_name: o.block_name,
            });
            return o.block_id;
          });
        }
      });
    },
    async update() {
      let data = new FormData();
      data.append("id", this.$route.query.store_id);
      data.append("store_name_eng", this.data_eng.store_name_eng);
      data.append("store_type_eng", this.data_eng.store_type_eng);
      data.append("product_type_eng", [this.data_eng.product_type_eng]);
      data.append("description_short_eng", this.data_eng.description_short_eng);
      data.append("description_eng", this.data_eng.description_eng);
      data.append("price_min", this.data_eng.price_min);
      data.append("price_max", this.data_eng.price_max);
      data.append("time_open", this.data_eng.time_open);
      data.append("time_close", this.data_eng.time_close);
      data.append("tel", this.data_eng.tel);
      data.append("location", this.data_eng.location);
      data.append("facebook", this.data_eng.facebook);
      data.append("facebook_link", this.data_eng.facebook_link);
      data.append("line", this.data_eng.line);
      data.append("line_link", this.data_eng.line_link);
      data.append("instagram", this.data_eng.instagram);
      data.append("instagram_link", this.data_eng.instagram_link);
      data.append("tiktok", this.data_eng.tiktok);
      data.append("tiktok_link", this.data_eng.tiktok_link);
      data.append("product_1_name_eng", this.data_eng.product_1_name_eng);
      data.append("product_1_price", this.data_eng.product_1_price);
      data.append(
        "product_1_description_eng",
        this.data_eng.product_1_description_eng
      );
      data.append("product_2_name_eng", this.data_eng.product_2_name_eng);
      data.append("product_2_price", this.data_eng.product_2_price);
      data.append(
        "product_2_description_eng",
        this.data_eng.product_2_description_eng
      );
      data.append("product_3_name_eng", this.data_eng.product_3_name_eng);
      data.append("product_3_price", this.data_eng.product_3_price);
      data.append(
        "product_3_description_eng",
        this.data_eng.product_3_description_eng
      );
      data.append("product_4_name_eng", this.data_eng.product_4_name_eng);
      data.append("product_4_price", this.data_eng.product_4_price);
      data.append(
        "product_4_description_eng",
        this.data_eng.product_4_description_eng
      );
      let config = {
        headers: {
          Authorization: `Bearer ${this.$store.state.access_token}`,
        },
      };
      await store_api.updateEng(data, config).then((result) => {
        if (result.data.success === true) {
          this.store_id = result.data.id;
          this.alertData("success", "สำเร็จ", "บันทึกข้อมูลเรียบร้อย");
        }
      });
    },
    handleImageUpload(event) {
      const file = event.target.files[0];

      if (file) {
        const reader = new FileReader();

        reader.onload = (e) => {
          this.imageData = e.target.result; // base64 encoded image data
        };

        reader.readAsDataURL(file);
      }
    },
    persist() {
      console.log(this.content_picture);

      // this.$store.commit('image_th',this.content_picture)
      const setAddObject = {
        topic: this.topic,
        brief_detail_topic: this.brief_detail_topic,
        html: this.html,
        content_picture: this.content_picture,
      };
      window.localStorage.setItem(
        "thaiAddObject",
        JSON.stringify(setAddObject)
      );
      // this.$router.push('/managecontent/eng_add')
    },

    async onFileChange(payload) {
      const file = payload;
      let extall = "png,PNG,jpeg,JPEG,jpg,JPG";
      let file_ext = file.name;

      let ext = file_ext.split(".").pop().toLowerCase();
      if (parseInt(extall.indexOf(ext)) < 0) {
        this.imagePreviewURL = this.base_url + "/images/image-list-slide.png";
        this.content_picture = null;
      } else {
        if (file) {
          this.imagePreviewURL = URL.createObjectURL(file);
          console.log(this.imagePreviewURL);
          URL.revokeObjectURL(file);
        } else {
          this.imagePreviewURL = before_image;
        }
      }
    },
    async onFileRemove() {
      this.content_picture = null;
      this.imagePreviewURL = this.base_url + "/images/image-list-slide.png";
    },
  },
  created() {},
  mounted() {
    this.imagePreviewURL = this.base_url + "/images/image-list-slide.png";

    let getAddObject = window.localStorage.getItem("thaiAddObject");
    if (getAddObject) {
      const data = JSON.parse(getAddObject);
      this.topic = data.topic;
      this.brief_detail_topic = data.brief_detail_topic;
      this.html = data.html;
      this.content_picture = data.content_picture;
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

.row-list {
  display: flex;
  justify-content: flex-start;

  @media screen and (max-width: 960px) {
    flex-direction: column;

    .image-list-slide {
      display: flex;
      justify-content: center;
      width: 100% !important;
      max-width: 100% !important;
    }
  }

  .col-list {
    width: fit-content;
    max-width: fit-content;
  }
}
</style>
