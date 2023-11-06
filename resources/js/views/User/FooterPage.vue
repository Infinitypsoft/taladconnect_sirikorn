<template>

    <v-footer dark>

      <v-container>
        <v-row class="mt-5">
          <v-col cols="4 pl-5 pr-15">
            <div class="mb-4">
                <v-img
                    class="logo-web"
                    width="200"
                    :src="base_url + `/images/logo-web.png`"
                ></v-img>
            </div>
            <h2 class="bold">ร้าน ZGOLDTH</h2>
            <p>เป็นเพียงตัวแทนจำหน่ายเท่านั้น ไม่มีส่วนเกี่ยวข้อง กับองค์กรหรือบุคคลใด ๆ ที่แอบอ้างใช้ชื่อบัญชีธนาคาร ร้าน ZGOLDTH เครดิตในเว็บไซต์ใช้สำหรับซื้อสินค้า ภายในเว็บไซต์ Zgoldth.com เท่านั้น โปรดระวังมิจฉาชีพ แอบอ้างบัญชีเราเพื่อหลอกให้ผู้อื่น จ่ายค่าสินค้าแทน</p>
          </v-col>
          <v-col cols="4 px-10">
            <div class="d-flex ">
                <div>
                    <h4 class="bold">บริการของเรา</h4>
                    <p class="mt-4">บัตรเติมเงิน</p>
                    <p>เติมเกมมือถือ</p>
                </div>
                <div class="ml-20">
                    <h4 class="bold">ติดต่อเรา</h4>
                    <p class="mt-4"> <v-icon>mdi mdi-phone</v-icon> 096 663 8643</p>
                    <p class="d-flex"><v-img :src="base_url + `/public/mock/line.png`" max-width="20" class="mr-2"></v-img> ID : @Zgoldth</p>
                </div>
            </div>
            <div class="d-flex mt-5">
                <div>
                    <h4 class="bold">เงื่อนไข ข้อตกลงและนโยบายความเป็นส่วนตัว</h4>
                    <p class="mt-4">เงื่อนไข & ข้อตกลง</p>
                    <p>นโยบายความเป็นส่วนตัว</p>
                </div>
            </div>
          </v-col>
          <v-col cols="4 px-10">
            <div>
                <h4 class="bold">ติดตามข่าวสาร</h4>
                <img :src="base_url + '/public/mock/facebook_page.png'" alt="" max-width="300" width="399">
            </div>

            <div class="mt-10">
                <h4 class="bold">Follow Us On Social</h4>
            </div>
          </v-col>
        </v-row>
      </v-container>

      <!-- <v-container>
        <div class="top-menu">
          <div class="top-menu-text text-white"><v-icon class="mr-1" small dark>mdi-phone</v-icon> 096 663 8643</div>
          <div class="top-menu-text text-white"><v-icon class="mr-1" small
              dark>mdi-book-open-page-variant-outline</v-icon> เปิดให้บริการปกติ</div>
        </div>
      </v-container> -->

    </v-footer>

</template>

<script>
export default {
  data() {
    return {
      loading_page: false,
      dialog_forgot: false,
      links: ["Dashboard", "Messages", "Profile", "Updates"],
    };
  },
  methods: {},
  created() {},
  mounted() {},
};
</script>

<style scoped>
</style>
