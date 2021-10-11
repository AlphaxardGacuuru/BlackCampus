import React, { useState } from 'react'
import { useHistory } from 'react-router-dom'
import axios from 'axios';

import Button from './Button'

const LoginPopUp = (props) => {

	const [phone, setPhone] = useState('07')

	const history = useHistory()

	const onSubmit = (e) => {
		e.preventDefault()

		axios.get('/sanctum/csrf-cookie').then(() => {
			axios.post(`${url}/api/login`, {
				phone: phone,
				password: phone,
				remember: 'checked'
			}).then(res => {
				// const resStatus = res.statusText
				setMessage("Logged in")
				axios.get(`${url}/api/home`).then((res) => setAuth(res.data))
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
				setErrors(newError)
			});
		});

		setPhone('07')
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
				<div className="p-2">
					<form onClick={onSubmit}>
						<input
							id="phone"
							type="text"
							className="form-control"
							name="phone"
							value={phone}
							onChange={(e) => { setPhone(e.target.value) }}
							required={true}
							autoComplete="phone" />
						<br />

						<Button type="submit" btnClass="mysonar-btn float-right" btnText={'Login'} />
					</form>
				</div>
			</div>
		</div>
	)
}

export default LoginPopUp
