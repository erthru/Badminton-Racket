<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <br>
          <h3>List Brands</h3>
          <div class="row">
            <div class="col-md-3">
              <input
                class="form-control"
                v-model="searchVal"
                type="search"
                placeholder="Search Racket"
              >
            </div>
            <div class="col-md-2 p-0">
              <button v-on:click="searchBrands()" class="btn btn-outline-primary">Search</button>
            </div>
            <div class="col-md-7">
              <router-link class="btn btn-primary" style="float:right" to="/brand/add">+ Add</router-link>
            </div>
          </div>
          <br>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col" width="10%">#</th>
                  <th scope="col" width="75%">Name</th>
                  <th scope="col" width="15%">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="brand in brands" :key="brand.id">
                  <td>{{brand.id}}</td>
                  <td>{{brand.name}}</td>
                  <td>
                    <router-link class="btn btn-warning" :to="'/brand/detail/'+brand.id">Detail</router-link>
                    <button class="btn btn-danger" v-on:click="deleteBrand(brand.id)">Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
            <nav aria-label="...">
              <ul class="pagination" v-bind:hidden="isPaginationHidden">
                <li :class="'page-item '+ prevButtonDisabled">
                  <button class="page-link" v-on:click="getBrands('prev')">Previous</button>
                </li>
                <li class="page-item disabled">
                  <p class="page-link">Page {{currentPage}} of {{totalPage}}</p>
                </li>
                <li :class="'page-item '+ nextButtonDisabled">
                  <button class="page-link" v-on:click="getBrands('next')">Next</button>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Const from "../../../helper/const";
export default {
  mounted() {
    console.log("brand component");
    this.getBrands("next");
  },
  data() {
    return {
      brands: [],
      currentPage: 0,
      totalPage: 0,
      prevButtonDisabled: "disabled",
      nextButtonDisabled: "disabled",
      searchVal: "",
      isPaginationHidden: false
    };
  },
  methods: {
    getBrands(mode) {
      if (mode == "next") {
        this.currentPage += 1;
      } else if (mode == "prev") {
        this.currentPage -= 1;
      }

      axios
        .get(Const.baseUrlApi + "brand?page=" + this.currentPage)
        .then(res => {
          this.brands = res.data.data.data;
          this.totalPage = res.data.data.last_page;

          if (this.currentPage == 1) {
            this.prevButtonDisabled = "disabled";
          } else {
            this.prevButtonDisabled = "";
          }

          if (this.currentPage == this.totalPage) {
            this.nextButtonDisabled = "disabled";
          } else {
            this.nextButtonDisabled = "";
          }
        });
    },
    searchBrands() {
      this.isPaginationHidden = true;

      if (!this.searchVal) this.isPaginationHidden = false;

      axios
        .get(Const.baseUrlApi + "brand/search/query?q=" + this.searchVal)
        .then(res => {
          this.brands = res.data.data;
        });
    },
    deleteBrand(id){
        axios.delete(Const.baseUrlApi+"brand/"+id).then(res=>{
            this.getBrands();
        });
    }
  }
};
</script>

