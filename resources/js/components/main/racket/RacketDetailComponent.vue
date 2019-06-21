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
                <option
                  v-for="brand in brands"
                  :selected="brand.id == brandId"
                  :key="brand.id"
                  :value="brand.id"
                >{{brand.name}}</option>
              </select>
            </div>
            <div class="form-group">
              <label>Click To Change Image</label>
              <br>
              <div
                class="spinner-border text-primary"
                role="status"
                v-bind:hidden="isSpinnerHidden"
              >
                <span class="sr-only">Loading...</span>
              </div>
              <img
                :src="imgImg"
                height="120"
                width="120"
                onclick="document.getElementById('inputImage').click()"
                v-bind:hidden="isImgHidden"
              >
              <input type="file" id="inputImage" @change="setImageFile" hidden>
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
    this.getRacket();
    this.getBrands();
  },
  data() {
    return {
      imgFile: null,
      brands: [],
      nameVal: "",
      balancePointVal: "",
      descriptionVal: "",
      imgImg: "",
      brandId: "",
      isSpinnerHidden: true,
      isImgHidden: false
    };
  },
  methods: {
    getRacket() {
      axios
        .get(Const.baseUrlApi + "racket/" + this.$route.params.id)
        .then(res => {
          this.nameVal = res.data.data.name;
          this.balancePointVal = res.data.data.balance_point;
          this.descriptionVal = res.data.data.description;
          this.imgImg = Const.baseUrlImage + res.data.data.image;
          this.brandId = res.data.data.brand.id;
        });
    },
    submit() {
      const body = {
        name: this.nameVal,
        balance_point: this.balancePointVal,
        description: this.descriptionVal,
        brand_id: this.brandId
      };
      axios
        .put(Const.baseUrlApi + "racket/" + this.$route.params.id, body)
        .then(res => {
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
      this.isSpinnerHidden = false;
      this.isImgHidden = true;

      const multipartData = new FormData();
      multipartData.append("image", this.imgFile);

      axios
        .post(
          Const.baseUrlApi + "racket/image/" + this.$route.params.id,
          multipartData
        )
        .then(res => {
          this.imgImg = Const.baseUrlImage + res.data.data.image;
          this.isSpinnerHidden = true;
          this.isImgHidden = false;
        });
    }
  }
};
</script>
