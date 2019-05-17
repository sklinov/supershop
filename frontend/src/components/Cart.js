import React, { Component } from 'react'

export default class Cart extends Component {
  constructor(props) {
    super(props);
    this.state = {
      error: null,
      isLoaded: false,
      inCart: [],
      isVisible : false,
      
    };
  }

  render() {
    return (
      <div>
        Cart
      </div>
    )
  }
}
