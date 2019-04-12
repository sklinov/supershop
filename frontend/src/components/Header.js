import React, { Component } from 'react';
import Menu from '../components/Menu';
import Logo from '../components/Logo';
import Login from '../components/Login';
import Cart from '../components/Cart';
import '../styles/header.css';

export default class Header extends Component {
  render() {
    return (
      <div className="header">
        <Logo />
        <Menu />
        <div className="container container-column">
            <Login />
            <Cart />
        </div>
      </div>
    )
  }
}
