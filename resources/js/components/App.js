import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import { HashRouter as Router, Route, Redirect, useHistory, useLocation } from 'react-router-dom'

import TopNav from './TopNav'
import Messages from './Messages'
import BottomNav from './BottomNav'
import LoginPopUp from './LoginPopUp';

import Index from '../pages/Index';
import Profile from '../pages/Profile';
import PostCreate from '../pages/PostCreate';
import PostShow from '../pages/PostShow';

function App() {
	// Declare states
	const [login, setLogin] = useState()
	const [url, setUrl] = useState(window.location.href.match(/https/) ?
		'https://campus.black.co.ke' :
		'http://localhost:8001')
	const [auth, setAuth] = useState({
		"id": "1",
		"name": "Guest",
		"pp": "storage/profile-pics/male_avatar.png",
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
			.then((res) => setAuth(res.data))
			.catch(() => setErrors(['Failed to fetch auth']))

		// Fetch Follows Notifications
		axios.get(`${url}/api/follow-notifications`)
			.then((res) => setFollowNotifications(res.data))
			.catch(() => setErrors(['Failed to fetch follow notifications']))

		// Fetch Notifications
		axios.get(`${url}/api/notifications`)
			.then((res) => setNotifications(res.data))
			.catch(() => setErrors(['Failed to fetch notifications']))
	}, [])

	return (
		<Router>
			{/* Login Pop Up */}
			{login && <LoginPopUp {...{ url, auth, setAuth, setLogin, setMessage, setErrors }} />}

			<TopNav {...{ url, auth, login, setLogin, setMessage, setErrors, setAuth, notifications, followNotifications }} />

			<Route path="/" exact render={() => (
				<Index {...{ url, auth, setMessage, setErrors }} />
			)} />

			<Route path="/profile/:user_id" exact render={() => (
				<Profile {...{ url, auth, setMessage, setErrors }} />
			)} />

			<Route path="/post-create" exact render={() => (
				<>
					<PostCreate {...{ url, auth, setMessage, setErrors }} />
					{auth.user_id == 29 && <LoginPopUp {...{ url, auth, setAuth, setLogin, setMessage, setErrors }} />}
				</>
			)} />

			<Route path="/post-show/:id" exact render={() => (
				<>
					<PostShow {...{ url, auth, setMessage, setErrors }} />
					{auth.user_id == 29 && <LoginPopUp {...{ url, auth, setAuth, setLogin, setMessage, setErrors }} />}
				</>
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
