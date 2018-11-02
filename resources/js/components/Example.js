import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Example extends Component {
    render() {
        return (
                <div className="content-center">
                  <div className="card-header">
                    Example Component
                  </div>
                  <div className="card-body">
                    I'm an example component!
                  </div>
                </div>
        );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<Example />, document.getElementById('app'));
}
