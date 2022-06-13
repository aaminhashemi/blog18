import {Link} from "react-router-dom";

const Permission=({item})=>{
    return(
        <tr>
          <td>{item.name} </td>
          <td><Link className='fa fa-edit fa-2x' to={`/home/permission/${item.id}/edit`}></Link></td>
      </tr>
    )
}

export default Permission;
