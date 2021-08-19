import React,{useState,useEffect} from "react";
import { PayPalButton } from "react-paypal-button-v2";
import { toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
const Test = () => {
   
  const [client_id,setClientId] = useState("");
  const [currency,setCurrency] =useState("");
  useEffect(() => {
    const fetchData = async () => {
      const { data } = await axios.get(`/api/paypal-credentials`);
      
      setCurrency(data.currency)
      setClientId(data.clientId)
      
    };
    fetchData();
  }, []);

  if(!client_id) return null;
    return (
      <PayPalButton
        amount="10"
        // shippingPreference="NO_SHIPPING" // default is "GET_FROM_FILE"
        onSuccess={(details, data) => {
          //alert("Transaction completed by " + details.payer.name.given_name);
          toast("Success! Check email for details" + details.payer.name.given_name, { type: "success" });
          // OPTIONAL: Call your server to save the transaction
          return fetch("/paypal-transaction-complete", {
            method: "post",
            body: JSON.stringify({
              orderId: data.orderID
            })
          });
        }}
        options={{
          clientId:client_id,
          currency: currency
        }}
      />
    );
  
}
export default Test;