let cvService = {
    serve: function () {
        // Event listener for create button
        document.querySelector('.createButton').addEventListener('click', function (event) {
            event.preventDefault();
            
            let cvName = document.querySelector('.create-cv .field label.input').value;
            let bio = document.querySelector('.create-cv .field input[type="text"]').value;
  
            // Education
            let educationUniversity = document.querySelector('.create-cv .field.education input[type:"text"]').value;
            let educationDegree = document.querySelector('.create-cv .field.education input[type:"text"]').value;
            let educationFieldOfStudy = document.querySelector('.create-cv .field.education input[type:"text"]').value;
            let educationStartDate = document.querySelector('.create-cv .field.education input:nth-of-type(4)').value;
            let educationEndDate = document.querySelector('.create-cv .field.education input:nth-of-type(5)').value;
            let educationDescription = document.querySelector('.create-cv .field.education input[type:"text"]').value;

            // Experience
            let experienceCompany = document.querySelector('.create-cv .field.experience input[type:"text"]').value;
            let experiencePosition = document.querySelector('.create-cv .field.experience input[type:"text"]').value;
            let experienceStartDate = document.querySelector('.create-cv .field.experience input:nth-of-type(3)').value;
            let experienceEndDate = document.querySelector('.create-cv .field.experience input:nth-of-type(4)').value;
            let experienceDescription = document.querySelector('.create-cv .field.experience input[type:"text"]').value;

            // Skills
            let skills = document.querySelector('.create-cv .field.skills input').value;


            let data = {
                cvName: cvName,
                bio: bio,
                education: {
                  university: educationUniversity,
                  degree: educationDegree,
                  fieldOfStudy: educationFieldOfStudy,
                  startDate: educationStartDate,
                  endDate: educationEndDate,
                  description: educationDescription
                },
                experience: {
                  company: experienceCompany,
                  position: experiencePosition,
                  startDate: experienceStartDate,
                  endDate: experienceEndDate,
                  description: experienceDescription
                },
                skills: skills
              };

            // AjaxPOST
            $.ajax({
                type: "POST",
                url: "/cv",
                data: JSON.stringify(data),
                contentType: "application/json",
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
                },
                success: function (response) {
                    console.log("CV created successfully");
                },
                error: function (response) {
                    console.log("Failed to create CV");
                }
            }); 
        });

      

        

    }

}