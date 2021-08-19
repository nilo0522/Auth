import React, { useEffect, useState } from "react";
import { Link, NavLink } from "react-router-dom";
import { ProSidebar, Menu, MenuItem, SubMenu } from 'react-pro-sidebar';
import 'react-pro-sidebar/dist/css/styles.css';
const roles_permission_links = [
  { to: "/roles", title: "Roles" },
  { to: "/permissions", title: "Permission" },
  { to: "/roles-permissions", title: "Assign Roles Permission" },
 
];
import { IoApps } from "react-icons/io5";
import { MdGavel } from "react-icons/md";
import { FaMoneyCheck,FaPaypal,FaCheckCircle,FaCcStripe,FaCogs,FaMoneyCheckAlt,FaRegClock } from "react-icons/fa";
import { RiMailSettingsLine,RiBuilding2Line } from "react-icons/ri";
import { CgGlobeAlt } from "react-icons/cg";

const Sidebar = () => {
  const [resource, setResource] = useState([]);
  const [user,setUser] = useState([]);
  const [isLoad,setLoad] = useState(false);
  useEffect(() => {
    const fetchData = async () => {
      const { data } = await axios.get("/api/resource");
      setResource(data);
      await axios.get("/api/setting").then(res => {

        setUser(res.data);
      setLoad(true)
      
      })
      
    };
    fetchData();
  }, []);

  return (
    <div className="w-100 bg-gray-700 border-r">
      <div className="bg-gray-800 border-b-2 border-gray-800 flex items-center px-8 py-3 text-white">
        <img className="h-8 w-8 mr-3" src="img/logo.svg" />
        <span className="font-bold mr-2 text-lg">Laravel</span>
        <span className="text-lg">Fligno</span>
      </div>
    <ProSidebar className="w-64" breakPoint="sm">
  <Menu iconShape="circle" className="px-2 py-4 text-gray-300 ">
    
    <SubMenu icon={<IoApps/>} title="Resource" >
     
      {resource.map(resource => (
         <MenuItem  key={resource.slug}>
            <NavLink
             
              to={`/resource/${resource.slug}`}
              activeClassName="font-bold text-white"
              className="flex items-center ml-3 py-1"
            >
              {resource.title}
            </NavLink>
            </MenuItem>
          ))}
      
    </SubMenu>
    <SubMenu icon={<MdGavel/>} title="Roles and Permission" >
     
    {roles_permission_links.map(link => (
      <MenuItem  key={link.to}>
            <NavLink
             
              to={link.to}
              activeClassName="font-bold text-white"
              className="flex items-center ml-3 py-1"
            >
              {link.title}
            </NavLink>
            </MenuItem>
          ))}
     
   </SubMenu>
    {//Payment Management ->leave this comment
<SubMenu icon={<FaMoneyCheck/>} title="Payment Management" >
        <MenuItem>
         <NavLink   
              to="/paypal"
              activeClassName="font-bold text-white"
              className="flex items-center ml-3 py-1"
              > <span className="mr-2"><FaPaypal/></span> Paypal
             </NavLink>
         </MenuItem>
         <MenuItem>
       
         <NavLink
              to="/test-paypal"
              activeClassName="font-bold text-white"
              className="flex items-center ml-3 py-1">
                 <span className="mr-2"><FaCheckCircle/></span>Test Paypal
             </NavLink>
      </MenuItem>
      <MenuItem>
           <NavLink
              to="/stripe"
              activeClassName="font-bold text-white"
              className="flex items-center ml-3 py-1">
                 <span className="mr-2"><FaCcStripe/></span>Stripe
             </NavLink>
        </MenuItem>
        <MenuItem>
       
         <NavLink
              to="/test-stripe"
              activeClassName="font-bold text-white"
              className="flex items-center ml-3 py-1">
                 <span className="mr-2"><FaCheckCircle/></span>Test Stripe
             </NavLink>
      </MenuItem>
      </SubMenu>
    }

    
    <SubMenu icon={<FaCogs/>} title = {"Settings"}>
       
        <MenuItem>
           <NavLink
              to="/session-setting"
              activeClassName="font-bold text-white"
              className="flex items-center ml-3 py-1"
            > <span className="mr-2"><FaRegClock/></span>Session
            </NavLink>
        </MenuItem>
        <MenuItem>
        <NavLink
              to="/mail"
              activeClassName="font-bold text-white"
              className="flex items-center ml-3 py-1"
            ><span className="mr-2"><RiMailSettingsLine/></span>Mail
            </NavLink>
        </MenuItem>
        <MenuItem>
        <NavLink
              to="/organization"
              activeClassName="font-bold text-white"
              className="flex items-center ml-3 py-1"
            ><span className="mr-2"><RiBuilding2Line/></span>Organization
            </NavLink>
        </MenuItem>
        <MenuItem>
        <NavLink
              to="/timezone"
              activeClassName="font-bold text-white"
              className="flex items-center ml-3 py-1"
            ><span className="mr-2"><CgGlobeAlt/></span>
              Time Zone
            </NavLink>
        </MenuItem>
        {
          //Gateway ->leave this comment
<MenuItem>
        <NavLink
         to="/gateway"
         activeClassName="font-bold text-white"
         className="flex items-center ml-3 py-1">
            <span className="mr-2"><FaMoneyCheckAlt/></span>Gateway
        </NavLink>
      </MenuItem>
        }
   </SubMenu>
  </Menu>
  </ProSidebar>
</div>
    
  );
};

export default Sidebar;
