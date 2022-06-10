import {useState} from "react";

const CreateBooks = () => {
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
     <div className='col-lg-10 mx-0 my-0 px-2 py-2' style={{'backgroundColor':'white'}}>
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
                     <button  className="btn btn-success" >افزودن</button>
                 </div>
             </div>
         </form>
     </div>
    )
}

export default CreateBooks;
