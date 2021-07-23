import React, { useRef,useState,useEffect } from "react";
import { Button, Form } from "~/components";
import { NavLink } from "react-router-dom";
import { formSubmit } from "~/helpers/utilities";


const SessionTimeout = () =>
{

    const [errors, setErrors] = useState({});
    const form = useRef(null);
    const [loading, setLoading] = useState(false);
    const [setting, setSetting] = useState([]);
    const [isloading, setIsLoading] = useState(false);
    const [dt,setDt] = useState('')
    const [time_value,setTime] = useState(1)
    const handleSubmit = async evt => {
      evt.preventDefault();
      let formData = new FormData(form.current);
      window.loadingStatus = `Saving data...`;
      setLoading(true);
  
      let errors = await formSubmit(
        `post`,
        `/api/setting`,
        formData,
        `Session successfully save`,
        `/admin/session-setting`
      );
      setLoading(false);
      setErrors(errors || {});
    };
  
    useEffect(() => {
      const fetchData = async () => {
        const {data} = await axios.get(`/api/setting-session`)
         
          setSetting(data)
          setDt(data.attr)
          setTime(data.value)
          $('#date').val(data.attr)
          $('#timeout_token').val(data.value)
        setIsLoading(true)
        
      
       
      };
      fetchData();
    },[])


return(
    <form className="w-full max-w-sm" ref={form} onSubmit={handleSubmit}>
    <div className="md:flex md:items-center mb-6">
      <div className="md:w-1/2 ml-3 mr-3">
        <label className="block text-black-500 font-bold md:text-right mb-1 md:mb-0 " htmlFor="inline-full-name">
          Session Expired In
        </label>
      </div>
      <div className="md:w-1/3">
      <select id="date" name="date" autoComplete="date"   className="ml-3 mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

        
        <option >Seconds</option>
        <option >Minute</option>
        <option>Hour</option>
        <option>Day</option>
        <option>Week</option>
        <option>Month</option>
        <option>Year</option>
        
    
                   
                   
                  </select>
      </div>
      <div className="md:w-1/3">
       
          <input type="number" name="timeout_token" autoComplete="timeout" id="timeout_token"  className="ml-5 mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
          min={1}/>
      </div>
    </div>
   <div className="md:w-1/3">
   <Button
            disabled={loading}
            className={`bg-blue-500 hover:bg-blue-700 text-white mr-4`}
          >
            {loading && <i className="fa fa-circle-notch fa-spin mr-2" />}{" "}
            Save
          </Button>
   </div>
     
   
  </form>
  );
}
  export default SessionTimeout;