import { createApp } from "vue";
import "bootstrap/dist/js/bootstrap.bundle.min";
import "./styles.css";

import ProductsList from "./components/ProductsList";
import CartButton from "./components/CartButton";
import CartModal from "./components/cart/CartModal";

const app = createApp({
  data: () => ({
    cartProducts: [],
  }),
  computed: {
    totalAmount() {
      return this.cartProducts.reduce((total, { amount }) => total + amount, 0);
    },
  },
  methods: {
    addProductToCart(product) {
      let checkProdInCart = false;
      for (let i = 0; i < this.cartProducts.length; i++) {
        if (product["id"] === this.cartProducts[i]["id"]) {
          this.cartProducts[i]["amount"] = this.cartProducts[i]["amount"] +1;
          checkProdInCart = true;
        }
      }
      if (!checkProdInCart) {
        this.cartProducts.push({
          ...product,
          amount: 1,
        });
      }
    },
    incrementProductAmount(index) {
      const product = this.cartProducts[index];
      this.cartProducts.splice(index, 1, {
        ...product,
        amount: product.amount + 1,
      });
    },
    decrementProductAmount(index) {
      const product = this.cartProducts[index];
      this.cartProducts.splice(index, 1, {
        ...product,
        amount: product.amount - 1,
      });
    },
    removeProductFromCart(index) {
      this.cartProducts.splice(index,1);
    },
  },
});

app.component("products-list", ProductsList);
app.component("cart-button", CartButton);
app.component("cart-modal", CartModal);

app.mount("#app");