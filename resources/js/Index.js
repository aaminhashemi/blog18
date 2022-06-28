import React from "react";
import {
  BrowserRouter as Router , Routes,
  Route,useNavigate
} from "react-router-dom";
import ReactDOM from 'react-dom/client';
import {getBooks} from './data/data'
import './../../node_modules/bootstrap/dist/css/bootstrap.min.css'
import  './../../node_modules/font-awesome/css/font-awesome.min.css'
import './../css/app.css'
import Books from "./Components/Books";
import Main from "./Components/Main";
import CreateBooks from "./Components/CreateBooks";
import EditBook from "./Components/EditBook";
import Login from "./Components/Auth/Login";
import axios from "axios";
import Register from "./Components/Auth/Register";
import Categories from "./Components/Category/Categories";
import CreateCategories from "./Components/Category/CreateCategories";
import Brands from "./Components/Brand/Brands";
import CreateBrands from "./Components/Brand/CreateBrands";
import Attributes from "./Components/Attribute/Attributes";
import CreateAttributes from "./Components/Attribute/CreateAttributes";
import Permissions from "./Components/Permission/Permissions";
import CreatePermissions from "./Components/Permission/CreatePermissions";
import Roles from "./Components/Role/Roles";
import CreateRoles from "./Components/Role/CreateRoles";
import Companies from "./Components/Company/Companies";
import CreateCompanies from "./Components/Company/CreateCompanies";
import Users from "./Components/User/Users";
import CreateUsers from "./Components/User/CreateUsers";
import EditCompany from "./Components/Company/EditCompany";
import EditCategory from "./Components/Category/EditCategory";
axios.defaults.baseURL='http://127.0.0.1:8000';
axios.defaults.withCredentials = true;

axios.defaults.headers.post['Content-Type'] = 'application/json';
axios.defaults.headers.post['Accept'] = 'application/json';
axios.interceptors.request.use(function (config) {
    const token=localStorage.getItem('token');
    config.headers.Authorization=token ?`Bearer ${token}` :'';
    return config;
});

let isAuthenticated=false;
const tokenExist = localStorage.getItem('token');
if(tokenExist!==null){
    axios.post(`/api/check`).then((res)=>{
         (res.data.status===200)? isAuthenticated=true : isAuthenticated=false
    })
}else{
    isAuthenticated=false

}

function Index() {
    const book_list = getBooks();
    return (
        <Router>
            <Routes>
                <Route path="/" element={<Login/>} />
                <Route path="/register" element={<Register/>} />
                <Route path="/home" element={<Main/>} >
                <Route path="/home/books" element={<Books/>} />
                <Route path="/home/users" element={<Users/>} />
                <Route path="/home/categories" element={<Categories/>} />
                <Route path="/home/categories/:id/edit" element={<EditCategory/>} />
                <Route path="/home/companies" element={<Companies/>} />
                <Route path="/home/companies/:id/edit" element={<EditCompany/>} />
                <Route path="/home/permissions" element={<Permissions/>} />
                <Route path="/home/roles" element={<Roles/>} />
                <Route path="/home/brands" element={<Brands/>} />
                <Route path="/home/attributes" element={<Attributes/>} />
                <Route path="/home/brands/create" element={<CreateBrands/>} />
                <Route path="/home/users/create" element={<CreateUsers/>} />
                <Route path="/home/companies/create" element={<CreateCompanies/>} />
                <Route path="/home/roles/create" element={<CreateRoles/>} />
                <Route path="/home/permissions/create" element={<CreatePermissions/>} />
                <Route path="/home/attributes/create" element={<CreateAttributes/>} />
                <Route path="/home/books/create" element={<CreateBooks/>} />
                <Route path="/home/categories/create" element={<CreateCategories/>} />
                <Route path="/home/books/:id/create" element={<EditBook/>} />
                </Route>
            </Routes>
        </Router>
    );
  }
  export default Index
  if (document.getElementById('example')) {


    const root = ReactDOM.createRoot(
        document.getElementById('example')
      );
      root.render(<Index />);

}
