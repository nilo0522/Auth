import React, { useState } from "react";
import DataTable from "~/Layout/DataTable";


const columns = {
  
  name: {
    label: "Name",
    
  
      },
      pub_key: {
        label: "Publishable Key",
        
      
          },
          secret_key: {
            label: "Secret Key",
            
          
              },
};

const title = {
  singular: "Stripe",
  plural : "Stripe Account"
};


const Stripe = () => (
  <DataTable
    className = "table-responsive"
    columns={columns}
    endpoint="/api/stripe"
    title={title}
    editLink="/stripe/edit"
    options={{
      order: "asc",
      sort: "created_at"
    }}
  />
);

export default Stripe;
