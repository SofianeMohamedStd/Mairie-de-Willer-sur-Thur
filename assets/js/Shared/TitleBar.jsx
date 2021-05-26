import React from "react";

const TitleBar = ({title, user}) => {
    return (
        <header className="bg-white shadow">
            <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 className="text-2xl">{title} {user.first_name},</h1>
            </div>
        </header>
    )
}
export default TitleBar
