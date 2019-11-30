import Vue from "vue";
import Vuetify from "vuetify/lib";

Vue.use(Vuetify);

export default new Vuetify({
  icons: {
    iconfont: "mdi"
  },
  theme: {
    dark: false,
    themes: {
      dark: {
        primary: "#7B1FA2",
        accent: "#D81B60",
        secondary: "#D1C4E9",
        success: "#4CAF50",
        info: "#2196F3",
        warning: "#FB8C00",
        error: "#FF5252"
      },
      light: {
        primary: "#6319D2",
        accent: "#C2185B",
        secondary: "#051D38",
        success: "#388E3C",
        info: "#2196F3",
        warning: "#FB8C00",
        error: "#FF5252"
      }
    }
  }
});
