import {useEffect, useState} from "react";
import ZeroTableRows from "../ZeroTableRows";
import Receiving from "../Receiving";
import Company from "./Company";
import Swal from "sweetalert2";

const Companies = () => {
    const [loading, setLoading] = useState(true)
    const [companies, setCompanies] = useState([])
    useEffect(() => {
        axios.get(`/api/company/list`).then((res) => {
            setCompanies(res.data.companies)
            setLoading(false)
        })
    }, [])
    if (loading) {
        return <Receiving/>
    }
    const removeItem = (id) => {
        Swal.fire({
            text: "آیا از حذف این آیتم مطمئن هستید؟",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'لغو',
            confirmButtonText: 'تایید کن!',
        }).then(function (isConfirm) {
            if (isConfirm.isConfirmed) {
                axios.post((`/api/company/delete/${id}`)).then(res => {
                    if (res.data.status === 200) {
                        companies.filter((companies.id!==id))
                    }
                })
            } else {
                alert('bye')
            }
        });
    }
    return (
        <div>
            <div className="alert alert-primary" role="alert">
                <span style={{'textAlign': 'right', 'direction': 'rtl'}}>مسیر کاربر</span>
            </div>
            {
                companies.length !== 0 ?
                    <table className='table border table-hover table-striped'>
                        <thead>
                        <tr>
                            <td>نام</td>
                            <td>عملیات</td>
                        </tr>
                        </thead>
                        <tbody>
                        {
                            companies.map((item, index) => {
                                return (
                                    <Company item={item} key={index}/>
                                )
                            })
                        }
                        </tbody>
                    </table>
                    : <ZeroTableRows title='شرکت پخش'/>
            }
        </div>

    )
}

export default Companies;
