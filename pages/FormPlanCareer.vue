<template>
  <div>
  <h3>แผนอาชีพ</h3>
  <form @submit.prevent="submitForm" @reset.prevent="resetForm" method="post">
    <div class="row">
      <div class="col-md-6 col-xs-12">
        <label for="plan-Career-id">PlanCareer-ID/รหัสอาชีพ:</label>
        <input
          type="text"
          name="plan-Career-id"
          v-model="planCareer.Plan_Career_id"
          placeholder="PC-ID/รหัสอาชีพ"
          required  disabled
          class="form-control form-control-lg"
        />
      </div>
      <div class="col-md-6 col-xs-12">
        <label for="Employee-id">Employee-ID/รหัสสมาชิก:</label>
        <input
          type="text"
          name="Employee-id"
          v-model="planCareer.Employee_id"
          placeholder="EP-ID/รหัส"
          required  disabled
          class="form-control form-control-lg"
        />
      </div>
    </div>
    <!-- :value="career.career_id" -->
    <div class="row">
      <div class="col-md-6 col-xs-12">
        <label for="PlanCareer-name">Plan Career/แผนอาชีพ:</label>
        <input
          type="text"
          name="Plan-Career-name"
          v-model="planCareer.career_id"
          placeholder="Plan Career/แผนอาชีพ"
          class="form-control1 form-control-lg"
        />
        <select class="form-control1"
        :size="4"
        v-model="planCareer.career_id">
          <option value="" disabled selected>อาชีพที่ต้องการ:</option>
          <option
            v-for="career in careers"
            :value="career.career_id"
            :key="career.index"
          >
            {{ career.career_id }} {{ career.career }}
          </option>
        </select>
      </div>
    </div>
    <div class="topbutton">
            <v-btn
              class="buttonForm"
              depressed
              type="submit"
              color="#28a745"
              value="Save/บันทึก"
              >{{status}}</v-btn
            >
            <v-btn
              class="buttonForm"
              depressed
              type="reset"
              color="#dc3545"
              value="Cancel/ยกเลิก"
              >Cancel/ยกเลิก</v-btn
            >
    </div>
  </form>
  <!-- <div class="py-2">
    {{ planCareers_ }}
  </div>
  <div class="py-2">
    {{ planCareer }}
  </div> -->
  <div class="py-2">
    <table class="table">
      <thead>
        <!-- แก้ไข วัน31/01/66  -->
        <tr>
          <th scope="col">PlanCareer-ID</th>
          <th scope="col">Employee-ID</th>
          <th scope="col">Career ID</th>
          <th scope="col">Career</th>
          <th scope="col">Name</th>
          <th scope="col">University</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="row in planCareers" :key="row.index">
          <td>{{ row.Plan_Career_id }}</td>
          <td>{{ row.Employee_id }}</td>
          <td>{{ row.career_id }}</td>
          <td>{{ row.career }}</td>
          <td>{{ row.name }}</td>
          <td>{{ row.university }}</td>

             <td>
                <v-btn depressed color="#3366FF" @click="editUser(row.Plan_Career_id)">Edit</v-btn>
              </td>
              <td>
                <v-btn depressed color="#FF3333" @click="deleteUser(row.Plan_Career_id)">Delete</v-btn>
              </td>

        </tr>
        <tr></tr>
      </tbody>
    </table>
  </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "FormPlanCareer",
  data() {
    return {
      message: "Form Plan Career",
      planCareers: Array,
      planCareers_: Array,
      careers: Array,
      //Plan_Career_id	Employee_id	Name_Plan_Career Description
      planCareer: {
        Plan_Career_id: "",
        Employee_id:this.$store.getters.myMember_id,
        career_id: "",
        career:"",

      },
      isEdit: false,
      status: "Save/บันทึก",
    };
  },
  methods: {
    //แก้ไขให้มันเป็นช่องว้่าง
    resetForm() {
      this.status = "Save/บันทึก";
      this.isEdit = false;
      console.log("ยกเลิก");
      this.planCareer.Plan_Career_id = "";
      this.planCareer.career_id = "";
    },
    getAllUser() {
      console.log(" แสดงข้อมูลทั้งหมด ");
      var self = this;
      axios
        .post("https://icp2022.net/ICPScoreCard/api-plan-career.php", {
          action: "getall",
        })
        .then(function (res) {
          console.log("ข้อมูลแผนอาชีพ:",res.data);
          self.planCareers = res.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getCareer() {
      console.log(" แสดงข้อมูลทั้งหมด ");
      var self = this;
      axios
        .post("https://icp2022.net/ICPScoreCard/api-career.php", {
          action: "getall",
        })
        .then(function (res) {
          self.careers = res.data;
          console.log("careers :",self.careers);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    submitForm() {
      if (!this.isEdit) {
        console.log("Employee_id", this.planCareer.Employee_id);
        console.log("career_id", this.planCareer.career_id);
        const newPlanCareer = {
          Employee_id: this.planCareer.Employee_id,
          career_id: this.planCareer.career_id,

        };
        this.$emit("saveData", newPlanCareer);

        axios
          .post("https://icp2022.net/ICPScoreCard/api-plan-career.php", {
            action: "insert",
            Employee_id: this.planCareer.Employee_id,
            career_id: this.planCareer.career_id,
          })
          .then((res) => {
            console.log(res);
            this.resetForm();
            this.getAllUser();
          })
          .catch(function (error) {
            console.log(error);
          });
      } else {
        axios
          .post("https://icp2022.net/ICPScoreCard/api-plan-career.php", {
            action: "update",
            Plan_Career_id: this.planCareer.Plan_Career_id,
            Employee_id: this.planCareer.Employee_id,
            career_id: this.planCareer.career_id,


          })
          .then((response) => {
            console.log(response);
            this.resetForm();
            this.getAllUser();
          })
          .catch(function (error) {
            console.log(error);
          });
      }
    },
    editUser(Plan_Career_id) {
      this.status = "Update(อัพเดท)";
      this.isEdit = true;
      var self = this;
      console.log("Plan_Career_id:",Plan_Career_id);
      axios
        .post("https://icp2022.net/ICPScoreCard/api-plan-career.php", {
          action: "edit",
          Plan_Career_id: Plan_Career_id,
        })
        .then(function (response) {
          self.planCareer.Plan_Career_id = response.data.Plan_Career_id;
          self.planCareer.Employee_id = response.data.Employee_id;
          self.planCareer.career_id = response.data.career_id;
          self.planCareer.career = response.data.career;
          self.planCareers_ = response.data;
          console.log("แก้ไขแผนอาชีพ:",response.data);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    deleteUser(Plan_Career_id) {
      if (confirm("คุณต้องการลบรหัส " + Plan_Career_id + " หรือไม่ ?")) {
        var self = this;
        axios
          .post("https://icp2022.net/ICPScoreCard/api-plan-career.php", {
            action: "delete",
            Plan_Career_id: Plan_Career_id,
          })
          .then(function (response) {
            console.log(response);
            self.resetForm();
            self.getAllUser();
          })
          .catch(function (error) {
            console.log(error);
          });
      }
    },
  },
  created() {
    this.getAllUser();
    this.getCareer();
  },
};
</script>

<style scoped>
h3 {
  color: #2f855a;
}
select {
  color: #2f855a;
}
form {
  margin: 2rem auto;
  max-width: 100%;
  /* border-radius: 12px; */
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
  padding: 2rem;
  color: white;
  /* background: rgb(4, 131, 242); */
  text-align: left;
}
/* .form-control {
  margin: 0.5rem 0;
} */
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
  border: 1px solid #ced4da;
}
button {
  font: inherit;
  cursor: pointer;
  /* background: gray;
  color: white; */
  padding: 0.05rem 1rem;
  border-radius: 15px;
}
.form-control1{
  display: block;
    width: 200%;
    padding: 0.375rem 0.75rem;

}
/* input[type="radio"] {
  display: inline-block;
  width: auto;
  margin-right: 1rem;
}
input[type="radio"] + label {
  font-weight: normal;
} */
</style>
