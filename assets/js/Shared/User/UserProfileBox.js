import React from "react";
import {InertiaLink, usePage} from "@inertiajs/inertia-react";
import Layout from "../../Pages/Layout";

const UserProfileBox = () => {

    const links = [
        {'label': 'Mon compte', 'href': '/profile', 'withInertia': true},
        {'label': 'Mon foyer', 'href': '/family', 'withInertia': true},
        {'label': 'Me déconnecter', 'href': '/logout', 'withInertia': false},
    ]

    const user = usePage().props.auth.user

    return (
        <>
            <div className="flex flex-col justify-center">
                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt=""
                     className="rounded-full mx-auto transform -translate-y-20  -mb-16 w-32 h-32 shadow-2xl border-4 border-gray-100"/>
            </div>

            <h1 className="font-bold text-center text-3xl text-willerBlue">{user.first_name} {user.last_name} </h1>
            <p className="text-center text-sm text-willerGreen font-medium">Inscrit depuis le 24/12/1969</p>
            <hr className="my-5 "/>

            <ul className="divide divide-y">
                {links.map((link) => (
                    link.withInertia ?
                        <li key={link.href}><InertiaLink className="block py-3"href={link.href}>{link.label}</InertiaLink></li> :
                        <li key={link.href}><a className="block py-3"href={link.href}>{link.label}</a></li>
                    )
                )}
            </ul>
        </>
    )
}

UserProfileBox.layout = page => <Layout children={page}/>


export default UserProfileBox
