import { useNavigate } from "react-router-dom";

const Navbar =()=>{
    const navigate = useNavigate();
    const Logout=()=>{
        axios.post(`/api/logout`).then(res=>{
            if (res.data.status===200){
                localStorage.removeItem('token');
                navigate("/");
            }
        })
    }
    return(
        <nav className="navbar navbar-expand-lg navbar-light" style={{'backgroundColor':'#d4d4d4'}}>
        <div className="container-fluid">
          <a className="navbar-brand" href="#">پنل مدیریت سایت</a>
            <button onClick={Logout} className='btn btn-danger'>خروج</button>
        </div>

      </nav>
    )
}

export default Navbar
