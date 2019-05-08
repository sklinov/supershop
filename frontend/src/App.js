import React, { Component } from 'react';
import { Router, Route } from "react-router-dom";
import createBrowserHistory from "history/createBrowserHistory";
import './App.css';
import Header from './components/Header';
import Category from './components/Category';
import Product from './components/Product';
import AllCategories from './components/AllCategories';

const history = createBrowserHistory();

class App extends Component {
 
  render() {
    return (
      <Router history={history}>
      <div className="App">
        <Header />
        
        <Route exact path="/category/" component={AllCategories} />
        <Route path="/category/:id" component={Category} />
        <Route path="/product/:id" component={Product} />
        {/* <Category /> */}
      </div>
      </Router>
    );
  }
}

export default App;
