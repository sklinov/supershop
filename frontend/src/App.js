import React, { Component } from 'react';
import { BrowserRouter as Router, Route, Link } from "react-router-dom";
import './App.css';
import Header from './components/Header';
import Category from './components/Category';


class App extends Component {
  



  render() {
    return (
      <Router>
      <div className="App">
        <Header />

        <Route exact path="/" component={Home} />
        <Route path="/category" component={Category} />
        
        {/* <Category /> */}
      </div>
      </Router>
    );
  }
}

export default App;
