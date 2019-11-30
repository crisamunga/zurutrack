export default {
  required(v, message) {
    return !!v || (message || "This field is required");
  },

  email(v, message) {
    return (
      /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
      (message || "Enter a valid E-mail address")
    );
  },

  minLength(v, length, message) {
    return (
      v.length >= length ||
      (message || `Must have at least ${length} characters`)
    );
  },

  maxLength(v, length, message) {
    return (
      v.length <= length || (message || `Must not exceed ${length} characters`)
    );
  },

  match(v, other, message) {
    return v == other || (message || `Values do not match`);
  }
};
