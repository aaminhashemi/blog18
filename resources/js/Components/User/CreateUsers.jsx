import React,{useEffect,useState} from "react";
import {useHistory, useNavigate} from "react-router-dom";
import Swal from "sweetalert2";

const CreateUsers = () => {
    const navigate = useNavigate();
    const [createInput, setCreateInput] = useState({
        first_name: '',
        last_name: '',
        email: '',
        mobile: '',
        password: '',
        type: '',
        category_id: '',
        errors_list: []

    });
    const inputSetter=(e)=>{
        setCreateInput({...createInput, [e.target.name]: e.target.value})
    }

    const submit = (e) => {
        e.preventDefault();
        axios.post(`/api/user/save`, createInput).then(res => {
            if (res.data.status === 200) {
                Swal.fire({
                    title: 'موفقیت آمیز',
                    text: res.data.message,
                    icon: 'success',
                    confirmButtonText: 'باشه',
                    showCloseButton: true
                });
                navigate('/home/users');
            } else if (res.data.status === 403) {
                setCreateInput({...createInput, errors_list: res.data.validation_errors});
                Swal.fire({
                    title: 'ناموفق',
                    text: res.data.message,
                    icon: 'warning',
                    confirmButtonText: 'باشه',
                    showCloseButton: true
                });
            } else {
                setCreateInput({...createInput, errors_list: res.data.validation_errors});
            }
        })
    };

    return(

        <>
            <div className="alert alert-primary" role="alert">
                <span style={{'textAlign': 'right', 'direction': 'rtl'}}>مسیر کاربر</span>
            </div>
            <div className='col-lg-6 mx-0 my-0 px-2 py-2' style={{'backgroundColor':'white'}}>

                <div className="card row col-lg-12 mx-1">
                    <div className="card-body">
                        <h5 className="card-title">افزودن کاربر جدید</h5>
                        <form onSubmit={submit} method='post' className='col-lg-12'>
                            <div className="mb-3 row">
                                <label className="col-sm-3">نام </label>
                                <div className="col-sm-6">
                                    <input type="text" name='first_name' className="form-control"
                                           value={createInput.first_name} onChange={inputSetter} />
                                </div>
                            </div>
                            <div className="mb-3 row">
                                <label className="col-sm-3">نام خانوادگی </label>
                                <div className="col-sm-6">
                                    <input type="text" name='last_name' className="form-control"
                                           value={createInput.last_name} onChange={inputSetter} />
                                </div>
                            </div>
                            <div className="mb-3 row">
                                <label className="col-sm-3">ایمیل </label>
                                <div className="col-sm-6">
                                    <input type="text" name='email' className="form-control"
                                           value={createInput.email} onChange={inputSetter} />
                                </div>
                            </div>
                            <div className="mb-3 row">
                                <label className="col-sm-3">شماره موبایل </label>
                                <div className="col-sm-6">
                                    <input type="text" name='mobile' className="form-control"
                                           value={createInput.mobile} onChange={inputSetter} />
                                </div>
                            </div>
                            <div className="mb-3 row">
                                <label className="col-sm-3">کلمه عبور </label>
                                <div className="col-sm-6">
                                    <input type="text" name='password' className="form-control"
                                           value={createInput.password} onChange={inputSetter} />
                                </div>
                            </div>
                            <div className="mb-3 row">
                                <label className="col-sm-3">نوع</label>
                                <div className="col-sm-6">
                                    <select name='type' className="form-control"
                                            value={createInput.type} onChange={inputSetter} >
                                        <option value="user">کاربر عادی</option>
                                        <option value="admin">مدیر</option>
                                    </select>
                                </div>
                            </div>
                            <div className="mb-3 row">
                                <div className="col-lg-3"/>
                                <div className="col-lg-2">
                                    <button  className="btn btn-success" >افزودن</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </>

    )
}

export default CreateUsers;
