import React, { Component } from 'react'
import '../styles/category.css'
import { Link } from "react-router-dom";

export default class Category extends Component {
    constructor(props) {
        super(props);
        this.state = {
          error: null,
          isLoaded: false,
          categoryId: 1,
          category : {}, 
          products: []
        };
      }
    componentWillMount() {
        this.setState({categoryId : this.props.match.params.id}); 
    }

    componentDidMount() {
    const url = adjustURL("/src/api/products.php");
    fetch(url,{
        method: "POST",
        body: JSON.stringify({"id" : this.state.categoryId})
        })
        .then(response => response.json())
        .then(
        (result) => {
            this.setState({
            isLoaded: true,
            products: result.products,
            category: result.category
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
    const { error, isLoaded, products, category } = this.state;
    if (error) {
    return <div>Error: {error.message}</div>;
    } else if (!isLoaded) {
    return <div>Loading...</div>;
    } else {
    return (
          
            <div className="category__container">
              <h1 className="category__header">
                  {category.name}
              </h1>
              <div className="category__items">
                { 
                    products.map((product) => (
                        <Link to={"/product/"+product.id}>
                            <div className="category__item">
                            <div className="item__imagebox"> 
                                <img src={"/img/product/"+product.image_url} alt={product.name} className="item__image"/>
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