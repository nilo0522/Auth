import React, { useRef,useState,useEffect } from "react";
import { Button, Form } from "~/components";
import { NavLink } from "react-router-dom";
import { formSubmit } from "~/helpers/utilities";
import TimePicker from 'react-time-picker';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import Checkbox from '@material-ui/core/Checkbox';
import api from "../../api"; 
import axios from 'axios'
import swal from 'sweetalert';

const Email = () =>
{

    const [errors, setErrors] = useState({});
    const form = useRef(null);
    const [loading, setLoading] = useState(false);
    const [setting, setSetting] = useState([]);
    const [isloading, setIsLoading] = useState(false);
    const [email_time, setEmailTime] = useState('12:00');
    const [checked,setChecked] = useState([])
    
    const [days,setDays] = useState([]);

    
     
    const handleChange = (e) => {
      let check = [...days]
      let all = true
      if(e.target.value === "Everyday")
      {
        
        check.map(row=>{
          if(e.target.checked == true)
          {
            row.checked = true
          }else
          {row.checked = false}
          
        })
      }else
      {
        
    check.map(row=>{
           

           if(row.name === e.target.value){
               row.checked = e.target.checked
             
            }else
            {
              if(row.name =="Everyday")
               row.checked = false
            }
            if(row.checked == false && row.name !="Everyday")
            {
              all = false
              
            }
           
     })
  
      if(all)
      {
        
        check.map(e=>{
          if(e.name === "Everyday")
           e.checked = true
        })
      }
    }
      setDays(check)
      
    };
   
    const handleSubmit = async evt => {
      evt.preventDefault();
      let formdata = new FormData();
        formdata.append('email_time',email_time)
        days.map(row=>{
          if(row.checked)
          {
            formdata.append('days[]',row.name)
          }
         
        })
     
     // window.loadingStatus = `Saving data...`;
      setLoading(true);
  
     /* let errors = await formSubmit(
        `post`,
        `/api/mail`,
        formdata,
        `Email schedule successfully save`,
        //`/admin/mail`
      );*/
      api.setEmailSchedule(formdata)
      setLoading(false);
      swal("Schedule save successfully!", "Ok!", "success");
      //setErrors(errors || {});
    };
  
    useEffect(() => {
      const fetchData = async () => {
        const {data} = await axios.get(`/api/mail`)
      
          setSetting(data.setting)
          setChecked(JSON.parse(data.setting.value))
       
          setIsLoading(true)
          setEmailTime(data.setting.time)
          let check = data.attr
          
          check.map(row=>{
            if(data.setting.value !=null)
            {
            JSON.parse(data.setting.value).map(row2=>{                   
                if(row.name == row2)
                {row.checked =true   }
              })}})
            

           setDays(check)
      };
      fetchData();
    },[])
    
 

    
return(
  <div className="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
  <div className="relative py-3 sm:max-w-xl sm:mx-auto">
    <div className="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
      <div className="max-w-md mx-auto">
        <div className="flex items-center space-x-5">
          <div className="h-14 w-14 bg-yellow-200 rounded-full flex flex-shrink-0 justify-center items-center text-yellow-500 text-2xl font-mono"><i className="fa fa-clock"></i></div>
          <div className="block pl-2 font-semibold text-xl self-start text-gray-700">
            <h2 className="leading-relaxed">Set Email Schedule</h2>
            <p className="text-sm text-gray-500 font-normal leading-relaxed">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
          </div>
        </div>
        <div className="divide-y divide-gray-200">
          
          <div className="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
            <div className="flex flex-col">
              <label className="leading-loose">Set Time</label>
              <TimePicker
                onChange={setEmailTime}
                value={email_time}
              />
            </div>
            <div className="flex flex-col">
              <label className="leading-loose">Repeat</label>
              {isloading  && days.map((check,index)=>{
                return  (<FormControlLabel
                key={index}
                control={<Checkbox onChange={handleChange} value={check.name} checked={check.checked}  />}
                label={check.name}
               
              />)
              })}
              </div>
              </div>
              <div className="pt-4 flex items-center space-x-4">
                <button onClick={handleSubmit} className="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">Save</button>
          </div>
         
        </div>
      </div>
    </div>
  </div>
</div>
  

  );
}

  export default Email;