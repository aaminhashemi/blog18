import React, {useState} from "react";
import {useEffect } from 'react';
import { Route, Navigate } from "react-router-dom";
import Main from "./Components/Main";
import axios from "axios";

const AdminRoute=()=>{
    const[isAuthenticated,setIsAuthenticated] =useState(true);
   /* useEffect(() => {
        const getChecked=async () => {
            const res = await axios.post(`/api/check`);
            if(res.data.status===200){
                setIsAuthenticated(true);
            }else{
                setIsAuthenticated(false);
            }
            //console.log(isAuthenticated)
        };
        getChecked();
    }, [isAuthenticated]);*/
    return isAuthenticated ? <Main/> : <Navigate to='/' />
}
export default AdminRoute;
