import {Link} from "react-router-dom";

const Book=({item})=>{
    return(
        <tr>
          <td>{item.name} </td>
          <td>{item.writer} </td>
          <td>{item.publisher} </td>
          <td>{item.count} </td>
          <td>{item.date} </td>
          <td><Link className='fa fa-edit fa-2x' to={`/home/books/${item.id}/edit`}></Link></td>
      </tr>
    )
}

export default Book;
