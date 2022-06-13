import React from 'react';
import ReactDOM from 'react-dom';
import Books from './Books'
import {getBooks} from './../data/data'
import './../../../node_modules/bootstrap/dist/css/bootstrap.min.css'
function Example() {
    const book_list = getBooks();

    return (
        <div>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="#">Home</a>
        <a class="nav-link" href="#">Features</a>
        <a class="nav-link" href="#">Pricing</a>
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </div>
    </div>
  </div>
</nav>
<div className="App">
     
      <div className='container row'>
        <div className='sidebar mr-0 col-lg-2 border d-flex align-items-start d-block' style={{'height': 90+'vh'}}>
          <ul className='mt-5 w-100 px-0 mx-0 list-group'>
            <li  style={{'listStyle': 'none'}} data-bs-toggle="collapse"
             data-bs-target="#collapseExample" aria-expanded="false" 
             aria-controls="collapseExample"> <p> کتاب ها <span className='fa fa-list'></span></p></li>
            <ul className="collapse row" id="collapseExample">
              <li className="col-lg-12 px-0 mx-0 w-100" style={{'listStyle': 'none','width':100+'%'}}>
                <p className='d-block'>لیست کتاب ها</p>
              </li>
            </ul>
            <li style={{'listStyle': 'none'}} className=''>آیتم دوم</li>
            <li style={{'listStyle': 'none'}} className=''>آیتم سوم</li>
            <li style={{'listStyle': 'none'}} className=''>آیتم چهارم</li>
            <li style={{'listStyle': 'none'}} className=''>آیتم پنجم</li>
          </ul>
          
        </div>
        <Books books={book_list}/>
      </div>
    </div>
    </div>
    );
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
