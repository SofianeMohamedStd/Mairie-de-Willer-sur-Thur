import React from "react";
import Layout from "../../Layout";
import { useForm } from "react-hook-form";

const AddFamilyMember = () => {

    const { register, handleSubmit, watch, formState: { errors } } = useForm();
    const onSubmit = data => console.log(data);

    //password
    const regex = /(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}/gm;

    console.log(watch("password")); // watch input value by passing the name of it

    return (
        <div className="px-4 py-6 sm:px-0">
            <h2 className="title_2">Votree foyer</h2>

            <form onSubmit={handleSubmit(onSubmit)}>

                <label htmlFor="inputEmail" className="login__form_label">Prénom</label>
                <input className="mb-4  login__form_field" defaultValue="test" {...register("firstname")} />
                <div>{errors.firstname && <span className="text-red-600">Cette valeur doit être fournie</span>}</div>

                <label htmlFor="lastname" className="login__form_label">Nom</label>
                <input className="mb-4 login__form_field" {...register("lastname", { required: true })} />
                <div>{errors.lastname && <span className="text-red-600">Cette valeur doit être fournie</span>}</div>

                <label htmlFor="inputEmail" className="login__form_label">Mot de passe</label>
                <input type="password" className="mb-4 login__form_field" {...register("password", { required: true , pattern: regex })} />
                <div>{errors.password && <span className="text-red-600">Cette valeur doit être fournie</span>}</div>

                <label htmlFor="inputEmail" className="login__form_label">Répeter le mot de passe</label>
                <input type="password" className="mb-4 login__form_field" {...register("passwordRepeat", { required: true , pattern: regex })} />
                <div>{errors.passwordRepeat && <span className="text-red-600">Cette valeur doit être fournie</span>}</div>

                <input type="submit" className="btn-primary"/>
            </form>
        </div>
    )
};

AddFamilyMember.layout = page => <Layout children={page}/>

export default AddFamilyMember;
