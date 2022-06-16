import React,{useEffect,useState} from "react";
import {useHistory} from "react-router-dom";
import Swal from "sweetalert2";

const CreateUsers = () => {
    //const history = useHistory();
    const [picture, setPicture] = useState([]);
    const [loading, setLoading] = useState(true);
    const [createInput, setCreateInput] = useState({
        name: '',
        category_id: '',
        errors_list: []

    });
    const inputSetter=(e)=>{
        setCreateInput({...createInput, [e.target.name]: e.target.value})
    }
    useEffect(() => {
        axios.get(`/api/category/list`).then(res => {
            if (res.data.status === 200) {
                setCategoriesList(res.data.categories);
                setLoading(false);
            }
        })
    }, []);
    var categories = '';

    const submit = (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('file', picture.image);
        formData.append('name', createInput.name);
        formData.append('category_id', createInput.category_id);
        axios.post(`/api/category/save`, formData).then(res => {
            if (res.data.status === 200) {
                Swal.fire({
                    title: 'موفقیت آمیز',
                    text: res.data.message,
                    icon: 'success',
                    confirmButtonText: 'باشه',
                    showCloseButton: true
                });
                //history.push('/home/categories');
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

    const handleImage = (e) => {
        setPicture({image: e.target.files[0]})
    };

    return(

        <>
            <div className="alert alert-primary" role="alert">
                <span style={{'textAlign': 'right', 'direction': 'rtl'}}>مسیر کاربر</span>
            </div>
            <div className='col-lg-6 mx-0 my-0 px-2 py-2' style={{'backgroundColor':'white'}}>

                <div className="card row col-lg-12 mx-1">
                    <div className="card-body">
                        <h5 className="card-title">افزودن دسته بندی جدید</h5>
                        <form onSubmit={submit} method='post' className='col-lg-12'>
                            <div className="mb-3 row">
                                <label className="col-sm-3">نام دسته بندی</label>
                                <div className="col-sm-6">
                                    <input type="text" name='name' className="form-control"
                                           value={createInput.name} onChange={inputSetter} />
                                </div>
                            </div>
                            <div className="mb-3 row">
                                <label className="col-sm-3">نام دسته بندی</label>
                                <div className="col-sm-6">
                                    <select type="text" name='category_id' className="form-control"
                                            value={createInput.category_id} onChange={inputSetter} >
                                        <option value="">ندارد</option>
                                        {categories}
                                    </select>
                                </div>
                            </div>
                            <div className="mb-3 row">
                                <label className="col-sm-3">تصویر</label>
                                <div className="col-sm-6">
                                    <input type="file" className="form-control"  name='image' onChange={handleImage} />
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
