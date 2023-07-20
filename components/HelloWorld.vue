<template>
  <div class="hello">
    <h3>{{ msg }}</h3>
    <p>
      เพื่อส่งเสริมโอกาสให้คนพิการที่มีการศึกษา
      มีศักยภาพสูงให้ได้ทํางานในสถานประกอบการ
      <br />
      โดยสิ่งสำคัญคือ การมีอาชีพ
      ที่ทําให้สามารถพึ่งพาตนเองได้ของนักศึกษาและบัณฑิตพิการ
    </p>
    <br />
    <h3>แนวคิดหลักของโครงการ คือ</h3>
    <ul>
      <li>
        นักศึกษาออกแบบและวางแผนอาชีพ เป้าหมาย ที่อาจจะมีมากกว่าหนึ่งอาชีพ
        และเตรียมตัวเชิงรุก
        <br />
        โดยการย้อนกลับถึง ทักษะเฉพาะที่จำเป็น
        และการวางแผนเพื่อพัฒนาตัวเองในทักษะนั้นๆ เพื่อให้ตอบโจทย์อาชีพที่วางไว้
      </li>
    </ul>
    <ul>
      <li>
        <div class="container">
          <img alt="diability"  style="width:100%;max-width:300px" src="../assets/diability.png" />
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'HelloWorld',
  props: {
    msg: String,
  },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.container {
  width: 700px;
  height: 200px;
}
/* Resize images */
.container img {
  
  width: 100%;
  height: 100%;
}
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
.hello {
  color: black;
}
</style>
