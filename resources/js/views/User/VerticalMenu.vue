<template>
  <div>
    <div class="nav-header">
      <v-container>
        <div class="top-menu">
          <div class="top-menu-text text-white">
            <v-icon class="mr-1" small dark>mdi-phone</v-icon> 096 663 8643
          </div>
          <div class="top-menu-text text-white">
            <v-icon class="mr-1" small dark>mdi-book-open-page-variant-outline</v-icon>
            เปิดให้บริการปกติ
          </div>
        </div>
      </v-container>
      <div class="nav-header-menu">
        <v-container>
          <div class="sub-menu">
            <v-row>
              <v-col cols="12" xs="12" sm="12" md="2" lg="2" xl="2">
                <div class="">
                  <v-img class="logo-web" :src="base_url + `/images/logo-web.png`"></v-img>
                </div>
              </v-col>
              <v-col cols="12" xs="12" sm="12" md="8" lg="8" xl="8"
                class="d-flex align-items-center justify-content-center">
                <div class="">
                  <v-btn class="font-20 slideleft sub-menu-text" @click="link('/')"
                    :class="{ active: $route.path == '/' }" text dark>
                    <div class="d-flex align-items-center">
                      <v-icon class="mr-2">mdi-home</v-icon> หน้าหลัก
                    </div>
                  </v-btn>
                  <v-btn class="font-20 slideleft sub-menu-text" @click="link('/card-online')"
                    :class="{ active: $route.path == '/card-online' }" text dark>
                    <div class="d-flex align-items-center">
                      <v-icon class="mr-2">mdi-plus-box-multiple</v-icon>
                      บัตรเติมเงิน
                    </div>
                  </v-btn>
                  <v-btn class="font-20 slideleft sub-menu-text" @click="link('/termgame')"
                    :class="{ active: $route.path == '/termgame' }" text dark>
                    <div class="d-flex align-items-center">
                      <v-icon class="mr-2">mdi-diamond-stone</v-icon>
                      เติมเกมมือถือ
                    </div>
                  </v-btn>
                  <v-btn class="font-20 slideleft sub-menu-text" @click="link('/history_internet_banking_page')" text
                    dark>
                    <div class="d-flex align-items-center">
                      <v-icon class="mr-2">mdi-currency-usd</v-icon> เติมเครดิต
                    </div>
                  </v-btn>
                  <v-btn class="font-20 slideleft sub-menu-text" text dark @click="link('/history_trueWallet_page')">
                    <div class="d-flex align-items-center">
                      <v-icon class="mr-2">mdi-phone-message-outline</v-icon>
                      ติดต่อเรา
                    </div>
                  </v-btn>
                </div>
              </v-col>
              <v-col cols="12" xs="12" sm="12" md="2" lg="2" xl="2" class="d-flex align-items-center">
                <div>
                  <v-btn class="font-16 sub-menu-button-login" block dark>
                    <v-icon left dark>mdi-login</v-icon>เข้าสู่ระบบ หรือ
                    สมัครสมาชิก
                  </v-btn>
                </div>
              </v-col>
            </v-row>
          </div>
        </v-container>
      </div>
    </div>
  </div>
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
  methods: {
    link(route) {
      this.$router.push(route);
    },
  },
  created() { },
  mounted() { },
};
</script>

<style scoped>
.nav-header {
  background: transparent linear-gradient(0deg, #6e1f1c 80%, #f01705 100%) 100% 100% no-repeat padding-box !important;
  z-index: 9;
  width: 100%;
  opacity: 100%;
}

.top-menu {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 3px;
}

.top-menu-text {
  display: flex;
  align-items: center;
}

.nav-header-menu {
  background: #090c0f 0% 0% no-repeat padding-box;
  border: 1px solid #090c0f;
  opacity: 1;
  padding: 9px 0 9px 0;
}

.sub-menu {
  display: flex;
  align-items: center;
}

.header-logo {
  display: inline-block;
}

.logo-web {
  width: 230px;
}

.sub-menu-text {
  color: #c4c4c4;
  border-radius: 0;
  padding: 0 !important;
  margin: 0 25px;
  letter-spacing: 0px;
  opacity: 1;
}

.sub-menu-text.active {
  color: #dfa50e;
  background-color: transparent !important;
  border-bottom: 2px #dfa50e solid !important;
}

.sub-menu-text:hover {
  color: #dfa50e;
  border-bottom: 2px #dfa50e solid !important;
}

.sub-menu-text::before {
  background-color: #000000 !important;
}

.sub-menu-button-login {
  background-color: #dfa50e !important;
  border-radius: 10px;
  padding: 20px !important;
  color: #ffffff;
  letter-spacing: 0px;
  opacity: 1;
}
</style>
