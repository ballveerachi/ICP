<template>
  <div>
<h3>ประเมินตนเอง</h3>
  <form @submit.prevent="submitForm" @reset.prevent="resetForm" method="post">
    <div class="row">
      <div class="input-field col s4">
        <label for="self_assessment_id"> selfAssessment-ID/รหัสประเมินตนเอง: </label>
        <!-- <input type="text" v-model="selfAssessment.selfAssessmentId" /> -->
        <input
          type="text"
          name="self_assessment_id"
          v-model="selfAssessment.self_assessment_id"
          placeholder="SA-ID/รหัสประเมินตนเอง"
          required  disabled
          class="form-control form-control-lg"
        />
      </div>
    </div>
    <div class="row">
      <div class="input-field col s4">
        <label for="career_plan-id">Career-ID/รหัสอาชีพ:</label>
        <!-- <input type="text" v-model="selfAssessment.selfAssessmentId" /> -->
        <input
          type="text"
          name="planCareerId"
          v-model="selfAssessment.Plan_Career_id"
          placeholder="CA-ID/รหัสอาชีพ"
          required  disabled
          class="form-control form-control-lg"
        />
        <select
          :size="4"
          v-model="selfAssessment.Plan_Career_id"
          :required="true"
          @change="getQualification()"
        >
          <option value="" disabled selected>อาชีพที่ต้องการ:</option>
          <option
            v-for="career in careers"
            :value="career.Plan_Career_id"
            :key="career.index"
          >
            {{ career.Plan_Career_id }} {{ career.career }}
          </option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s4">
        <label for="quanlification-id">Qualification-ID/รหัสคุณสมบัติ:</label>
        <!-- <input type="text" v-model="selfAssessment.qualificationId" /> -->
        <input
          type="text"
          name="quanlification-id"
          v-model="selfAssessment.qa_plan_career_id"
          placeholder="Qualification/คุณสมบัติ"
          required  disabled
          class="form-control form-control-lg"
        />
        <select :size="4" v-model="selfAssessment.qa_plan_career_id">
          <option value="" disabled selected>คุณสมบัติตามแผนอาชีพ:</option>
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
        <label for="self_assessment_date">AssessmentDate/วันที่ประเมินตนเอง:</label>
        <!-- <input type="text" v-model=self_assessment_date	" /> -->
        <input
          type="text"
          name="AassessmentDate"
          v-model="selfAssessment.self_assessment_date	"
          placeholder="AssessmentDate/วันที่ประเมินตนเอง"
          class="form-control form-control-lg"
        />
      </div>
    </div>
    <div class="row">
      <div class="input-field col s4">
        <label for="level">SelfAssessment/ประเมินตนเอง:</label>
        <!-- <input type="text" v-model="qualification.qualification_name" /> -->
        <input
          type="text"
          name="perform"
          v-model="selfAssessment.perform_id"
          placeholder="ระดับการประเมินตนเอง"
          class="form-control form-control-lg"
        />
        <select :size="4" v-model="selfAssessment.perform_id">
          <option value="" disabled selected>ระดับการประเมินตนเอง:</option>
          <option
            v-for="perform in performs"
            :value="perform.perform_id"
            :key="perform.index"
          >
            {{ perform.perform_name}}
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
    {{ selfAssessments_ }}
  </div>
  <div class="py-2">
    {{ selfAssessment }}
  </div> -->
  <div class="py-2">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">SA-ID</th>
          <th scope="col">QA-ID</th>
          <th scope="col">Assessment Date</th>
          <th scope="col">Self Assessment</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="row in selfAssessments" :key="row.self_assessment_id">
          <td>{{ row.self_assessment_id }}</td>
          <td>{{ row.qa_plan_career_id }}</td>
          <td>{{ row.self_assessment_date }}</td>
          <td>{{ row.perform_id }}</td>


          <td>
            <v-btn depressed color="#3366FF" @click="editUser(row.self_assessment_id)">Edit</v-btn>
          </td>
          <td>
            <v-btn depressed color="#FF3333" @click="deleteUser(row.self_assessment_id)">Delete</v-btn>
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
  name: "FormSelfAssessment",
  data() {
    return {
      message: "Form Self Acessment",
      currentYear: new Date().getFullYear(),
      performs:Array,
      selfAssessments: Array,
      selfAssessments_: Array,
      careers: Array,
      career_qualifications: Array,
      employee_id: this.$store.getters.myMember_id,
      planCareerId: "",
      selfAssessment: {
        self_assessment_id: "",
        qualificationId: "",
        qualification_name:"",
        perform_id: "",
        perform_name: "",
        self_assessment_date: "",
        planCareerId:"",
        Plan_Career_id:"",
        qa_plan_career_id:""


      },
      isEdit: false,
      status: "Save/บันทึก",
    };
  },
  methods: {
    resetForm() {
      this.status = "Save/บันทึก";
      this.isEdit = false;
      console.log("ยกเลิกการบันทึกข้อมูล");
      // this.selfAssessment.selfAssessmentId = 0;
      // this.selfAssessment.qualificationId = 0;
      this.selfAssessment.qa_plan_career_id ="";
      this.selfAssessment.Plan_Career_id ="";
      this.selfAssessment.self_assessment_date = "";
      this.selfAssessment.perform_id = "";

    },
    getAllUser() {
      console.log(" แสดงข้อมูลทั้งหมด ");
      var self = this;
      axios
        .post("https://icp2022.net/ICPScoreCard/api-self-assessment.php", {
          action: "getall",
        })
        .then(function (res) {
          console.log(res);
          self.selfAssessments = res.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    submitForm() {
      if (!this.isEdit) {
        console.log("บันทึกข้อมูล");
        console.log("qualification:", this.selfAssessment);
        const newSelfAssessment = {
          self_assessment_id: this.selfAssessment.self_assessment_id,
          qa_plan_career_id: this.selfAssessment.qa_plan_career_id,
          self_assessment_date: this.selfAssessment.self_assessment_date,
          perform_id: this.selfAssessment.perform_id,

        };
        this.$emit("saveData", newSelfAssessment);

        axios
          .post("https://icp2022.net/ICPScoreCard/api-self-assessment.php", {
            action: "insert",
            self_assessment_id: this.selfAssessment.self_assessment_id,
            qa_plan_career_id: this.selfAssessment.qa_plan_career_id,
            self_assessment_date: this.selfAssessment.self_assessment_date,
            perform_id: this.selfAssessment.perform_id
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
          .post("https://icp2022.net/ICPScoreCard/api-self-assessment.php", {
            action: "update",
            self_assessment_id: this.selfAssessment.self_assessment_id,
            qa_plan_career_id: this.selfAssessment.qa_plan_career_id,
            self_assessment_date: this.selfAssessment.self_assessment_date,
            perform_id: this.selfAssessment.perform_id

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
    getPerform() {
      console.log(" ค่าประเมินตนเอง ");
      var self = this;
      axios
        .post("https://icp2022.net/ICPScoreCard/api-self-assessment.php", {
          action: "getPerform",
        })
        .then(function (res) {
          self.performs = res.data;
          console.log("perform:", self.performs);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getCareer() {
      console.log(" ข้อมูลอาชีพ ");
      var self = this;
      axios
        .post("https://icp2022.net/ICPScoreCard/api-self-assessment.php", {
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
      console.log("แผนอาชีพ",this.selfAssessment.Plan_Career_id);
      var self = this;
      axios
        .post("https://icp2022.net/ICPScoreCard/api-self-assessment.php", {
          action: "getCareer_Qualifiation",

          Plan_Career_id: this.selfAssessment.Plan_Career_id,
        })
        .then(function (res) {
          console.log("แก้ไขแผนอาชีพ+++",res.data);
          self.career_qualifications = res.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    editUser(self_assessment_id) {
      this.status = "Update(อัพเดท)";
      this.isEdit = true;
      var self = this;
      axios
        .post("https://icp2022.net/ICPScoreCard/api-self-assessment.php", {
          action: "edit",
          self_assessment_id: self_assessment_id,
        })
        .then(function (response) {
          console.log(response);
          self.selfAssessment.self_assessment_id = response.data.self_assessment_id;
          self.selfAssessment.Plan_Career_id = response.data.plan_career_id;
          self.getQualification();
          self.selfAssessment.qa_plan_career_id = response.data.qa_plan_career_id;
          self.selfAssessment.perform_id = response.data.perform_id,
          self.selfAssessment.self_assessment_date =response.data.self_assessment_date,
          self.selfAssessments_ = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    deleteUser(self_assessment_id) {
      if (confirm("คุณต้องการลบรหัส " + 	self_assessment_id + " หรือไม่ ?")) {
        var self = this;
        axios
          .post("https://icp2022.net/ICPScoreCard/api-self-assessment.php", {
            action: "delete",
            self_assessment_id: self_assessment_id,
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
    this.getPerform();
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
  /* border-radius: 12px; */
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
  padding: 2rem;
  color: white;
  /* background: rgb(4, 131, 242); */
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

input[type="radio"] {
  display: inline-block;
  width: auto;
  margin-right: 1rem;
}
input[type="radio"] + label {
  font-weight: normal;
}
</style>
