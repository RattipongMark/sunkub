import React, { useState } from 'react';
import axios from 'axios';

export const Auth = () => {
    const [formData, setFormData] = useState({
        fname: '',
        lname: '',
        gender: '',
        dob: '',
        email: '',
        password: '',
        password_confirmation: ''
    });

    const handleChange = (event) => {
        setFormData({ ...formData, [event.target.name]: event.target.value });
    };

    const handleSubmit = async (event) => {
        event.preventDefault();
        try {
            const response = await axios.post('http://127.0.0.1:8000/api/register', formData);
            console.log(response.data);
            // Handle successful response
        } catch (error) {
            if (error.response && error.response.data && error.response.data.errors) {
                const errorMessages = error.response.data.errors;
                // Display error messages to the user
                console.log(errorMessages);
            } else {
                console.error(error);
                // Handle other types of errors
            }
        }
    };
    

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Register</div>

                        <div className="card-body">
                            <form onSubmit={handleSubmit}>
                                {/* CSRF token */}
                                {/* @csrf */}

                                <div className="row mb-3">
                                    <label htmlFor="fname" className="col-md-4 col-form-label text-md-end">FirstName</label>

                                    <div className="col-md-6">
                                        <input id="fname" type="text" className="form-control" name="fname" value={formData.fname} onChange={handleChange}/>
                                    </div>
                                </div>

                                <div className="row mb-3">
                                    <label htmlFor="lname" className="col-md-4 col-form-label text-md-end">LastName</label>

                                    <div className="col-md-6">
                                        <input id="lname" type="text" className="form-control" name="lname" value={formData.lname} onChange={handleChange} required autoComplete="lname" />
                                    </div>
                                </div>

                                <div className="row mb-3">
                                    <label htmlFor="gender" className="col-md-4 col-form-label text-md-end">Gender</label>

                                    <div className="col-md-6">
                                        <select id="gender" className="form-select" name="gender" value={formData.gender} onChange={handleChange} required autoComplete="gender" autoFocus>
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div className="row mb-3">
                                    <label htmlFor="dob" className="col-md-4 col-form-label text-md-end">Date of Birth</label>

                                    <div className="col-md-6">
                                        <input id="dob" type="date" className="form-control" name="dob" value={formData.dob} onChange={handleChange} required autoComplete="dob" />
                                    </div>
                                </div>

                                <div className="row mb-3">
                                    <label htmlFor="email" className="col-md-4 col-form-label text-md-end">Email Address</label>

                                    <div className="col-md-6">
                                        <input id="email" type="email" className="form-control" name="email" value={formData.email} onChange={handleChange} required autoComplete="email" />
                                    </div>
                                </div>

                                <div className="row mb-3">
                                    <label htmlFor="password" className="col-md-4 col-form-label text-md-end">Password</label>

                                    <div className="col-md-6">
                                        <input id="password" type="password" className="form-control" name="password" value={formData.password} onChange={handleChange} required autoComplete="new-password" />
                                    </div>
                                </div>

                                <div className="row mb-3">
                                    <label htmlFor="password-confirm" className="col-md-4 col-form-label text-md-end">Confirm Password</label>

                                    <div className="col-md-6">
                                        <input id="password-confirm" type="password" className="form-control" name="password_confirmation" value={formData.password_confirmation} onChange={handleChange} required autoComplete="new-password" />
                                    </div>
                                </div>

                                <div className="row mb-0">
                                    <div className="col-md-6 offset-md-4">
                                        <button type="submit" className="btn btn-primary">
                                            Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};
