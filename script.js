window.addEventListener("load", function ()
{
    var containerToHide = document.getElementById("createPost_containerID");
    var createBtn = document.getElementById("CreateBtn");

    if (containerToHide != null)
    {
        containerToHide.style.display = "none";
    }

    if (createBtn != null)
    {
        createBtn.addEventListener("click", function ()
        {
            if (containerToHide != null)
            {
                var isHidden = window.getComputedStyle(containerToHide).display === "none"; // Check if the container is currently hidden

                if (isHidden == true)
                {
                    containerToHide.style.display = "block";
                    createBtn.value = "Close Form";
                }
                else
                {
                    containerToHide.style.display = "none";
                    createBtn.value = "Create Post";
                }
            }
        });
    }
});

function Validate() {
    let errMsg = "";
    let result = true;

    //fields 

    const fileUpload = document.getElementById("file-upload"); //file upload control
    const postTitle = document.getElementById("post-title").value.trim(); //title
    const postAuthor = document.getElementById("post-author").value.trim(); //author
    const postDescription = document.getElementById("post-description").value.trim(); //description
    const postContent = document.getElementById("post-content").value.trim(); //content

    const checkSoftware = document.getElementById("Software").checked;
    const checkEngineering = document.getElementById("Engineering").checked;
    const checkUniProject = document.getElementById("Uni_Project").checked;
    const checkPersonalProject = document.getElementById("Personal_Project").checked;
    const checkWorkProject = document.getElementById("Work_Project").checked;
    const checkGroupProject = document.getElementById("Group_Project").checked;
    const checkOpenSource = document.getElementById("Open_Source").checked;
    const checkRobotics = document.getElementById("Robotics").checked;
    const checkGameDevelopment = document.getElementById("Game_Development").checked;
    const checkWebDevelopment = document.getElementById("Web_Development").checked;
    const checkCode = document.getElementById("Code").checked;

    //validation logic

    //cxheck that file is valid type
    if (fileUpload != null)
    {
        const files = fileUpload.files;

        if (files.length > 0)
        {
            const allowedTypes = ["jpg", "jpeg", "png"];

            for (let i = 0; i < files.length; i++)
            {
                const file = files[i];
                const fileName = file.name;

                let fileExtension = "";

                if (fileName.includes(".") == true)
                {
                    const splitName = fileName.split(".");
                    fileExtension = splitName[splitName.length - 1].toLowerCase();
                }
                else
                {
                    fileExtension = "";
                }

                let isAllowed = false;

                for (let j = 0; j < allowedTypes.length; j++)
                {
                    if (fileExtension === allowedTypes[j])
                    {
                        isAllowed = true;
                        break;
                    }
                }

                if (isAllowed == false)
                {
                    errMsg = errMsg + "File type not allowed: " + fileName + "\n";
                    result = false;
                    errMsg = errMsg + "Allowed file types are: " + allowedTypes.join(", ") + "\n";
                }
            }
        }
    }

    if (fileUpload == null || fileUpload.files.length == 0) {
        errMsg = errMsg + "Please upload at least one file.\n";
        result = false;
    }

    //check fields are not empty
    if (!checkCode && !checkEngineering && !checkGameDevelopment && !checkGroupProject && !checkOpenSource && !checkPersonalProject && !checkRobotics && !checkSoftware && !checkUniProject && !checkWebDevelopment && !checkWorkProject) {
        errMsg = errMsg + "Please select at least one category.\n";
        result = false;
    }

    if (postTitle == "") {
        errMsg = errMsg + "Please enter a post title.\n";
        result = false;
    }
    if (postAuthor == "") {
        errMsg = errMsg + "Please enter the post author.\n";
        result = false;
    }
    if (postDescription == "") {
        errMsg = errMsg + "Please enter a post description.\n";
        result = false;
    }
    if (postContent == "") {
        errMsg = errMsg + "Please enter the post content.\n";
        result = false;
    }   

    //check field lengths
    if (postTitle.length > 50 || postTitle.length < 15) {
        errMsg = errMsg + "Post title must be between 15 and 50 characters.\n";
        result = false;
    }

    if (postAuthor.length > 30 || postAuthor.length < 5) {
        errMsg = errMsg + "Post author must be between 5 and 30 characters.\n";
        result = false;
    }

    if (postDescription.length > 150 || postDescription.length < 20) {
        errMsg = errMsg + "Post description must be between 20 and 150 characters.\n";
        result = false;
    }
    if (postContent.length < 100 || postContent.length > 500) {
        errMsg = errMsg + "Post content must be between 100 and 500 characters.\n";
        result = false;
    }


    //return results
    if (errMsg !== "") {
        alert(errMsg);
        result = false;
    }
    return result;
}

window.addEventListener("load", () => {
    const form = document.getElementById("create_post_form");
    if (form) {
        form.addEventListener("submit", (event) => {
            if (!Validate()) event.preventDefault();
        });
    }
});
