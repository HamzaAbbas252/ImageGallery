import api from "./apis";

export default {
    getCookie(){
        api.get('/csrf-cookie');

    }
}