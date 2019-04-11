import React, { Component } from 'react'
import '../styles/logo.css';

export default class Logo extends Component {
  render() {
    return (
      <div className="logo__container">
        <div className="logo__firstline">Super</div>
        <div className="logo__secondline">Shop</div>
      </div>
    )
  }
}
