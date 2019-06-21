<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <br>
          <h3>Add Brand</h3>
          <form @submit.prevent="submit()">
            <div class="form-group">
              <label>Name</label>
              <input type="text" placeholder="Input name" class="form-control" v-model="nameVal" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Const from "../../../helper/const";
export default {
  mounted() {
    console.log("brand add mounted");
  },
  data() {
    return {
      nameVal: ""
    };
  },
  methods: {
    submit() {
      const body = {
        name: this.nameVal
      };

      axios.post(Const.baseUrlApi + "brand", body).then(res => {
        this.$router.push("/brand");
      });
    }
  }
};
</script>
