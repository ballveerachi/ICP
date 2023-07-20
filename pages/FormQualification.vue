<template>
  <div>
    <h3>คุณสมบัติ/ทักษะ</h3>
  <form @submit.prevent="submitForm" @reset.prevent="resetForm" method="post">
    <div class="row">
      <div class="input-field col s4">
        <label for="qualification-id">Qualification-ID/รหัสคุณสมบัติ:</label>
        <!-- <input type="text" v-model="qualification.qualificationId" /> -->
        <input
          type="text"
          name="qa_plan_career_id-id"
          v-model="qualification.qa_plan_career_id"
          placeholder="QA-ID/รหัสคุณสมบัติ"
          required  disabled
          class="form-control form-control-lg"
        />
      </div>
    </div>
    <div class="row">
      <div class="input-field col s4">
        <label for="planCareer-id">PlanCareer-ID/รหัสแผนอาชีพ:</label>
        <!-- <input type="text" v-model="qualification.planCareerId" /> -->
        <input
          type="text"
          name="Name_Plan_Career"
          v-model="qualification.planCareerId"
          placeholder="Career/อาชีพ"
          required  disabled
          class="form-control form-control-lg"
        />
        <select
          :size="4"
          v-model="qualification.planCareerId"
          :required="true"
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
        <label for="qualification_name">Qualification/คุณสมบัติ:</label>
        <!-- <input type="text" v-model="qualification.qualification_name" /> -->
        <input
          type="text"
          name="qualification_name"
          v-model="qualification.qualificationId"
          placeholder="คุณสมบัติที่กำหนด"
          class="form-control form-control-lg"
        />
        <select :size="4" v-model="qualification.qualificationId">
          <option value="" disabled selected>คุณสมบัติที่กำหนด:</option>
          <option
            v-for="qualification in qualifications"
            :value="qualification.qualificationId"
            :key="qualification.index"
          >
            {{ qualification.qualificationId }}
            {{ qualification.qualification_name }}


          </option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s4">
        <label for="level">level/ระดับความสำคัญ:</label>
        <!-- <input type="text" v-model="qualification.qualification_name" /> -->
        <input
          type="text"
          name="level"
          v-model="qualification.level_id"
          placeholder="ระดับความสำคัญ"
          class="form-control form-control-lg"
        />
        <select :size="4" v-model="qualification.level_id">
          <option value="" disabled selected>ระดับความสำคัญ:</option>
          <option
            v-for="level in levels"
            :value="level.level_id"
            :key="level.index"
          >
            {{ level.level_id }}
            {{ level.level_description}}
          </option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s4">
        <label for="level">target/เป้าหมาย:</label>
        <!-- <input type="text" v-model="qualification.qualification_name" /> -->
        <input
          type="text"
          name="target"
          v-model="qualification.target_id"
          placeholder="เป้าหมาย"
          class="form-control form-control-lg"
        />
        <select :size="4" v-model="qualification.target_id">
          <option value="" disabled selected>เป้าหมาย:</option>
          <option
            v-for="target in targets"
            :value="target.target_id"
            :key="target.index"
          >
            {{ target.target_id }}
            {{ target.target_name}}
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
    {{ qualifications_ }}
  </div>
  <div class="py-2">
    {{ qualification }}
  </div> -->
  <!-- <div class="py-2">employee_id:{{ employee_id }} careers:{{ careers }}</div>
  <div class="py-2">career_qualifications: {{ career_qualifications }}</div> -->
  <div class="py-2">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Qualification-ID</th>
          <th scope="col">PlanCareer-ID</th>
          <th scope="col">PlanCareer-Name</th>
          <th scope="col">Qualification</th>
          <th scope="col">Level</th>
          <th scope="col">target</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="row in getall" :key="row.index">
          <td>{{ row.qa_plan_career_id }}</td>
          <td>{{ row.Plan_Career_id }}</td>
          <td>{{ row.career }}</td>
          <td>{{ row.qualification_name }}</td>
          <td>{{ row.level_description }}</td>
          <td>{{ row.target_name }}</td>
          <td>
             <v-btn depressed color="#3366FF" @click="editUser(row.qa_plan_career_id)">Edit</v-btn>
          </td>
          <td>
            <v-btn depressed color="#FF3333" @click="deleteUser(row.qa_plan_career_id)">Delete</v-btn>
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
  name: "FormQualification",
  components: {},
  data() {
    return {
      message: "Form Qualification",
      selected: "",
      getall:Array,
      targets:Array,
      levels:Array,
      qualifications: Array,
      qualifications_: Array,
      employee_id: this.$store.getters.myMember_id,
      careerPath: "",
      careers: Array,
      career_qualifications: Array,
      qualification: {
        qa_plan_career_id:"",
        qualificationId: "",
        planCareerId: "",
        qualification_name: "",
        level_id: "",
        target_id: "",
        qualification_id: "",
        // month: "มกราคม",
        // self_assessment: "Yes",

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
      // this.qualification.qualificationId = 0;
      this.qualification.planCareerId = "";
      this.qualification.qualification_name = "";
      this.qualification.qualificationId = "";
      this.qualification.level_id = "";
      this.qualification.target_id = "";
      // this.qualification.month = "";
      // this.qualification.self_assessment = "";
    },
    getAllUser() {
      console.log(" แสดงข้อมูลทั้งหมด ");
      var self = this;
      axios
        .post("https://icp2022.net/api-qa-plan-career.php", {
          action: "getall",
        })
        .then(function (res) {
          console.log("ข้อมูลแผนคุณสมบัติ",res.data);
          self.getall = res.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getCareer() {
      console.log(" ข้อมูลอาชีพ ");
      var self = this;
      axios
        .post("https://icp2022.net/ICPScoreCard/api-qualification.php", {
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
    getQualifications() {
      console.log(" แสดงข้อมูลคุณสมบัติ ");
      var self = this;
      axios
        .post("https://icp2022.net/ICPScoreCard/api-qualification.php", {
          action: "getQualifiation",
          // career_id: this.qualification.planCareerId,
        })
        .then(function (res) {
          self.qualifications = res.data;
          console.log("qualification:", self.qualifications);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getLevel() {
      console.log(" แสดงข้อมูลระดับ ");
      var self = this;
      axios
        .post("https://icp2022.net/ICPScoreCard/api-qualification.php", {
          action: "getLevel",
        })
        .then(function (res) {
          self.levels = res.data;
          console.log("level:", self.levels);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getTarget() {
      console.log(" ข้อมูลค่าเป้าหมาย ");
      var self = this;
      axios
        .post("https://icp2022.net/ICPScoreCard/api-qualification.php", {
          action: "getTarget",
        })
        .then(function (res) {
          self.targets = res.data;
          console.log("target:", self.targets);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    submitForm() {
      if (!this.isEdit) {
        console.log("บันทึกข้อมูล");
        console.log("รหัสคุณสมบัติ",this.qa_plan_career_id)
        console.log("แผนอาชีพ",this.qualification.planCareerId)
        console.log("คุณสมบัติ",this.qualification.qualificationId)
        console.log("เป้าหมาย",this.qualification.target_id)
        console.log("ระดับ",this.qualification.level_id)
        const newQualification = {
          plan_career_id: this.qualification.planCareerId,
          qualification_id: this.qualification.qualificationId,
          target_id: this.qualification.target_id,
          level_id: this.qualification.level_id,

        };
        this.$emit("saveData", newQualification);

        axios
            .post("https://icp2022.net/ICPScoreCard/api-qa-plan-career.php", {
              action: "insert",
              plan_career_id: this.qualification.planCareerId,
              qualification_id: this.qualification.qualificationId,
              target_id: this.qualification.target_id,
              level_id: this.qualification.level_id,

            })
            .then((res) => {
              console.log("insert:", res);
              this.resetForm();
              this.getAllUser();
              // this.getUpdate();
            })
            .catch(function (error) {
              console.log(error);
            });

      } else {
        console.log("qa_plan_career_id:",this.qualification.qa_plan_career_id);
        console.log("plan_career_id:",this.qualification.planCareerId);
        console.log("qualificationId:",this.qualification.qualificationId);
        console.log("target_id:",this.qualification.target_id);
        console.log("level_id:",this.qualification.level_id);

        axios
          .post("https://icp2022.net/ICPScoreCard/api-qa-plan-career.php", {
            action: "update",
            qa_plan_career_id:this.qualification.qa_plan_career_id,
            plan_career_id: this.qualification.planCareerId,
            qualificationId: this.qualification.qualificationId,
            target_id: this.qualification.target_id,
            level_id: this.qualification.level_id,


            // month: this.qualification.month,
            // result: this.qualification.self_assessment,
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
    editUser(qa_plan_career_id) {
      this.status = "Update/อัพเดท";
      this.isEdit = true;
      var self = this;
      console.log("qa_plan_career_id:",qa_plan_career_id);
      axios
        .post("https://icp2022.net/ICPScoreCard/api-qa-plan-career.php", {
          action: "edit",
          qa_plan_career_id:qa_plan_career_id,
        })
        .then(function (response) {
          console.log(response);
          self.qualification.qa_plan_career_id =response.data.qa_plan_career_id;
          self.qualification.qualificationId = response.data.qualificationId;
          self.qualification.planCareerId = response.data.plan_career_id;
          self.qualification.target_id = response.data.target_id;
          self.qualification.level_id = response.data.level_id;
          self.qualifications_ = response.data;
          console.log("แก้ไขคุณสมบัติ:",response.data);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    deleteUser(qa_plan_career_id) {
      if (confirm("คุณต้องการลบรหัส " + qa_plan_career_id + " หรือไม่ ?")) {
        var self = this;
        axios
          .post("https://icp2022.net/ICPScoreCard/api-qa-plan-career.php", {
            action: "delete",
            qa_plan_career_id: qa_plan_career_id,
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
    this.getQualifications();
    this.getLevel();
    this.getTarget();


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
