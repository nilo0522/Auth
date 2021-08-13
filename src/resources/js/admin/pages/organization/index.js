import React, { useState } from "react";
import DataTable from "~/Layout/DataTable";


const columns = {
  
  company: {
    label: "Organization",
    
  
      },
      email: {
        label: "Email",
        
      
          },
          contact: {
            label: "Contact",
            
          
              },
};

const title = {
  singular: "Organization",
  plural: "Organizations"
};


const Permissions = () => (
  <DataTable
    columns={columns}
    endpoint="/api/organization"
    title={title}
    editLink="/organization/edit"
    options={{
      order: "asc",
      sort: "created_at"
    }}
  />
);

export default Permissions;
