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
      <v-card class="p-4" elevation="2">
        <v-tabs
          background-color="transparent"
          color="basil"
          grow
          v-model="active_tab"
        >
          <v-tab
            @click="
              linkPage('/managerenter/detail/add_thai?id=' + $route.query.id)
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
          <v-tab @click="linkPage('/managerenter/detail/add_seo?id=' +
                  $route.query.id +
                  '&store_id=' +
                  $route.query.store_id)">
            จัดการ SEO
          </v-tab>
        </v-tabs>

        <v-card>
          <v-card-text class="fs-18 fw-600 color-707070 pl-0 pr-0"
            >ข้อมูลร้านค้า</v-card-text
          >
          <v-row>
            <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
              <v-card class="mt-2 p-5 pt-3 hfc" elevation="2">
                <v-form ref="input_form" @submit.prevent="create()">
                  <v-list-item three-line class="pl-0 pr-0 ml-0 mr-0">
                    <v-row>
                      <!-- รูปภาพปกร้านค้า -->
                      <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                        <div class="d-flex align-items-center mb-6 mt-4">
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
                            >รายละเอียดร้านค้า</span
                          >
                        </div>

                        <div class="">
                          <img
                            v-if="imagePreviewURL[0]"
                            :src="imagePreviewURL[0]"
                            alt="image list slide"
                            width="100%"
                            height="auto"
                            max-width="100%"
                            style="max-width: 420px"
                          />
                          <div class="upload_image">
                            <v-btn
                              class="white--text"
                              color="error"
                              depressed
                              fab
                              @click="store_pictureOnFileRemove"
                              ><v-icon>mdi-minus-thick</v-icon></v-btn
                            >
                          </div>
                        </div>
                      </v-col>
                      <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                        <v-card-text class="p-0 mt-2">
                          <div class="d-flex align-center">
                            <span class="font-16 color-707070"
                              >รูปภาพปกร้านค้า
                              <span style="color: red">*</span></span
                            >
                          </div>
                          <div>
                            <p class="font-14 mt-3 text-ex">
                              คำแนะนำ : ขนาดรูปภาพแนะนำ 1920 x 1080
                              หรือรูปสี่เหลี่ยมผืนผ้า ขนาดไฟล์ไม่เกิน 2 gb
                              สกุลไฟล์ jpg png jpeg เท่านั้น
                            </p>
                            <v-file-input
                              class="w-424"
                              outlined
                              dense
                              id="uploader"
                              accept="image/*"
                              v-model="pic"
                              :rules="[(v) => !!v || 'กรุณาเลือกรูปภาพ']"
                              @change="onFileChange(pic, 0)"
                              single-line
                              clearable
                              clear-icon=""
                              label="กรุณาเลือกไฟล์รูปภาพ"
                              required
                            ></v-file-input>
                          </div>
                        </v-card-text>
                        <v-btn
                          @click="
                            imagePreviewURLArr.push(
                              base_url + '/images/image-list-slide.png'
                            ),
                              (numImage = numImage + 1)
                          "
                          class="btn-success pl-30 pr-30"
                          color="warning"
                          dark
                        >
                          <img
                            class="mr-2"
                            :src="base_url + `/images/icon/image- 1.png`"
                            alt=""
                            width="20"
                            height="20"
                          />
                          <span>เพิ่มรูปภาพอื่นๆ</span>
                        </v-btn>
                      </v-col>
                      <!-- เพิ่มรูปภาพอื่นๆ -->
                      <v-col xs="12" sm="12" md="12" lg="12" xl="12">
                        <v-row>
                          <v-col
                            v-for="i in numImage"
                            :key="i"
                            cols="12"
                            xs="12"
                            sm="12"
                            md="4"
                            lg="4"
                            xl="4"
                          >
                            <v-btn
                              class="white--text mb-1"
                              color="error"
                              @click="store_pictureOnFileRemoveArr(i)"
                              ><v-icon>mdi-minus-thick</v-icon> ลบรูปภาพ</v-btn
                            >
                            <div class="d-flex align-center">
                              <img
                                v-if="imagePreviewURLArr[i]"
                                :src="imagePreviewURLArr[i]"
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
                            <div>
                              <v-file-input
                                class="w-424"
                                outlined
                                dense
                                id="uploader"
                                accept="image/*"
                                v-model="pic_list[i]"
                                :rules="[(v) => !!v || 'กรุณาเลือกรูปภาพ']"
                                @change="onFileChangeArr(pic_list[i], i)"
                                single-line
                                clearable
                                clear-icon=""
                                label="กรุณาเลือกไฟล์รูปภาพ"
                                required
                              ></v-file-input>
                            </div>
                          </v-col>
                        </v-row>
                      </v-col>
                    </v-row>
                  </v-list-item>
                  <v-row>
                    <v-col>
                      <v-card-text class="p-0">
                        <div class="d-flex align-center mb-2">
                          <span class="font-16 color-707070"
                            >ชื่อร้านค้า <span style="color: red">*</span></span
                          >
                        </div>
                        <div>
                          <v-text-field
                            hide-details="auto"
                            label="กรุณากรอกชื่อร้านค้า"
                            v-model="store_name"
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
                            v-model="block_list"
                            item-value="id"
                            item-text="block_name"
                            :items="block_select_box"
                            outlined
                            dense
                            multiple
                            single-line
                            label="กรุณาเลือกล๊อตที่ตั้งร้านค้า"
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
                            v-model="store_type"
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
                            v-model="product_type"
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
                          <span class="mt-2 fs-14 fw-500 color-707070 twn"
                            >ราคาเริ่มต้น (บาท)</span
                          >
                          <v-text-field
                            hide-details="auto"
                            label="กรุณากรอกราคาเริ่มต้น (บาท)"
                            v-model="price_min"
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
                          <span class="mt-2 fs-14 fw-500 color-707070 twn"
                            >ราคาสูงสุด (บาท)</span
                          >
                          <v-text-field
                            hide-details="auto"
                            label="กรุณากรอกราคาสูงสุด (บาท)"
                            v-model="price_max"
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
                          <span class="mt-2 fs-14 fw-500 color-707070 twn"
                            >เวลาเปิด</span
                          >
                          <v-text-field
                            hide-details="auto"
                            label="กรุณาเลือกเวลาเปิด"
                            v-model="time_open"
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
                          <span class="mt-2 fs-14 fw-500 color-707070 twn"
                            >เวลาปิด</span
                          >
                          <v-text-field
                            hide-details="auto"
                            label="กรุณาเลือกเวลาปิด"
                            v-model="time_close"
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
                        v-model="description_short"
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
                      <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                        <div class="d-flex align-center mb-2">
                          <span class="font-16 color-707070"
                            >เบอร์โทร <span style="color: red">*</span></span
                          >
                        </div>
                        <div>
                          <v-text-field
                            hide-details="auto"
                            label="กรุณากรอกเบอร์โทร"
                            v-model="tel"
                            outlined
                            dense
                            single-line
                            :rules="rules.store_phone"
                          ></v-text-field>
                        </div>
                      </v-col>
                      <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
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
                            v-model="location"
                            outlined
                            dense
                            single-line
                            :rules="rules.location_link"
                          ></v-text-field>
                        </div>
                      </v-col>
                      <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                        <div class="d-flex align-center mb-2">
                          <span class="font-16 color-707070"
                            >เฟสบุ๊ค <span style="color: red">*</span></span
                          >
                        </div>
                        <div>
                          <v-text-field
                            hide-details="auto"
                            label="กรุณากรอกเฟสบุ๊ค"
                            v-model="facebook"
                            outlined
                            dense
                            single-line
                            :rules="rules.facebook"
                          ></v-text-field>
                        </div>
                      </v-col>
                      <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
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
                            v-model="facebook_link"
                            outlined
                            dense
                            single-line
                            :rules="rules.facebook_link"
                          ></v-text-field>
                        </div>
                      </v-col>
                      <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                        <div class="d-flex align-center mb-2">
                          <span class="font-16 color-707070"
                            >ไลน์ไอดี <span style="color: red">*</span></span
                          >
                        </div>
                        <div>
                          <v-text-field
                            hide-details="auto"
                            label="กรุณากรอกไลน์ไอดี"
                            v-model="line"
                            outlined
                            dense
                            single-line
                            :rules="rules.id_line"
                          ></v-text-field>
                        </div>
                      </v-col>
                      <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
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
                            v-model="line_link"
                            outlined
                            dense
                            single-line
                            :rules="rules.id_line_link"
                          ></v-text-field>
                        </div>
                      </v-col>
                      <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                        <div class="d-flex align-center mb-2">
                          <span class="font-16 color-707070"
                            >อินสตราแกรม <span style="color: red">*</span></span
                          >
                        </div>
                        <div>
                          <v-text-field
                            hide-details="auto"
                            label="กรุณากรอกอินสตราแกรม"
                            v-model="instagram"
                            outlined
                            dense
                            single-line
                            :rules="rules.instagram"
                          ></v-text-field>
                        </div>
                      </v-col>
                      <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
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
                            v-model="instagram_link"
                            outlined
                            dense
                            single-line
                            :rules="rules.instagram_link"
                          ></v-text-field>
                        </div>
                      </v-col>
                      <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                        <div class="d-flex align-center mb-2">
                          <span class="font-16 color-707070"
                            >ติ๊กต็อก <span style="color: red">*</span></span
                          >
                        </div>
                        <div>
                          <v-text-field
                            hide-details="auto"
                            label="กรุณากรอกติ๊กต็อก"
                            v-model="tiktok"
                            outlined
                            dense
                            single-line
                            :rules="rules.tiktok"
                          ></v-text-field>
                        </div>
                      </v-col>
                      <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
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
                            v-model="tiktok_link"
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
                        >เมนูอาหารแนะนำ <span style="color: red">*</span></span
                      >
                    </div>
                    <div>
                      <v-row>
                        <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                          <img
                            class="mt-4"
                            v-if="imagePreviewURL[1]"
                            :src="imagePreviewURL[1]"
                            alt="image list slide"
                            width="100%"
                            height="auto"
                            style="max-width: 420px"
                          />

                          <v-card-text class="p-0 mt-6">
                            <div class="d-flex align-center">
                              <span class="font-16 color-707070"
                                >รูปภาพเมนูอาหารแนะนำเมนูที่ 1
                                <span style="color: red">*</span></span
                              >
                            </div>
                            <div>
                              <p class="font-14 mt-3 text-ex">
                                คำแนะนำ : ขนาดรูปภาพแนะนำ 1920 x 1080
                                หรือรูปสี่เหลี่ยมผืนผ้า ขนาดไฟล์ไม่เกิน 2 gb
                                สกุลไฟล์ jpg png jpeg เท่านั้น
                              </p>
                              <v-file-input
                                class="w-424"
                                outlined
                                dense
                                id="uploader"
                                accept="image/*"
                                v-model="product_1_pic"
                                :rules="[(v) => !!v || 'กรุณาเลือกรูปภาพ']"
                                @change="onFileChange(product_1_pic, 1)"
                                single-line
                                clearable
                                clear-icon=""
                                label="กรุณาเลือกไฟล์รูปภาพ"
                                required
                              ></v-file-input>
                            </div>
                          </v-card-text>
                        </v-col>

                        <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                          <div class="d-flex align-center mb-2">
                            <span class="font-16 color-707070"
                              >ชื่อเมนูอาหารแนะนำเมนูที่ 1
                              <span style="color: red">*</span></span
                            >
                          </div>
                          <div>
                            <v-text-field
                              hide-details="auto"
                              label="กรุณากรอกชื่อเมนูอาหารแนะนำเมนูที่ 1"
                              v-model="product_1_name"
                              outlined
                              dense
                              single-line
                              :rules="rules.tiktok_link"
                              :counter="50"
                            ></v-text-field>
                          </div>

                          <div class="d-flex align-center mb-2">
                            <span class="font-16 color-707070"
                              >ราคาอาหาร <span style="color: red">*</span></span
                            >
                          </div>
                          <div>
                            <v-text-field
                              hide-details="auto"
                              label="กรุณากรอกราคาอาหาร"
                              v-model="product_1_price"
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
                              v-model="product_1_description"
                              outlined
                              dense
                              single-line
                              :rules="rules.tiktok_link"
                            ></v-textarea>
                          </div>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                          <img
                            class="mt-4"
                            v-if="imagePreviewURL[2]"
                            :src="imagePreviewURL[2]"
                            alt="image list slide"
                            width="100%"
                            height="auto"
                            style="max-width: 420px"
                          />

                          <v-card-text class="p-0 mt-6">
                            <div class="d-flex align-center">
                              <span class="font-16 color-707070"
                                >รูปภาพเมนูอาหารแนะนำเมนูที่ 2
                                <span style="color: red">*</span></span
                              >
                            </div>
                            <div>
                              <p class="font-14 mt-3 text-ex">
                                คำแนะนำ : ขนาดรูปภาพแนะนำ 1920 x 1080
                                หรือรูปสี่เหลี่ยมผืนผ้า ขนาดไฟล์ไม่เกิน 2 gb
                                สกุลไฟล์ jpg png jpeg เท่านั้น
                              </p>
                              <v-file-input
                                class="w-424"
                                outlined
                                dense
                                id="uploader"
                                accept="image/*"
                                v-model="product_2_pic"
                                :rules="[(v) => !!v || 'กรุณาเลือกรูปภาพ']"
                                @change="onFileChange(product_2_pic, 2)"
                                single-line
                                clearable
                                clear-icon=""
                                label="กรุณาเลือกไฟล์รูปภาพ"
                                required
                              ></v-file-input>
                            </div>
                          </v-card-text>
                        </v-col>

                        <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                          <div class="d-flex align-center mb-2">
                            <span class="font-16 color-707070"
                              >ชื่อเมนูอาหารแนะนำเมนูที่ 12
                              <span style="color: red">*</span></span
                            >
                          </div>
                          <div>
                            <v-text-field
                              hide-details="auto"
                              label="กรุณากรอกชื่อเมนูอาหารแนะนำเมนูที่ 2"
                              v-model="product_2_name"
                              outlined
                              dense
                              single-line
                              :rules="rules.tiktok_link"
                              :counter="50"
                            ></v-text-field>
                          </div>

                          <div class="d-flex align-center mb-2">
                            <span class="font-16 color-707070"
                              >ราคาอาหาร <span style="color: red">*</span></span
                            >
                          </div>
                          <div>
                            <v-text-field
                              hide-details="auto"
                              label="กรุณากรอกราคาอาหาร"
                              v-model="product_2_price"
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
                              v-model="product_2_description"
                              outlined
                              dense
                              single-line
                              :rules="rules.tiktok_link"
                            ></v-textarea>
                          </div>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                          <img
                            class="mt-4"
                            v-if="imagePreviewURL[3]"
                            :src="imagePreviewURL[3]"
                            alt="image list slide"
                            width="100%"
                            height="auto"
                            style="max-width: 420px"
                          />

                          <v-card-text class="p-0 mt-6">
                            <div class="d-flex align-center">
                              <span class="font-16 color-707070"
                                >รูปภาพเมนูอาหารแนะนำเมนูที่ 3
                                <span style="color: red">*</span></span
                              >
                            </div>
                            <div>
                              <p class="font-14 mt-3 text-ex">
                                คำแนะนำ : ขนาดรูปภาพแนะนำ 1920 x 1080
                                หรือรูปสี่เหลี่ยมผืนผ้า ขนาดไฟล์ไม่เกิน 2 gb
                                สกุลไฟล์ jpg png jpeg เท่านั้น
                              </p>
                              <v-file-input
                                class="w-424"
                                outlined
                                dense
                                id="uploader"
                                accept="image/*"
                                v-model="product_3_pic"
                                :rules="[(v) => !!v || 'กรุณาเลือกรูปภาพ']"
                                @change="onFileChange(product_3_pic, 3)"
                                single-line
                                clearable
                                clear-icon=""
                                label="กรุณาเลือกไฟล์รูปภาพ"
                                required
                              ></v-file-input>
                            </div>
                          </v-card-text>
                        </v-col>

                        <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                          <div class="d-flex align-center mb-2">
                            <span class="font-16 color-707070"
                              >ชื่อเมนูอาหารแนะนำเมนูที่ 13
                              <span style="color: red">*</span></span
                            >
                          </div>
                          <div>
                            <v-text-field
                              hide-details="auto"
                              label="กรุณากรอกชื่อเมนูอาหารแนะนำเมนูที่ 3"
                              v-model="product_3_name"
                              outlined
                              dense
                              single-line
                              :rules="rules.tiktok_link"
                              :counter="50"
                            ></v-text-field>
                          </div>

                          <div class="d-flex align-center mb-2">
                            <span class="font-16 color-707070"
                              >ราคาอาหาร <span style="color: red">*</span></span
                            >
                          </div>
                          <div>
                            <v-text-field
                              hide-details="auto"
                              label="กรุณากรอกราคาอาหาร"
                              v-model="product_3_price"
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
                              v-model="product_3_description"
                              outlined
                              dense
                              single-line
                              :rules="rules.tiktok_link"
                            ></v-textarea>
                          </div>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                          <img
                            class="mt-4"
                            v-if="imagePreviewURL[4]"
                            :src="imagePreviewURL[4]"
                            alt="image list slide"
                            width="100%"
                            height="auto"
                            style="max-width: 420px"
                          />

                          <v-card-text class="p-0 mt-6">
                            <div class="d-flex align-center">
                              <span class="font-16 color-707070"
                                >รูปภาพเมนูอาหารแนะนำเมนูที่ 4
                                <span style="color: red">*</span></span
                              >
                            </div>
                            <div>
                              <p class="font-14 mt-3 text-ex">
                                คำแนะนำ : ขนาดรูปภาพแนะนำ 1920 x 1080
                                หรือรูปสี่เหลี่ยมผืนผ้า ขนาดไฟล์ไม่เกิน 2 gb
                                สกุลไฟล์ jpg png jpeg เท่านั้น
                              </p>
                              <v-file-input
                                class="w-424"
                                outlined
                                dense
                                id="uploader"
                                accept="image/*"
                                v-model="product_4_pic"
                                :rules="[(v) => !!v || 'กรุณาเลือกรูปภาพ']"
                                @change="onFileChange(product_4_pic, 4)"
                                single-line
                                clearable
                                clear-icon=""
                                label="กรุณาเลือกไฟล์รูปภาพ"
                                required
                              ></v-file-input>
                            </div>
                          </v-card-text>
                        </v-col>

                        <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                          <div class="d-flex align-center mb-2">
                            <span class="font-16 color-707070"
                              >ชื่อเมนูอาหารแนะนำเมนูที่ 4
                              <span style="color: red">*</span></span
                            >
                          </div>
                          <div>
                            <v-text-field
                              hide-details="auto"
                              label="กรุณากรอกชื่อเมนูอาหารแนะนำเมนูที่ 4"
                              v-model="product_4_name"
                              outlined
                              dense
                              single-line
                              :rules="rules.tiktok_link"
                              :counter="50"
                            ></v-text-field>
                          </div>

                          <div class="d-flex align-center mb-2">
                            <span class="font-16 color-707070"
                              >ราคาอาหาร <span style="color: red">*</span></span
                            >
                          </div>
                          <div>
                            <v-text-field
                              hide-details="auto"
                              label="กรุณากรอกราคาอาหาร"
                              v-model="product_4_price"
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
                              v-model="product_4_description"
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
                        :src="base_url + `/images/icon/megaphone 3.png`"
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
                      <vue-editor v-model="description"></vue-editor>
                    </div>
                  </v-card-text>
                  <v-card-actions>
                    <v-card-text class="p-0 d-flex justify-center">
                      <v-btn
                        type="submit"
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
      active_tab: 0,
      store_picture: null,
      content_picture: null,
      imagePreviewURL: ['','','','',''],
      imagePreviewURLArr: [],
      content_pictureArr: [],
      numImage: 0,
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
        { id: 1, name: "ร้านอาหาร" },
        { id: 2, name: "ร้านเครื่องดื่ม" },
        { id: 3, name: "ร้านเบเกอรี่" },
        { id: 4, name: "ร้านเบเกอรี่" },
        { id: 5, name: "ร้านเสื้อผ้าและความงาม" },
        { id: 6, name: "ร้านของชำ" },
      ],
      select_store_type: 0,
      product_type_list: [
        { id: 1, name: "อาหารไทย" },
        { id: 2, name: "อาหารญี่ปุ่น" },
        { id: 3, name: "อาหารประเภทเส้น" },
        { id: 4, name: "อาหารประเภทข้าว (จานเดียว)" },
        { id: 5, name: "อาหารทะเล" },
        { id: 6, name: "ขนมไทย" },
        { id: 7, name: "เบเกอรี่" },
        { id: 8, name: "อาหารว่างและของทานเล่น" },
        { id: 9, name: "ของหวาน" },
        { id: 10, name: "อาหารเสียบไม้" },
        { id: 11, name: "อาหารตะวันตก" },
        { id: 12, name: "เครื่องดื่ม" },
        { id: 13, name: "อาหารอีสาน" },
        { id: 14, name: "อาหารเหนือ" },
        { id: 15, name: "อาหารตามสั่ง" },
        { id: 16, name: "ข้าวราดแกง" },
      ],
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
      hide: {
        strikethrough: true,
        table: true,
      },
      pic: null,
      pic_list: [],
      store_name: null,
      store_type: null,
      product_type: null,
      description_short: null,
      description: null,
      price_min: null,
      price_max: null,
      time_open: null,
      time_close: null,
      tel: null,
      location: null,
      facebook: null,
      facebook_link: null,
      line: null,
      line_link: null,
      instagram: null,
      instagram_link: null,
      tiktok: null,
      tiktok_link: null,
      product_1_pic: null,
      product_1_name: null,
      product_1_price: null,
      product_1_description: null,
      product_2_pic: null,
      product_2_name: null,
      product_2_price: null,
      product_2_description: null,
      product_3_pic: null,
      product_3_name: null,
      product_3_price: null,
      product_3_description: null,
      product_4_pic: null,
      product_4_name: null,
      product_4_price: null,
      product_4_description: null,
      block_list: [],
      block_select_box: [],
      store_id: null,
    };
  },
  methods: {
    async getSelectbox() {
      let config = {
        headers: {
          Authorization: `Bearer ${this.$store.state.access_token}`,
        },
      };
      let id = this.base64Decode(this.$route.query.id);
      await store_api.getSelectbox(id, config).then((result) => {
        if (result.data.success === true) {
          this.block_select_box = result.data.data;
        }
      });
    },
    async create() {
      let data = new FormData();
      data.append("tennant_member_id", this.base64Decode(this.$route.query.id));
      data.append("pic", this.pic);
      this.pic_list.forEach((element) => {
        data.append("pic_list[]", element);
      });
      data.append("store_name", this.store_name);
      data.append("store_type", this.store_type);
      data.append("product_type", this.product_type);
      data.append("description_short", this.description_short);
      data.append("description", this.description);
      data.append("price_min", this.price_min);
      data.append("price_max", this.price_max);
      data.append("time_open", this.time_open);
      data.append("time_close", this.time_close);
      data.append("tel", this.tel);
      data.append("location", this.location);
      data.append("facebook", this.facebook);
      data.append("facebook_link", this.facebook_link);
      data.append("line", this.line);
      data.append("line_link", this.line_link);
      data.append("instagram", this.instagram);
      data.append("instagram_link", this.instagram_link);
      data.append("tiktok", this.tiktok);
      data.append("tiktok_link", this.tiktok_link);
      data.append("product_1_pic", this.product_1_pic);
      data.append("product_1_name", this.product_1_name);
      data.append("product_1_price", this.product_1_price);
      data.append("product_1_description", this.product_1_description);
      data.append("product_2_pic", this.product_2_pic);
      data.append("product_2_name", this.product_2_name);
      data.append("product_2_price", this.product_2_price);
      data.append("product_2_description", this.product_2_description);
      data.append("product_3_pic", this.product_3_pic);
      data.append("product_3_name", this.product_3_name);
      data.append("product_3_price", this.product_3_price);
      data.append("product_3_description", this.product_3_description);
      data.append("product_4_pic", this.product_4_pic);
      data.append("product_4_name", this.product_4_name);
      data.append("product_4_price", this.product_4_price);
      data.append("product_4_description", this.product_4_description);
      this.block_list.forEach((item) => {
        data.append("block_list[]", item);
      });
      let config = {
        headers: {
          Authorization: `Bearer ${this.$store.state.access_token}`,
        },
      };
      await store_api.create(data, config).then((result) => {
        if (result.data.success === true) {
          this.store_id = result.data.id;
          this.alertData("success", "สำเร็จ", "บันทึกข้อมูลเรียบร้อย");
          this.router.push(
            "/managerenter/detail/edit_thai?id=" +
              this.base64Decode(this.$route.query.id) +
              "&store_id=" +
              this.store_id
          );
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

    async onFileChangestore_picture(payload) {
      const file = payload;
      let extall = "png,PNG,jpeg,JPEG,jpg,JPG";
      let file_ext = file.name;

      let ext = file_ext.split(".").pop().toLowerCase();
      if (parseInt(extall.indexOf(ext)) < 0) {
        this.store_picture = this.base_url + "/images/image-list-slide.png";
        this.content_picture = null;
      } else {
        if (file) {
          this.store_picture = URL.createObjectURL(file);
          console.log(this.store_picture);
          URL.revokeObjectURL(file);
        } else {
          this.store_picture = before_image;
        }
      }
    },
    async onFileChange(payload, index) {
      const file = payload;
      let extall = "png,PNG,jpeg,JPEG,jpg,JPG";
      let file_ext = file.name;

      let ext = file_ext.split(".").pop().toLowerCase();
      if (parseInt(extall.indexOf(ext)) < 0) {
        this.imagePreviewURL[index] = this.base_url + "/images/image-list-slide.png";
        this.content_picture = null;
      } else {
        if (file) {
          this.imagePreviewURL[index] = URL.createObjectURL(file);
          console.log(this.imagePreviewURL[index]);
          URL.revokeObjectURL(file);
        } else {
          this.imagePreviewURL[index] = before_image;
        }
      }
    },
    async onFileChangeArr(payload, i) {
      const file = payload;
      let extall = "png,PNG,jpeg,JPEG,jpg,JPG";
      let file_ext = file.name;

      let ext = file_ext.split(".").pop().toLowerCase();
      if (parseInt(extall.indexOf(ext)) < 0) {
        this.imagePreviewURLArr[i] =
          this.base_url + "/images/image-list-slide.png";
        this.content_pictureArr[i] = null;
      } else {
        if (file) {
          this.imagePreviewURLArr[i] = URL.createObjectURL(file);
          console.log(this.imagePreviewURLArr[i]);
          URL.revokeObjectURL(file);
        } else {
          this.imagePreviewURLArr[i] = before_image;
        }
      }
    },

    async store_pictureOnFileRemoveArr(index) {
      this.numImage.splice(index, 1);
      this.pic_list.splice(index, 1);
    },

    async store_pictureOnFileRemove() {
      this.store_picture = this.base_url + "/images/image-list-slide.png";
    },

    async onFileRemove() {
      this.content_picture = null;
      this.imagePreviewURL = this.base_url + "/images/image-list-slide.png";
    },
  },
  created() {},
  mounted() {
    this.imagePreviewURL.forEach((item, i) => {
       this.imagePreviewURL[i] = this.base_url + "/images/image-list-slide.png"
    });
    this.imagePreviewURLArr.push(
      this.base_url + "/images/image-list-slide.png"
    );
    this.getSelectbox();
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
