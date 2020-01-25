import React, {Component} from "react";
import Filter from "../filter/filter";
import DataService from "../../services/data-service";
import Spinner from "../spinner/spinner";

import './restaurant.css';

export default class Restaurants extends Component {


    dataService = new DataService();

    state = {
        dataFilters: [
            {
                id: 1,
                name: "Суши",
                img: "sushi.jpg",
                active: false
            },
            {
                id: 2,
                name: "Пицца",
                img: "pizza.png",
                active: false
            },
            {
                id: 3,
                name: "Бургеры",
                img: "burgers.png",
                active: false
            },
            {
                id: 4,
                name: "Фастфуд",
                img: "fastfood.png",
                active: false
            },
            {
                id: 5,
                name: "Пироги",
                img: "cakes.png",
                active: false
            },
            {
                id: 6,
                name: "Десерты",
                img: "desserts.png",
                active: false
            },
            {
                id: 7,
                name: "Азиатская",
                img: "asia.png",
                active: false
            },
            {
                id: 8,
                name: "Узбекская",
                img: "uzbekistan.png",
                active: false
            },
            {
                id: 9,
                name: "Рыба",
                img: "fish.png",
                active: false
            },
            {
                id: 10,
                name: "Шашлыки",
                img: "shashlik.png",
                active: false
            },
            {
                id: 11,
                name: "Завтраки",
                img: "breakfast.png",
                active: false
            },
            {
                id: 12,
                name: "Обеды",
                img: "dinner.png",
                active: false
            },
        ],
        restaurants: null,
        limit: 9, // кол-во ресторанов, которые показываем при 1 загрузке компонента
        categories: null
    };

    componentDidMount() {
        this.dataService
            .getRestaurants()
            .then((restaurants) => {
                this.setState({
                    restaurants
                })
            });
    }

    renderRestaurants = (restaurants) => {

        // Выбираем рестораны, у которых categoriesID совпадает с this.state.categories.
        // После выбора с помощью .filter удаляем все пустые (undefined или null) элементы
        const result = restaurants.map((item) => {if (item.categories.indexOf(this.state.categories) !== -1 || !this.state.categories) return item}).filter(item => item !== undefined && item !== null);

        return result.slice(0, this.state.limit).map((item) => {
            if (item.categories.indexOf(this.state.categories) !== -1 || !this.state.categories)  {
                return (
                    <div className="col-lg-4 mb-4 col-md-6 offset-md-0 col-sm-8 offset-sm-2" key={item.id}>
                        <div>
                            <a className="restaurants__item" href="/#">
                                <div className="restaurants__img">
                                    <img src={`/img/restaurants/${item.image}`} alt={item.name}></img>
                                </div>
                                <div className="restaurants__description">
                                    <div className="restaurants__name">{item.name}</div>
                                </div>
                            </a>
                        </div>
                    </div>
                );
            }
            return undefined;
        })
    };

    onClickMoreRestaurants = () => {
        this.setState({
            limit: this.state.limit + 3
        });
    };


    onToggleActive = (id) => {
        const array = this.state.dataFilters.slice();
        const idx = array.findIndex((item) => item.id === id);
        const item = array[idx];
        const newItem = {...item, active: !item.active};
        array.forEach(function (item) {
            item.active = false
        });
        const newDataFilters = [...array.slice(0, idx), newItem, ...array.slice(idx + 1)];

        if (!item.active && newItem.active) {
            this.setState({
                categories: id,
                dataFilters: newDataFilters,
                limit: 9
            });
            return;
        }
        this.setState({
            categories: null,
            dataFilters: newDataFilters,
            limit: 9
        });
    };

    render() {

        const { restaurants, dataFilters } = this.state;

        if (!restaurants) return (
            <div className="container" style={{textAlign: 'center'}}>
                <Spinner/>
            </div>
        );

        let items = this.renderRestaurants(restaurants);

        if (!items.length) {
            items = (
                <div className="no-restaurant">
                    Скоро по этому фильтру появятся рестораны! <br></br>
                    Попробуйте выбрать другой фильтр!
                </div>
            );
        }


        return (
            <section className="section-restaurants">
                <div className="container">
                    <h2 className="section-restaurants__title">Рестораны</h2>

                    <Filter dataFilters={dataFilters} onToggleActive={this.onToggleActive}/>

                    <div className="restaurants">
                        <div className="row">
                            {items}
                        </div>

                        <div className="more">
                            <button type="button" onClick={this.onClickMoreRestaurants}>
                                Показать еще рестораны
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        );
    }
};