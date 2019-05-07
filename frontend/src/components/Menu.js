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
    const url = adjustURL("/src/api/categories.php");
    fetch(url)
        .then(response => response.json())
        .then(
        (result) => {
            this.setState({
            isLoaded: true,
            categories: result.categories
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
        <div className="category__item">
        { 
            categories.map((category) => (
            <span key={category.id} className="menu__item">{category.name}</span>
            ))
        }
        </div>
      );
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