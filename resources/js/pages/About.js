import React from 'react'

const About = () => {
	return (
		<div className="row">
			<div className="col-sm-1"></div>
			<div className="col-sm-6 contact-form text-center">
				<h1>Welcome to the Help Center</h1>
				<br />
				<img
					src="/storage/img/black-campus-512.png"
					width="50%"
					height="auto"
					loading="lazy" />
				<br />
				<br className="hidden" />
				<h4>Black Campus is a social network that works as an onpne notice board where information can be disseminated to the entire fraternity.</h4>
				<br />
				<h3>Accounts</h3>
				<img
					src='/storage/profile-pics/male_musician.png'
					style={{
						verticalApgn: "top",
						width: "50px",
						height: "50px",
						borderRadius: "50%"
					}}
					alt="avatar" />
				<img
					src='/storage/profile-pics/male_avatar.png'
					style={{
						verticalApgn: "top",
						width: "50px",
						height: "50px",
						borderRadius: "50%"
					}}
					alt='avatar' />
				<br />
				<br />
				<p>There are two types of accounts, Leaders and Normal.
					<br />
					Leaders have the abipty to post and add stories.</p>
				<br />
				<h2>HOW TO USE BLACK CAMPUS</h2>
				<h3>How to Post</h3>
				<p>While on the home page, go to the compose icon
					<button
						id='floatBtn'
						className="ml-2"
						style={{
							position: "relative",
							fontSize: "10px",
							height: "60px",
							width: "60px",
							zIndex: 0,
							lineHeight: "10px",
							right: "0px",
							top: "0px"
						}}>
						<svg
							xmlns="http://www.w3.org/2000/svg"
							width="30"
							height="30"
							fill="currentColor"
							className="bi bi-pen"
							viewBox="0 0 16 16">
							<path
								d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
						</svg>
					</button>
				</p>
				<br />
				<h3>How to Comment on a Post</h3>
				<p>While on the home page, click on a post's comment icon
					<svg className="bi bi-chat ml-2"
						width="1.2em"
						height="1.2em"
						viewBox="0 0 16 16"
						fill="currentColor"
						xmlns="http://www.w3.org/2000/svg">
						<path fillRule="evenodd"
							d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
					</svg>
				</p>
				<br />
				<h3>How to Add a story</h3>
				<p>While on the home page, click on the add story icon</p>
				<br />

			</div>
			<div className="col-sm-5"></div>
		</div>
	)
}

export default About