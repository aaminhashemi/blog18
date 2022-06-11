import React from "react";
import {
  BrowserRouter as Router , Routes,
  Route,
} from "react-router-dom";
import ReactDOM from 'react-dom/client';
import {getBooks} from './data/data'
import './../../node_modules/bootstrap/dist/css/bootstrap.min.css'
import  './../../node_modules/font-awesome/css/font-awesome.min.css'
import './../css/app.css'
import Books from "./components/Books";
import Main from "./components/Main";
import CreateBooks from "./components/CreateBooks";
import EditBook from "./components/EditBook";
import Login from "./components/Login";
import axios from "axios";
import Register from "./components/Register";
import Categories from "./components/Categories";
import CreateCategories from "./components/CreateCategories";
import Brands from "./components/Brands";
import CreateBrands from "./components/CreateBrands";
import Attributes from "./components/Attributes";
import CreateAttributes from "./components/CreateAttributes";
import Permissions from "./components/Permissions";
import CreatePermissions from "./components/CreatePermissions";
import Roles from "./components/Roles";
import CreateRoles from "./components/CreateRoles";
axios.defaults.baseURL='http://127.0.0.1:8000';
axios.defaults.withCredentials = true;

axios.defaults.headers.post['Content-Type'] = 'application/json';
axios.defaults.headers.post['Accept'] = 'application/json';
axios.interceptors.request.use(function (config) {
    const token=localStorage.getItem('token');
    config.headers.Authorization=token ?`Bearer ${token}` :'';
    return config;
});

function Index() {
    const book_list = getBooks();
    return (
        <Router>
            <Routes>
                <Route path="/" element={<Login/>} />
                <Route path="/register" element={<Register/>} />
                <Route path="/home" element={<Main/>} >
                <Route path="/home/books" element={<Books/>} />
                <Route path="/home/categories" element={<Categories/>} />
                <Route path="/home/permissions" element={<Permissions/>} />
                <Route path="/home/roles" element={<Roles/>} />
                <Route path="/home/brands" element={<Brands/>} />
                <Route path="/home/attributes" element={<Attributes/>} />
                <Route path="/home/brands/create" element={<CreateBrands/>} />
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
