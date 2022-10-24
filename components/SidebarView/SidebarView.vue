<script>
import { collapsed, toggleSidebar, sidebarWidth } from "./state";

export default {
  props: {},
  components: {  },
  setup() {
    return { collapsed, toggleSidebar, sidebarWidth };
  },
};
</script>

<template>
  <div class="sidebar" :style="{ width: sidebarWidth }">
    <h1>
      <span v-if="collapsed">
        <div STYLE="font-size:30.0pt">I</div>
        <div STYLE="font-size:30.0pt">S</div>
      </span>
      <span STYLE="font-size:40.0pt" v-else>IScard </span>
    </h1>
    <label for="myName">{{ $store.getters.myName }}</label>
    <nuxt-link to="/" icon="fas fa-home">Home</nuxt-link>
    <nuxt-link to="/FormComponent" icon="fas fa-address-book">
      ข้อมูลส่วนตัว
    </nuxt-link>
    <nuxt-link to="/FormPlanCareer" icon="fas fa-person-arrow-up-from-line">
      อาชีพเป้าหมาย
    </nuxt-link>
    <nuxt-link to="/FormQualification" icon="fas fa-address-card">
      คุณสมบัติ/ทักษะ
    </nuxt-link>
    <nuxt-link to="/FormPlan" icon="fas fa-user-graduate">แผนเรียน/ทำ</nuxt-link>
    <nuxt-link to="/FormSelfAssessment" icon="fas fa-wheelchair-move">
      ประเมินตนเอง
    </nuxt-link>
    <!-- <SidebarLink to="/DashboardPage" icon="fas fa-chart-bar"
      >Dashboard</SidebarLink
    >
    <SidebarLink to="/FormDashborad" icon="fas fa-chart-column"
      >Dashborad</SidebarLink
    > -->
    <nuxt-link to="/FormPivotTable" icon="fas fa-chart-pie"
      >กราฟ</nuxt-link
    >
    <!-- <SidebarLink to="/PersonData" icon="fas fa-image">Person</SidebarLink>
    <SidebarLink to="/PlanCareerData" icon="fas fa-image">
      Plan Career Data
    </SidebarLink> -->
    <span
      class="collapse-icon"
      :class="{ 'rotate-180': collapsed }"
      @click="toggleSidebar"
    >
      <i class="fas fa-angle-double-left" />
    </span>
  </div>
</template>

<style>
:root {
  --sidebar-bg-color: #2f855a;
  --sidebar-item-hover: #38a169;
  --sidebar-item-active: #276749;
}
</style>

<style scoped>
.sidebar {
  color: white;
  background-color: var(--sidebar-bg-color);

  float: left;
  position: fixed;
  z-index: 1;
  top:0;
  left: 0;
  bottom: 0;
  padding: 0.5em;

  transition: 0.3s ease;

  display: flex;
  flex-direction: column;
}

.sidebar h1 {
  height: 2.0em;
}

.collapse-icon {
  position: absolute;
  bottom: 0;
  padding: 0.75em;

  color: rgba(255, 255, 255, 0.7);

  transition: 0.2s linear;
}

.rotate-180 {
  transform: rotate(180deg);
  transition: 0.2s linear;
}
</style>
