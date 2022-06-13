import {useEffect, useState} from "react";
import ZeroTableRows from "../ZeroTableRows";
import Receiving from "../Receiving";
import Role from "./Role";

const Roles = () => {
    const [loading, setLoading] = useState(true)
    const [roles, setRoles] = useState([])
    useEffect(() => {
        axios.get(`/api/role/list`).then((res) => {
            setRoles(res.data.roles)
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
                roles.length !== 0 ?
                    <table className='table border table-hover table-striped'>
                        <thead>
                        <tr>
                            <td>نام</td>
                            <td>دسترسی ها</td>
                            <td>عملیات</td>
                        </tr>
                        </thead>
                        <tbody>
                        {
                            roles.map((item, index) => {
                                return (
                                    <Role item={item} key={index}/>
                                )
                            })
                        }
                        </tbody>
                    </table>
                    : <ZeroTableRows title='نقش کاربری'/>
            }
        </div>
    )
}

export default Roles;
