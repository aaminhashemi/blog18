import {Link} from "react-router-dom";

const Category=({item})=>{
    return(
        <tr>
          <td>{item.name} </td>
          <td>{item.parent} </td>
          <td><img src={`http://127.0.0.1:8000/${item.image}`} width='100px'/> </td>
          <td><Link className='fa fa-edit fa-2x' to={`/home/categories/${item.id}/edit`}></Link></td>
      </tr>
    )
}

export default Category;
