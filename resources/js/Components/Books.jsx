import Book from "./Book";
import {useEffect, useState} from "react";
import ZeroTableRows from "./ZeroTableRows";
import Receiving from "./Receiving";

const Books = () => {
    const [loading, setLoading] = useState(true)
    const [books, setBooks] = useState([])
    useEffect(() => {
        axios.get(`/api/books`).then((res) => {
            setBooks(res.data.books)
            setLoading(false)
        })
    }, [])
    if (loading){
        return <Receiving/>
    }
    return (
        <div >
            <div className="alert alert-primary" role="alert">
                <span style={{'textAlign': 'right', 'direction': 'rtl'}}>مسیر کاربر</span>
            </div>
            {
                books.length !== 0 ?
                    <table className='table border table-hover table-striped'>
                        <thead>
                        <tr>
                            <td>نام کتاب</td>
                            <td>نویسنده</td>
                            <td>ناشر</td>
                            <td>تعداد چاپ</td>
                            <td>سال چاپ</td>
                            <td>عملیات</td>
                        </tr>
                        </thead>
                        <tbody>
                        {
                            books.map((item, index) => {
                                return (
                                    <Book item={item} key={index}/>
                                )
                            })
                        }
                        </tbody>
                    </table>
                    : <ZeroTableRows title='کتاب'/>
            }
        </div>

    )
}

export default Books;
