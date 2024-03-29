import React, { useState } from "react";
import PropTypes from 'prop-types';
import CardNews from "./CardNews";
import TBody from "./TBody";

const Table = (props) => {
    const [flagNews, setFlagNews] = useState(false);
    const [datumNews, setDatumNews] = useState({});
    const handleClickNews = (datum) => {
        setFlagNews(true);
        setDatumNews(datum);
    };
    return (
        <div>
            {flagNews ? 
                <CardNews data={datumNews} setFlagNews={setFlagNews} />
                :
                <div className="table-responsive">
                    <table className="table table-dark table-striped w-100">
                        <TBody data={props.data} handleClickNews={handleClickNews} />
                    </table>
                </div>
            }
        </div>
    );
};
Table.propTypes = {
    data: PropTypes.array.isRequired,
};
export default Table;
