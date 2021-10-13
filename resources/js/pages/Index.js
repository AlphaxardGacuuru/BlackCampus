import React, { useState, useEffect } from 'react'
import { Link, useHistory, useLocation } from 'react-router-dom'
import axios from 'axios'

import Img from '../components/Img'
import Button from '../components/Button'

const Index = (props) => {

	const history = useHistory()

	const [leaders, setLeaders] = useState([])
	const [posts, setPosts] = useState([])

	useEffect(() => {
		// Get Users
		axios.get(`${props.url}/api/posts`)
			.then((res) => {
				setLeaders(res.data[0])
				setPosts(res.data[1])
			}).catch((err) => props.setErrors([err.data]))
	}, [])

	// Function for following musicians
	const onFollow = (musician) => {
		axios.get('/sanctum/csrf-cookie').then(() => {
			axios.post(`${props.url}/api/follows`, {
				musician: musician
			}).then((res) => {
				props.setMessage(res.data)
				axios.get(`${props.url}/api/follows`).then((res) => props.setFollows(res.data))
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

	// Function for liking posts
	const onPostLike = (post) => {
		axios.get('sanctum/csrf-cookie').then(() => {
			axios.post(`${props.url}/api/post-likes`, {
				post: post
			}).then((res) => {
				props.setMessage(res.data)
				axios.get(`${props.url}/api/post-likes`).then((res) => props.setPostLikes(res.data))
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
		})
	}

	// Function for deleting posts
	const onDeletePost = (id) => {
		axios.get('sanctum/csrf-cookie').then(() => {
			axios.delete(`${props.url}/api/posts/${id}`).then((res) => {
				props.setMessage(res.data)
				axios.get(`${props.url}/api/posts`).then((res) => props.setPosts(res.data))
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
		})
	}

	// Function for voting in poll
	const onPoll = (post, parameter) => {
		axios.get('sanctum/csrf-cookie').then(() => {
			axios.post(`${props.url}/api/polls`, {
				post: post,
				parameter: parameter
			}).then((res) => {
				props.setMessage(res.data)
				axios.get(`${props.url}/api/polls`).then((res) => props.setPolls(res.data))
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
		})
	}

	var percentage = 100

	return (
		<>
			{/* Post button */}
			{props.auth.account_type == 'leader' &&
				<Link to="/post-create" id="floatBtn">
					<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" className="bi bi-pen"
						viewBox="0 0 16 16">
						<path
							d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
					</svg>
				</Link>}

			{/* <!-- Profile info area --> */}
			<div className="row">
				<div className="col-sm-1 hidden"></div>
				<div className="col-sm-3 hidden">
					<div className="d-flex border">
						<div className="p-2">
							<div className="avatar-thumbnail-sm" style={{ borderRadius: "50%" }}>
								<Link to={"/profile/" + props.auth.id}>
									<Img src={'/storage/' + props.auth.pp}
										width="100px"
										height="100px"
										alt="avatar" />
								</Link>
							</div>
						</div>
						<div className="p-2 flex-grow-1">
							<h5 className="m-0 p-0"
								style={{
									width: "160px",
									whiteSpace: "nowrap",
									overflow: "hidden",
									textOverflow: "clip"
								}}>
								{props.auth.name}
							</h5>
							<h6 className="m-0 p-0"
								style={{
									width: "140px",
									whiteSpace: "nowrap",
									overflow: "hidden",
									textOverflow: "clip"
								}}>
								<small>{props.auth.id}</small>
							</h6>
						</div>
					</div>
					<div className="d-flex border-bottom border-left border-right">
						<div className="p-2 flex-fill">
							<h6>Posts</h6>
							<br />
						</div>
						<div className="p-2 flex-fill" style={{ color: "purple" }}>
							<Link to='/fans'>
								<h6>Fans</h6>

								<br />
							</Link>
						</div>
					</div>
					{/* <!-- Profile info area End --> */}

					<br />

					{/* <!-- Musician suggestions area --> */}
					<div className="border">
						<div className="p-2 border-bottom">
							<h2>Leaders to follow</h2>
						</div>
						{leaders.map((leader, key) => (
							<div key={key} className='media p-2 border-bottom'>
								<div className='media-left'>
									<Link to={`/profile/:${leader.id}`}>
										<Img src={`/storage/${leader.pp}`} width="30px" height="30px" alt="musician" />
									</Link>
								</div>
								<div className='media-body'>
									<Link to={`/profile/`} className="text-dark">
										<b></b>
										<small><i></i></small>
									</Link>
									<button className={'btn btn-light float-right rounded-0'}
										onClick={() => onFollow()}>
										Followed
										<svg className='bi bi-check' width='1.5em' height='1.5em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
											<path fillRule='evenodd'
												d='M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z' />
										</svg>
									</button>
									<Button btnClass={'btn float-right'}
										onClick={() => onFollow()}
										btnText={'follow'} />
									<Button
										onClick={() =>
											props.setErrors([`You must have bought atleast one song by `])}
										btnText={'follow'} />
								</div>
							</div>
						))}
					</div>
				</div>
				{/* <!-- Leader suggestion area end --> */}

				<div className="col-sm-4">
					{/* <!-- ****** Stories Area ****** --> */}
					<div className="p-2 border">
						<h5>Songs for you</h5>
						<div className="hidden-scroll">
						</div>
					</div>
					{/* <!-- ****** Stories Area End ****** --> */}

					{/* <!-- Posts area --> */}
					{posts
						.reverse()
						.map((post, index) => (
							<div key={index} className='media p-2 border-bottom'>
								<div className='media-left'>
									<div className="avatar-thumbnail-xs" style={{ borderRadius: "50%" }}>
										<Link to={`/profile/${post.id}`}>
											<Img src={`${props.auth.pp}`}
												width="40px"
												height="40px"
												alt={'avatar'} />
										</Link>
									</div>
								</div>
								<div className='media-body'>
									<h6 className="media-heading m-0"
										style={{
											width: "100%",
											whiteSpace: "nowrap",
											overflow: "hidden",
											textOverflow: "clip"
										}}>
										<b>{post.name}</b>
										<small>{post.id}</small>
										<small>
											<i className="float-right mr-1">{post.created_at}</i>
										</small>
									</h6>
									<p className="mb-0">{post.text}</p>

									{/* Show media */}
									<div className="mb-1" style={{
										borderTopLeftRadius: "10px",
										borderTopRightRadius: "10px",
										borderBottomRightRadius: "10px",
										borderBottomLeftRadius: "10px",
										overflow: "hidden"
									}}>
										{post.media && <Img src={post.media} alt={'post-media'} width="100%" height="auto" />}
									</div>

									{/* Show poll */}
									{/* {post.parameter_1 ?
										(((new Date().getTime() - new Date(post.created_at).getTime()) / 86400000) < 1) ?
											polls.some((poll) => {
												return poll.id == props.auth.id &&
													poll.post_id == post.id &&
													poll.parameter == post.parameter_1
											}) ?
												<Button
													btnClass={"mysonar-btn btn-2 mb-1"}
													btnText={post.parameter_1}
													btnStyle={{ width: "100%" }}
													onClick={() => onPoll(post.id, post.parameter_1)} />
												: <Button
													btnClass={"mysonar-btn mb-1"}
													btnText={post.parameter_1}
													btnStyle={{ width: "100%" }}
													onClick={() => onPoll(post.id, post.parameter_1)} />
											: polls.some((poll) => {
												// Get percentage votes for poll
												percentage = polls
													.filter((poll) => poll.post_id == post.id &&
														poll.parameter == post.parameter_1)
													.length * 100 /
													polls.filter((poll) => poll.post_id == post.id).length

												return poll.id == props.auth.id &&
													poll.post_id == post.id &&
													poll.parameter == post.parameter_1
											}) ?
												<div className='progress rounded-0 mb-1' style={{ height: '33px' }}>
													<div className='progress-bar'
														style={{ width: `${percentage}%`, backgroundColor: "#232323" }}>
														{post.parameter_1}
													</div>
												</div>
												: <div className='progress rounded-0 mb-1' style={{ height: '33px' }}>
													<div className='progress-bar'
														style={{ width: `${percentage}%`, backgroundColor: "grey" }}>
														{post.parameter_1}
													</div>
												</div>
										: ""}

									{post.parameter_2 ?
										(((new Date().getTime() - new Date(post.created_at).getTime()) / 86400000) < 1) ?
											polls.some((poll) => {
												return poll.id == props.auth.id &&
													poll.post_id == post.id &&
													poll.parameter == post.parameter_2
											}) ?
												<Button
													btnClass={"mysonar-btn btn-2 mb-1"}
													btnText={post.parameter_2}
													btnStyle={{ width: "100%" }}
													onClick={() => onPoll(post.id, post.parameter_2)} />
												: <Button
													btnClass={"mysonar-btn mb-1"}
													btnText={post.parameter_2}
													btnStyle={{ width: "100%" }}
													onClick={() => onPoll(post.id, post.parameter_2)} />
											: polls.some((poll) => {
												// Get percentage votes for poll
												percentage = polls
													.filter((poll) => poll.post_id == post.id &&
														poll.parameter == post.parameter_2)
													.length * 100 /
													polls.filter((poll) => poll.post_id == post.id).length

												return poll.id == props.auth.id &&
													poll.post_id == post.id &&
													poll.parameter == post.parameter_2
											}) ?
												<div className='progress rounded-0 mb-1' style={{ height: '33px' }}>
													<div className='progress-bar'
														style={{ width: `${percentage}%`, backgroundColor: "#232323" }}>
														{post.parameter_2}
													</div>
												</div>
												: <div className='progress rounded-0 mb-1' style={{ height: '33px' }}>
													<div className='progress-bar'
														style={{ width: `${percentage}%`, backgroundColor: "grey" }}>
														{post.parameter_2}
													</div>
												</div>
										: ""}

									{post.parameter_3 ?
										(((new Date().getTime() - new Date(post.created_at).getTime()) / 86400000) < 1) ?
											polls.some((poll) => {
												return poll.id == props.auth.id &&
													poll.post_id == post.id &&
													poll.parameter == post.parameter_3
											}) ?
												<Button
													btnClass={"mysonar-btn btn-2 mb-1"}
													btnText={post.parameter_3}
													btnStyle={{ width: "100%" }}
													onClick={() => onPoll(post.id, post.parameter_3)} />
												: <Button
													btnClass={"mysonar-btn mb-1"}
													btnText={post.parameter_3}
													btnStyle={{ width: "100%" }}
													onClick={() => onPoll(post.id, post.parameter_3)} />
											: polls.some((poll) => {
												// Get percentage votes for poll
												percentage = polls
													.filter((poll) => poll.post_id == post.id &&
														poll.parameter == post.parameter_3)
													.length * 100 /
													polls.filter((poll) => poll.post_id == post.id).length

												return poll.id == props.auth.id &&
													poll.post_id == post.id &&
													poll.parameter == post.parameter_3
											}) ?
												<div className='progress rounded-0 mb-1' style={{ height: '33px' }}>
													<div className='progress-bar'
														style={{ width: `${percentage}%`, backgroundColor: "#232323" }}>
														{post.parameter_3}
													</div>
												</div>
												: <div className='progress rounded-0 mb-1' style={{ height: '33px' }}>
													<div className='progress-bar'
														style={{ width: `${percentage}%`, backgroundColor: "grey" }}>
														{post.parameter_3}
													</div>
												</div>
										: ""}

									{post.parameter_4 ?
										(((new Date().getTime() - new Date(post.created_at).getTime()) / 86400000) < 1) ?
											polls.some((poll) => {
												return poll.id == props.auth.id &&
													poll.post_id == post.id &&
													poll.parameter == post.parameter_4
											}) ?
												<Button
													btnClass={"mysonar-btn btn-2 mb-1"}
													btnText={post.parameter_4}
													btnStyle={{ width: "100%" }}
													onClick={() => onPoll(post.id, post.parameter_4)} />
												: <Button
													btnClass={"mysonar-btn mb-1"}
													btnText={post.parameter_4}
													btnStyle={{ width: "100%" }}
													onClick={() => onPoll(post.id, post.parameter_4)} />
											: polls.some((poll) => {
												// Get percentage votes for poll
												percentage = polls
													.filter((poll) => poll.post_id == post.id &&
														poll.parameter == post.parameter_4)
													.length * 100 /
													polls.filter((poll) => poll.post_id == post.id).length

												return poll.id == props.auth.id &&
													poll.post_id == post.id &&
													poll.parameter == post.parameter_4
											}) ?
												<div className='progress rounded-0 mb-1' style={{ height: '33px' }}>
													<div className='progress-bar'
														style={{ width: `${percentage}%`, backgroundColor: "#232323" }}>
														{post.parameter_4}
													</div>
												</div>
												: <div className='progress rounded-0 mb-1' style={{ height: '33px' }}>
													<div className='progress-bar'
														style={{ width: `${percentage}%`, backgroundColor: "grey" }}>
														{post.parameter_4}
													</div>
												</div>
										: ""}

									{post.parameter_5 ?
										(((new Date().getTime() - new Date(post.created_at).getTime()) / 86400000) < 1) ?
											polls.some((poll) => {
												return poll.id == props.auth.id &&
													poll.post_id == post.id &&
													poll.parameter == post.parameter_5
											}) ?
												<Button
													btnClass={"mysonar-btn btn-2 mb-1"}
													btnText={post.parameter_5}
													btnStyle={{ width: "100%" }}
													onClick={() => onPoll(post.id, post.parameter_5)} />
												: <Button
													btnClass={"mysonar-btn mb-1"}
													btnText={post.parameter_5}
													btnStyle={{ width: "100%" }}
													onClick={() => onPoll(post.id, post.parameter_5)} />
											: polls.some((poll) => {
												// Get percentage votes for poll
												percentage = polls
													.filter((poll) => poll.post_id == post.id &&
														poll.parameter == post.parameter_5)
													.length * 100 /
													polls.filter((poll) => poll.post_id == post.id).length

												return poll.id == props.auth.id &&
													poll.post_id == post.id &&
													poll.parameter == post.parameter_5
											}) ?
												<div className='progress rounded-0 mb-1' style={{ height: '33px' }}>
													<div className='progress-bar'
														style={{ width: `${percentage}%`, backgroundColor: "#232323" }}>
														{post.parameter_5}
													</div>
												</div> :
												<div className='progress rounded-0 mb-1' style={{ height: '33px' }}>
													<div className='progress-bar'
														style={{ width: `${percentage}%`, backgroundColor: "grey" }}>
														{post.parameter_5}
													</div>
												</div>
										: ""} */}

									{/* Total votes */}
									{/* {post.parameter_1 &&
										<small style={{ color: "grey" }}>
											<i>
												Total votes:
												{post.parameter_1 && polls.filter((poll) => {
													return poll.post_id == post.id
												}).length}
											</i>
											<br />
										</small>} */}

									{/* Post likes */}
									<a href="#" style={{ color: "#cc3300" }} onClick={(e) => {
										e.preventDefault()
										onPostLike(post.id)
									}}>
										<svg xmlns='http://www.w3.org/2000/svg' width='1.2em' height='1.2em' fill='currentColor'
											className='bi bi-heart-fill' viewBox='0 0 16 16'>
											<path fillRule='evenodd'
												d='M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z' />
										</svg>
										<small> </small>
									</a> :
									<a href="#" onClick={(e) => {
										e.preventDefault()
										onPostLike(post.id)
									}}>
										<svg xmlns='http://www.w3.org/2000/svg' width='1.2em' height='1.2em' fill='currentColor'
											className='bi bi-heart' viewBox='0 0 16 16'>
											<path
												d='m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z' />
										</svg>
										<small></small>
									</a>

									{/* Post comments */}
									<Link to={"post-show/" + post.id}>
										<svg className="bi bi-chat ml-5" width="1.2em" height="1.2em" viewBox="0 0 16 16"
											fill="currentColor" xmlns="http://www.w3.org/2000/svg">
											<path fillRule="evenodd"
												d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
										</svg>
										<small>
										</small>
									</Link>

									{/* <!-- Default dropup button --> */}
									<div className="dropup float-right">
										<a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
											aria-haspopup="true" aria-expanded="false">
											<svg className="bi bi-three-dots-vertical" width="1em" height="1em" viewBox="0 0 16 16"
												fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												<path fillRule="evenodd"
													d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
											</svg>
										</a>
										<div className="dropdown-menu dropdown-menu-right p-0" style={{ borderRadius: "0" }}>
											{post.id !== props.auth.id ?
												post.id !== "@blackmusic" &&
												<a href="#" className="dropdown-item" onClick={(e) => {
													e.preventDefault()
													onFollow(post.id)
												}}>
													<h6>Unfollow</h6>
												</a>
												: <a href='#' className="dropdown-item" onClick={(e) => {
													e.preventDefault();
													onDeletePost(post.id)
												}}>
													<h6>Delete post</h6>
												</a>}
										</div>
									</div>
								</div>
							</div>
						))
					}
				</div>
				{/* <!-- Posts area end --> */}

				<div className="col-sm-3"></div>

				<div className="col-sm-1"></div>
			</div>
		</>
	)
}

export default Index