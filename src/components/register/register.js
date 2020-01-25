import React, {Component} from "react";

export class Register extends Component {
    render() {

        const {onCloseWindow} = this.props;

        return (
            <div className="modal modal_register">
                <div className="modal__content">
                    <div className="modal__close" onClick={() => onCloseWindow()}>×</div>
                    <div>
                        <h2 className="modal__title">Регистрация</h2>
                        <form action="/register" method="POST" className="form">
                            <input type="text" className="form__input" placeholder="Фамилия" required></input>
                            <input type="text" className="form__input" placeholder="Имя" required></input>
                            <input type="text" className="form__input" placeholder="Логин" required></input>
                            <input type="password" className="form__input" placeholder="Пароль" required></input>
                            <input type="submit" className="button form__button" value="Зарегистрироваться"></input>
                        </form>
                    </div>
                </div>
            </div>
        );
    }
};