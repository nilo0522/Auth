import React,{useState,useEffect} from "react";
import ReactDOM from "react-dom";
import StripeCheckout from "react-stripe-checkout";
import axios from "axios";
import { toast } from "react-toastify";
import api from "../../api"; 
import "react-toastify/dist/ReactToastify.css";
import "./styles.css";

toast.configure();

function Test() {
  const [product] = React.useState({
    name: "Tesla Roadster",
    price: 64998.67,
    description: "Cool car"
  });
  const [pub_key,setPubkey] = useState("");
  const [isfetching,setIsFetching] = useState(true);
  const isPayment = true;
  const amount =  product.price *100
  async function handleToken(token) {
    const response = await api.Payment({token,product,isPayment,amount});
    const { status } = response.data;
    
    console.log("Response:", response.data);
    if (status === "success") {
      toast("Success! Check email for details", { type: "success" });
    } else {
      toast("Something went wrong", { type: "error" });
    }
  }
  
  useEffect(() => {
    const fetchData = async () => {
      const { data } = await axios.get(`/api/stripe-pub-key`);
      
      setIsFetching(false);
      setPubkey(data)
      
    };
    fetchData();
  }, []);
  if(isfetching) return null
  return (
    <div className="container">
      <div className="product">
        <h1>{product.name}</h1>
        <h3>On Sale · ₱{product.price}</h3>
      </div>
      <StripeCheckout
        stripeKey={pub_key}
        token={handleToken}
        amount={amount}
        name="Tesla Roadster"
        billingAddress
        shippingAddress
        currency ="PHP"
        
      />
    </div>
  );
}
export default Test
