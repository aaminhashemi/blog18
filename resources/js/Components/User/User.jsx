import React, {useState} from 'react';
import {Link} from "react-router-dom";
import Swal from "sweetalert2";
import parse from 'html-react-parser';


const User = ({item, roles}) => {

    const [selectedUser,setSelectedUser]=useState()
    const [createInput, setCreateInput] = useState({
        role: '',
        errors_list: []

    });
    const inputSetter=(e)=>{
        setCreateInput({...createInput, [e.target.name]: e.target.value})
    }
    let options = ''

    options = roles.map((item, index) => {
        return <option key={index} value={item.name}>
            {item.name}
        </option>
    })

    const setUser=(id)=>{
        setSelectedUser(id)
    }
    const submit = (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('role', createInput.role);
        formData.append('user_id', selectedUser);
        axios.post(`/api/user/add_role`, formData).then(res => {
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

    return (
        <>
            <tr>
                <td>{item.first_name} </td>
                <td>{item.last_name} </td>
                <td>{parse(item.role)} </td>
                <td>
                    <button type="button" className="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#assign_role" onClick={(e)=>setUser(item.id)} >
                        اختصاص نقش کاربری
                    </button>
                </td>
                <td><Link className='fa fa-edit fa-2x' to={`/home/users/${item.id}/edit`}></Link></td>
            </tr>
            <div className="modal fade rtl" id="assign_role" tabIndex="-1" aria-labelledby="assign_role_label"
                 aria-hidden="true">
                <div className="modal-dialog">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h5 className="modal-title" id="assign_role_label">اختصاص نقش</h5>
                            <button type="button" className="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <form onSubmit={submit}>
                            <div className="modal-body">
                                <div className='row'>
                                    <label className='col-lg-3'>نقش ها</label>
                                    <div className='col-lg-9'>
                                        <select className='form-control' name='role' onChange={inputSetter}>
                                            <option>لطفا نقش مورد نظر را انتخاب کنید.</option>
                                            {options}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div className="modal-footer">
                                <button type="button" className="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" className="btn btn-primary" type='submit'>ذخیره</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </>
    )
}

export default User;
