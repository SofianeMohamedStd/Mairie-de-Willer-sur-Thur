import React, {Component, Fragment} from 'react';
import {Inertia} from "@inertiajs/inertia";
import Layout from "../Layout";
import {InertiaLink} from "@inertiajs/inertia-react";

class ListPolls extends Component {

    constructor(props) {
        super(props);
        this.state ={
            polls : this.props.prop,
        }
    }
    render() {
        console.log(this.state.polls)
        return (
            <div>
                <h1>Liste des Sondages</h1>
                {
                    this.state.polls.map(function (item,i){
                        return(
                            <div key={i}
                                 className="shadow-lg rounded-lg md:w-1/4 p-4 bg-white dark:bg-gray-800 relative overflow-hidden m-3">
                                <div className="w-full flex items-start">
                                    <div className="flex flex-col">
                                        <a className="block py-3" href={"/sondage/"+item.id}>{item.title}</a>
                                    </div>
                                </div>
                            </div>
                        )
                    })
                }


            </div>

        )
    }
}

ListPolls.layout = page => <Layout children={page}/>

export default ListPolls;