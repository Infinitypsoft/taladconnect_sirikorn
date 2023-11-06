<template>
    <div class="loading_all_page" v-if="loading_page === true">
        <v-progress-circular indeterminate size="70" :width="8" color="#FFBC15"></v-progress-circular>
        <p class="mt-3">กำลังโหลดข้อมูล</p>
    </div>

    <div v-else>
        <div class="container">
            <div class="d-flex justify-space-between align-items-center mt-4 mb-4">
                <v-card-text class="p-0">
                    <h1 class="font-20 m-0">เพิ่มข้อมูลแกลลอรี่</h1>
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
                        <v-form ref="form_gallery_add" v-on:submit.prevent="galleryAdd()">
                            <v-row class="m-0 p-4 pb-0">
                                <v-col cols="12" xs="12" sm="12" md="12" lg="8" xl="8">
                                    <v-card-title class="p-0 text-card-title">
                                        <p>ข้อมูลแกลลอรี่</p>
                                    </v-card-title>
                                    <v-card elevation="2" class="pl-60 pr-60 pt-30 pb-30">
                                        <v-card-text class="p-0">
                                            <div class="d-flex align-center">
                                                <img class="mr-2" :src="base_url + `/images/icon/megaphone.png`"
                                                    alt="Keyword" width="20" height="20" />

                                                <span class="font-16 color-title-card">หัวข้อแกลลอรี่</span>
                                            </div>
                                            <div>
                                                <p class="font-14 mt-3 text-ex">ภาษาไทย</p>
                                                <v-text-field hide-details="auto" label="กรุณากรอกหัวข้อแกลลอรี่ เป็นภาษาไทย"
                                                    v-model="title_thai" outlined dense single-line
                                                    :rules="invitation_thRules" :counter="27"></v-text-field>
                                            </div>
                                            <div>
                                                <p class="font-14 text-ex">ภาษาอังกฤษ</p>
                                                <v-text-field hide-details="auto" :rules="invitation_enRules" :counter="25" v-model="title_eng"
                                                    outlined dense single-line
                                                    label="กรุณากรอกหัวข้อแกลลอรี่ เป็นภาษาอังกฤษ"></v-text-field>
                                            </div>
                                        </v-card-text>
                                        <v-card-text class="p-0">
                                            <div class="d-flex align-center">
                                                <img class="mr-2" :src="base_url + `/images/icon/detail.png`" alt="Keyword"
                                                    width="20" height="20" />

                                                <span class="font-16 color-title-card">รายละเอียด</span>
                                            </div>
                                            <div>
                                                <p class="font-14 mt-3 text-ex">ภาษาไทย</p>
                                                <v-textarea outlined single-line v-model="description_thai"
                                                    label="กรุณากรอกรายละเอียดที่จะแสดงหน้าเว็บไซต์ เป็นภาษาไทย"
                                                    :rules="detail_thRules" :counter="120"></v-textarea>
                                            </div>
                                            <div>
                                                <p class="font-14 text-ex">ภาษาอังกฤษ</p>
                                                <v-textarea outlined single-line v-model="description_eng"
                                                    label="กรุณากรอกรายละเอียดที่จะแสดงหน้าเว็บไซต์ เป็นภาษาอังกฤษ"
                                                    :rules="detail_enRules" :counter="120"></v-textarea>
                                            </div>
                                        </v-card-text>

                                    </v-card>
                                </v-col>
                                <v-col cols="12" xs="12" sm="12" md="12" lg="4" xl="4">
                                    <v-card elevation="2">
                                        <div class="title-color-bar"></div>
                                        <v-row class="pt-30">
                                            <v-col class="pt-0 d-flex justify-center" xs="12" sm="12" md="12" lg="12"
                                                xl="12">
                                                <v-card-title class="pt-0 d-flex flex-column">
                                                    <h1 class="fs-35 fw-600 mb-0 pb-0 color-black">รูปภาพแกลลอรี่</h1>
                                                    <p class="fs-16 fw-400 pt-1 color-212621">รายละเอียดแกลลอรี่</p>
                                                </v-card-title>
                                            </v-col>
                                            <v-col class="pt-0 d-flex justify-center p-5" xs="12" sm="12" md="12" lg="12"
                                                xl="12">
                                                <v-img width="100%" height="auto"
                                                    :src="base_url + `/images/gallery/image 24.png`"></v-img>

                                            </v-col>
                                        </v-row>
                                    </v-card>
                                </v-col>
                            </v-row>
                            <v-row class="m-0 p-4 pt-0">
                                <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                                    <v-card-title class="p-0 text-card-title">
                                        <p>ข้อมูลข่าวสารและกิจกรรมภาษาไทย</p>
                                    </v-card-title>
                                    <v-card elevation="2" class="pl-60 pr-60 pt-30 pb-30">

                                        <!-- Image gallery 1 -->
                                        <v-list-item three-line class="pl-0 pr-0 ml-0 mr-0 mb-5">
                                            <div class="row-list w-100" style="gap: 50px;">
                                                <div class="col-list image-list-slide max-w-419 w-100">
                                                    <img class="mt-4 max-h-245 h-100" v-if="imagePreviewURL_1"
                                                        :src="imagePreviewURL_1" alt="image list slide" width="100%"
                                                        height="auto" style="max-width: 420px;" />
                                                </div>
                                                <div class="col-list d-flex flex-column justify-center align-center">
                                                    <v-card-text class="p-0 mt-2">
                                                        <div class="d-flex align-center">
                                                            <img class="mr-2" :src="base_url + `/images/icon/picture.png`"
                                                                alt="Title" width="20" height="20" />
                                                            <span class="font-16 color-title-card">เพิ่มรูปภาพแกลลอรี่รูปที่
                                                                1
                                                                <span style="color: red;">*</span></span>
                                                        </div>
                                                        <div>
                                                            <p class="font-14 mt-3 text-ex">คำแนะนำ : ขนาดรูปภาพแนะนำ 700 x
                                                                480 หรือรูปสี่เหลี่ยมผืนผ้า ขนาดไฟล์ไม่เกิน 2 gb สกุลไฟล์
                                                                jpg png jpeg เท่านั้น</p>

                                                            <v-file-input class="w-100" outlined dense id="uploader"
                                                                accept="image/*" v-model="content_picture_1"
                                                                :rules="[v => !!v || 'กรุณาเลือกรูปภาพ']"
                                                                @change="onFileChange_1" single-line clearable clear-icon=""
                                                                label="กรุณาเลือกไฟล์รูปภาพ" required></v-file-input>
                                                        </div>
                                                    </v-card-text>
                                                </div>
                                            </div>
                                        </v-list-item>

                                        <!-- Image gallery 2 -->
                                        <v-list-item three-line class="pl-0 pr-0 ml-0 mr-0 mb-5">
                                            <div class="row-list w-100" style="gap: 50px;">
                                                <div class="col-list image-list-slide max-w-419 w-100">
                                                    <img class="mt-4 max-h-500 h-100" v-if="imagePreviewURL_2"
                                                        :src="imagePreviewURL_2" alt="image list slide" width="100%"
                                                        style="max-width: 420px;" />
                                                </div>
                                                <div class="col-list d-flex flex-column justify-center align-center">
                                                    <v-card-text class="p-0 mt-2">
                                                        <div class="d-flex align-center">
                                                            <img class="mr-2" :src="base_url + `/images/icon/picture.png`"
                                                                alt="Title" width="20" height="20" />
                                                            <span class="font-16 color-title-card">เพิ่มรูปภาพแกลลอรี่รูปที่
                                                                2
                                                                <span style="color: red;">*</span></span>
                                                        </div>
                                                        <div>
                                                            <p class="font-14 mt-3 text-ex">คำแนะนำ : ขนาดรูปภาพแนะนำ 700 x
                                                                800 หรือรูปสี่เหลี่ยมผืนผ้า ขนาดไฟล์ไม่เกิน 2 gb สกุลไฟล์
                                                                jpg png jpeg เท่านั้น</p>

                                                            <v-file-input class="w-100" outlined dense id="uploader"
                                                                accept="image/*" v-model="content_picture_2"
                                                                :rules="[v => !!v || 'กรุณาเลือกรูปภาพ']"
                                                                @change="onFileChange_2" single-line clearable clear-icon=""
                                                                label="กรุณาเลือกไฟล์รูปภาพ" required></v-file-input>
                                                        </div>
                                                    </v-card-text>
                                                </div>
                                            </div>
                                        </v-list-item>

                                        <!-- Image gallery 3 -->
                                        <v-list-item three-line class="pl-0 pr-0 ml-0 mr-0 mb-5">
                                            <div class="row-list w-100" style="gap: 50px;">
                                                <div class="col-list image-list-slide max-w-419 w-100">
                                                    <img class="mt-4 max-h-245 h-100" v-if="imagePreviewURL_3"
                                                        :src="imagePreviewURL_3" alt="image list slide" width="100%"
                                                        height="auto" style="max-width: 420px;" />
                                                </div>
                                                <div class="col-list d-flex flex-column justify-center align-center">
                                                    <v-card-text class="p-0 mt-2">
                                                        <div class="d-flex align-center">
                                                            <img class="mr-2" :src="base_url + `/images/icon/picture.png`"
                                                                alt="Title" width="20" height="20" />
                                                            <span class="font-16 color-title-card">เพิ่มรูปภาพแกลลอรี่รูปที่
                                                                3
                                                                <span style="color: red;">*</span></span>
                                                        </div>
                                                        <div>
                                                            <p class="font-14 mt-3 text-ex">คำแนะนำ : ขนาดรูปภาพแนะนำ 700 x
                                                                480 หรือรูปสี่เหลี่ยมผืนผ้า ขนาดไฟล์ไม่เกิน 2 gb สกุลไฟล์
                                                                jpg png jpeg เท่านั้น</p>

                                                            <v-file-input class="w-100" outlined dense id="uploader"
                                                                accept="image/*" v-model="content_picture_3"
                                                                :rules="[v => !!v || 'กรุณาเลือกรูปภาพ']"
                                                                @change="onFileChange_3" single-line clearable clear-icon=""
                                                                label="กรุณาเลือกไฟล์รูปภาพ" required></v-file-input>
                                                        </div>
                                                    </v-card-text>
                                                </div>
                                            </div>
                                        </v-list-item>

                                        <!-- Image gallery 4 -->
                                        <v-list-item three-line class="pl-0 pr-0 ml-0 mr-0 mb-5">
                                            <div class="row-list w-100" style="gap: 50px;">
                                                <div class="col-list image-list-slide max-w-419 w-100">
                                                    <img class="mt-4 max-h-500 h-100" v-if="imagePreviewURL_4"
                                                        :src="imagePreviewURL_4" alt="image list slide" width="100%"
                                                        height="auto" style="max-width: 420px;" />
                                                </div>
                                                <div class="col-list d-flex flex-column justify-center align-center">
                                                    <v-card-text class="p-0 mt-2">
                                                        <div class="d-flex align-center">
                                                            <img class="mr-2" :src="base_url + `/images/icon/picture.png`"
                                                                alt="Title" width="20" height="20" />
                                                            <span class="font-16 color-title-card">เพิ่มรูปภาพแกลลอรี่รูปที่
                                                                4
                                                                <span style="color: red;">*</span></span>
                                                        </div>
                                                        <div>
                                                            <p class="font-14 mt-3 text-ex">คำแนะนำ : ขนาดรูปภาพแนะนำ 700 x
                                                                800 หรือรูปสี่เหลี่ยมผืนผ้า ขนาดไฟล์ไม่เกิน 2 gb สกุลไฟล์
                                                                jpg png jpeg เท่านั้น</p>

                                                            <v-file-input class="w-100" outlined dense id="uploader"
                                                                accept="image/*" v-model="content_picture_4"
                                                                :rules="[v => !!v || 'กรุณาเลือกรูปภาพ']"
                                                                @change="onFileChange_4" single-line clearable clear-icon=""
                                                                label="กรุณาเลือกไฟล์รูปภาพ" required></v-file-input>
                                                        </div>
                                                    </v-card-text>
                                                </div>
                                            </div>
                                        </v-list-item>

                                        <!-- Image gallery 5 -->
                                        <v-list-item three-line class="pl-0 pr-0 ml-0 mr-0 mb-5">
                                            <div class="row-list w-100" style="gap: 50px;">
                                                <div class="col-list image-list-slide max-w-419 w-100">
                                                    <img class="mt-4 max-h-500 h-100" v-if="imagePreviewURL_5"
                                                        :src="imagePreviewURL_5" alt="image list slide" width="100%"
                                                        height="auto" style="max-width: 420px;" />
                                                </div>
                                                <div class="col-list d-flex flex-column justify-center align-center">
                                                    <v-card-text class="p-0 mt-2">
                                                        <div class="d-flex align-center">
                                                            <img class="mr-2" :src="base_url + `/images/icon/picture.png`"
                                                                alt="Title" width="20" height="20" />
                                                            <span class="font-16 color-title-card">เพิ่มรูปภาพแกลลอรี่รูปที่
                                                                5
                                                                <span style="color: red;">*</span></span>
                                                        </div>
                                                        <div>
                                                            <p class="font-14 mt-3 text-ex">คำแนะนำ : ขนาดรูปภาพแนะนำ 700 x
                                                                800 หรือรูปสี่เหลี่ยมผืนผ้า ขนาดไฟล์ไม่เกิน 2 gb สกุลไฟล์
                                                                jpg png jpeg เท่านั้น</p>

                                                            <v-file-input class="w-100" outlined dense id="uploader"
                                                                accept="image/*" v-model="content_picture_5"
                                                                :rules="[v => !!v || 'กรุณาเลือกรูปภาพ']"
                                                                @change="onFileChange_5" single-line clearable clear-icon=""
                                                                label="กรุณาเลือกไฟล์รูปภาพ" required></v-file-input>
                                                        </div>
                                                    </v-card-text>
                                                </div>
                                            </div>
                                        </v-list-item>

                                        <!-- Image gallery 6 -->
                                        <v-list-item three-line class="pl-0 pr-0 ml-0 mr-0 mb-5">
                                            <div class="row-list w-100" style="gap: 50px;">
                                                <div class="col-list image-list-slide max-w-419 w-100">
                                                    <img class="mt-4 max-h-245 h-100" v-if="imagePreviewURL_6"
                                                        :src="imagePreviewURL_6" alt="image list slide" width="100%"
                                                        height="auto" style="max-width: 420px;" />
                                                </div>
                                                <div class="col-list d-flex flex-column justify-center align-center">
                                                    <v-card-text class="p-0 mt-2">
                                                        <div class="d-flex align-center">
                                                            <img class="mr-2" :src="base_url + `/images/icon/picture.png`"
                                                                alt="Title" width="20" height="20" />
                                                            <span class="font-16 color-title-card">เพิ่มรูปภาพแกลลอรี่รูปที่
                                                                6
                                                                <span style="color: red;">*</span></span>
                                                        </div>
                                                        <div>
                                                            <p class="font-14 mt-3 text-ex">คำแนะนำ : ขนาดรูปภาพแนะนำ 700 x
                                                                480 หรือรูปสี่เหลี่ยมผืนผ้า ขนาดไฟล์ไม่เกิน 2 gb สกุลไฟล์
                                                                jpg png jpeg เท่านั้น</p>

                                                            <v-file-input class="w-100" outlined dense id="uploader"
                                                                accept="image/*" v-model="content_picture_6"
                                                                :rules="[v => !!v || 'กรุณาเลือกรูปภาพ']"
                                                                @change="onFileChange_6" single-line clearable clear-icon=""
                                                                label="กรุณาเลือกไฟล์รูปภาพ" required></v-file-input>
                                                        </div>
                                                    </v-card-text>
                                                </div>
                                            </div>
                                        </v-list-item>

                                        <!-- Image gallery 7 -->
                                        <v-list-item three-line class="pl-0 pr-0 ml-0 mr-0 mb-5">
                                            <div class="row-list w-100" style="gap: 50px;">
                                                <div class="col-list image-list-slide max-w-419 w-100">
                                                    <img class="mt-4 max-h-245 h-100" v-if="imagePreviewURL_7"
                                                        :src="imagePreviewURL_7" alt="image list slide" width="100%"
                                                        height="auto" style="max-width: 420px;" />
                                                </div>
                                                <div class="col-list d-flex flex-column justify-center align-center">
                                                    <v-card-text class="p-0 mt-2">
                                                        <div class="d-flex align-center">
                                                            <img class="mr-2" :src="base_url + `/images/icon/picture.png`"
                                                                alt="Title" width="20" height="20" />
                                                            <span class="font-16 color-title-card">เพิ่มรูปภาพแกลลอรี่รูปที่
                                                                7
                                                                <span style="color: red;">*</span></span>
                                                        </div>
                                                        <div>
                                                            <p class="font-14 mt-3 text-ex">คำแนะนำ : ขนาดรูปภาพแนะนำ 700 x
                                                                480 หรือรูปสี่เหลี่ยมผืนผ้า ขนาดไฟล์ไม่เกิน 2 gb สกุลไฟล์
                                                                jpg png jpeg เท่านั้น</p>

                                                            <v-file-input class="w-100" outlined dense id="uploader"
                                                                accept="image/*" v-model="content_picture_7"
                                                                :rules="[v => !!v || 'กรุณาเลือกรูปภาพ']"
                                                                @change="onFileChange_7" single-line clearable clear-icon=""
                                                                label="กรุณาเลือกไฟล์รูปภาพ" required></v-file-input>
                                                        </div>
                                                    </v-card-text>
                                                </div>
                                            </div>
                                        </v-list-item>

                                        <!-- Image gallery 8 -->
                                        <v-list-item three-line class="pl-0 pr-0 ml-0 mr-0 mb-5">
                                            <div class="row-list w-100" style="gap: 50px;">
                                                <div class="col-list image-list-slide max-w-419 w-100">
                                                    <img class="mt-4 max-h-245 h-100" v-if="imagePreviewURL_8"
                                                        :src="imagePreviewURL_8" alt="image list slide" width="100%"
                                                        height="auto" style="max-width: 420px;" />
                                                </div>
                                                <div class="col-list d-flex flex-column justify-center align-center">
                                                    <v-card-text class="p-0 mt-2">
                                                        <div class="d-flex align-center">
                                                            <img class="mr-2" :src="base_url + `/images/icon/picture.png`"
                                                                alt="Title" width="20" height="20" />
                                                            <span class="font-16 color-title-card">เพิ่มรูปภาพแกลลอรี่รูปที่
                                                                8
                                                                <span style="color: red;">*</span></span>
                                                        </div>
                                                        <div>
                                                            <p class="font-14 mt-3 text-ex">คำแนะนำ : ขนาดรูปภาพแนะนำ 700 x
                                                                480 หรือรูปสี่เหลี่ยมผืนผ้า ขนาดไฟล์ไม่เกิน 2 gb สกุลไฟล์
                                                                jpg png jpeg เท่านั้น</p>

                                                            <v-file-input class="w-100" outlined dense id="uploader"
                                                                accept="image/*" v-model="content_picture_8"
                                                                :rules="[v => !!v || 'กรุณาเลือกรูปภาพ']"
                                                                @change="onFileChange_8" single-line clearable clear-icon=""
                                                                label="กรุณาเลือกไฟล์รูปภาพ" required></v-file-input>
                                                        </div>
                                                    </v-card-text>
                                                </div>
                                            </div>
                                        </v-list-item>

                                        <!-- Image gallery 9 -->
                                        <v-list-item three-line class="pl-0 pr-0 ml-0 mr-0 mb-5">
                                            <div class="row-list w-100" style="gap: 50px;">
                                                <div class="col-list image-list-slide max-w-419 w-100">
                                                    <img class="mt-4 max-h-245 h-100" v-if="imagePreviewURL_9"
                                                        :src="imagePreviewURL_9" alt="image list slide" width="100%"
                                                        height="auto" style="max-width: 420px;" />
                                                </div>
                                                <div class="col-list d-flex flex-column justify-center align-center">
                                                    <v-card-text class="p-0 mt-2">
                                                        <div class="d-flex align-center">
                                                            <img class="mr-2" :src="base_url + `/images/icon/picture.png`"
                                                                alt="Title" width="20" height="20" />
                                                            <span class="font-16 color-title-card">เพิ่มรูปภาพแกลลอรี่รูปที่
                                                                9
                                                                <span style="color: red;">*</span></span>
                                                        </div>
                                                        <div>
                                                            <p class="font-14 mt-3 text-ex">คำแนะนำ : ขนาดรูปภาพแนะนำ 700 x
                                                                480 หรือรูปสี่เหลี่ยมผืนผ้า ขนาดไฟล์ไม่เกิน 2 gb สกุลไฟล์
                                                                jpg png jpeg เท่านั้น</p>

                                                            <v-file-input class="w-100" outlined dense id="uploader"
                                                                accept="image/*" v-model="content_picture_9"
                                                                :rules="[v => !!v || 'กรุณาเลือกรูปภาพ']"
                                                                @change="onFileChange_9" single-line clearable clear-icon=""
                                                                label="กรุณาเลือกไฟล์รูปภาพ" required></v-file-input>
                                                        </div>
                                                    </v-card-text>
                                                </div>
                                            </div>
                                        </v-list-item>

                                    </v-card>

                                    <div class="d-flex justify-center mt-5">
                                        <v-btn type="submit" color="white" class="ma-2 btn-save rounded-pill pl-30 pr-30">
                                            <v-icon class="fs-20" left dark>
                                                mdi-content-save
                                            </v-icon>
                                            <span>บันทึกข้อมูล</span>
                                        </v-btn>
                                    </div>
                                </v-col>
                            </v-row>
                        </v-form>
                    </v-card>
                </v-col>
            </v-row>


        </div>
    </div>
</template>

<script>
import gallery from '../../../api/gallery.js';

export default {
    data() {
        return {
            dialog: false,
            loading_page: false,
            imagePreviewURL_1: null,
            imagePreviewURL_2: null,
            imagePreviewURL_3: null,
            imagePreviewURL_4: null,
            imagePreviewURL_5: null,
            imagePreviewURL_6: null,
            imagePreviewURL_7: null,
            imagePreviewURL_8: null,
            imagePreviewURL_9: null,

            content_picture_1: null,
            content_picture_2: null,
            content_picture_3: null,
            content_picture_4: null,
            content_picture_5: null,
            content_picture_6: null,
            content_picture_7: null,
            content_picture_8: null,
            content_picture_9: null,
            submenu: [
                {
                    text: 'จัดการเว็บไซต์ประชาสัมพันธ์',
                    disabled: false,
                },
                {
                    text: 'จัดการภาพแกลลอรี่',
                    disabled: true,
                },
            ],
            invitation_thRules: [
                v => !!v && v.length <= 27 || 'สูงสุด 27 ตัวอักษร',
            ],
            invitation_enRules: [
                v => !!v && v.length <= 25 || 'สูงสุด 25 ตัวอักษร',
            ],
            detail_thRules: [
                v => !!v && v.length <= 120 || 'สูงสุด 120 ตัวอักษร',
            ],
            detail_enRules: [
                v => !!v && v.length <= 120 || 'สูงสุด 120 ตัวอักษร',
            ],
            title_thai: '',
            title_eng: '',
            description_thai: '',
            description_eng: '',
            gallery_pic_data: [],
            gallery_info_data: {},
        }
    },
    methods: {
        async getList() {
            let config = {
                headers: {
                    Authorization: `Bearer ${this.$store.state.access_token}`,
                },
            }
            await gallery.galleryList(config).then((result) => {
                if (result.data.success === true) {
                    this.gallery_pic_data = result.data.data;
                    this.gallery_info_data = result.data.data_info;
                    this.title_thai = this.gallery_info_data.title_thai
                    this.title_eng = this.gallery_info_data.title_eng
                    this.description_thai = this.gallery_info_data.description_thai
                    this.description_eng = this.gallery_info_data.description_eng

                    if (this.gallery_pic_data[0].pic_path !== null) {
                        this.imagePreviewURL_1 = this.base_url + `/public/` + this.gallery_pic_data[0].pic_path
                        this.content_picture_1 = { name: this.gallery_pic_data[0].pic_path }
                    }
                    if (this.gallery_pic_data[1].pic_path !== null) {
                        this.imagePreviewURL_2 = this.base_url + `/public/` + this.gallery_pic_data[1].pic_path
                        this.content_picture_2 = { name: this.gallery_pic_data[1].pic_path }
                    }
                    if (this.gallery_pic_data[2].pic_path !== null) {
                        this.imagePreviewURL_3 = this.base_url + `/public/` + this.gallery_pic_data[2].pic_path
                        this.content_picture_3 = { name: this.gallery_pic_data[2].pic_path }
                    }
                    if (this.gallery_pic_data[3].pic_path !== null) {
                        this.imagePreviewURL_4 = this.base_url + `/public/` + this.gallery_pic_data[3].pic_path
                        this.content_picture_4 = { name: this.gallery_pic_data[3].pic_path }
                    }
                    if (this.gallery_pic_data[4].pic_path !== null) {
                        this.imagePreviewURL_5 = this.base_url + `/public/` + this.gallery_pic_data[4].pic_path
                        this.content_picture_5 = { name: this.gallery_pic_data[4].pic_path }
                    }
                    if (this.gallery_pic_data[5].pic_path !== null) {
                        this.imagePreviewURL_6 = this.base_url + `/public/` + this.gallery_pic_data[5].pic_path
                        this.content_picture_6 = { name: this.gallery_pic_data[5].pic_path }
                    }
                    if (this.gallery_pic_data[6].pic_path !== null) {
                        this.imagePreviewURL_7 = this.base_url + `/public/` + this.gallery_pic_data[6].pic_path
                        this.content_picture_7 = { name: this.gallery_pic_data[6].pic_path }
                    }
                    if (this.gallery_pic_data[7].pic_path !== null) {
                        this.imagePreviewURL_8 = this.base_url + `/public/` + this.gallery_pic_data[7].pic_path
                        this.content_picture_8 = { name: this.gallery_pic_data[7].pic_path }
                    }
                    if (this.gallery_pic_data[8].pic_path !== null) {
                        this.imagePreviewURL_9 = this.base_url + `/public/` + this.gallery_pic_data[8].pic_path
                        this.content_picture_9 = { name: this.gallery_pic_data[8].pic_path }
                    }

                }

            })
        },
        async galleryAdd() {
            if (this.$refs.form_gallery_add.validate()) {
                this.loading_page = true;
                let config = {
                    headers: {
                        Authorization: `Bearer ${this.$store.state.access_token}`,
                    },
                }

                const data = new FormData()

                data.append('info_id', this.gallery_info_data.id);
                data.append('title_thai', this.title_thai);
                data.append('title_eng', this.title_eng);
                data.append('description_thai', this.description_thai);
                data.append('description_eng', this.description_eng);

                if (this.content_picture_1 instanceof File || this.content_picture_1 instanceof Blob) {
                    data.append('pic_ids[]', 1);
                    data.append('pics[]', this.content_picture_1)
                }
                if (this.content_picture_2 instanceof File || this.content_picture_2 instanceof Blob) {
                    data.append('pic_ids[]', 2);
                    data.append('pics[]', this.content_picture_2)
                }
                if (this.content_picture_3 instanceof File || this.content_picture_3 instanceof Blob) {
                    data.append('pic_ids[]', 3);
                    data.append('pics[]', this.content_picture_3)
                }
                if (this.content_picture_4 instanceof File || this.content_picture_4 instanceof Blob) {
                    data.append('pic_ids[]', 4);
                    data.append('pics[]', this.content_picture_4)
                }
                if (this.content_picture_5 instanceof File || this.content_picture_5 instanceof Blob) {
                    data.append('pic_ids[]', 5);
                    data.append('pics[]', this.content_picture_5)
                }
                if (this.content_picture_6 instanceof File || this.content_picture_6 instanceof Blob) {
                    data.append('pic_ids[]', 6);
                    data.append('pics[]', this.content_picture_6)
                }
                if (this.content_picture_7 instanceof File || this.content_picture_7 instanceof Blob) {
                    data.append('pic_ids[]', 7);
                    data.append('pics[]', this.content_picture_7)
                }
                if (this.content_picture_8 instanceof File || this.content_picture_8 instanceof Blob) {
                    data.append('pic_ids[]', 8);
                    data.append('pics[]', this.content_picture_8)
                }
                if (this.content_picture_9 instanceof File || this.content_picture_9 instanceof Blob) {
                    data.append('pic_ids[]', 9);
                    data.append('pics[]', this.content_picture_9)
                }

                await gallery.galleryUpdate(data, config).then((result) => {
                    if (result.data.success === true) {
                        this.loading_page = false;
                        this.alertData('success', 'ทำรายการเสร็จสิ้น', 'ระบบได้บันทึกข้อมูลเรียบร้อยแล้ว');
                        this.$router.push('/managegallery')
                    }
                }).catch((error) => {
                    if (error.response.status === 401) {
                        this.loading_page = false
                        this.$store.commit('logOutSuccess')
                        this.$router.push('/login')
                    }
                })

            }

        },

        async onFileChange_1(payload) {
            const file = payload
            let extall = "png,PNG,jpeg,JPEG,jpg,JPG";
            let file_ext = file.name;

            let ext = file_ext.split('.').pop().toLowerCase();
            if (parseInt(extall.indexOf(ext)) < 0) {

                this.imagePreviewURL_1 = this.base_url + `/images/image-list-slide.png`
                this.content_picture_1 = null
            } else {
                if (file) {

                    this.imagePreviewURL_1 = URL.createObjectURL(file)
                    console.log(this.imagePreviewURL_1);
                    URL.revokeObjectURL(file)
                } else {
                    this.imagePreviewURL_1 = before_image
                }
            }
        },

        async onFileChange_2(payload) {
            const file = payload
            let extall = "png,PNG,jpeg,JPEG,jpg,JPG";
            let file_ext = file.name;

            let ext = file_ext.split('.').pop().toLowerCase();
            if (parseInt(extall.indexOf(ext)) < 0) {

                this.imagePreviewURL_2 = this.base_url + `/images/image-list-slide.png`
                this.content_picture_2 = null
            } else {
                if (file) {

                    this.imagePreviewURL_2 = URL.createObjectURL(file)
                    console.log(this.imagePreviewURL_1);
                    URL.revokeObjectURL(file)
                } else {
                    this.imagePreviewURL_2 = before_image
                }
            }
        },

        async onFileChange_3(payload) {
            const file = payload
            let extall = "png,PNG,jpeg,JPEG,jpg,JPG";
            let file_ext = file.name;

            let ext = file_ext.split('.').pop().toLowerCase();
            if (parseInt(extall.indexOf(ext)) < 0) {

                this.imagePreviewURL_3 = this.base_url + `/images/image-list-slide.png`
                this.content_picture_3 = null
            } else {
                if (file) {

                    this.imagePreviewURL_3 = URL.createObjectURL(file)
                    console.log(this.imagePreviewURL_1);
                    URL.revokeObjectURL(file)
                } else {
                    this.imagePreviewURL_3 = before_image
                }
            }
        },

        async onFileChange_4(payload) {
            const file = payload
            let extall = "png,PNG,jpeg,JPEG,jpg,JPG";
            let file_ext = file.name;

            let ext = file_ext.split('.').pop().toLowerCase();
            if (parseInt(extall.indexOf(ext)) < 0) {

                this.imagePreviewURL_4 = this.base_url + `/images/image-list-slide.png`
                this.content_picture_4 = null
            } else {
                if (file) {

                    this.imagePreviewURL_4 = URL.createObjectURL(file)
                    console.log(this.imagePreviewURL_1);
                    URL.revokeObjectURL(file)
                } else {
                    this.imagePreviewURL_4 = before_image
                }
            }
        },

        async onFileChange_5(payload) {
            const file = payload
            let extall = "png,PNG,jpeg,JPEG,jpg,JPG";
            let file_ext = file.name;

            let ext = file_ext.split('.').pop().toLowerCase();
            if (parseInt(extall.indexOf(ext)) < 0) {

                this.imagePreviewURL_5 = this.base_url + `/images/image-list-slide.png`
                this.content_picture_5 = null
            } else {
                if (file) {

                    this.imagePreviewURL_5 = URL.createObjectURL(file)
                    console.log(this.imagePreviewURL_1);
                    URL.revokeObjectURL(file)
                } else {
                    this.imagePreviewURL_5 = before_image
                }
            }
        },

        async onFileChange_6(payload) {
            const file = payload
            let extall = "png,PNG,jpeg,JPEG,jpg,JPG";
            let file_ext = file.name;

            let ext = file_ext.split('.').pop().toLowerCase();
            if (parseInt(extall.indexOf(ext)) < 0) {

                this.imagePreviewURL_6 = this.base_url + `/images/image-list-slide.png`
                this.content_picture_6 = null
            } else {
                if (file) {

                    this.imagePreviewURL_6 = URL.createObjectURL(file)
                    console.log(this.imagePreviewURL_1);
                    URL.revokeObjectURL(file)
                } else {
                    this.imagePreviewURL_6 = before_image
                }
            }
        },

        async onFileChange_7(payload) {
            const file = payload
            let extall = "png,PNG,jpeg,JPEG,jpg,JPG";
            let file_ext = file.name;

            let ext = file_ext.split('.').pop().toLowerCase();
            if (parseInt(extall.indexOf(ext)) < 0) {

                this.imagePreviewURL_7 = this.base_url + `/images/image-list-slide.png`
                this.content_picture_7 = null
            } else {
                if (file) {

                    this.imagePreviewURL_7 = URL.createObjectURL(file)
                    console.log(this.imagePreviewURL_1);
                    URL.revokeObjectURL(file)
                } else {
                    this.imagePreviewURL_7 = before_image
                }
            }
        },

        async onFileChange_8(payload) {
            const file = payload
            let extall = "png,PNG,jpeg,JPEG,jpg,JPG";
            let file_ext = file.name;

            let ext = file_ext.split('.').pop().toLowerCase();
            if (parseInt(extall.indexOf(ext)) < 0) {

                this.imagePreviewURL_8 = this.base_url + `/images/image-list-slide.png`
                this.content_picture_8 = null
            } else {
                if (file) {

                    this.imagePreviewURL_8 = URL.createObjectURL(file)
                    console.log(this.imagePreviewURL_1);
                    URL.revokeObjectURL(file)
                } else {
                    this.imagePreviewURL_8 = before_image
                }
            }
        },

        async onFileChange_9(payload) {
            const file = payload
            let extall = "png,PNG,jpeg,JPEG,jpg,JPG";
            let file_ext = file.name;

            let ext = file_ext.split('.').pop().toLowerCase();
            if (parseInt(extall.indexOf(ext)) < 0) {

                this.imagePreviewURL_9 = this.base_url + `/images/image-list-slide.png`
                this.content_picture_9 = null
            } else {
                if (file) {

                    this.imagePreviewURL_9 = URL.createObjectURL(file)
                    console.log(this.imagePreviewURL_1);
                    URL.revokeObjectURL(file)
                } else {
                    this.imagePreviewURL_9 = before_image
                }
            }
        },
    },
    created() {
    },
    mounted() {
        this.imagePreviewURL_1 = this.base_url + `/images/gallery/01.png`
        this.imagePreviewURL_2 = this.base_url + `/images/gallery/02.png`
        this.imagePreviewURL_3 = this.base_url + `/images/gallery/03.png`
        this.imagePreviewURL_4 = this.base_url + `/images/gallery/04.png`
        this.imagePreviewURL_5 = this.base_url + `/images/gallery/05.png`
        this.imagePreviewURL_6 = this.base_url + `/images/gallery/06.png`
        this.imagePreviewURL_7 = this.base_url + `/images/gallery/07.png`
        this.imagePreviewURL_8 = this.base_url + `/images/gallery/08.png`
        this.imagePreviewURL_9 = this.base_url + `/images/gallery/09.png`
        this.getList()
    }
}
</script>

<style scoped lang="scss">
* {
    font-family: 'Kanit', sans-serif !important;
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

.btn-success {
    margin-top: 10px;
    border-radius: 30px;
    background: linear-gradient(90deg, #86D780 0%, #60A577 100%);
    box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);

    color: #F9F9F9;
    font-size: 16px;

}

.text-domain-name {
    color: #707070;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
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