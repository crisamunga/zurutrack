export default {
  namespaced: true,
  state: {
    users: []
  },
  getters: {
    all(state) {
      return state.users;
    }
  },
  mutations: {
    all(state, users) {
      state.users = users;
    },
    add(state, user) {
      state.users.push(user);
    },
    remove(state, user_id) {
      state.users = state.users.filter(user => user.id != user_id);
    }
  },
  actions: {
    index(context) {
      let url = `/webapi/users`;
      return new Promise((resolve, reject) => {
        axios
          .get(url)
          .then(response => {
            context.commit("all", response.data.data);
            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });
    },
    link(context, data) {
      let url = `/webapi/users/link`;
      return new Promise((resolve, reject) => {
        axios
          .post(url, data)
          .then(response => {
            context.commit("add", response.data.data);
            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });
    },
    store(context, user) {
      let url = `/webapi/users`;
      return new Promise((resolve, reject) => {
        axios
          .post(url, user)
          .then(response => {
            context.commit("add", response.data.data);
            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });
    },
    delete(context, user_id) {
      let url = `/webapi/users/${user_id}`;
      return new Promise((resolve, reject) => {
        axios
          .delete(url)
          .then(response => {
            context.commit("remove", user_id);
            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });
    }
  }
};
