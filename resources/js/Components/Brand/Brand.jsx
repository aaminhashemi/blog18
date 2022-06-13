import {Link} from "react-router-dom";
import parse from 'html-react-parser';

const Brand=({item})=>{
    return(
        <tr>
          <td>{item.name} </td>
          <td>{parse(item.condition)} </td>
          <td><img src={`http://127.0.0.1:8000/${item.image}`} width='100px'/> </td>
          <td><Link className='fa fa-edit fa-2x' to={`/home/books/${item.id}/edit`}></Link></td>
      </tr>
    )
}

export default Brand;
