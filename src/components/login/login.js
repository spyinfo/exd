import React, {Component} from "react";

export class Login extends Component {
    render() {

        const {onCloseWindow} = this.props;

        return (
            <div className="modal modal_login">
                <div className="modal__content modal__content_sm">
                    <div className="modal__close" onClick={() => onCloseWindow()}>×</div>
                    <div>
                        <h2 className="modal__title">Вход</h2>
                        <form action="/register" method="POST" className="form">
                            <input type="text" className="form__input" placeholder="Логин"></input>
                            <input type="password" className="form__input" placeholder="Пароль"></input>
                            <input type="submit" className="button form__button" value="Войти"></input>
                        </form>
                    </div>
                </div>
            </div>
        );
    }
}