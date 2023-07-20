<template>
  <div>
    <h3>แผนปฏิบัติ/เรียนรู้</h3>
  <form @submit.prevent="submitForm" @reset.prevent="resetForm" method="post">
    <div class="row">
      <div class="input-field col s4">
        <label for="plan-id">PlanLearning-ID/รหัสแผนเรียน/ทำ:</label>
        <!-- <input type="text" v-model="plan.planId" /> -->
        <input
          type="text"
          name="planId"
          v-model="plan.planId"
          placeholder="PL-ID/รหัสแผนเรียน/ทำ"
          required  disabled
          class="form-control form-control-lg"
        />
      </div>
    </div>
    <div class="row">
      <div class="input-field col s4">
        <label for="career_plan-id">Career-ID/รหัสแผนอาชีพ:</label>
        <!-- <input type="text" v-model="plan.planId" /> -->
        <input
          type="text"
          name="Career"
          v-model="plan.Plan_Career_id"
          placeholder="Career/อาชีพ"
          required  disabled
          class="form-control form-control-lg"
        />
        <select
          :size="4"
          v-model="plan.Plan_Career_id"
          :required="true"
          @change="getQualification()"
        >
          <option value="" disabled selected>อาชีพ:</option>
          <option
            v-for="career in careers"
            :value="career.Plan_Career_id "
            :key="career.index"
          >
            {{ career.Plan_Career_id }} {{ career.career }}
          </option>
        </select>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s4">
        <label for="qualification-id">Qualification-ID/รหัสคุณสมบัติ:</label>
        <!-- <input type="text" v-model="plan.qualificationId" /> -->
        <input
          type="text"
          name="qualification"
          v-model="plan.qa_plan_career_id"
          placeholder="Qualification/คุณสมบัติ"
          required  disabled
          class="form-control form-control-lg"
        />
        <select :size="4" v-model="plan.qa_plan_career_id">
          <option value="" disabled selected>กำหนดคุณสมบัติ:</option>
          <option
            v-for="career in career_qualifications"
            :value="career.qa_plan_career_id"
            :key="career.index"
          >
             {{ career.qa_plan_career_id }} {{ career.qualification_name }}
          </option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s4">
        <label for="leaning">Learning plan/แผนการเรียนรู้:</label>
        <!-- <input type="text" v-model="plan.leaning" /> -->
        <input
          type="text"
          name="leaning"
          v-model="plan.leaning"
          placeholder="Learnning plan/แผนการเรียนรู้"
          class="form-control form-control-lg"
        />
      </div>
    </div>
    <div class="row">
      <div class="input-field col s4">
        <label for="doing">Doing plan/แผนปฏิบัติการ:</label>
        <!-- <input type="text" v-model="plan.doing" /> -->
        <input
          type="text"
          name="doing"
          v-model="plan.doing"
          placeholder="Do/สิ่งที่ทำในแผนปฏิบัติการ"
          class="form-control form-control-lg"
        />
      </div>
    </div>
    <div class="row">
      <div class="input-field col s4">
        <label for="plan_start_date">Plan Start date/วันที่เริ่มแผน:</label>
        <!-- <input type="text" v-model="plan.doing" /> -->
        <input
          type="text"
          name="plan_start_date"
          v-model="plan.plan_start_date"
          placeholder="วันที่เริ่มแผน"
          class="form-control form-control-lg"
        />
      </div>
    </div>
    <div class="row">
      <div class="input-field col s4">
        <label for="plan_end_date">Plan End date /วันที่สิ้นสุดแผน:</label>
        <!-- <input type="text" v-model="plan.doing" /> -->
        <input
          type="text"
          name="plan_end_date"
          v-model="plan.plan_end_date"
          placeholder="วันที่สิ้นสุดแผน"
          class="form-control form-control-lg"
        />
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
    {{ plans_ }}
  </div>
  <div class="py-2">
    {{ plan }}
  </div> -->
  <!-- <div>employee_id: {{ employee_id }} careers: {{ careers }}</div>
  <div>career_qualifications: {{ career_qualifications }}</div> -->
  <div class="py-2">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">PlanLearning-ID</th>
          <th scope="col">QA-ID</th>
          <th scope="col">Lean</th>
          <th scope="col">Do</th>
          <th scope="col">PlanStartDate</th>
          <th scope="col">PlanEndDate</th>

        </tr>
      </thead>
      <tbody>
        <tr v-for="row in plans" :key="row.index">
          <td>{{ row.planId }}</td>
          <td>{{ row.qa_plan_career_id }}</td>
          <td>{{ row.leaning }}</td>
          <td>{{ row.doing }}</td>
          <td>{{ row.plan_start_date }}</td>
          <td>{{ row.plan_end_date }}</td>
          <td>
            <v-btn depressed color="#3366FF" @click="editUser(row.planId)">Edit</v-btn>
          </td>
          <td>
             <v-btn depressed color="#FF3333" @click="deleteUser(row.planId)">Delete</v-btn>
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
  name: "FormPlan",
  data() {
    return {
      message: "Form Plan Career",
      careers: Array,
      qa_plan_career:Array,
      career_qualifications: Array,
      plans: Array,
      plans_: Array,
      plan_qualification:Array,
      qualificationIds:Array,
      employee_id: this.$store.getters.myMember_id,
      planCareerId: "",

      // plan_career_id:"",
      // planId:	qualificationId	doing leaning
      plan: {
        planId: "",
        qualificationId: "",
        qa_plan_career_id:"",
        qualification_name:"",
        doing: "",
        leaning: "",
        plan_start_date:"",
        plan_end_date:"",
        planCareerId:"",
        Plan_Career_id:"",



      },
      isEdit: false,
      status: "Save/บันทึก",
    };
  },
  methods: {
    resetForm() {
      this.status = "บันทึก";
      this.isEdit = false;
      console.log("ยกเลิก");
      // this.plan.planId = 0;
      this.plan.qa_plan_career_id = "",
      this.plan.qualificationId = "";
      this.plan.doing = "";
      this.plan.leaning = "";
      this.plan.plan_start_date = "";
      this.plan.plan_end_date = "";
      this.plan.Plan_Career_id ="";


    },
    getAllUser() {
      console.log(" แสดงข้อมูลทั้งหมด ");
      var self = this;
      axios
        .post("https://icp2022.net/ICPScoreCard/api-plan.php", {
          action: "getall",
        })
        .then(function (res) {
          console.log(res);
          self.plans = res.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getCareer() {
      console.log(" ข้อมูลอาชีพ ");
      var self = this;
      axios
        .post("https://icp2022.net/ICPScoreCard/api-career-qualification.php", {
          action: "getEmpCareer",
          employee_id: this.employee_id,
        })
        .then(function (res) {
          self.careers = res.data;
          console.log("careers:", self.careers);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getQualification() {
      console.log("แผนอาชีพ",this.plan.Plan_Career_id);
      var self = this;
      axios
        .post("https://icp2022.net/ICPScoreCard/api-career-qualification.php", {
          action: "getCareer_Qualifiation",
          Plan_Career_id: this.plan.Plan_Career_id,
        })
        .then(function (res) {
          console.log("ข้อมูลคุณสมบัติ",res.data);
          self.career_qualifications = res.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    submitForm() {
      if (!this.isEdit) {
        console.log("บันทึก");
        console.log("Form Plan Career:", this.plan.qa_plan_career_id);
        const newPlan = {
          planId: this.plan.planId,
          qa_plan_career_id: this.plan.qa_plan_career_id,
          doing: this.plan.doing,
          leaning: this.plan.leaning,
          plan_start_date: this.plan.plan_start_date,
          plan_end_date: this.plan.plan_end_date

        };
        this.$emit("saveData", newPlan);

        axios
          .post("https://icp2022.net/ICPScoreCard/api-plan.php", {
            action: "insert",
            planId: this.plan.planId,
            qa_plan_career_id: this.plan.qa_plan_career_id,
            doing: this.plan.doing,
            leaning: this.plan.leaning,
            plan_start_date: this.plan.plan_start_date,
            plan_end_date: this.plan.plan_end_date
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
          .post("https://icp2022.net/ICPScoreCard/api-plan.php", {
            action: "update",
            planId: this.plan.planId,
            qa_plan_career_id: this.plan.qa_plan_career_id,
            doing: this.plan.doing,
            leaning: this.plan.leaning,
            plan_start_date: this.plan.plan_start_date,
            plan_end_date: this.plan.plan_end_date
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
    editUser(planId) {
      this.status = "Update/อัพเดท";
      this.isEdit = true;
      var self = this;
      axios
        .post("https://icp2022.net/ICPScoreCard/api-plan.php", {
          action: "edit",
          planId: planId,
        })
        .then(function (response) {
          console.log(response);
          self.plan.planId = response.data.planId;
          self.plan.Plan_Career_id = response.data.plan_career_id;
          self.getQualification();

          self.plan.qualification_name = response.data.qualification_name;
          self.plan.qa_plan_career_id = response.data.qa_plan_career_id;
          self.plan.doing = response.data.doing;
          self.plan.leaning = response.data.leaning;
          self.plan.plan_start_date = response.data.plan_start_date;
          self.plan.plan_end_date= response.data.plan_end_date;

          self.plans_ = response.data;
          console.log("แก้ไขคุณสมบัติ:",response.data);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    deleteUser(planId) {
      if (confirm("คุณต้องการลบรหัส " + planId + " หรือไม่ ?")) {
        var self = this;
        axios
          .post("https://icp2022.net/ICPScoreCard/api-plan.php", {
            action: "delete",
            planId: planId,
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
select {
  color: #2f855a;
}
h3 {
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
.form-control {
  margin: 0.5rem 0;
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

</style>
