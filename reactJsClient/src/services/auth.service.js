import axios from "axios";

const API_URL = "http://localhost:8000/api/";

// const register = (username, email, password) => {
//   return axios.post(API_URL + "signup", {
//     username,
//     email,
//     password,
//   });
// };

const login = (username, password) => {
  return axios
    .post(API_URL + "login", {
      email: username,
      password: password,
    })
    .then((response) => {
      if (response.data.token) {
        localStorage.setItem("token", JSON.stringify(response.data.token));
      }

      return response.data;
    });
};

const getMicroService = (url, params) => {
  return axios
    .get(API_URL + url, params,{
      headers: {
        'Authorization': 'Bearer ' . localStorage.getItem("token")
      }
    })
    .then((response) => {
      // if (response.data.username) {
      //   localStorage.setItem("user", JSON.stringify(response.data));
      // }

      return response.data;
    });
};

// const logout = () => {
//   localStorage.removeItem("user");
//   return axios.post(API_URL + "signout").then((response) => {
//     return response.data;
//   });
// };

const getCurrentUser = () => {
  return JSON.parse(localStorage.getItem("token"));
};

const getCurrentUserAccountDetails = () => {
  var token = "Bearer " + localStorage.getItem("token");
    return axios
    .get(API_URL + 'account/currentUserAccount',{
      headers: {
        'Authorization': token.replace("\"", "")
      }
    })
    .then((response) => {
      return response.data;
    });
};

const getApiUrl = () => {
  return API_URL;
};

const AuthService = {
  // register,
  login,
  // logout,
  getCurrentUser,
  getCurrentUserAccountDetails,
  getApiUrl
}

export default AuthService;
