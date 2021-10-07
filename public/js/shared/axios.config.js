// // axios config
// axios.default.headers = { "content-type": "application/json" };
// const token = $('meta[name="csrf-token"]').attr("content");
// const baseUrl = window.location.origin;

// //Add a request interceptor
// axios.interceptors.request.use(
//     function (config) {
//         // set the csrf token
//         config.headers["X-CSRF-TOKEN"] = token;
//         return config;
//     },
//     function (error) {
//         // Do something with request error
//         return Promise.reject(error);
//     }
// );

// export { token, baseUrl };
