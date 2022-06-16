import {Link} from "react-router-dom";

const Company=({item})=>{
    return(
        <tr>
          <td>{item.name} </td>
          <td><Link className='fa fa-edit fa-2x' to={`/home/companies/${item.id}/edit`}></Link></td>
      </tr>
    )
}

export default Company;
