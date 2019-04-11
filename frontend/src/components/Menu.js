import React, { Component } from 'react'
import '../styles/menu.css';

export default class Menu extends Component {
    render() {
    return(
        <div className="menu">
        { 
            this.props.categories.map((category) => (
            <span className="menu__item">{category.name}</span>
            ))
        }
        </div>
    )
  }
}

