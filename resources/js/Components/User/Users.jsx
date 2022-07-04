import {useEffect, useState} from "react";
import ZeroTableRows from "../ZeroTableRows";
import Receiving from "../Receiving";
import Category from "./User";
import User from "./User";

const Users = () => {
    const [loading, setLoading] = useState(true)
    const [users, setUsers] = useState([])
    const [roles, setRoles] = useState([])
    useEffect(() => {
        axios.get(`/api/user/list`).then((res) => {
            setUsers(res.data.users)
        })
        axios.get(`/api/role/list`).then((res) => {
            setRoles(res.data.roles)
            setLoading(false)
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
                users.length !== 0 ?
                    <table className='table border table-hover table-striped'>
                        <thead>
                        <tr>
                            <td>نام</td>
                            <td>نام خانوادگی</td>
                            <td>نقش کاربری</td>
                            <td>ایمیل</td>
                            <td>اختصاص نقش</td>
                            <td>عملیات</td>
                        </tr>
                        </thead>
                        <tbody>
                        {
                            users.map((item, index) => {
                                return (
                                    <User item={item} roles={roles} key={index} />
                                )
                            })
                        }
                        </tbody>
                    </table>
                    : <ZeroTableRows title='کاربری'/>
            }
        </div>
    )
}

export default Users;
