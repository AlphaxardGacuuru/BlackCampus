import React from 'react'
import Button from '../components/Button'
import axios from 'axios';
import { Link, useHistory } from 'react-router-dom'
import { useState, useEffect } from 'react'

// Import React FilePond
import { FilePond, registerPlugin } from 'react-filepond';

// Import FilePond styles
import 'filepond/dist/filepond.min.css';

// Import the Image EXIF Orientation and Image Preview plugins
// Note: These need to be installed separately
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImageCrop from 'filepond-plugin-image-crop';
import FilePondPluginImageTransform from 'filepond-plugin-image-transform';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

// Register the plugins
registerPlugin(
	FilePondPluginImageExifOrientation,
	FilePondPluginImagePreview,
	FilePondPluginFileValidateType,
	FilePondPluginImageCrop,
	FilePondPluginImageTransform,
	FilePondPluginFileValidateSize
);

const PostCreate = (props) => {

	// Get csrf token
	const token = document.head.querySelector('meta[name="csrf-token"]');

	// Declare states
	const [text, setText] = useState("")
	const [media, setMedia] = useState("")
	// const [preview, setPreview] = useState()
	const [para1, setPara1] = useState("")
	const [para2, setPara2] = useState("")
	const [para3, setPara3] = useState("")
	const [para4, setPara4] = useState("")
	const [para5, setPara5] = useState("")
	const [mediaStyle, setMediaStyle] = useState()
	const [pollStyle, setPollStyle] = useState()
	const [display1, setDisplay1] = useState("none")
	const [display2, setDisplay2] = useState("none")
	const [display3, setDisplay3] = useState("none")
	const [display4, setDisplay4] = useState("none")
	const [display5, setDisplay5] = useState("none")

	// Get history for page location
	const history = useHistory()

	// Assign id to element
	// const mediaInput = React.useRef(null)

	// Declare new FormData object for form data
	const formData = new FormData();

	const onSubmit = (e) => {
		e.preventDefault()

		// Add form data to FormData object
		formData.append("text", text);
		// If media has been selected then append the file to FormData object
		media && formData.append("media", media);
		formData.append("para1", para1);
		formData.append("para2", para2);
		formData.append("para3", para3);
		formData.append("para4", para4);
		formData.append("para5", para5);

		// Send data to PostsController
		// Get csrf cookie from Laravel inorder to send a POST request
		axios.get('sanctum/csrf-cookie').then(() => {
			axios.post(`${props.url}/api/posts`, formData).then((res) => {
				props.setMessage("Posted")
				axios.get(`${props.url}/api/posts`).then((res) => props.setPosts(res.data))
				setTimeout(() => history.push('/'), 1000)
			}).catch(err => {
				const resErrors = err.response.data.errors

				var resError
				var newError = []
				for (resError in resErrors) {
					newError.push(resErrors[resError])
				}
				props.setErrors(newError)
			})
		})
	}

	return (
		<div className="row">
			<div className="col-sm-4"></div>
			<div className="col-sm-4">
				<div className="contact-form">
					<form action="POST" onSubmit={onSubmit}>
						<div className="float-left">
							{/* <!-- Close Icon --> */}
							<Link to="/">
								<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" className="bi bi-x"
									viewBox="0 0 16 16">
									<path
										d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
								</svg>
							</Link>
						</div>
						<div className="form group float-right">
							<Button type="submit" btnClass={'btn btn-success rounded-0'} btnText={'post'} />
						</div>
						<br />

						<textarea
							name='post-text'
							className='form-control rounded-0 mt-5'
							style={{ height: 200 }}
							placeholder="What's on your mind"
							onChange={(e) => { setText(e.target.value) }}>
						</textarea>
						<br />

						<div className="d-flex text-center">
							<div className="p-2 flex-fill"
								style={{ backgroundColor: "#232323", display: mediaStyle }}
								onClick={() => {
									// mediaInput.current.click()
									setPollStyle("none")
								}}>
								<span style={{ color: "white" }}>
									<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
										className="bi bi-image" viewBox="0 0 16 16">
										<path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
										<path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z" />
									</svg>
								</span>
							</div>
							<div className="p-2 flex-fill"
								style={{ backgroundColor: "#232323", display: pollStyle }}
								onClick={() => {
									setDisplay1("inline")
									setMediaStyle("none")
								}}>
								<span style={{ color: "white" }}>
									<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
										className="bi bi-bar-chart" viewBox="0 0 16 16">
										<path
											d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z" />
									</svg>
								</span>
							</div>
						</div>

						{/* Upload Image */}
						{pollStyle == "none" &&
							<div className="mt-2">
								<FilePond
									name="filepond-media"
									labelIdle='Drag & Drop your Image or <span class="filepond--label-action"> Browse </span>'
									imageCropAspectRatio="1:1"
									acceptedFileTypes={['image/*']}
									stylePanelAspectRatio="16:9"
									allowRevert={true}
									server={{
										url: `${props.url}/api`,
										process: {
											url: "/posts",
											headers: { 'X-CSRF-TOKEN': token.content },
											onload: res => {
												setMedia(res)
											},
										},
										revert: {
											url: `/posts/${media.substr(11)}`,
											headers: { 'X-CSRF-TOKEN': token.content },
											onload: res => {
												props.setMessage(res)
											},
										},
									}} />
							</div>}

						<div>
							{/* Poll inputs */}
							<input
								type='text'
								style={{ display: display1 }}
								className='form-control rounded-0 mt-2'
								placeholder="Parameter 1"
								onChange={(e) => {
									setDisplay2("inline")
									setPara1(e.target.value)
								}} />

							<input
								type='text'
								style={{ display: display2 }}
								className='form-control rounded-0 mt-2'
								placeholder='Parameter 2'
								onChange={(e) => {
									setDisplay3("inline")
									setPara2(e.target.value)
								}} />

							<input
								type='text'
								style={{ display: display3 }}
								className='form-control rounded-0 mt-2'
								placeholder='Parameter 3'
								onChange={(e) => {
									setDisplay4("inline")
									setPara3(e.target.value)
								}} />

							<input
								type='text'
								style={{ display: display4 }}
								className='form-control rounded-0 mt-2'
								placeholder='Parameter 4'
								onChange={(e) => {
									setDisplay5("inline")
									setPara4(e.target.value)
								}} />

							<input
								type='text'
								style={{ display: display5 }}
								className='form-control rounded-0 mt-2'
								placeholder='Parameter 5'
								onChange={(e) => setPara5(e.target.value)} />
						</div>
					</form>
				</div>
			</div>
			<div className="col-sm-4"></div>
		</div>
	)
}

export default PostCreate