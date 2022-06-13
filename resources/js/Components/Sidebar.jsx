import React from 'react';
import {Link, Outlet} from 'react-router-dom';
import ReactDOM from 'react-dom';

const Sidebar = ({menu}) => {

    return (
        <div className='flex-shrink-0 p-3 bg-white mx-o'
             style={{'height': 90 + 'vh', 'borderLeft': 1 + 'px'}}>
            <div className="d-flex row flex-row col-lg-12 justify-content-center align-items-center pb-3 mb-3 w-100 link-dark text-decoration-none border-bottom">
                <div className='d-flex justify-content-center flex-row d-block align-items-center'>
                    <img className=' row  ' src='http://toplearn.com/img/user/250x259/20049_0ed1f947-20ac-e0dc-a9ae-39ef0c3fbdf3_رادمان_.png' style={{'borderRadius':50+'%','width':100+'px'}}  />
                </div>
                <p className='d-flex justify-content-center row align-items-center'>اسماعیل هاشمی</p>
            </div>
            <ul className='list-unstyled ps-0 px-0 mx-0'>
                {menu.map((item, index) => {
                    return (
                        <li key={item.key} className="mb-1"><span className='btn btn-toggle align-items-center rounded collapsed'
                          data-bs-toggle="collapse" aria-expanded="true" data-bs-target={'#' + item.id}> {item.title}</span>
                            {
                                menu.map((innerItem, innerIndex) => {
                                    if(item.id === innerItem.id) {
                                        return (
                                            <div className="collapse" id={innerItem.id}>
                                                <ul className="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                                    {item.options.map((op, index2) => {
                                                        /*<li className="col-lg-12 px-0 mx-0 w-100 link-dark rounded"
                                                            key={innerItem.key}
                                                            style={{'listStyle': 'none', 'width': 100 + '%'}}>
                                                            <Link to={op.url} style={{'listStyle': 'none'}}>{op.title}</Link>
                                                        </li>*/
                                                        return (<li><Link to={op.url} key={innerItem.key}
                                                                  className="link-dark rounded">{op.title}</Link></li>)
                                                    })}
                                                </ul>
                                            </div>

                                        )
                                    }

                                })
                            }
                        </li>
                    )
                })}
                {/* {menu.map((item, index) => {
                    return (
                        <ul className="list-unstyled collapse row btn-toggle-nav list-unstyled fw-normal pb-1 small" id={item.id} key={item.key} data-parent={'#' + item.id}>
                            {item.options.map((op, index2) => {
                                return (
                                    <li className="col-lg-12 px-0 mx-0 w-100 link-dark rounded" key={item.key}
                                        style={{'listStyle': 'none', 'width': 100 + '%'}}>
                                        <Link to={op.url} style={{'listStyle': 'none'}}>{op.title}</Link>
                                    </li>
                                )
                            })}
                        </ul>
                    )
                })}*/}
            </ul>
        </div>
    );
}
export default Sidebar
