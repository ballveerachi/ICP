<template>
  <div>
    <v-app dark>
      <v-navigation-drawer
        v-model="drawer"
        :mini-variant="miniVariant"
        :clipped="clipped"
        fixed
        app
      >
        <v-list>
          <v-list-item
            v-for="(item, i) in items"
            :key="i"
            :to="item.to"
            router
            exact
          >
            <v-list-item-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-action>
            <!-- List sideBar -->
            <v-list-item-content>
              <v-list-item-title v-text="item.title" />
            </v-list-item-content>
            <!-- List sideBar -->
          </v-list-item>
        </v-list>
      </v-navigation-drawer>
      <v-app-bar :clipped-left="clipped" fixed app>
        <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
        <v-spacer />
        <v-btn  v-if="!$store.getters.myAuthenticate" nuxt-link to="/LoginPage" text color="#FFFFFF"> Sign In </v-btn>
        <v-btn  v-if="$store.getters.myAuthenticate" nuxt-link to="/LogoutPage" text color="#FFFFFF"> Sign Out </v-btn>
        /
        <v-btn nuxt-link to="/RegistrationPage" class="ma-2" outlined color="#FFFFFF"> Sign Up </v-btn>
      </v-app-bar>
      <v-main>
        <v-container>
          <Nuxt />
        </v-container>
      </v-main>
      <v-footer :absolute="!fixed" app>
        <span>&copy; {{ new Date().getFullYear() }}</span>
      </v-footer>
    </v-app>
  </div>
</template>

<script>
export default {
  name: "DefaultLayout",
  data() {
    return {
      clipped: false,
      drawer: false,
      fixed: false,
      items: [
        {
          icon: "mdi-home",
          title: "Home",
          to: "/",
        },
        {
          icon: "mdi-account-box",
          title: "ข้อมูลส่วนตัว",
          to: "/FormComponent",
        },
        {
          icon: "mdi-account-check",
          title: "อาชีพเป้าหมาย",
          to: "/FormPlanCareer",
        },
        {
          icon: "mdi-account-key",
          title: "คุณสมบัติ/ทักษะ",
          to: "/FormQualification",
        },
        {
          icon: "mdi-run-fast",
          title: "แผนเรียน/ทำ",
          to: "/FormPlan",
        },
        {
          icon: "mdi-account-search",
          title: "ประเมินตนเอง",
          to: "/FormSelfAssessment",
        },
        {
          icon: "mdi-chart-bar",
          title: "กราฟ",
          to: "/FormPivotTable",
        },
      ],
      miniVariant: false,
      right: true,
      rightDrawer: false,
    };
  },
};
</script>
<style scoped>
</style>
