import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import { HashRouter as Router, Route, Redirect, useHistory, useLocation } from 'react-router-dom'

import TopNav from './TopNav'
import Messages from './Messages'
import BottomNav from './BottomNav'

// import LoginPopUp from '../auth/LoginPopUp';

function App() {
	// Declare states
	const [url, setUrl] = useState(window.location.href.match(/https/) ?
		'https://campus.black.co.ke' :
		'http://localhost:3000')
	const [auth, setAuth] = useState({
		"name": "Guest",
		"username": "@guest",
		"pp": "profile-pics/male_avatar.png",
		"account_type": "normal"
	})
	const [message, setMessage] = useState('')
	const [errors, setErrors] = useState([])

	const [notifications, setNotifications] = useState([])
	const [followNotifications, setFollowNotifications] = useState([])

	return (
		<Router>
			<TopNav {...{ url, auth, setMessage, setErrors, setAuth, notifications, followNotifications }} />

			<BottomNav {...{ url, auth, setMessage, setErrors, setAuth }} />
		</Router>
	);
}

export default App;

if (document.getElementById('app')) {
	ReactDOM.render(<App />, document.getElementById('app'));
}
