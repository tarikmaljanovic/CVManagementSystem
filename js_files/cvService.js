let cvService = {
    serve: function () {
        $("#createButton").click(function() {
            let education_inputs = $(".edu-create :input");
            let experience_inputs = $(".exp-create :input");
            let skills_input = $(".skills :input")[0].value.split(',');
            let cv_name = $("#cv-name").val();
            let bio = $("#bio").val();
            let edu_form_data = [];
            let exp_form_data = [];

            let counter = 0;
            let temp = {};

            if(education_inputs.length == 6) {
                for(let input of education_inputs) {
                    temp[input.placeholder] = input.value
                }
                edu_form_data.push(temp)
            } else {
                for(let input of education_inputs) {
                    if(counter < 5) {
                        temp[input.placeholder] = input.value
                        counter++
                    } else if (counter == 5) {
                        temp[input.placeholder] = input.value
                        counter++

                        edu_form_data.push(temp)
                        temp = {}
                        counter = 0
                    }
                }
            }

            temp = {}

            if(experience_inputs.length == 5) {
                for(let input of experience_inputs) {
                    temp[input.placeholder] = input.value
                }
                exp_form_data.push(temp)
            } else {
                for(let input of experience_inputs) {
                    if(counter < 4) {
                        temp[input.placeholder] = input.value
                        counter++
                    } else if (counter == 4) {
                        temp[input.placeholder] = input.value
                        counter++
                        
                        exp_form_data.push(temp)
                        temp = {}
                        counter = 0
                    }
                }
            }

            $.ajax({
                url: "cv",
                type: "POST",
                data: JSON.stringify({
                    cv_name: cv_name,
                    bio: bio,
                    user_id: JSON.parse(localStorage.getItem("user")).id
                }),
                contentType: "application/json",
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
                },
                success: function(data) {
                    for(let edu of edu_form_data) {
                        edu["cv_id"] = data.data.id
                        cvService.addEdu(edu)
                    }

                    for(let exp of exp_form_data) {
                        exp["cv_id"] = data.data.id
                        cvService.addExp(exp)
                    }

                    for(let skill of skills_input) {
                        cvService.addSkill({
                            skill_name: skill.trim(),
                            cv_id: data.data.id
                        })
                    }
                    window.location.reload()
                },
                error: function() {
                    console.log("CV Creation Failed")
                }
            })

            return false;
        });

        $.ajax({
            url: "getCvsByUser/" + JSON.parse(localStorage.getItem("user")).id,
            type: "GET",
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
            },
            success: function(data) {
                for(cv of data) {
                    $(".cv-section").prepend(`
                        <div class="column is-3 cv">
                            <div class="notification">
                                <p class="cv-title">${cv.cv_name}</p>
                            </div>
                            <div class="buttons">
                                <button class="button is-rounded" onClick="cvService.editCv(${cv.id})">Edit</button>
                                <button class="button is-rounded" onClick="cvService.deleteCv(${cv.id})">Delete</button>
                            </div>
                        </div>
                    `)
                }
            },
            error: function() {
                console.log("Failed to load CVs");
            }
        })
    },

    addEdu: function(edu_data) {
        $.ajax({
            url: "education",
            type: "POST",
            data: JSON.stringify(edu_data),
            contentType: "application/json",
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
            },
            success: function(data) {
                console.log("Education Added Successfully")
            },
            error: function() {
                console.log("Education Creation Failed")
            }
        })
    },

    addExp: function(exp_data) {
        $.ajax({
            url: "experience",
            type: "POST",
            data: JSON.stringify(exp_data),
            contentType: "application/json",
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
            },
            success: function(data) {
                console.log("Experience Added Successfully")
            },
            error: function() {
                console.log("Experience Creation Failed")
            }
        })
    },

    addSkill: function(skill_data) {
        $.ajax({
            url: "userSkill",
            type: "POST",
            data: JSON.stringify(skill_data),
            contentType: "application/json",
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
            },
            success: function(data) {
                console.log("Skill Added Successfully")
            },
            error: function() {
                console.log("Skill Creation Failed")
            }
        })
    },

    deleteCv: function(cv_id) {
        $(".confirmation").removeClass("is-hidden");

        $("#confirm-delete").click(function() {
            $.ajax({
                url: "delEducationByCv/" + cv_id,
                type: "DELETE",
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
                },
                success: function(data) {
                    console.log("Education Deleted Successfully");
                },
                error: function() {
                    console.log("Failed to delete education");
                }
            })

            $.ajax({
                url: "delExperienceByCv/" + cv_id,
                type: "DELETE",
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
                },
                success: function(data) {
                    console.log("Experience Deleted Successfully");
                },
                error: function() {
                    console.log("Failed to delete experience")
                }
            })

            $.ajax({
                url: "delSkillsByCv/" + cv_id,
                type: "DELETE",
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
                },
                success: function(data) {
                    console.log("Skills Deleted Successfully");
                },
                error: function() {
                    console.log("Failed to delete skills")
                }
            })

            $.ajax({
                url: "cvs/" + cv_id,
                type: "DELETE",
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
                },
                success: function(data) {
                    console.log("CV Deleted Successfully");
                },
                error: function() {
                    console.log("Failed to delete CV")
                }
            })

            $(".confirmation").addClass("is-hidden");
            window.location.reload()
            return false;
        });


        $("#stop-delete").click(function() {
            $(".confirmation").addClass("is-hidden");

            return false;
        });
    },

    editCv: function(cv_id) {
        $(".edit-cv").removeClass("is-hidden");
        let educations = []
        let experiences = []
        let skills = []
        
        $.ajax({
            url: "cvs/" + cv_id,
            type: "GET",
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
            },
            success: function(data) {
                $("#cv-name2").val(data.cv_name)
                $("#bio2").val(data.bio)
            }
        })

        $.ajax({
            url: "getEducationByCv/" + cv_id,
            type: "GET",
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
            },
            success: function(data) {
                for(let edu of data) {
                    educations.push(edu)
                    $(".edu-edit").append(`
                        <label class="label">Education</label>
                        <div class="control">
                            <input class="input" type="text" placeholder="edu_inst_name" value="${edu.edu_inst_name}">
                            <input class="input" type="text" placeholder="degree" value="${edu.degree}">
                            <input class="input" type="text" placeholder="field_of_study" value="${edu.field_of_study}">
                            <input class="input" type="number" placeholder="start_date" value="${edu.start_date}">
                            <input class="input" type="number" placeholder="end_date" value="${edu.end_date}">
                            <textarea class="input" placeholder="description">${edu.description}</textarea>
                        </div>
                    `)
                }
            }
        })

        $.ajax({
            url: "getExperienceByCv/" + cv_id,
            type: "GET",
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
            },
            success: function(data) {
                for(let exp of data) {
                    experiences.push(exp)
                    $(".exp-edit").append(`
                        <label class="label">Experience</label>
                        <div class="control">
                            <input class="input" type="text" placeholder="company_name" value="${exp.company_name}">
                            <input class="input" type="text" placeholder="position" value="${exp.position}">
                            <input class="input" type="number" placeholder="start_date" value="${exp.start_date}">
                            <input class="input" type="number" placeholder="end_date" value="${exp.end_date}">
                            <textarea class="input" placeholder="description">${exp.description}</textarea>
                        </div>
                    `)
                }
            }
        })

        $.ajax({
            url: "getSkillsByCv/" + cv_id,
            type: "GET",
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
            },
            success: function(data) {
                let skills_str = ""
                for(let skill of data) {
                    skills.push(skill)
                    skills_str += skill.skill_name + ", "
                }
                $("#skills-edit").val(skills_str)
            }
        })

        $("#save-cv-changes").click(function() {
            let education_inputs = $(".edu-edit :input");
            let experience_inputs = $(".exp-edit :input");
            let skills_input = $("#skills-edit")[0].value.split(',');
            let cv_name = $("#cv-name2").val();
            let bio = $("#bio2").val();
            let edu_form_data = [];
            let exp_form_data = [];

            let counter = 0;
            let temp = {};

            if(education_inputs.length == 6) {
                for(let input of education_inputs) {
                    temp[input.placeholder] = input.value
                }
                edu_form_data.push(temp)
            } else {
                for(let input of education_inputs) {
                    if(counter < 5) {
                        temp[input.placeholder] = input.value
                        counter++
                    } else if (counter == 5) {
                        temp[input.placeholder] = input.value
                        counter++

                        edu_form_data.push(temp)
                        temp = {}
                        counter = 0
                    }
                }
            }

            temp = {}

            if(experience_inputs.length == 5) {
                for(let input of experience_inputs) {
                    temp[input.placeholder] = input.value
                }
                exp_form_data.push(temp)
            } else {
                for(let input of experience_inputs) {
                    if(counter < 4) {
                        temp[input.placeholder] = input.value
                        counter++
                    } else if (counter == 4) {
                        temp[input.placeholder] = input.value
                        counter++
                        
                        exp_form_data.push(temp)
                        temp = {}
                        counter = 0
                    }
                }
            }

            $.ajax({
                url: "cvUpdate",
                type: "POST",
                data: {
                    cv_name: cv_name,
                    bio: bio,
                    id: cv_id
                },
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
                },
                success: function(data) {
                    console.log("CV Updated Successfully")
                },
                error: function() {
                    console.log("CV Update Failed")
                }
            })

            for(let i = 0; i < edu_form_data.length; i++) {
                let id = educations[i].id
                edu_form_data[i].id = id
                educations[i] = edu_form_data[i]
            }

            for(let i = 0; i < exp_form_data.length; i++) {
                let id = experiences[i].id
                exp_form_data[i].id = id
                experiences[i] = exp_form_data[i]
            }

            for(let i = 0; i < skills.length; i++) {
                skills[i].skill_name = skills_input[i]
            }


            for(let edu of educations) {
                $.ajax({
                    url: "eduUpdate",
                    type: "POST",
                    data: edu,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
                    },
                    success: function(data) {
                        console.log("Education Updated Successfully")
                    },
                    error: function() {
                        console.log("Education Update Failed")
                    }
                })
            }

            for(let exp of experiences) {
                $.ajax({
                    url: "expUpdate",
                    type: "POST",
                    data: exp,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
                    },
                    success: function(data) {
                        console.log("Experience Updated Successfully")
                    },
                    error: function() {
                        console.log("Experience Update Failed")
                    }
                })
            }

            for(let skill of skills) {
                $.ajax({
                    url: "skillUpdate",
                    type: "POST",
                    data: {
                        skill_name: skill.skill_name,
                        id: skill.id
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
                    },
                    success: function(data) {
                        console.log("Skill Updated Successfully");
                    },
                    error: function() {
                        console.log("Failed to update Skill")
                    }
                })
            }
            window.location.reload()
        })
    }
}