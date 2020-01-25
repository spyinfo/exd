import React from "react";

const Footer = () => {
    return (
        <footer className="footer">
            <div className="container">
                <div className="row align-items-center">
                    <div className="col-lg-3 col-md-5">
                        <div className="logo">
                            <img src="/img/logo.svg" alt="logo" className="logo__img"></img>
                                <span className="logo__text">Реально быстрая доставка еды</span>
                        </div>
                    </div>
                    <div className="col-lg-3 offset-lg-6 col-md-4 offset-md-3 col-12">
                        <div className="download">

                            <a href="/#">
                                <img src="/img/play.svg" alt="Google play"></img>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <hr className="footer-line"></hr>

            <div className="rights">
                2020 - Ex-Delivery. Все права защищены
            </div>
        </footer>
    );
};

export default Footer;