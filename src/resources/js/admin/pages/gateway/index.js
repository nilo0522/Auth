import React ,{useState,useEffect} from 'react'
import api from '../../api'
import Select from 'react-select';

const Gateway = () =>

{
  


  const [gateway,setGateway] = useState([])
  const [currency,setCurrency] = useState('')
  const [gateway_option,setGatewayOption] = useState([])
  const [currency_option,setCurrencyOption] = useState([])
  const [isFetching,setIsFetching] = useState(true)
   useEffect(() => {
    const fetchData = async () => {
      const {data} = await axios.get(`/api/gateway`)
      setGateway(data.gateway)
      setGatewayOption(data.gateway_option.option)
      setCurrency(data.currency)
      setCurrencyOption(data.currency_option.option)
      setIsFetching(false)
    }
    fetchData()
   }, [])
   const handleSelect = (e) => 
   {
     if(e)
     {
       console.log(e.value)
        setGateway(e.value)
        const formdata =  new FormData()
        formdata.append('gateway',e.value)
        api.Gateway(formdata);
      }
   }
   const handleSelect2 = (e) => 
   {
     if(e)
     {
       console.log(e.value)
        setCurrency(e.value)
        const formdata =  new FormData()
        formdata.append('currency',e.value)
        api.Gateway(formdata);
      }
   }

  if(isFetching) return null;
    return (<div style={{ width: '500px' }}>
    
      <div className="mb-4">
      <label className="block text-gray-700 text-sm font-bold mb-2" >
        Payment Gateway
      </label>
      <Select
          className="basic-single"
          isClearable
          isSearchable={true}
          defaultInputValue={gateway}
          onChange ={handleSelect}
          options={gateway_option}
        />
    </div>
    <div className="mb-4">
      <label className="block text-gray-700 text-sm font-bold mb-2" >
       Currency
      </label>
      <Select
          className="basic-single"
          isClearable
          isSearchable={true}
          defaultInputValue={currency}
          onChange ={handleSelect2}
          options={currency_option}
        />
    </div>
      
 
        
  </div>)
  
  
  
}
export default Gateway;
