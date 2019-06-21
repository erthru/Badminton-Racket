<template>
  <div>
    <br>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h3>List Rackets</h3>
          <div class="row">
            <div class="col-md-3">
              <input class="form-control" v-model="searchVal" type="search" placeholder="Search Racket">
            </div>
            <div class="col-md-2 p-0">
              <button v-on:click="searchRacket()" class="btn btn-outline-primary">Search</button>
            </div>
            <div class="col-md-7">
              <router-link class="btn btn-primary" style="float:right" to="/add">+ Add</router-link>
            </div>
          </div>
          <br>
          <div class="table-responsive">
            <table class="table table-striped" style="table-layout:fixed;">
              <thead>
                <tr>
                  <th scope="col" width="10%">#</th>
                  <th scope="col" width="15%">Name</th>
                  <th scope="col" width="20%">Balance Point</th>
                  <th scope="col" width="30%">Description</th>
                  <th scope="col" width="10%">Brand</th>
                  <th scope="col" width="15%">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="racket in rackets" :key="racket.id">
                  <td>{{racket.id}}</td>
                  <td>{{racket.name}}</td>
                  <td>{{racket.balance_point}}mm</td>
                  <td>
                    <p
                      style="text-overflow: ellipsis; overflow: hidden; white-space:nowrap; width:100%;"
                    >{{racket.description}}</p>
                  </td>
                  <td>{{racket.brand.name}}</td>
                  <td><router-link class="btn btn-warning" :to="'/detail/'+racket.id">Detail</router-link> <button class="btn btn-danger" v-on:click="deleteRacket(racket.id)">Delete</button></td>
                </tr>
              </tbody>
            </table>
          </div>
          <nav aria-label="...">
            <ul class="pagination" v-bind:hidden="isPaginationHidden">
              <li :class="'page-item '+ prevButtonDisabled">
                <button class="page-link" v-on:click="getRackets('prev')">Previous</button>
              </li>
              <li class="page-item disabled">
                <p class="page-link">Page {{currentPage}} of {{totalPage}}</p>
              </li>
              <li :class="'page-item '+ nextButtonDisabled">
                <button class="page-link" v-on:click="getRackets('next')">Next</button>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Const from "../../../helper/const";
export default {
  mounted() {
    console.log("racket mounted");
    this.getRackets("next");
  },
  data() {
    return {
      rackets: [],
      currentPage: 0,
      totalPage: 0,
      prevButtonDisabled: "disabled",
      nextButtonDisabled: "disabled",
      searchVal: "",
      isPaginationHidden: false
    };
  },
  methods: {
    getRackets(mode) {
      if (mode == "next") {
        this.currentPage += 1;
      } else if (mode == "prev") {
        this.currentPage -= 1;
      }

      axios
        .get(Const.baseUrlApi + "racket?page=" + this.currentPage)
        .then(res => {
          this.rackets = res.data.data.data;
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
    searchRacket() {
      this.isPaginationHidden = true;

      if(!this.searchVal)
        this.isPaginationHidden = false

      axios.get(Const.baseUrlApi+"racket/search/query?q="+this.searchVal).then(res => {
        this.rackets = res.data.data;
      });
    },
    deleteRacket(id){
      axios.delete(Const.baseUrlApi+"racket/"+id).then(res => {
        this.getRackets();
      });
    }
  }
};
</script>
