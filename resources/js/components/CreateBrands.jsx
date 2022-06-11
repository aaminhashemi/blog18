import React,{useEffect,useState} from "react";
import {useHistory} from "react-router-dom";
import Swal from "sweetalert2";

const CreateBrands = () => {
    //const history = useHistory();
    const [picture, setPicture] = useState([]);
    const [loading, setLoading] = useState(true);
    const [categoriesList, setCategoriesList] = useState([]);
    const [createInput, setCreateInput] = useState({
        name: '',
        category_id: '',
        errors_list: []

    });
    const inputSetter=(e)=>{
        setCreateInput({...createInput, [e.target.name]: e.target.value})
    }
    useEffect(() => {
        axios.get(`/api/categories`).then(res => {
            if (res.data.status === 200) {
                setCategoriesList(res.data.categories);
                setLoading(false);
            }
        })
    }, []);
    var categories = '';
    if (loading) {
        categories = ''
    } else {
        categories = categoriesList.map((item, index) => {
            return (
                <option key={item.id} value={item.id}>{item.name}</option>
            )
        })
    }

    const handleImage = (e) => {
        setPicture({image: e.target.files[0]})
    };
    const submit = (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('file', picture.image);
        formData.append('name', createInput.name);
        formData.append('status', createInput.status);
        axios.post(`/api/brands/create`, formData).then(res => {
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


    return(
     <div className='col-lg-6 mx-0 my-0 px-2 py-2' style={{'backgroundColor':'white'}}>
         <div className="card row col-lg-12 mx-1">
             <div className="card-body">
                 <h5 className="card-title">افزودن برند جدید</h5>
         <form onSubmit={submit} method='post' className='col-lg-6'>
             <div className="mb-3 row">
                 <label  className="col-sm-3 col-form-label">نام برند</label>
                 <div className="col-sm-9">
                     <input type="text" name='name' className="form-control"
                            value={createInput.name} onChange={inputSetter} />
                 </div>
             </div>
             <div className="mb-3 row">
                 <label  className="col-sm-3 col-form-label">وضعیت</label>
                 <div className="col-sm-9">
                     <label>
                         فعال
                         <input type='radio' name='status' value='active' onChange={inputSetter}/>
                     </label>
                     <label>
                         غیر فعال
                         <input type='radio' name='status' value='inactive' onChange={inputSetter}/>
                     </label>
                 </div>
             </div>
             <div className="mb-3 row">
                 <label  className="col-sm-2 col-form-label">تصویر</label>
                 <div className="col-sm-10">
                     <input type="file" className="form-control"  name='image' onChange={handleImage} />
                 </div>
             </div>

             <div className="mb-3 row">
                 <div className="col-lg-2"></div>
                 <div className="col-lg-2">
                     <button  className="btn btn-success" >افزودن</button>
                 </div>
             </div>
         </form>
             </div>
         </div>

     </div>
    )
}

export default CreateBrands;
