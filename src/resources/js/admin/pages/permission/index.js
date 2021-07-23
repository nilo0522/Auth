import React, { useState } from "react";
import DataTable from "~/Layout/DataTable";
import Socket_Conn from "../../../socket_con";

const columns = {
  name: {
    label: "Name"
  }
};

const title = {
  singular: "Permission",
  plural: "Permissions"
};


const Permissions = () => (
  <DataTable
    columns={columns}
    endpoint="/api/permission"
    title={title}
    editLink="/permission/edit"
    options={{
      order: "asc",
      sort: "created_at"
    }}
  />
);

export default Permissions;
