import React, { useState, useEffect } from 'react'
import { Link } from 'react-router-dom'

import Img from '../components/Img'
import Button from '../components/Button'

const Leaders = (props) => {

	const [leaders, setLeaders] = useState([])

	useEffect(() => {
		// Get Content
		axios.get(`${props.url}/api/posts`)
			.then((res) => setLeaders(res.data.leaders))
			.catch((err) => props.setErrors(["Failed to fetch leaders"]))
	}, [])

	// Function for following leaders
	const onFollow = (id) => {
		axios.get('/sanctum/csrf-cookie').then(() => {
			axios.post(`${props.url}/api/follows`, {
				id: id
			}).then((res) => {
				props.setMessage(res.data)
				axios.get(`${props.url}/api/posts`).then((res) => setLeaders(res.data.leaders))
			}).catch((err) => {
				const resErrors = err.response.data.errors
				var resError
				var newError = []
				for (resError in resErrors) {
					newError.push(resErrors[resError])
				}
				// Get other errors
				newError.push(err.response.data.message)
				props.setErrors(newError)
			})
		});
	}

	return (
		<div className="row">
			<div className="col-sm-4"></div>
			<div className="col-sm-4">

				{/* <!-- Leader suggestions area --> */}
				<div className="border">
					<div className="p-2 border-bottom">
						<h2>Leaders</h2>
					</div>
					{leaders.map((leader, key) => (
						<div key={key} className='d-flex border-bottom'>
							<div className='p-2'>
								<Link to={`/profile/:${leader.id}`}>
									<Img src={leader.pp} width="100px" height="100px" alt="musician" />
								</Link>
							</div>
							<div className='p-2 flex-grow-1'>
								<Link to={`/profile/${leader.id}`} className="text-dark">
									<b>{leader.name}</b>
								</Link>
								<h6>{leader.bio}</h6>
							</div>
							<div className="p-2">
								{leader.hasFollowed ?
									<button className={'btn btn-sm btn-light float-right rounded-0'}
										onClick={() => onFollow(leader.id)}>
										Followed
										<svg className='bi bi-check'
											width='1.5em'
											height='1.5em'
											viewBox='0 0 16 16'
											fill='currentColor'
											xmlns='http://www.w3.org/2000/svg'>
											<path fillRule='evenodd'
												d='M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z' />
										</svg>
									</button> :
									<Button btnClass={'btn btn-sm btn-success rounded-0 float-right'}
										onClick={() => onFollow(leader.id)}
										btnText={'follow'} />}
							</div>
						</div>
					))}
				</div>
				{/* <!-- Leader suggestion area end --> */}
			</div>
			<div className="col-sm-4"></div>
		</div>
	)
}

export default Leaders
