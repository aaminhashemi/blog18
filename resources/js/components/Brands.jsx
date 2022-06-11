import {useEffect, useState} from "react";
import ZeroTableRows from "./ZeroTableRows";
import Receiving from "./Receiving";
import Category from "./Category";
import Brand from "./Brand";

const Brands = () => {
    const [loading, setLoading] = useState(true)
    const [brands, setBrands] = useState([])
    useEffect(() => {
        axios.get(`/api/brand/list`).then((res) => {
            setBrands(res.data.brands)
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
                brands.length !== 0 ?
                    <table className='table border table-hover table-striped'>
                        <thead>
                        <tr>
                            <td>نام</td>
                            <td>والد</td>
                            <td>تصویر</td>
                            <td>عملیات</td>
                        </tr>
                        </thead>
                        <tbody>
                        {
                            brands.map((item, index) => {
                                return (
                                    <Brand item={item} key={index}/>
                                )
                            })
                        }
                        </tbody>
                    </table>
                    : <ZeroTableRows title='برند'/>
            }
        </div>

    )
}

export default Brands;
