export default class DataService {
    async getRestaurants() {
        const restaurantsJSON = {
            "restaurants": [
                {
                    "id": 1,
                    "name": "McDonalds",
                    "image": "mcdonalds.png",
                    "categories": [
                        3, 4, 12
                    ]
                },
                {
                    "id": 2,
                    "name": "KFC",
                    "image": "kfc.jpg",
                    "categories": [
                        3, 4, 12
                    ]
                },
                {
                    "id": 3,
                    "name": "Burger king",
                    "image": "bk.png",
                    "categories": [
                        3, 4, 12
                    ]
                },
                {
                    "id": 4,
                    "name": "Кофе Хауз",
                    "image": "cafehouse.jpg",
                    "categories": [
                        6, 11
                    ]
                },
                {
                    "id": 5,
                    "name": "Domino's Pizza",
                    "image": "dominospizza.jpg",
                    "categories": [
                        2, 4, 12
                    ]
                },
                {
                    "id": 6,
                    "name": "Il Pittore",
                    "image": "pittore.jpg",
                    "categories": [
                        2
                    ]
                },

                {
                    "id": 7,
                    "name": "El Duderino's",
                    "image": "duderinos.jpg",
                    "categories": [
                        2, 4
                    ]
                },
                {
                    "id": 8,
                    "name": "Пироги №1",
                    "image": "pirogi-1.jpg",
                    "categories": [
                        5
                    ]
                },
                {
                    "id": 9,
                    "name": "Три пирога",
                    "image": "pirogi-3.jpg",
                    "categories": [
                        5
                    ]
                },
                {
                    "id": 10,
                    "name": "VanWok",
                    "image": "vanwok.jpg",
                    "categories": [
                        7
                    ]
                },

                {
                    "id": 11,
                    "name": "GOODMAN",
                    "image": "goodman.jpg",
                    "categories": [
                        4, 12
                    ]
                },

                {
                    "id": 12,
                    "name": "TGI FRIDAYS",
                    "image": "tgi-fridays.jpg",
                    "categories": [
                        3
                    ]
                },

                {
                    "id": 13,
                    "name": "Dark pub",
                    "image": "dark pub.jpg",
                    "categories": [
                        3
                    ]
                },
            ]
        };
        return restaurantsJSON.restaurants.map(this._transformRestaurant);
    }

    _transformRestaurant = (restaurant) => {
        return {
            id: restaurant.id,
            name: restaurant.name,
            image: restaurant.image,
            categories: restaurant.categories
        };
    }
}
