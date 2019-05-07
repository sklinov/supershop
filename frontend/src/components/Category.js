import React, { Component } from 'react'
import '../styles/category.css'
import { BrowserRouter as Router, Route, Link } from "react-router-dom";

export default class Category extends Component {
    constructor(props) {
        super(props);
        this.state = {
          error: null,
          isLoaded: false,
          categoryId: 1, 
          products: []
        };
      }
    componentDidMount() {
    const url = adjustURL("/src/api/products.php");
    fetch(url)
        .then(response => response.json())
        .then(
        (result) => {
            this.setState({
            isLoaded: true,
            products: result.products
            });
        },
        (error) => {
            this.setState({
            isLoaded: true,
            error
            });
        }
        )
    }
      
    render() {
    const { error, isLoaded, products } = this.state;
    if (error) {
    return <div>Error: {error.message}</div>;
    } else if (!isLoaded) {
    return <div>Loading...</div>;
    } else {
    return (
          
            <div className="category__container">
              <h1 className="category__header">
                  Category
              </h1>
              <div className="category__items">
                { 
                    products.map((product) => (
                        <Link >
                            <div className="category__item">
                            <div className="item__imagebox"> 
                                <img src={"product"+product.image_url} alt={product.name} className="item__image"/>
                            </div>
                            <div className="item__details">
                                <span key={product.id} className="item__name">{product.name}</span>
                                <span key={product.price} className="item__price">{product.price}руб.</span>
                            </div>
                            </div>
                        </Link>
                    ))
                }
               </div>
            </div>
    )
    }
  }
}

function adjustURL(oldurl) {
    const localpath = "http://localhost:80/supershop/frontend";
    var location = window.location.href;
    if(location.includes("localhost"))
    {
      oldurl=localpath+oldurl;
    }
    return oldurl;
  }