const axios = window.axios;
const BASE_API_URL = 'http://127.0.0.1:8000/api';

export default
{

    
     setEmailSchedule : (data) => 
    axios.post(`${BASE_API_URL}/mail`,data,{
        Accept: 'application/json',
        'Content-Type': 'multipart/form-data',
    })
}