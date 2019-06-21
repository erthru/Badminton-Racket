<template>
  <div>
    <div class="container">
      <div class="col-md-12">
        <br>
        <h3>Brand API Documentation</h3>
        <br>
        <h4>Show all Brand [GET]:</h4>
        <p>
          <strong>endpoint</strong>: /api/brand
        </p>
        <p>&nbsp;</p>
        <h4>Find one Brand [GET]:</h4>
        <p>
          <strong>end point</strong>
          : /api/brand/{id}
        </p>
        <p>&nbsp;</p>
        <h4>Search Brand [GET]:</h4>
        <p>
          <strong>endpoint</strong>: /api/brand/search/query
        </p>
        <p>
          <strong>params</strong>: q (string)
        </p>
        <p>&nbsp;</p>
        <h4>Create Brand [POST]:</h4>
        <p>
          <strong>endpoint</strong>: /api/brand
        </p>
        <p>
          <strong>params</strong>: name (string)
        </p>
        <p>&nbsp;</p>
        <h4>Update Brand [PUT]:</h4>
        <p>
          <strong>endpoint</strong>
          : /api/brand/{id}
        </p>
        <p>
          <strong>params</strong>: name (string)
        </p>
        <p>&nbsp;</p>
        <h4>Update Brand [DELETE]:</h4>
        <p>
          <strong>endpoint</strong>
          : /api/brand/{id}
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("brand documentation component");
  }
};
</script>

