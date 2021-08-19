const axios = window.axios;
const BASE_API_URL = 'http://127.0.0.1:8000/api';

export default
{

    
     setEmailSchedule : (data) => 
    axios.post(`${BASE_API_URL}/mail`,data,{
        Accept: 'application/json',
        'Content-Type': 'multipart/form-data',
    }),
    setTimeZone : (data) => 
    axios.post(`${BASE_API_URL}/timezone`,data,{
        Accept: 'application/json',
        'Content-Type': 'multipart/form-data',
    }),
    Payment : (token,data) => 
    axios.post(`${BASE_API_URL}/payment`,token,data,{
        Accept: 'application/json',
        'Content-Type': 'multipart/form-data',
    }),
    Gateway : (data) => 
    axios.post(`${BASE_API_URL}/gateway`,data,{
        Accept: 'application/json',
        'Content-Type': 'multipart/form-data',
    })
}