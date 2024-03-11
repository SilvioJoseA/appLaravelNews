import React from 'react';
import PropTypes from 'prop-types';
const CardHeader = (props) => {
    return (
        <div className="card-header d-flex justify-content-between align-items-center row">
            <div className='col-11'>
                <h6>{props.title}</h6>
            </div>
            <div className='col-1'>
                <button className="btn btn-sm btn-danger" onClick={() => props.setFlagNews(false)}>X</button>
            </div>
            
        </div>
    );
}
CardHeader.propTypes = {
    title: PropTypes.string.isRequired,
    setFlagNews: PropTypes.func.isRequired,
};
export default CardHeader;
