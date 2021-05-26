import React, {Component, Fragment} from 'react';
import {Inertia} from "@inertiajs/inertia";
import Layout from "./Layout";

class Profile extends Component {
    constructor(props) {
        super(props);
        this.state = {
            firstname: this.props.prop.firstname,
            lastname: this.props.prop.lastname,
            email: this.props.prop.email,
            phone: this.props.prop.phone,
            isFlipped: false
        }
        this.handleClick = this.handleClick.bind(this);
        this.handleFirstNameChange = this.handleFirstNameChange.bind(this);
        this.handleLastNameChange = this.handleLastNameChange.bind(this);
        this.handleEmailChange = this.handleEmailChange.bind(this);
        this.handlePhoneChange = this.handlePhoneChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleClick(e) {
        e.preventDefault();
        this.setState(prevState => ({isFlipped: !prevState.isFlipped}));
    }

    handleSubmit(event) {
        event.preventDefault();
        const {firstname, lastname, email} = this.state;
        Inertia.post('/users', {firstname, lastname, email});

    }

    handleFirstNameChange(e) {
        this.setState({firstname: e.target.value});
    }

    handleLastNameChange(e) {
        this.setState({lastname: e.target.value});
    }

    handleEmailChange(e) {
        this.setState({email: e.target.value});
    }

    handlePhoneChange(e) {
        this.setState({phone: e.target.value});
    }


    // render() {
    //     return (<>
    //             <Fragment>
    //                 <div className="container">
    //                     <div className="main-body">
    //                         <div className="card mb-3">
    //                             <div className="card-body">
    //                                 <div className="row">
    //                                     <div className="col-sm-3">
    //                                         <h6 className="mb-0">Full Name</h6>
    //                                     </div>
    //                                     <div className="col-sm-9 text-secondary">
    //                                         <h5>{this.props.prop.firstname} {this.props.prop.lastname}</h5>
    //                                     </div>
    //                                 </div>
    //                                 <div className="row">
    //                                     <div className="col-sm-3">
    //                                         <h6 className="mb-0">Email</h6>
    //                                     </div>
    //                                     <div className="col-sm-9 text-secondary">
    //                                         <h5>{this.props.prop.email}</h5>
    //                                     </div>
    //                                 </div>
    //                                 <div className="row">
    //                                     <div className="col-sm-3">
    //                                         <h6 className="mb-0">Phone</h6>
    //                                     </div>
    //                                     <div className="col-sm-9 text-secondary">
    //                                         <h5>{this.state.phone}</h5>
    //                                     </div>
    //                                 </div>
    //                                 <InertiaLink className="btn btn-primary" href="/editEmail">edit email</InertiaLink>
    //                                 <InertiaLink className="btn btn-success" href="/editPassword">edit password</InertiaLink>
    //                             </div>
    //
    //                         </div>
    //                     </div>
    //                 </div>
    //             </Fragment>
    //         </>
    //     )
    // }

    render() {
        return (
            <form>
                <div className="mb-6">
                    <label htmlFor="inputEmail" className="login__form_label">Email</label>
                    <input type="email" name="email" id="inputEmail" className="login__form_field" required=""
                           autoFocus=""/>
                </div>
            </form>
        )
    }
}

Profile.layout = page => <Layout children={page}/>

export default Profile;
