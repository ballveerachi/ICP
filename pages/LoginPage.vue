<template>
  <div class="vue-tempalte">
    <form>
      <h3>Login/เข้าสู่ระบบ</h3>
      <div class="form-group">
        <input
          type="text"
          name="username"
          v-model="input.username"
          placeholder="E-mail/ชื่อผู้ใช้"
          class="form-control form-control-lg"
        />
      </div>
      <div class="form-group">
        <input
          type="password"
          name="password"
          v-model="input.password"
          placeholder="Password/รหัสผ่าน"
          class="form-control form-control-lg"
        />
      </div>
      <div>
        <v-btn
              class="buttonForm"
              depressed
              type="button"
              color="#343a40"
              @click="login()"
              >Login/เข้าสู่ระบบ </v-btn
            >
            <v-btn
              class="buttonForm"
              depressed
              type="button"
              color="#DCDCDC"
              @click="cancle()"
              >Cancel/ยกเลิก</v-btn
            >
      </div>
      username:{{input.username}}
      password:{{input.password}}
    </form>
  </div>
  <!-- <div>member: {{ member }}</div> -->
</template>

<script>
import axios from "axios";

export default {
  name: "LoginPage",
  data() {
    return {
      input: {
        username: "",
        password: "",
      },
      member: {
        member_id: 0,
        full_name: "",
        status: "",
      },
    };
  },
  methods: {
    login() {
      if (this.input.username != "" && this.input.password != "") {
        this.checkMember();
      } else {
        console.log("A username and password must be present");
      }
    },
    cancle(){
      this.$router.replace({ name: "index" });
      console.log(" ยกเลิก ");
    },
    checkMember() {
      console.log(" ตรวจสอบข้อมูลสมาชิก ");
      var self = this;
      axios
        .post("https://icp2022.net/ICPScoreCard/api-member.php", {
          action: "checkMember",
          user: this.input.username,
          pass: this.input.password,
        })
        .then(function (res) {
          console.log("data:",res.data);
          if(res.data.length > 0){
            var member_id = res.data.map((item) => item.member_id)[0];
            var full_name = res.data.map((item) => item.full_name)[0];
            var status = res.data.map((item) => item.status)[0];
            self.storeCommit(member_id,full_name, status);
          }else{
            console.log("The username and / or password is incorrect");
            self.$q
              .dialog({
                title: "คำเตือน",
                message:
                  "ชื่อผู้ใช้/รหัสผ่านไม่ถูกต้อง หรืออีเมลย์ยังไม่ได้รับการยืนยัน",
                persistent: true,
              })
              .onOk(() => {
                self.input.username = "";
                self.input.password = "";
              });


          }

        })
        .catch(function (error) {
          console.log(error);
        });
    },
    storeCommit(member_id, full_name, status) {
      console.log("login:", member_id);
      console.log("login:", full_name);
      console.log("login:", status);
      if (member_id != 0 && full_name != "" && status != "") {
        this.$store.commit("setMyAuthenticate", true);
        this.$store.commit("setMyMember_id", member_id);
        this.$store.commit("setMyName", full_name);
        this.$store.commit("setMyStatus", status);
        this.$router.replace({ name: "index" });
      } else {
        console.log("11111111");
      }
    },
  },
  created() {
    // this.getAllUser();
  },
};
</script>

<style scoped>
h3 {
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
