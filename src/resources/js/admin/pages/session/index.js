import React, { useRef,useState,useEffect } from "react";
import { Button, Form } from "~/components";
import { NavLink } from "react-router-dom";
import { formSubmit } from "~/helpers/utilities";
import TextField from '@material-ui/core/TextField';
import FormControl from '@material-ui/core/FormControl';
import { makeStyles } from '@material-ui/core/styles';
import InputLabel from '@material-ui/core/InputLabel';
import Select from '@material-ui/core/Select';
import MenuItem from '@material-ui/core/MenuItem';
const SessionTimeout = () =>
{
    
const useStyles = makeStyles((theme) => ({
  formControl: {
    margin: theme.spacing(1),
    minWidth: 120,
  },
  selectEmpty: {
    marginTop: theme.spacing(2),
  },
}));
    const classes = useStyles();
    const [errors, setErrors] = useState({});
    const form = useRef(null);
    const [loading, setLoading] = useState(false);
    const [setting, setSetting] = useState([]);
    const [isloading, setIsLoading] = useState(false);
    const [dt,setDt] = useState([])
    const [opt_value,setOptinValue] = useState(0); 
    const [time_value,setTime] = useState(0)
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
         
          setSetting(data.setting)
          setDt(data.option.option)
          setTime(data.setting.time)
          setOptinValue(data.setting.value)
         
        setIsLoading(true)
        
      
       
      };
      fetchData();
    },[])

 const handleTime = (e) =>
 {
      setTime(e)
 }
 const handleChange = (e) =>
 {
      setOptinValue(e.target.value)
 }
return(
    <form className="w-full max-w-sm" ref={form} onSubmit={handleSubmit}>
    <div className="md:flex md:items-center mb-6">
      <div className="md:w-1/2 ml-3 mr-3">
        <label className="block text-black-500 font-bold md:text-right mb-1 md:mb-0 " htmlFor="inline-full-name">
          Session Expired In
        </label>
      </div>
     
      <div className="">
      <TextField
          name="timeout"
          id="outlined-number"
          label="Time-out"
          type="number"
          InputProps={{
            inputProps: { 
                 min: 1 
            }
        }}
          InputLabelProps={{
            shrink: true,
          }}
          variant="outlined"
          value={time_value}
          onChange ={e=>handleTime(e.target.value)}
        />
         
          

      </div>
      
      <FormControl variant="outlined" className={classes.formControl}>
      <InputLabel id="demo-simple-select-outlined-label">Time</InputLabel>
      <Select
         name="time"
        labelId="demo-simple-select-outlined-label"
        id="demo-simple-select-outlined"
        value={opt_value}
        onChange={handleChange}
        label="Time"
      >
       
       <MenuItem   value={0}>NONE</MenuItem>
       { dt.map((opt,i)=>{
          return( <MenuItem key={i} value={opt.value}>{opt.text}</MenuItem>)
         })
       }
       
      </Select>
    </FormControl>
      

    
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