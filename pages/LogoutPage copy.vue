<template>
  <div class="vue-tempalte">
    <v-form>
      <h3>Logout/ออกจากระบบ</h3>
      <h5>คุณต้องการออกจากระบบใช่ไหม?</h5>
      <button
        type="button"
        class="btn btn-success btn-lg btn-block"
        @click="confirm()"
      >
        Logout/ออกจากระบบ
      </button>
  
      <button
        type="button"
        class="btn btn-dark btn-lg btn-block"
        @click="cancel()"
      >
        Cancel/ยกเลิก
      </button>
    </v-form>
  </div>
</template>

<script>
export default {
  data() {
    return {}
  },
  methods: {
    confirm() {
      this.$store.commit('setMyAuthenticate', false)
      this.$store.commit('setMyMember_id', 0)
      this.$store.commit('setMyName', '')
      this.$store.commit('setMyStatus', '')
      this.$router.replace({ name: 'index' })
      console.log('confirm')
    },
    cancel() {
      this.$router.replace({ name: 'index' })
      console.log('cancel')
    },
  },
}
</script>
<style scoped>
h3,
h5 {
  color: #2f855a;
  text-align: center;
}
select {
  color: #2f855a;
}
form {
  margin: 2rem auto;
  max-width: 100%;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
  padding: 2rem;
  color: white;
  text-align: left;
}
label {
  color: #2f855a;
  font-weight: bold;
}
input,
select {
  display: block;
  width: 100%;
  font: inherit;
  margin-top: 0.5rem;
}
button {
  font: inherit;
  cursor: pointer;
  padding: 0.05rem 1rem;
  border-radius: 15px;
}
</style>