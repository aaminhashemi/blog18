import {useEffect, useState} from "react";
import ZeroTableRows from "../ZeroTableRows";
import Receiving from "../Receiving";
import Company from "./Company";

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
