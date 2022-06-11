import {Link} from "react-router-dom";
import parse from "html-react-parser";
const Role=({item})=>{
    return(
        <tr>
          <td>{item.name} </td>
          <td>{parse(item.permission_list)} </td>
          <td><Link className='fa fa-edit fa-2x' to={`/home/permission/${item.id}/edit`}></Link></td>
      </tr>
    )
}

export default Role;
