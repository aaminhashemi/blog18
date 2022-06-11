import {useEffect, useState} from "react";
import ZeroTableRows from "./ZeroTableRows";
import Receiving from "./Receiving";
import Permission from "./Permission";

const Permissions = () => {
    const [loading, setLoading] = useState(true)
    const [permissions, setPermissions] = useState([])
    useEffect(() => {
        axios.get(`/api/permission/list`).then((res) => {
            setPermissions(res.data.permissions)
            setLoading(false)
            //console.log(permissions)
        })
    }, [])
    if (loading) {
        return <Receiving/>
    }
    return (
        <div>
            <div className="alert alert-primary" role="alert">
                <span style={{'textAlign': 'right', 'direction': 'rtl'}}>مسیر کاربر</span>
            </div>
            {
                permissions.length !== 0 ?
                    <table className='table border table-hover table-striped'>
                        <thead>
                        <tr>
                            <td>نام</td>
                            <td>عملیات</td>
                        </tr>
                        </thead>
                        <tbody>
                        {
                            permissions.map((item, index) => {
                                return (
                                    <Permission item={item} key={index}/>
                                )
                            })
                        }
                        </tbody>
                    </table>
                    : <ZeroTableRows title='دسترسی'/>
            }
        </div>
    )
}

export default Permissions;
