import store from "../store";

export default function auth(from, to, next) {
  if (!store.state.auth.user) {
    return next({
      name: "login"
    });
  }

  return next();
}
