import React, {useEffect, useState} from "react"
import {Link, Outlet} from "react-router-dom"
import Navbar from "./Navbar"
import Sidebar from "./Sidebar"
import LoginError from "./Auth/LoginError";

const Main = () => {
    const handleErrorResponse = (error) => {
        let errorResponse;
        if(error.response && error.response.data) {
            // I expect the API to handle error responses in valid format
            errorResponse = error.response.data;
            // JSON stringify if you need the json and use it later
        } else if(error.request) {
            // TO Handle the default error response for Network failure or 404 etc.,
            errorResponse = error.request.message || error.request.statusText;
        } else {
            errorResponse = error.message;
        }
        throw new Error(errorResponse);
    }
    const[menu,setMenu]=useState([])
    useEffect(()=>{
        axios.get(`/api/menu`).then((res)=>{
            setMenu(res.data.menu)
        }).catch(function (error) {
            var err=error.toJSON();
            console.log(err.status)
        });
    },[])
    return (
        <div>
            <Navbar/>
            <div className="App">
                <div className='container-fluid row px-0'>
                    <div className='col-lg-2 mx-0' style={{'backgroundColor':'#f6f6f8'}} >
                    <Sidebar menu={menu} />
                    </div>
                    <div className='col-lg-10 mx-0 my-0 px-2 py-2' style={{'backgroundColor':'#fff'}}>
                        <Outlet style={{'backgroundColor':'#fff'}} />
                    </div >
                </div>
            </div>
        </div>
    )
}

export default Main
