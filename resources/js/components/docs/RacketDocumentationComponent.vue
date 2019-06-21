<template>
  <div>
    <div class="container">
      <div class="col-md-12">
        <br>
        <h3>Racket API Documentation</h3>
        <br>
        <h4>Show all Rackets [GET]:</h4>
        <p>
          <strong>endpoint</strong>: /api/racket
        </p>
        <p>&nbsp;</p>
        <h4>Find one Racket [GET]:</h4>
        <p>
          <strong>end point</strong>
          : /api/racket/{id}
        </p>
        <p>&nbsp;</p>
        <h4>Search Rackets [GET]:</h4>
        <p>
          <strong>endpoint</strong>: /api/racket/search/query
        </p>
        <p>
          <strong>params</strong>: q (string)
        </p>
        <p>&nbsp;</p>
        <h4>Create Rackets [POST]:</h4>
        <p>
          <strong>endpoint</strong>: /api/racket
        </p>
        <p>
          <strong>params</strong>: name (string), balance_point (integer), description (string), image (file), brand_id (integer)
        </p>
        <p>&nbsp;</p>
        <h4>Update Image Rackets [POST]:</h4>
        <p>
          <strong>endpoint</strong>
          : /api/racket/image/{id}
        </p>
        <p>
          <strong>params</strong>: image (file)
        </p>
        <p>&nbsp;</p>
        <h4>Update Rackets [PUT]:</h4>
        <p>
          <strong>endpoint</strong>
          : /api/racket/{id}
        </p>
        <p>
          <strong>params</strong>: name (string), balance_point (integer), description (string), brand_id (integer)
        </p>
        <p>&nbsp;</p>
        <h4>Update Rackets [DELETE]:</h4>
        <p>
          <strong>endpoint</strong>
          : /api/racket/{id}
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("racket documentation component");
  }
};
</script>

