import React from 'react';
import Layout from "../Layout";
import {Inertia} from "@inertiajs/inertia";

class ListQuestions extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            answer: [],
            checked: "",
            checkedItems: [],
            sondage: props.pop
        }
        this.handleChange = this.handleChange.bind(this);
        this.handleOnChange = this.handleOnChange.bind(this);
        this.addSingleAnswer = this.addSingleAnswer.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);

    }

    handleChange(e) {
        const id_answer = e.target.id;
        const isChecked = e.target.checked;
        const id_question = e.target.name;
        console.log(isChecked)
        if (!isChecked) {

            this.setState(prevState => ({
                checkedItems: prevState.checkedItems.filter(person => person.id_answer !== id_answer)
            }));
        } else {

            this.setState(prevState => ({
                checkedItems: [...prevState.checkedItems, {id_question, id_answer}]
            }));
        }
    }

    handleCheckboxChange(e) {
        this.setState({checked: e.target.checked})
    }

    handleOnChange(e) {
        this.setState({answer_id: [...this.state.answer_id, e.target.value]})

    };

    addSingleAnswer(id_question, id_answer) {
        this.setState(prevState => ({
            answer: prevState.answer.filter(person => person.id_question !== id_question)
        }));
        this.setState(prevState => ({
            answer: [...prevState.answer, {id_question, id_answer}]
        }));
    }

    handleSubmit(event) {
        event.preventDefault();
        const Polls_id = this.state.sondage
        const single = this.state.answer;
        const multiple = this.state.checkedItems;
        //const message = "hello"
        Inertia.post('/sondageUser',{Polls_id,single,multiple});

    }

    render() {
        // console.log(this.props)
        // console.log(this.state.checkedItems)
        // console.log(this.state.answer)
        // console.log(this.state.sondage)
        return (
            <React.Fragment>
                <form onSubmit={this.handleSubmit}>

                {
                    this.props.prop.map((questions) => {
                            if (questions.multiple === false) {
                                return (

                                    <div key={questions.id} id={this.state.sondage}
                                          className="shadow-lg rounded-lg md:w-1/4 p-4 bg-white :bg-gray-800 relative overflow-hidden m-3">

                                        <div className="w-full flex items-start">
                                            <div className="flex flex-col">
                                                <span className="block py-3">{questions.question} ?</span>
                                                {questions.answers.map(options => (
                                                    <div className="mb-6" key={options.id}>
                                                        <input type="radio" name={questions.id} value={options.id}
                                                               id={options.id + questions.id}
                                                               onChange={() => this.addSingleAnswer(questions.id, options.id)}/>
                                                        <label htmlFor="inputEmail"
                                                               className="login__form_label">{options.wording}</label>
                                                    </div>
                                                ))
                                                }
                                            </div>
                                        </div>
                                    </div>
                                )
                            } else {
                                return (
                                    <div key={questions.id} id={"1" + questions.id}
                                          className="shadow-lg rounded-lg md:w-1/4 p-4 bg-white :bg-gray-800 relative overflow-hidden m-3">
                                        <div className="w-full flex items-start">
                                            <div className="flex flex-col">
                                                <span className="block py-3">{questions.question} ?</span>
                                                {questions.answers.map((option) =>
                                                    (
                                                        <label key={option.id}>
                                                            <input type="checkbox" name={questions.id}
                                                                   id={option.id}
                                                                   onChange={this.handleChange}/>
                                                            {option.wording}
                                                        </label>
                                                    ))
                                                }
                                            </div>
                                        </div>
                                    </div>
                                )
                            }
                        }
                    )
                }
                    <button className="btn btn-secondary" type="submit">Envoyer</button>
                </form>
            </React.Fragment> 
        )
    }
}

ListQuestions.layout = page => <Layout children={page}/>

export default ListQuestions;
