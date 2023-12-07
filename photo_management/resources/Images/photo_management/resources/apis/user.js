import api from "./apis"

export default
{
    register(form){
        return api.post('/register',form);
    }
};