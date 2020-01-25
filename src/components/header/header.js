import React, {Component} from "react";
import {Register} from "../register/register";
import {Login} from "../login/login";

export default class Header extends Component {

    state = {
        hamburger: false,
        registerWindow: false,
        loginWindow: false
    };

    onToggleClassHamburger = () => {
        this.setState({
            hamburger: !this.state.hamburger
        });
    };

    onToggleRegisterWindow = () => {
        this.setState({
            registerWindow: !this.state.registerWindow
        })
    };

    onToggleLoginWindow = () => {
        this.setState({
            loginWindow: !this.state.loginWindow
        })
    };

    render() {

        let classActive = this.state.hamburger ? "active" : null;
        const registerWindow = this.state.registerWindow ? <Register onCloseWindow={this.onToggleRegisterWindow}/> : null;
        const loginWindow = this.state.loginWindow ? <Login onCloseWindow={this.onToggleLoginWindow}/> : null;

        return (
            <header className="header">
                <div className="container">
                    <div className="row align-items-center">
                        <div className="col-lg-3 col-md-5 col-8 col-sm-6">
                            <div className="logo">
                                <a href="/">
                                    <img src="/img/logo.svg" alt="logo" className="logo__img"></img>
                                </a>
                                <span className="logo__text">Реально быстрая доставка еды</span>
                            </div>
                        </div>
                        <div className="offset-xl-6 col-xl-3 col-lg-4 offset-lg-5 d-none d-lg-block">
                            <div className="auth d-flex justify-content-between">
                                {/*TODO Заменить на теги <button>*/}
                                <a href="/#" className="auth__button auth__button_register" onClick={this.onToggleRegisterWindow}>
                                    Регистрация
                                </a>
                                <a href="/#" className="auth__button auth__button_login" onClick={this.onToggleLoginWindow}>
                                    Вход
                                </a>
                            </div>
                        </div>
                        <div className="col-md-2 offset-md-5 col-sm-2 offset-sm-4 col-3 d-lg-none text-right">
                            <a href="/#" id="menu-bar">
                                <svg className={`ham hamRotate ham ${classActive}`} viewBox="0 0 100 100" width="80" onClick={this.onToggleClassHamburger}>
                                    <path
                                        className="line top"
                                        d="m 70,33 h -40 c 0,0 -8.5,-0.149796 -8.5,8.5 0,8.649796 8.5,8.5 8.5,8.5 h 20 v -20"/>
                                    <path
                                        className="line middle"
                                        d="m 70,50 h -40"/>
                                    <path
                                        className="line bottom"
                                        d="m 30,67 h 40 c 0,0 8.5,0.149796 8.5,-8.5 0,-8.649796 -8.5,-8.5 -8.5,-8.5 h -20 v 20"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                {registerWindow}
                {loginWindow}
                <hr className="header-line" style={{marginTop: 40 + 'px'}}></hr>

            </header>
        );
    }
};
