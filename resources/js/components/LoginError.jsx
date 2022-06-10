import spin from './../src/Spinner.gif'
const LoginError=()=>{
    return(

        <div  className='col-lg-9 mx-0 my-0 px-2 py-2'>
            <img className='mx-auto my-auto d-flex center' style={{'width':100+'px'}} src={spin} alt='no'/>
            <h6 className='text-center'>اشکال در دریافت اطلاعات</h6>
        </div>
    )
}

export default LoginError;
