import React, { Component } from 'react'
import { Link } from "react-router-dom";
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
        <div className="menu">
        { 
            categories.map((category) => (
            <Link to={"/category/"+category.id} key={category.id} className="menu__item">{category.name}</Link>
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