import React, { Component } from 'react';
import Menu from '../components/Menu';
import Logo from '../components/Logo';
import Login from '../components/Login';
import Cart from '../components/Cart';
import '../styles/header.css';

export default class Header extends Component {
  state = {
    categories: [
        {
            id: 1,
            name : "Категория 1"
        },
        {
            id: 2,
            name : "Категория 2"
        },
        {
            id: 3,
            name : "Категория 3"
        }
    ]
  }
  render() {
    return (
      <div className="header">
        <Logo />
        <Menu categories={this.state.categories}/>
        <div className="container container-column">
            <Login />
            <Cart />
        </div>
      </div>
    )
  }
}
