import {Link} from "react-router-dom";
import Swal from "sweetalert2";
import companies from "./Companies";

const Company = ({item}) => {

    return (
        <tr key={item.id}>
            <td>{item.name} </td>
            <td><Link className='fa fa-edit fa-2x' to={`/home/companies/${item.id}/edit`}></Link></td>
            <td><span className='fa fa-remove fa-2x' onClick={(e) => removeItem(item.id)}></span></td>
        </tr>
    )
}

export default Company;
