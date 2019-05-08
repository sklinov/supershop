import React, { Component } from 'react'
import Images from '../components/Images'
import '../styles/product.css'


export default class Product extends Component {
    constructor(props) {
        super(props);
        this.state = {
          error: null,
          isLoaded: false,
          productId : "2",
          product : [],
          images : []
        };
      }
    componentWillMount() {
      this.setState({productId : this.props.match.params.id}); 
    }
      
    componentDidMount() {
    
    const url = adjustURL("/src/api/product.php");
    //console.log("Component did mount with id:"+this.state.productId);
       
    fetch(url,{
        method: "POST",
        body: JSON.stringify({"id" : this.state.productId})
        })
        .then(response => response.json())
        .then(
        (result) => {
            this.setState({
            isLoaded: true,
            product: result.product,
            images: result.images
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
    const product  = this.state.product;
    return (
      <div className="product__container">
        <div className="product__column">
          <div className="product__image">
            <Images images={this.state.images} />
          </div>
        </div>
        <div className="product__column">
          <div className="product__name">
            {product.name}
          </div>
          <div className="product__description">
            {product.description}
          </div>
        </div>
        <div className="product__column">
          <div className="product__priceblock">
            {
              product.old_price > 0 && product.old_price !== product.price &&
              <div className="product__oldprice">{product.old_price}</div>
            
            }
            
            <div className="product__price">{product.price}</div>
            <div className="product__instock">
            {
              product.quantity > 0 &&
              <div> Товар в наличии </div>
            }
            {
              product.quantity <= 0 &&
              <div> Нет наличии </div>
            }
            </div>          
              <button className="button__addtocart">
                Купить
              </button>
          </div>
        </div>
      </div>
    )
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
