import React, {Fragment} from 'react';
import {InertiaLink, usePage} from '@inertiajs/inertia-react'

import {Disclosure, Menu, Transition} from "@headlessui/react"
import {BellIcon, MenuIcon, XIcon} from "@heroicons/react/outline"
import TitleBar from "../Shared/TitleBar"
import UserProfileBox from "../Shared/User/UserProfileBox"
import Logo from "../../images/logo-seul.png"

const navigation = [{
    'label' : 'Tableau de bord',
    'href' : '/'
},{
    'label' : 'Mes dossiers',
    'href' : '/'
},{
    'label' : 'Sondage' ,
    'href' : '/sondage'
} ]

const profile = [
    {'label':'Mes informations' , 'href' : '/profile','withInertia' : true},
    {'label':'Paramètres' , 'href' : '/settings','withInertia' : true},
    {'label':'Me déconnecter' , 'href' : '/logout' ,'withInertia' : false},
]

function classNames(...classes) {
    return classes.filter(Boolean).join(' ')
}


export default function Layout({children}) {

    const user = usePage().props.auth.user

    return (
        <div>
            {/*{<div><pre>{JSON.stringify(user, null, 2) }</pre></div>}*/}
            <Disclosure as="nav" className="bg-gray-900">
                {({ open }) => (
                    <>
                        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div className="flex items-center justify-between h-16">
                                <div className="flex items-center">
                                    <div className="flex-shrink-0">
                                        <img
                                            className="h-8"
                                            src={Logo}
                                            alt="Willer-sur-Thur"
                                        />
                                    </div>
                                    <div className="hidden md:block">
                                        <div className="ml-10 flex items-baseline space-x-4">
                                            {navigation.map((item, itemIdx) =>
                                                itemIdx === 0 ? (
                                                    <Fragment key={item.label}>
                                                        {/* Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" */}
                                                        <InertiaLink href={item.href} className="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium">
                                                            {item.label}
                                                        </InertiaLink>
                                                    </Fragment>
                                                ) : (
                                                    <InertiaLink
                                                        key={item.label}
                                                        href={item.href}
                                                        className="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                                                    >
                                                        {item.label}
                                                    </InertiaLink>
                                                )
                                            )}
                                        </div>
                                    </div>
                                </div>
                                <div className="hidden md:block">
                                    <div className="ml-4 flex items-center md:ml-6">
                                        <button className="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                                            <span className="sr-only">View notifications</span>
                                            <BellIcon className="h-6 w-6" aria-hidden="true" />
                                        </button>

                                        {/*Profile dropdown*/}
                                        <Menu as="div" className="ml-3 relative">
                                            {({ open }) => (
                                                <>
                                                    <div>
                                                        <Menu.Button className="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                                                            <span className="sr-only">Open user menu</span>
                                                            <img
                                                                className="h-8 w-8 rounded-full"
                                                                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                                                alt=""
                                                            />
                                                        </Menu.Button>
                                                    </div>
                                                    <Transition
                                                        show={open}
                                                        as={Fragment}
                                                        enter="transition ease-out duration-100"
                                                        enterFrom="transform opacity-0 scale-95"
                                                        enterTo="transform opacity-100 scale-100"
                                                        leave="transition ease-in duration-75"
                                                        leaveFrom="transform opacity-100 scale-100"
                                                        leaveTo="transform opacity-0 scale-95"
                                                    >
                                                        <Menu.Items
                                                            static
                                                            className="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                                        >
                                                            {profile.map((item) => (

                                                                <Menu.Item key={item.href}>
                                                                    {
                                                                        ({ active }) => (
                                                                            <>
                                                                                {
                                                                                    item.withInertia && <InertiaLink
                                                                                        className={classNames(active ? 'bg-gray-100' : '','block px-4 py-2 text-sm text-gray-700')}
                                                                                        href={item.href}>{item.label}
                                                                                    </InertiaLink >
                                                                                }

                                                                                {
                                                                                    !item.withInertia && <a
                                                                                        className={classNames(active ? 'bg-gray-100' : '','block px-4 py-2 text-sm text-gray-700')}
                                                                                        href={item.href}>{item.label}
                                                                                    </a >
                                                                                }

                                                                            </>
                                                                        )
                                                                    }
                                                                </Menu.Item>
                                                            ))}
                                                        </Menu.Items>
                                                    </Transition>
                                                </>
                                            )}
                                        </Menu>
                                    </div>
                                </div>
                                <div className="-mr-2 flex md:hidden">
                                    {/* Mobile menu button */}
                                    <Disclosure.Button className="bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                                        <span className="sr-only">Open main menu</span>
                                        {open ? (
                                            <XIcon className="block h-6 w-6" aria-hidden="true" />
                                        ) : (
                                            <MenuIcon className="block h-6 w-6" aria-hidden="true" />
                                        )}
                                    </Disclosure.Button>
                                </div>
                            </div>
                        </div>

                        {/* Mobile menu */}
                        <Disclosure.Panel className="md:hidden">
                            <div className="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                                {navigation.map((item, itemIdx) =>
                                    itemIdx === 0 ? (
                                        <Fragment key={item}>
                                            {/* Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" */}
                                            <a href="#" className="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium">
                                                {item} ***
                                            </a>
                                        </Fragment>
                                    ) : (
                                        <a
                                            key={item}
                                            href="#"
                                            className="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                                        >
                                            {item} ///
                                        </a>
                                    )
                                )}
                            </div>
                            <div className="pt-4 pb-3 border-t border-gray-700">
                                <div className="flex items-center px-5">
                                    <div className="flex-shrink-0">
                                        <img
                                            className="h-10 w-10 rounded-full"
                                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                            alt=""
                                        />
                                    </div>
                                    <div className="ml-3">
                                        <div className="text-base font-medium leading-none text-white">Tom Cook</div>
                                        <div className="text-sm font-medium leading-none text-gray-400">tom@example.com</div>
                                    </div>
                                    <button className="ml-auto bg-gray-800 flex-shrink-0 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                                        <span className="sr-only">View notifications</span>
                                        <BellIcon className="h-6 w-6" aria-hidden="true" />
                                    </button>
                                </div>
                                <div className="mt-3 px-2 space-y-1">
                                    {profile.map((item) => (
                                        <a
                                            key={item}
                                            href="#"
                                            className="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700"
                                        >
                                            {item}
                                        </a>
                                    ))}
                                </div>
                            </div>
                        </Disclosure.Panel>
                    </>
                )}
            </Disclosure>

            <TitleBar title="Bonjour" user={user}/>

            <div>
                <main>
                    <div className="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 border-2 ">

                        <div className="flex">
                            <div className="bg-white p-5 mx-5 rounded-lg shadow-md w-3/4">
                                {children}
                            </div>

                            <div className="flex flex-col bg-white p-5 mx-5 text-gray-800 rounded-lg shadow-md w-1/4">
                                <UserProfileBox/>
                            </div>
                        </div>


                    </div>
                </main>
            </div>
        </div>
    );
}
