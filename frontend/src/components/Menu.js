import React, { Component } from 'react'
import '../styles/menu.css';

export default class Menu extends Component {
    constructor(props) {
        super(props);
        this.state = {
          error: null,
          isLoaded: false,
          categories: []
        };
      }
    
               
    componentDidMount() {
    fetch("../api/categories.php")
        .then(res => res.json())
        .then(
        (result) => {
            this.setState({
            isLoaded: true,
            categories: result
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
   
    const { error, isLoaded, categories } = this.state;
    if (error) {
      return <div>Error: {error.message}</div>;
    } else if (!isLoaded) {
      return <div>Loading...</div>;
    } else {
      return (
        <div className="menu">
        { 
            this.state.categories.map((category) => (
            <span className="menu__item">{category.name}</span>
            ))
        }
        </div>
      );
    }
    } 
 
}

