import React ,{useState,useEffect} from 'react'
import { Select2 } from "select2-react-component"
import api from '../../api'
const TimeZone = () =>

{
  const [load,isLoad] = useState(false)
  const [data,setData] = useState([])
  const [timezone,setTimeZone] = useState('')
   useEffect(() => {
    const fetchData = async () => {
      const {data} = await axios.get(`/api/timezone`)
      setData(data.attr.option)
      setTimeZone(data.time_zone.value)
      isLoad(true)
    }
    fetchData()
   }, [])
   const handleSelect = (value) => 
   {
      setTimeZone(value)
      const formdata =  new FormData()
      formdata.append('timezone',value)
      console.log(formdata)
      api.setTimeZone(formdata)
   }
   useEffect(() => {
        console.log(data);
       console.log(timezone)
      
   }, [data,timezone])
  
   if(load)
   {
    return (<div style={{ width: '500px' }}>
     <Select2 data={data}
          value={timezone}
          update={value => handleSelect(value)}>
        </Select2>
  </div>)
   }else{
    return (<div style={{ width: '500px' }}>
    loading
 </div>)
   }
  
  
}
export default TimeZone;
