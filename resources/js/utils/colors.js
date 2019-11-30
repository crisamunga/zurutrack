export default {
  colors: [
    "red",
    "green",
    "orange",
    "blue",
    "cyan",
    "indigo",
    "purple",
    "pink",
    "deep-purple",
    "teal",
    "light-blue",
    "brown"
  ],
  getRandomColor() {
    return this.colors[Math.floor(Math.random() * this.colors.length)];
  },
  getSpecificColor(index) {
    return this.colors[index % this.colors.length];
  },
  getRandomTextColor() {
    return this.getRandomColor() + "--text";
  },
  getSpecificTextColor(index) {
    return this.getSpecificColor(index) + "--text";
  }
};
