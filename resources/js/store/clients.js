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
      this.users = users;
    },
    add(state, user) {
      this.users.push(user);
    },
    remove(state, user_id) {
      this.users = this.users.filter(user => user.id != user_id);
    }
  },
  actions: {
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
      let url = `/webapi/fleets/${user_id}`;
      return new Promise((resolve, reject) => {
        axios
          .delete(url)
          .then(response => {
            context.commit("delete", user_id);
            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });
    }
  }
};
