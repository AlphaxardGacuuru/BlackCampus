import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import { HashRouter as Router, Route, Redirect, useHistory, useLocation } from 'react-router-dom'

import TopNav from './TopNav'
import Messages from './Messages'
import BottomNav from './BottomNav'

import Index from '../pages/Index';

// import LoginPopUp from '../auth/LoginPopUp';

function App() {
	// Declare states
	const [url, setUrl] = useState(window.location.href.match(/https/) ?
		'https://campus.black.co.ke' :
		'http://localhost:8001')
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

	// Reset Messages and Errors to null after 3 seconds
	if (errors.length > 0 || message.length > 0) {
		setTimeout(() => setErrors([]), 3000);
		setTimeout(() => setMessage(''), 3000);
	}

	// Fetch data on page load
	useEffect(() => {
		// Fetch Auth
		axios.get(`${url}/api/home`)
			// .then((res) => setAuth(res.data))
			.catch(() => setErrors(['Failed to fetch auth']))

		// Fetch Follows Notifications
		axios.get(`${url}/api/follow-notifications`)
			.then((res) => setFollowNotifications(res.data))
			.catch(() => setErrors(['Failed to fetch follow notifications']))

		// Fetch Notifications
		axios.get(`${url}/api/notifications`)
			.then((res) => setNotifications(res.data))
			.catch(() => setErrors(['Failed to fetch notifications']))

		//Fetch Users
		axios.get(`${url}/api/users`)
			.then((res) => setUsers(res.data))
			.catch(() => setErrors(['Failed to fetch users']))

	}, [])

	return (
		<Router>
			<TopNav {...{ url, auth, setMessage, setErrors, setAuth, notifications, followNotifications }} />

			<Route path="/" exact render={() => (
				<Index {...{ url, auth, setMessage, setErrors }} />
			)} />

			<BottomNav {...{ url, auth, setMessage, setErrors, setAuth }} />

			<Messages {...{ message, errors }} />
		</Router>
	);
}

export default App;

if (document.getElementById('app')) {
	ReactDOM.render(<App />, document.getElementById('app'));
}
