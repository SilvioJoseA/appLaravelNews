import React from 'react';
import PropTypes from 'prop-types';
import Table from './Table';
import './styles/styles.css';
const MainContainer = (props) => {
    return (
        <section className="menu-container-component row w-100 mt-1">
            <div className="col w-100 d-flex justify-content-center align-items-center text-muted">
                <Table data={props.data} />
            </div>            
        </section>
    );
};
MainContainer.propTypes = {
    data: PropTypes.array.isRequired,
};
export default MainContainer;
