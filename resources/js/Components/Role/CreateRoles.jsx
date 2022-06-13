import React, {useEffect, useState} from "react";
import {useHistory} from "react-router-dom";
import Swal from "sweetalert2";

const CreateRoles = () => {
    //const history = useHistory();

    const [loading, setLoading] = useState(true);
    let selectedPermissions = [];
    const [permissionsList, setPermissionsList] = useState([]);
    const [createInput, setCreateInput] = useState({
        name: '',
        errors_list: []

    });
    useEffect(() => {
        axios.get(`/api/permission/list`).then(res => {
            if (res.data.status === 200) {
                setPermissionsList(res.data.permissions);
                setLoading(false);
            }
        })
    }, []);
    const checkbox = (e) => {
        if(e.target.checked){
            selectedPermissions.push(e.target.value);
        }else{
            selectedPermissions = selectedPermissions.filter(item => item !== e.target.value)
            //selectedPermissions.splice(index, selectedPermissions.indexOf(e.target.value));
        }
        console.log(selectedPermissions)
        //setCreateInput({...createInput, [e.target.name]: e.target.value})
    }
    var permissions = '';
    if (loading) {
        permissions = ''
    } else {
        permissions = permissionsList.map((item, index) => {
            return (
                <div key={item.id}>
                    <input type="checkbox" id={item.name} name="permission" value={item.name} onChange={checkbox}/>
                    <label htmlFor={item.name}> {item.name}</label><br/>
                </div>
            )
        })
    }
    const inputSetter = (e) => {
        setCreateInput({...createInput, [e.target.name]: e.target.value})
    }


    const submit = (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('title', createInput.name);
        //formData.append('permissions[]', selectedPermissions);
        selectedPermissions.forEach(function(value) {
            formData.append("permissions[]", value) // you have to add array symbol after the key name
        })
        axios.post(`/api/role/save`, formData).then(res => {
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

    return (

        <>
            <div className="alert alert-primary" role="alert">
                <span style={{'textAlign': 'right', 'direction': 'rtl'}}>مسیر کاربر</span>
            </div>
            <div className='col-lg-6 mx-0 my-0 px-2 py-2' style={{'backgroundColor': 'white'}}>

                <div className="card row col-lg-12 mx-1">
                    <div className="card-body">
                        <h5 className="card-title">افزودن دسترسی</h5>
                        <form onSubmit={submit} method='post' className='col-lg-12'>
                            <div className="mb-3 row">
                                <label className="col-sm-3">نام نقش</label>
                                <div className="col-sm-6">
                                    <input type="text" name='name' className="form-control"
                                           value={createInput.name} onChange={inputSetter}/>
                                </div>
                            </div>
                            <div className="mb-3 row">
                                <label className="col-sm-3">دسترسی ها</label>
                                <div className="col-sm-6">
                                    {permissions}
                                </div>
                            </div>
                            <div className="mb-3 row">
                                <div className="col-lg-3"></div>
                                <div className="col-lg-2">
                                    <button className="btn btn-success">افزودن</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </>

    )
}

export default CreateRoles;
