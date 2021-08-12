import React ,{useState,useEffect} from 'react'
import { Select2 } from "select2-react-component"
import api from '../../api'
import Select from 'react-select';
import Card from '@material-ui/core/Card';
import CardContent from '@material-ui/core/CardContent';
const TimeZone = () =>

{
  
  const [load,isLoad] = useState(false)
  const [data,setData] = useState([])
  const [timezone,setTimeZone] = useState('')
  const [timezone_date,setTD] = useState('')
   useEffect(() => {
    const fetchData = async () => {
      const {data} = await axios.get(`/api/timezone`)
      setData(data.attr)
      setTimeZone(data.timezone)
      setTD(data.date)
      isLoad(true)
    }
    fetchData()
   }, [])
   const handleSelect = (e) => 
   {
       if(e)
       {
         
         setTimeZone(e.value)
        const formdata =  new FormData()
        formdata.append('timezone',e.value)
        api.setTimeZone(formdata).then(res=>{
            setTD(res.data.date)
        })
        
       }
        else{
          setTimeZone(timezone)
        }
      
      
     

    
   }
 useEffect(() => {
  console.log("time->",timezone_date)
 }, [timezone_date])
  
   if(load)
   {
    return (<div style={{ width: '500px' }}>
    
   <Card  className="mb-2 font-bold">
      <CardContent >
         <h1>{timezone_date}</h1>
      </CardContent>
     
    </Card>
   <Select
          className="basic-single"
          classNamePrefix="select"
          defaultValue={timezone}
          isClearable
          isSearchable={true}
          name="color"
          onChange ={handleSelect}
          options={data.option}
        />
         
  </div>)
   }else{
    return (<div style={{ width: '500px' }}>
    loading
 </div>)
   }
  
  
}
export default TimeZone;
