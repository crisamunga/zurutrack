import store from "../store";

export default function guest(from, to, next) {
  if (store.state.auth.user) {
    return next({
      name: "home"
    });
  }

  return next();
}
