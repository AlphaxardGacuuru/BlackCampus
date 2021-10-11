import React from 'react'
import { Link } from 'react-router-dom'
import { useLocation } from 'react-router-dom'

const Bottomnav = (props) => {

	const location = useLocation()

	return (
		<>
			<br className="anti-hidden" />
			<br className="anti-hidden" />
			{/* // <div className="col-sm-12 m-0 p-0"> */}
			<div className="bottomNav menu-content-area header-social-area">
				{/* Bottom Nav */}
				<div className="anti-hidden">
					<div className="container-fluid menu-area d-flex justify-content-between">
						{/* Home */}
						<Link
							to="/"
							style={{
								textAlign: "center",
								fontSize: "10px",
								fontWeight: "100",
								color: location.pathname == "/" ? "#D0B216" : "white"
							}}>
							<span style={{ fontSize: "20px", margin: "0" }} className="nav-link">
								<svg className="bi bi-house" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
									xmlns="http://www.w3.org/2000/svg">
									<path fillRule="evenodd"
										d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
									<path fillRule="evenodd"
										d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
								</svg>
							</span>
						</Link>
						{/* Home End */}
						{/* Discover */}
						<Link
							to="/video-charts"
							style={{
								textAlign: "center",
								fontSize: "10px",
								fontWeight: "100",
								color: location.pathname == "/video-charts" || location.pathname == "/audio-charts" ? "gold" : "white"
							}}>
							<span style={{ fontSize: "20px" }} className="nav-link">
								<svg className="bi bi-compass" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
									xmlns="http://www.w3.org/2000/svg">
									<path fillRule="evenodd"
										d="M8 15.016a6.5 6.5 0 1 0 0-13 6.5 6.5 0 0 0 0 13zm0 1a7.5 7.5 0 1 0 0-15 7.5 7.5 0 0 0 0 15z" />
									<path
										d="M6 1a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2H7a1 1 0 0 1-1-1zm.94 6.44l4.95-2.83-2.83 4.95-4.95 2.83 2.83-4.95z" />
								</svg>
							</span>
						</Link>
						{/* Discover End */}
					</div>
				</div>
				{/* Bottom Nav End */}
			</div>
		</>
	)
}

export default Bottomnav