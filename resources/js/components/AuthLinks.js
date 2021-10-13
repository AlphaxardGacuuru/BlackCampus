import React from 'react'
import { Link } from 'react-router-dom'

const AuthLinks = (props) => {
	return <Link className="display-4" to="#" onClick={() => props.setLogin(props.login ? false : true)}>Login</Link>
}

export default AuthLinks