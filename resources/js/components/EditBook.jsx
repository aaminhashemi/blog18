import {useState} from "react";
import {useParams} from "react-router-dom";

const EditBook = () => {
    let { id } = useParams();
    const [createInput, setCreateInput] = useState({
        name: '',
        publisher: '',
        count: '',
        date: '',
        writer: '',
        errors_list: []

    });
    const inputSetter=(e)=>{
        setCreateInput({...createInput, [e.target.name]: e.target.value})
    }
    const submit=(e)=>{
        e.preventDefault()
        axios.post(`/api/books/create`,createInput).then((res)=>{
            if(res.data.status===200){
                alert('ok')
            }else{
                alert('خطا')
            }
        })
    }
    return(
     <div>
         <div className="alert alert-primary" role="alert">
             <span style={{'textAlign': 'right', 'direction': 'rtl'}}>مسیر کاربر</span>
         </div>
         <form onSubmit={submit} method='post' className='col-lg-6'>
             <div className="mb-3 row">
                 <label  className="col-sm-2 col-form-label">نام کتاب</label>
                 <div className="col-sm-10">
                     <input type="text" name='name' className="form-control"
                            value={createInput.name} onChange={inputSetter} />
                 </div>
             </div>
             <div className="mb-3 row">
                 <label  className="col-sm-2 col-form-label">نام ناشر</label>
                 <div className="col-sm-10">
                     <input type="text" className="form-control"  name='publisher'
                            value={createInput.publisher} onChange={inputSetter} />
                 </div>
             </div>
             <div className="mb-3 row">
                 <label  className="col-sm-2 col-form-label">نام نویسنده</label>
                 <div className="col-sm-10">
                     <input type="text" className="form-control" name='writer'
                            value={createInput.writer} onChange={inputSetter}/>
                 </div>
             </div>
             <div className="mb-3 row">
                 <label  className="col-sm-2 col-form-label">تعداد</label>
                 <div className="col-sm-10">
                     <input type="text" className="form-control" name='count'
                            value={createInput.count} onChange={inputSetter} />
                 </div>
             </div>
             <div className="mb-3 row">
                 <label  className="col-sm-2 col-form-label">تاریخ</label>
                 <div className="col-sm-10">
                     <input type="test" name='date' onChange={inputSetter} value={createInput.date} className="form-control" />
                 </div>
             </div>
             <div className="mb-3 row">
                 <div className="col-lg-2"></div>
                 <div className="col-lg-2">
                     <button  className="btn btn-success" >ثبت</button>
                 </div>
             </div>
         </form>
     </div>
    )
}

export default EditBook;
