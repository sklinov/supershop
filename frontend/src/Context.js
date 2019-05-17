import React, { Component } from 'react'

const ProductContext = React.createContext();

class ProductProvider extends Component {
    state = {

    }
    handleDetail = () => {
        console.log("Handle Details");
        
    }
    addToCart = () => {
        console.log("Add to Cart");        
    }

    render() {
    return (
      <ProductContext.Provider value={{ 
          ...this.state,
          handleDetail : this.handleDetail,
          addtoCart : this.addToCart  }}>
          {this.props.children}
      </ProductContext.Provider>
    )
  }
}

const ProductConsumer = ProductContext.Consumer;

export {ProductProvider, ProductConsumer};