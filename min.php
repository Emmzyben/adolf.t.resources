<?php
session_start(); // Start a session

// Check if the user is not logged in, redirect them to the login page
if (!isset($_SESSION['username'])) {
    header("Location:login.html"); // Replace 'login.php' with the actual login page URL
    exit(); // Make sure to exit after redirection
}

// Replace these with your database connection details
$servername = 'localhost';
$username = "root";
$password = "";
$database = "adolph.t database";

// Create a database connection
$conn = new mysqli($servername , $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select all certificates ordered by registration_id
$sql = "SELECT * FROM certificate_registration ORDER BY registration_id";

// Execute the query
$result = $conn->query($sql);

// Check if there are any records
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="index.css">
    <title>Admin page</title>
    <style>
        .nav-container {
          position: relative;
          display: inline-block;
        }
        
        #dropdown {
          display: none;
          position: absolute;
          top: 100%;
          left: 0;
          background-color: #2a0134;
          padding: 10px 0;
          width: 300px;
          text-align: center;
        }
        
        #dropdown a:hover {
          background-color: grey;
        }
        
        #dropdown a {
          border-bottom: 1px solid white;
          list-style-type: none;
        }
        
        #dropdown a {
          color: white;
          display: block;
          font-weight: lighter;
          padding-bottom: 10px;
        }
        
        #hoverer {
          cursor: pointer;
        }
        
        /* Show the dropdown when either the "Services" link or the dropdown itself is hovered */
        #hoverer:hover + #dropdown,
        #dropdown:hover {
          display: block;
        }
        #border{
            border: 1px solid black;
        }<style>
    /* Define CSS styles for the container div */
    #defaultDiv {
        display: block;
        margin: 20px;
        padding: 10px;
        background-color: #2a0134;
        font-size: 20px;
        color: white;
        font-weight: bolder;
        text-align: center;
    }

    /* Define CSS styles for the certificates container */
    .certificates-container {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 10px; /* Add some space between certificates */
        margin-top: 10px;
    }

    /* Define CSS styles for each certificate */
    .certificate-details {
        padding: 10px;
        border: 1px solid #2a0134;
        margin-bottom: 10px;
        box-sizing: border-box;
        font-size: 13px;
    }

    /* Define a media query for smaller screens */
    @media (max-width: 768px) {
        .certificate-details {
            flex: 0 0 calc(100% - 10px); /* Full width for each certificate on smaller screens */
        }
    }


           </style>
        </head>
        <body>
            <header class="text-gray-600 body-font w-full z-50" style="border-bottom:10px solid #2a0134" >
                <div class="title-font font-medium text-gray-900" id="custom-container" style="height: 80px;">
                  <div style="text-align: left;">
                    <img src="images/logo.png" width="150px" style="margin-left: 4%;" />
                    <h1 class="text-[purple] cursor-pointer" style="font-size: 13px; padding-left: 20px;">Adolph T. Resources Nigeria Limited</h1>
                  </div>
              
                  <div id="upul">
                    <p class="text-gray-900 font-bold cursor-pointer">Email: adolph.t.resources@gmail.com</p>
                    <p class="text-gray-900 font-bold cursor-pointer">Tel1: +234 (0) 803 579 4886<br /> Tel2: +234 (0) 703 486 7802</p>
                  </div>
                </div>
              
              </header>
        
              <!-- nav -->
        

    <div class="border-b border-gray-200 dark:border-gray-700" style="border-bottom: 1px solid #2a0134;" >
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
            <li class="mr-2">
                <a href="#" onclick="handleNavClick('post')" class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-[white] hover:border-[#FF595A] dark:hover:text-[#FF595A] group">
                    <svg class="w-4 h-4 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-[#FF595A]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                    </svg>Make a Post
                </a>
            </li>
            <li class="mr-2">
                <a href="#" onclick="handleNavClick('pictures')" class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-[white] hover:border-[#FF595A] dark:hover:text-[#FF595A] group">
                    <svg class="w-4 h-4 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-[#FF595A]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                    </svg>Upload Pictures
                </a>
            </li>
            <li class="mr-2">
                <a href="#" onclick="handleNavClick('certificate')" class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-[white] hover:border-[#FF595A] dark:hover:text-[#FF595A] group">
                    <svg class="w-4 h-4 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-[#FF595A]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 11.424V1a1 1 0 1 0-2 0v10.424a3.228 3.228 0 0 0 0 6.152V19a1 1 0 1 0 2 0v-1.424a3.228 3.228 0 0 0 0-6.152ZM19.25 14.5A3.243 3.243 0 0 0 17 11.424V1a1 1 0 0 0-2 0v10.424a3.227 3.227 0 0 0 0 6.152V19a1 1 0 1 0 2 0v-1.424a3.243 3.243 0 0 0 2.25-3.076Zm-6-9A3.243 3.243 0 0 0 11 2.424V1a1 1 0 0 0-2 0v1.424a3.228 3.228 0 0 0 0 6.152V19a1 1 0 1 0 2 0V8.576A3.243 3.243 0 0 0 13.25 5.5Z"/>
                    </svg>Upload Certificate
                </a>
            </li>
            <li class="mr-2">
                <a href="#" onclick="handleNavClick('default')" class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-[white] hover:border-[#FF595A] dark:hover:text-[#FF595A] group">
                    <svg class="w-4 h-4 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-[#FF595A]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z"/>
                    </svg>Student Database
                </a>
            </li>
        </ul>
    </div>
         <?php
echo '<div id="defaultDiv">
<div>
<h1 class="header">Adolph T. Resources Nigeria Limited Student Database</h1>
    <div class="certificates-container">'; // Start certificates container

// Output data of each row
while ($row = $result->fetch_assoc()) {
// Start a certificate container
echo '<div class="certificate-details">';
echo "<p><strong>First Name:</strong> " . $row["first_name"] . "</p>";
echo "<p><strong>Middle Name:</strong> " . $row["middle_name"] . "</p>";
echo "<p><strong>Last Name:</strong> " . $row["last_name"] . "</p>";
echo "<p><strong>Address:</strong> " . $row["address"] . "</p>";
echo "<p><strong>City:</strong> " . $row["city"] . "</p>";
echo "<p><strong>State:</strong> " . $row["state"] . "</p>";
echo "<p><strong>Country:</strong> " . $row["country"] . "</p>";
echo "<p><strong>Date of Issuance:</strong> " . $row["date_of_issuance"] . "</p>";
echo "<p><strong>Phone Number 1:</strong> " . $row["phone_number1"] . "</p>";
echo "<p><strong>Phone Number 2:</strong> " . $row["phone_number2"] . "</p>";
echo "<p><strong>Skill Learnt:</strong> " . $row["skill_learnt"] . "</p>";
echo "<p><strong>Certificate number:</strong> " . $row["hash_field"] . "</p>";
// End the certificate container
echo '</div>';
}

echo '</div></div></div>'; // End certificates container and defaultDiv

// Close the database connection
$conn->close();
?>
    <div id="postDiv" style="display: none;">
        <section class="p-6 dark:bg-[#2a01348b] dark:text-gray-50"> 
            <form action="post_upload.php" method="post" autocomplete="off" enctype="multipart/form-data" class="container flex flex-col mx-auto space-y-12">
                <fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md shadow-sm dark:bg-[#2a0134ec]">
                    <div class="space-y-2 col-span-full lg:col-span-1">
                        <p class="font-medium">Blog</p>
                        <p class="text-xs">Make a blog post</p>
                    </div>
                    <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                        <div class="col-span-full sm:col-span-3">
                            <label for="post_title" class="text-sm">Post Title</label>
                            <input name="post_title" type="text" placeholder="Title" class="w-full rounded-md focus:ring focus:ring focus:ring dark:border-gray-700 dark:text-gray-900" />
                        </div>
                        <div class="col-span-full">
                            <label for="post_content" class="text-sm">Post Content</label>
                            <textarea name="post_content" placeholder="" class="w-full rounded-md focus:ring focus:ring focus:ring dark:border-gray-700 dark:text-gray-900"></textarea>
                        </div>
                        <div class="col-span-full">
                            <label for="file" class="text-sm">Attach a Photo (optional)</label>
                            <input type="file" name="file" class="w-full rounded-md focus:ring focus:ring focus:ring dark:border-gray-700 dark:text-gray-900"/>
                        </div>
                        <button type='submit' class="text-[white] bg-[#FF595A] border-0 py-2 px-6 focus:outline-none hover:bg-[#fe5000] rounded text-lg">Upload</button>
                    </div>
                </fieldset>
            </form>
            
        </section>
    </div>
    <div id="picturesDiv" style="display: none;">
        <section class="p-6 dark:bg-[#2a01348b] dark:text-gray-50">
            <form action="image_upload.php" method="post" autocomplete="off" enctype="multipart/form-data">  <fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md shadow-sm dark:bg-[#2a0134ec]">
                    <div class="space-y-2 col-span-full lg:col-span-1">
                        <p class="font-medium">Post a picture</p>
                        <p class="text-xs">upload a picture to the client area</p>
                    </div>
                    <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                        <div class="col-span-full">
                            <label for="post" class="text-sm">Description</label>
                            <textarea id="description" name="description" placeholder="" class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"></textarea>
                        </div>
                        <div class="col-span-full">
                            <label for="bio" class="text-sm">Upload Photo</label>
                            <input type="file" name="file" accept="image/*" required  class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900" />
                        </div>
                        <button class="text-[white] bg-[#FF595A] border-0 py-2 px-6 focus:outline-none hover:bg-[#fe5000] rounded text-lg" type="submit">Upload</button>
                    </div>
                </fieldset>
            </form>
            
        </section>
    </div>
    <div id="certificateDiv" style="display: none;">
        <section class="p-6 dark:bg-[#2a01348b] dark:text-gray-50">
            <form method="POST" action="certificate.php" class="container flex flex-col mx-auto space-y-12">
                <fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md shadow-sm dark:bg-[#2a0134ec]">
                    <div class="space-y-2 col-span-full lg:col-span-1">
                        <p class="font-medium">Upload certificate Information</p>
                        <p class="text-xs">fill the form with the student certificate details</p>
                    </div>
                    <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                        <div class="col-span-full sm:col-span-3">
                            <label for="first_name" class="text-sm">First name</label>
                            <input id="firstname" name="first_name" type="text" placeholder="First name" class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900" />
                        </div>
                        <div class="col-span-full sm:col-span-3">
                            <label for="middle" class="text-sm">Middle name</label>
                            <input id="middle_name" type="text" name="middle_name" placeholder="First name" class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900" />
                        </div>
                        <div class="col-span-full sm:col-span-3">
                            <label for="lastname" class="text-sm">Last name</label>
                            <input id="lastname" type="text" name="last_name" placeholder="Last name" class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900" />
                        </div>
                        <div class="col-span-full">
                            <label for="address" class="text-sm">Address</label>
                            <input id="address" type="text" name="address" placeholder="" class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"  />
                        </div>
                        <div class="col-span-full sm:col-span-2">
                            <label for="city" class="text-sm">City</label>
                            <input id="city" type="text" name="city" placeholder="" class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900" />
                        </div>
                        <div class="col-span-full sm:col-span-2">
                            <label for="state" class="text-sm">State / Province</label>
                            <input id="state" type="text" placeholder="" name="state" class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900" />
                        </div>
                        <div class="col-span-full sm:col-span-2">
                            <label for="country" class="text-sm">country</label>
                            <input id="country" type="text" placeholder="" name="country" class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900" />
                        </div>
                        <div class="col-span-full sm:col-span-2">
                            <label for="date" class="text-sm">Date of issuance</label>
                            <input id="date" type="date" name="date_of_issuance" placeholder="" class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900" />
                        </div>
                        <div class="col-span-full sm:col-span-2">
                            <label for="phone" class="text-sm">Phone number1</label>
                            <input id="phone_number1" type="number" name="phone_number1" placeholder="" class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900" />
                        </div>
                        <div class="col-span-full sm:col-span-2">
                            <label for="phone" class="text-sm">Phone number2</label>
                            <input  id="phone_number2" type="number" name="phone_number2" placeholder="" class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900" />
                        </div>
                        <div class="col-span-full sm:col-span-2">
                            <label for="country" class="text-sm">Skill learnt</label>
                            <input id="skill_learnt" type="text" name="skill_learnt" placeholder="" class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900" />
                            <br/><br/>
                            <button class="text-[white] bg-[#FF595A] border-0 py-2 px-6 focus:outline-none hover:bg-[#fe5000] rounded text-lg">Upload</button>
                        </div> 
                    </div>
                </fieldset>
            </form>
        </section>
    </div>

    <script>
        function handleNavClick(divName) {
            document.getElementById('defaultDiv').style.display = divName === 'default' ? 'block' : 'none';
            document.getElementById('postDiv').style.display = divName === 'post' ? 'block' : 'none';
            document.getElementById('picturesDiv').style.display = divName === 'pictures' ? 'block' : 'none';
            document.getElementById('certificateDiv').style.display = divName === 'certificate' ? 'block' : 'none';
        }
    </script>

<footer class="text-gray-600 body-font bg-[#2a0134]">
    <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
      <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
        <span class="ml-3 text-xl text-[#ffffff]">Adolph T. Resources</span> 
      </a>
      <p class="text-sm text-[#ffffff] sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">
        adolph.t.resources@gmail.com 
        <span style="border-right: 2px solid white; height: 70px;"></span>
        <a class="text-#ffffff ml-1" rel="noopener noreferrer" target="_blank"></a> 
        Tel: +234 (0) 803 579 4886, +234 (0) 703 486 7802
      </p>
      <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
        <a class="text-gray-500">
          <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
          </svg>
        </a>
        <a class="ml-3 text-gray-500">
          <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
          </svg>
        </a>
        <a class="ml-3 text-gray-500">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
          </svg>
        </a>
        <a class="ml-3 text-gray-500">
          <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
            <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
            <circle cx="4" cy="4" r="2" stroke="none"></circle>
          </svg>
        </a>
      </span>
    </div>
  </footer>





  </div>
  <script>
let isMenuOpen = false;

const toggleMenu = () => {
    const menu = document.getElementById("ul");
    
    if (!isMenuOpen) {
        menu.style.height = "auto";
        isMenuOpen = true;
    } else {
        menu.style.height = "0px";
        isMenuOpen = false;
    }
};

const closeMenu = () => {
    const menu = document.getElementById("ul");
    menu.style.height = "0px";
    isMenuOpen = false;
};
</script>

    <script src="index.js"></script>
</body>
</html>
