import React, {Component} from "react";

import Header from "../header/header";
import Restaurants from "../restaurants/restaurants";
import Footer from "../footer/footer";


export default class App extends Component {

    render() {
        return (
            <div className="ex-delivery">
                <Header/>
                <Restaurants/>
                <Footer/>
            </div>
        );
    }
};
