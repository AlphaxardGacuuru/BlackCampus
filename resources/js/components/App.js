import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import { HashRouter as Router, Route, Redirect, useHistory, useLocation } from 'react-router-dom'

import TopNav from './TopNav'

function App() {
	// Declare states
	const [login, setLogin] = useState()
	const [url, setUrl] = useState(window.location.href.match(/https/) ?
		'https://campus.black.co.ke' :
		'http://localhost:3000')
	const [auth, setAuth] = useState({
		"name": "Guest",
		"username": "@guest",
		"pp": "profile-pics/male_avatar.png",
		"account_type": "normal"
	})

	return (
		<Router>
			<TopNav {...{ url, auth, setAuth }} />
		</Router>
	);
}

export default App;

if (document.getElementById('app')) {
	ReactDOM.render(<App />, document.getElementById('app'));
}
