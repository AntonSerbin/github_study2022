<template>
  <div class="container">
    <div class="card my-5 shadow">
      <div class="card-body">
        <div class="row">
          <product
              v-for="product in products"
              :key="product.id_good"
              :id="product.id_good"
              :name="product.title"
              :category="product.category"
              :price="product.price"
              :image="product.image_name"
              :is-available="true"
              @add-to-cart="addProductToCart(product)"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Product from "./Product";
export default {
  name: "ProductsList",
  components: {
    Product,
  },
  data: () => ({
    products: [],
  }),
  mounted() {
    this.fetchProducts();
  },
  methods: {
    async fetchProducts() {
      try {
        const response = await fetch("http://localhost/api/goods/all");
        console.log("response Vue ProductList");
        console.log(response);
        this.products = await response.json();
        console.log("response response.json() Vue ProductList");
        console.log(this.products[0]);
      } catch (e) {
        console.error("Fetching error");
      }
    },
    addProductToCart(product) {
      this.$root.addProductToCart(product);
    },
  },
}
</script>
