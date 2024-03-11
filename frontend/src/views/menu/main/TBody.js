import React from 'react';
import PropTypes from 'prop-types';
const TBody = (props) => {
    return (
        <>
            {props.data ?
                <tbody>
                    {props.data.map((datum) => (
                        <tr key={datum.title}>
                            <td><img onClick={() => props.handleClickNews(datum)} src={datum.urlToImage} width="70" height="70" alt={datum.author} /></td>
                            <td onClick={() => props.handleClickNews(datum)}><p>{datum.title}</p></td>
                            <td onClick={() => props.handleClickNews(datum)}><p>{datum.author}</p></td>
                        </tr>
                    ))}
                </tbody>
                :
                <p>Error de conexión</p>
            }
        </>
    );
}
TBody.propTypes = {
    data: PropTypes.array,
    handleClickNews: PropTypes.func.isRequired,
};
export default TBody;
