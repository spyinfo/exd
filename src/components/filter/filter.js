import React, {Component} from "react";

export default class  Filter extends Component {

    render() {

        const dataFilters = this.props.dataFilters.slice();

        const elements = dataFilters.map(item => {
            return (
                <FilterItem filter={item} onToggleActive={this.props.onToggleActive} key={item.id}/>
            );
        });

        return (
            <ul className="filter">
                {elements}
            </ul>
        );
    }
}

class FilterItem extends Component {

    render() {

        const {filter, onToggleActive} = this.props;
        let clazz = "filter__item ";
        clazz += filter.active ? "filter__item_active" : null;

        return (
            <li className={clazz}>
                <a className="filter__link" onClick={() => onToggleActive(filter.id)}>
                    <span className="filter__text">{filter.name}</span>
                    <div className="filter__img" style={{backgroundImage: `url(${process.env.PUBLIC_URL + `/img/${filter.img}`})`}}></div>
                </a>
            </li>
        );
    }
};