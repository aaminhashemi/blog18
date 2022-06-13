import {useEffect, useState} from "react";
import ZeroTableRows from "../ZeroTableRows";
import Receiving from "../Receiving";
import Category from "./Category";

const Categories = () => {
    const [loading, setLoading] = useState(true)
    const [categories, setCategories] = useState([])
    useEffect(() => {
        axios.get(`/api/category/list`).then((res) => {
            setCategories(res.data.categories)
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
                categories.length !== 0 ?
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
                            categories.map((item, index) => {
                                return (
                                    <Category item={item} key={index}/>
                                )
                            })
                        }
                        </tbody>
                    </table>
                    : <ZeroTableRows title='دسته بندی'/>
            }
        </div>

    )
}

export default Categories;
