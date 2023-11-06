<template>
    <div class="hearder"  >
        <div class="navbar" >
            <div class="logo" data-aos="fade-right">
                <img :src="base_url + `/images/logo_header.png`" alt="Logo" width="60" height="60" />
                <span>TALAD CONNEx</span>
            </div>
            <div class="navbar-right" data-aos="fade-left">
                <div class="notify">
                    <img :src="base_url + `/images/notify.png`" alt="Notify" width="35" height="35" />
                    <span>3</span>
                </div>
                <div class="user-profile">
                    <img :src="base_url + `/images/user_profile.png`" alt="Avarta" width="35" height="35" />
                    <div class="text-group">
                        <h2>ดารินทร์ เครือวัลย์</h2>
                        <span>Admin</span>
                    </div>
                    <v-icon class="icon-dropdown" large color="blue-grey darken-2">
                        mdi-chevron-down
                    </v-icon>
                </div>
            </div>
        </div>
        <div class="container-menu">
            <div class="menu">
                <ul>
                    <li>
                        <img :src="base_url + `/images/icon/dashboard.png`" alt="Dashboard">
                        <span>Dashboard</span>
                    </li>
                    <li @click="linkPage('/managerequest')">
                        <img :src="base_url + `/images/icon/manage_requests.png`" alt="จัดการคำร้อง">
                        <span>จัดการคำร้อง</span>
                    </li>
                    <!-- <li @click="linkPage('/managepanelrental')">
                        <img :src="base_url + `/images/icon/mamage_rent.png`" alt="จัดการค่าเช่า">
                        <span>จัดการค่าเช่า</span>
                    </li> -->
                    <li>
                        <img :src="base_url + `/images/icon/mamage_rent.png`" alt="จัดการการเช่า">
                        <span>จัดการการเช่า</span>

                        <v-icon class="icon-dropdown" large color="blue-grey darken-2">
                            mdi-chevron-down
                        </v-icon>

                        <div class="menu-dropdown">
                            <ul>
                                <li @click="linkPage('/managepanelrental')">
                                    <img :src="base_url + `/images/icon/6a82b4be82d4395e9530cb44c9246a81.png`" alt="">
                                    <span>ทำสัญญาเช่าแผง</span>
                                </li>
                                <li @click="linkPage('/managebill')">
                                    <img :src="base_url + `/images/icon/36b31a1e0a822f39b9e0ddfb055955e1.png`" alt="">
                                    <span>จัดการใบเสร็จอื่น ๆ</span>
                                </li>
                                <li @click="linkPage('/managemeterwater')">
                                    <img :src="base_url + `/images/icon/1e2f5789e238dd51ba38a88ecd33fdae.png`" alt="">
                                    <span>จัดการมิเตอร์น้ำ</span>
                                </li>
                                <li @click="linkPage('/managemeterwater/billcycle')">
                                    <img :src="base_url + `/images/icon/75d3e2766febd19175971a415c9431e4.png`" alt="">
                                    <span>รอบบิลค่าน้ำ</span>
                                </li>
                                <li @click="linkPage('/managemeterelectricity')">
                                    <img :src="base_url + `/images/icon/2e66249f6f6c3c177a2ade9fb4390da2.png`" alt="">
                                    <span>จัดการมิเตอร์ไฟ</span>
                                </li>
                                <li @click="linkPage('/managemeterelectricity/billcycle')">
                                    <img :src="base_url + `/images/icon/75d3e2766febd19175971a415c9431e4.png`" alt="">
                                    <span>รอบบิลค่าไฟ</span>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li @click="linkPage('/managerenter')">
                        <img :src="base_url + `/images/icon/tenant_member.png`" alt="สมาชิกผู้เช่า">
                        <span>สมาชิกผู้เช่า</span>
                    </li>
                    <li @click="linkPage('/manageuser')">
                        <img :src="base_url + `/images/icon/manage_users.png`" alt="จัดการผู้ใช้งาน">
                        <span>จัดการผู้ใช้งาน</span>
                    </li>
                    <li>
                        <img :src="base_url + `/images/icon/manage_market.png`" alt="จัดการตลาด">
                        <span>จัดการตลาด</span>

                        <v-icon class="icon-dropdown" large color="blue-grey darken-2">
                            mdi-chevron-down
                        </v-icon>

                        <div class="menu-dropdown">
                            <ul>
                                <li @click="linkPage('/managermarketpanels')">
                                    <img :src="base_url + `/images/icon/manage_market_panels.png`" alt="">
                                    <span>ตั้งค่าแผงตลาด</span>
                                </li>
                                <li @click="linkPage('/managerentalcontract')">
                                    <img :src="base_url + `/images/icon/manage_space_rental_contracts.png`" alt="">
                                    <span>ตั้งค่าสัญญาเช่าพื้นที่</span>
                                </li>
                                <li @click="linkPage('/managestall')">
                                    <img :src="base_url + `/images/icon/161803f0dcbabddd8bb04ae829804644.png`" alt="">
                                    <span>ตั้งค่าค่าเช่าแผง</span>
                                </li>
                                <li @click="linkPage('/managetransfers')">
                                    <img :src="base_url + `/images/icon/05cf78d5940bea68adb085a221d3e0ad.png`" alt="">
                                    <span>ตั้งค่าช่องทางรับเงินโอน</span>
                                </li>
                                <li>
                                    <img :src="base_url + `/images/icon/c78e36c1859950397671ae73b3983f76.png`" alt="">
                                    <span>ตั้งค่าการเช่า</span>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <img :src="base_url + `/images/icon/setting.png`" alt="">
                        <span>จัดการเว็บไซต์ประชาสัมพันธ์</span>

                        <v-icon class="icon-dropdown" large color="blue-grey darken-2">
                            mdi-chevron-down
                        </v-icon>

                        <div class="menu-dropdown">
                            <ul>
                                <li @click="linkPage('/seo')" >
                                    <img :src="base_url + `/images/icon/manage_seo.png`" alt="">
                                    <span>จัดการ SEO</span>
                                </li>
                                <li @click="linkPage('/slide')">
                                    <img :src="base_url + `/images/icon/manage_slide_cover_images.png`" alt="">
                                    <span>จัดการภาพปกสไลด์</span>
                                </li>
                                <li @click="linkPage('/managecontent')">
                                    <img :src="base_url + `/images/icon/manage_articles.png`" alt="">
                                    <span>จัดการข่าวสารและกิจกรรม</span>
                                </li>
                                <li @click="linkPage('/managecontact')">
                                    <img :src="base_url + `/images/icon/contact.png`" alt="">
                                    <span>จัดการตลาด</span>
                                </li>
                                <li @click="linkPage('/managerecommended')">
                                    <img :src="base_url + `/images/icon/contact.png`" alt="">
                                    <span>จัดการร้านค้าแนะนำ/ร้านดังประจำตลาด</span>
                                </li>
                                <li @click="linkPage('/managereviewmarket')">
                                    <img :src="base_url + `/images/icon/review.png`" alt="">
                                    <span>จัดการรีวิว</span>
                                </li>
                                <li @click="linkPage('/managegallery')">
                                    <img :src="base_url + `/images/icon/imagegallery.png`" alt="">
                                    <span>จัดการภาพแกลลอรี่</span>
                                </li>
                                <li @click="linkPage('/manageaward')">
                                    <img :src="base_url + `/images/icon/awardsstandards.png`" alt="">
                                    <span>จัดการรางวัลและมาตรฐาน</span>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import AOS from 'aos'
import 'aos/dist/aos.css'
export default {
    data() {
        return {
            loading_page: false,
            email: null,
            password: null,
            show_password: false,
            show3: false,
            rulesEmail: {
                required: value => !!value || 'กรุณากรอกอีเมล',
                email: value => {
                    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    return pattern.test(value) || 'กรุณากรอกอีเมลให้ถูกต้อง'
                },
            },
            rules: {
                required: value => !!value || 'กรุณากรอกรหัสผ่าน',
            },
        }
    },
    methods: {

    },
    created() {
    },
    mounted() {
        AOS.init()
    }
}
</script>

<style scoped lang="scss">

.hearder {
    .navbar {
        display: flex;
        align-items: center;
        margin: 0;
        padding: 0;
        padding: 0 40px;
        height: 65px;
        width: 100%;
        background: #FFF;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);

        .logo {
            border-radius: 50%;
            border: 1px solid #F9F9F9;

            img {
                margin-right: 18px;
            }

            span {
                color: #2A4858;
                font-family: 'Kanit', sans-serif;
                font-size: 16px;
                font-style: normal;
                font-weight: 700;
                line-height: normal;
            }
        }

        .navbar-right {
            display: flex;
            align-items: center;

            .notify {
                position: relative;
                margin-right: 20px;

                span {
                    position: absolute;
                    top: 0;
                    right: 0;
                    color: #fff;
                    width: 22px;
                    height: 22px;
                    background-color: #E60023;
                    border-radius: 50%;

                    color: #FFF;
                    text-align: center;
                    font-family: 'Sarabun', sans-serif;
                    font-size: 14px;
                    font-style: normal;
                    font-weight: 600;
                    line-height: normal;
                }
            }

            .user-profile {
                display: flex;
                align-items: center;

                img {
                    margin-right: 20px;
                }

                .text-group {
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    margin-right: 20px;

                    h2 {
                        color: #707070;
                        font-family: 'Kanit', sans-serif;
                        font-size: 16px;
                        font-style: normal;
                        font-weight: 500;
                        line-height: normal;
                        margin: 0;
                        padding: 0;
                    }

                    span {
                        color: #B7B7B7;
                        font-family: 'Kanit', sans-serif;
                        font-size: 14px;
                        font-style: normal;
                        font-weight: 500;
                        line-height: normal;
                    }
                }

                .icon-dropdown {
                    width: 15px;
                    height: 15px;
                }

            }
        }
    }

    .container-menu {
        padding: 0 40px;
        margin-top: 13px;

        .menu {
            background: #FFF;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
            padding: 16px 9px;

            ul {
                display: flex;
                gap: 16px;
                align-items: center;
                margin: 0;

                li {
                    position: relative;
                    list-style: outside none none;
                    cursor: pointer;
                    padding: 12px 16px;
                    font-family: 'Kanit', sans-serif;
                    color: #707070;
                    font-size: 16px;
                    font-style: normal;
                    font-weight: 500;
                    line-height: normal;

                    &:hover {
                        border-radius: 5px;
                        background: linear-gradient(90deg, #86D780 0%, #60A577 100%);
                        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);

                        color: #F9F9F9;
                        font-size: 16px;
                        font-style: normal;
                        font-weight: 500;
                        line-height: normal;

                        img {
                            filter: grayscale(100%);
                        }

                        .menu-dropdown {
                            display: block;

                        }
                    }

                    img {
                        width: 20px;
                        height: 20px;
                        margin-right: 2px;
                    }

                    .icon-dropdown {
                        width: 10px;
                        height: 10px;
                        font-size: 16px !important;
                    }

                    .menu-dropdown {
                        position: absolute;
                        display: none;
                        padding-top: 5px;
                        top: 48px;
                        left: 0px;
                        width: 330px;
                        z-index: 1;

                        ul {
                            width: 100%;
                            display: flex;
                            flex-direction: column;
                            border: 1px solid #FAFAFA;
                            background: #FFF;
                            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);

                            margin: 0;
                            padding: 0;

                            li {
                                width: 100%;
                            }
                        }
                    }
                }
            }
        }
    }
}
</style>
