import React, { useState } from "react";
import DataTable from "~/Layout/DataTable";


const columns = {
  
  name: {
    label: "Name",
    
  
      },
      client_id: {
        label: "Client Id",
        
      
          },
          secret_key: {
            label: "Secret Key",
            
          
              },
};

const title = {
  singular: "Paypal",
  plural : "Paypal Account"
};


const Paypals = () => (
  <DataTable
    className = "table-responsive"
    columns={columns}
    endpoint="/api/paypal"
    title={title}
    editLink="/paypal/edit"
    options={{
      order: "asc",
      sort: "created_at"
    }}
  />
);

export default Paypals;
