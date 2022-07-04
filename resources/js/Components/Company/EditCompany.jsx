import React,{useEffect,useState} from "react";
import {useNavigate,useParams} from "react-router-dom";
import Swal from "sweetalert2";

const EditCompany = () => {
    const param=useParams();
    const id=param.id;
    const navigate = useNavigate();
    const [company,setCompany]=useState([]);
    const [loading,setLoading]=useState(true);
    const [errorInput, setErrorInput] = useState({
        errors_list: []

    });
    const inputSetter=(e)=>{
        setCompany({...company, [e.target.name]: e.target.value})
    }
    useEffect(() => {
        axios.get(`/api/company/edit/${id}`).then((res) => {
            setCompany(res.data.company)
            setLoading(false)
        })

    }, [])
    const submit = (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('name', company.name);
        axios.post(`/api/company/update/${id}`, formData).then(res => {
            if (res.data.status === 200) {
                Swal.fire({
                    title: 'موفقیت آمیز',
                    text: res.data.message,
                    icon: 'success',
                    confirmButtonText: 'باشه',
                    showCloseButton: true
                });
                navigate('/home/companies')
            } else if (res.data.status === 403) {
                setCreateInput({...errorInput, errors_list: res.data.validation_errors});
                Swal.fire({
                    title: 'ناموفق',
                    text: res.data.message,
                    icon: 'warning',
                    confirmButtonText: 'باشه',
                    showCloseButton: true
                });
            } else {
                setCreateInput({...errorInput, errors_list: res.data.validation_errors});
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
                        <h5 className="card-title">افزودن شرکت جدید</h5>
                        <form onSubmit={submit} method='post' className='col-lg-12'>
                            <div className="mb-3 row">
                                <label className="col-sm-3">نام شرکت</label>
                                <div className="col-sm-6">
                                    <input type="text" name='name' className="form-control"
                                           value={company.name} onChange={inputSetter} />
                                </div>
                            </div>
                            <div className="mb-3 row">
                                <div className="col-lg-3"></div>
                                <div className="col-lg-2">
                                    <button  className="btn btn-success" >ثبت</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </>

    )
}

export default EditCompany;
