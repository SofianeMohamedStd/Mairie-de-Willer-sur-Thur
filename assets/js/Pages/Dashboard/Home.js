import React from 'react';
import Layout from "../Layout";

const queries = [
    {'label': 'Inscription Périscolaire', 'date': '19/05/2021', 'statusText': 'En cours', 'status': 'w-2/3' , 'color' : 'blue'},
    {'label': 'Inscription Scolaire', 'date': '23/05/2021', 'statusText': 'En attente', 'status': 'w-2/3' , 'color' : 'blue'},
    {'label': 'Rdv Urbanisme', 'date': '26/05/2021', 'statusText': 'Confirmé', 'status': 'w-1/3' , 'color' : 'red'},
    {'label': 'Signalement', 'date': '31/05/2021', 'statusText': 'En traitement', 'status': 'w-3/4' , 'color' : 'green'},
]


const Home = () => {

    return (
        <div className="px-4 py-6 sm:px-0">
            <h2 className="title_2">Vos demandes en cours</h2>

            <div className="flex flex-wrap">
                {queries.map((query) => (<QueryStatusBox key={query.label} query={query}/>))}
            </div>

        </div>
    )
};

const QueryStatusBox = (props) => {

    const query = props.query;
    return (
        <div
            className="shadow-lg rounded-lg md:w-1/4 p-4 bg-white dark:bg-gray-800 relative overflow-hidden m-3">
            <a href="#" className="w-full h-full block">
                <div className="w-full flex items-start">
                    <div className="flex flex-col">
                        <span className="dark:text-white">{query.label}</span>
                        <span className="text-gray-400 text-sm dark:text-gray-300">demande du {query.date}</span>
                    </div>
                </div>
                <div className="flex items-center justify-between my-2">
                    <p className="text-gray-300 text-sm">{query.statusText}</p>
                </div>
                <div className={`w-full h-2 bg-${query.color}-200 rounded-full`}>
                    <div className={`${query.status} h-full text-center text-xs text-white bg-${query.color}-600 rounded-full`}>

                    </div>
                </div>
            </a>
        </div>
    )
}

Home.layout = page => <Layout children={page}/>

export default Home;
