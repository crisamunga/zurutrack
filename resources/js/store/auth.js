import axios from "axios";
const api_base_url = process.env.MIX_APP_URL;
const user = JSON.parse(localStorage.getItem("user"));

export default {
    namespaced: true,
    state: {
        user: user
    },
    getters: {
        token: state => state.user.access_token
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        }
    },
    actions: {
        login(context, data) {
            return new Promise((resolve, reject) => {
                let url = `${api_base_url}/login`;
                axios
                    .post(url, data)
                    .then(response => {
                        resolve(response);
                    })
                    .catch(error => {
                        context.dispatch(
                            "alert/error",
                            error.response.data.message,
                            {
                                root: true
                            }
                        );
                        reject(error.response);
                    });
            });
        },
        register(context, data) {
            return new Promise((resolve, reject) => {
                let url = `${api_base_url}/register`;
                axios
                    .post(url, data)
                    .then(response => {
                        context.dispatch(
                            "alert/info",
                            "Your registration was successful",
                            {
                                root: true
                            }
                        );
                        resolve(response);
                    })
                    .catch(error => {
                        context.dispatch("alert/error", error, { root: true });
                        reject(error.response);
                    });
            });
        },
        logout(context) {
            return new Promise((resolve, reject) => {
                let url = `${api_base_url}/logout`;
                axios
                    .post(url)
                    .then(response => {
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        }
    }
};
