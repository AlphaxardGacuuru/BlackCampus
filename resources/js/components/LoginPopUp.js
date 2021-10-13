import React, { useState } from 'react'
import { useHistory } from 'react-router-dom'
import axios from 'axios';

import Button from './Button'

const LoginPopUp = (props) => {

	const [email, setEmail] = useState()

	const history = useHistory()

	const onSubmit = (e) => {
		e.preventDefault()

		axios.get('/sanctum/csrf-cookie').then(() => {
			axios.post(`${props.url}/api/login`, {
				// name: "Al Gacuuru",
				email: email,
				password: email,
				password_confirmation: email,
				remember: 'checked'
			}).then(res => {
				props.setMessage("Logged in")
				axios.get(`${props.url}/api/home`).then((res) => props.setAuth(res.data))
				props.setLogin(false)
				setTimeout(() => history.push('/'), 1000)
			}).catch(err => {
				const resErrors = err.response.data.errors
				// Get validation errors
				var resError
				var newError = []
				for (resError in resErrors) {
					newError.push(resErrors[resError])
				}
				// Get other errors
				newError.push(err.response.data.message)
				props.setErrors(newError)
			});
		});
	}

	return (
		<div className="menu-open">
			<div className="bottomMenu">
				<div className="d-flex align-items-center justify-content-between">
					{/* <!-- Logo Area --> */}
					<div className="logo-area p-2">
						<a href="#">Login</a>
					</div>
				</div>
				<div className="p-2 mb-4">
					<center>
						<form onSubmit={onSubmit}>
							<input
								id="email"
								type="email"
								className="form-control rounded-0"
								name="email"
								placeholder="Email"
								onChange={(e) => setEmail(e.target.value)} />
								<br />

							<Button type="submit" btnClass="btn btn-success rounded-0" btnText={'Login'} />
						</form>
					</center>
				</div>
			</div>
		</div>
	)
}

export default LoginPopUp
