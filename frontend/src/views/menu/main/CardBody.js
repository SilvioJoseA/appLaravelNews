import React from 'react';
import PropTypes from 'prop-types';
const CardBody = (props) => {
    return (
        <div className="card-body border border-primary p-3 mt-3">
            <p className="card-text">{props.description}</p>
        </div>
    );
}
CardBody.propTypes = {
    description: PropTypes.string.isRequired,
};
export default CardBody;
