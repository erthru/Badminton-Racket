<template>
  <div>
    <div class="container">
      <br>
      <div class="row">
        <div class="col-md-6">
          <h3>Add Racket</h3>
          <form @submit.prevent="submit()">
            <div class="form-group">
              <label>Name</label>
              <input
                type="text"
                placeholder="Input Name"
                v-model="nameVal"
                class="form-control"
                required
              >
            </div>
            <div class="form-group">
              <label>Balance Point</label>
              <input
                type="number"
                placeholder="Input Balance Point"
                v-model="balancePointVal"
                class="form-control"
                required
              >
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea
                type="text"
                placeholder="Input Description"
                v-model="descriptionVal"
                class="form-control"
                required
              ></textarea>
            </div>
            <div class="form-group">
              <label>Select Brand</label>
              <select class="form-control" @change="getBrandId" required>
                <option value hidden>Select the Brand</option>
                <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{brand.name}}</option>
              </select>
            </div>
            <div class="form-group">
              <label>Upload Image</label>
              <br>
              <input type="file" @change="setImageFile" required>
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
    console.log("racket add mounted");
    this.getBrands();
  },
  data() {
    return {
      imgFile: null,
      brands: [],
      nameVal: "",
      balancePointVal: "",
      descriptionVal: "",
      brandId: ""
    };
  },
  methods: {
    submit() {
      const multipartData = new FormData();
      multipartData.append("name", this.nameVal);
      multipartData.append("balance_point", this.balancePointVal);
      multipartData.append("description", this.descriptionVal);
      multipartData.append("image", this.imgFile);
      multipartData.append("brand_id", this.brandId);

      axios.post(Const.baseUrlApi + "racket", multipartData).then(res => {
        this.$router.push("/");
      });
    },
    getBrands() {
      axios.get(Const.baseUrlApi + "brand/by/name").then(res => {
        this.brands = res.data.data;
      });
    },
    getBrandId(event) {
      if (event.target.options.selectedIndex > -1) {
        this.brandId =
          event.target.options[event.target.options.selectedIndex].value;
      }
    },
    setImageFile(event) {
      this.imgFile = event.target.files[0];
    }
  }
};
</script>
