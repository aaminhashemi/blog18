import {useState} from "react";
import {Link,useNavigate} from "react-router-dom";

const Login = () => {
    const navigate = useNavigate();
    const [createInput, setCreateInput] = useState({
        email: '',
        password: '',
        errors_list: []

    });
    const inputSetter=(e)=>{
        setCreateInput({...createInput, [e.target.name]: e.target.value})
    }
    const submit=(e)=>{
        e.preventDefault()
        axios.post(`/api/login`,createInput).then((res)=>{
            if(res.data.status===200){
                localStorage.setItem('token',res.data.token)
                navigate("/home");

            }else{
                alert(res.data.message)
            }
        })
    }
    return(
     <div className='mx-auto col-lg-6' style={{'backgroundColor':'white'}}>
         <div className='col-lg-12 mx-0 my-0 px-2 py-2 mt-5'>
             <h1 className='text-center'>فرم ورود به سایت</h1>
             <form onSubmit={submit} method='post' className='row mx-auto'>
                 <div className="mb-3 row d-flex flex-md-row">
                     <label  className="col-sm-2 col-form-label">ایمیل</label>
                     <div className="col-sm-10">
                         <input type="text" name='email' className="form-control"
                                value={createInput.email} onChange={inputSetter} />
                     </div>
                 </div>
                 <div className="mb-3 row d-flex flex-md-row">
                     <label  className="col-sm-2 col-form-label">کلمه عبور</label>
                     <div className="col-sm-10">
                         <input type="text" className="form-control"  name='password'
                                value={createInput.password} onChange={inputSetter} />
                     </div>
                 </div>
                 <div className="mb-3 row d-flex flex-md-row">
                     <Link to='/register' className='text-center'>هنوز عضو سایت نشده اید؟</Link>
                 </div>
                 <div className="mb-3 row d-flex flex-md-row">
                     <div className="col-lg-2"></div>
                     <div className="col-lg-2">
                         <button  className="btn btn-success" >ورود</button>
                     </div>
                 </div>
             </form>
         </div>
     </div>
    )
}

export default Login;
