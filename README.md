# PHPExcelWebsite
This website is intended for individuals or small business owners who want fast and clutter-free websites without paying a single penny. The websites build from this package uses excel files as databases along with PHP for the backend. The frontend uses HTML, CSS, and Bootstrap. The resulting websites will have features such as login, register, forgot password, comment box, quick links, search-bar, etc. At the admin side, features such as track activities, block users, disable the comment section, etc will be present. A handy web page creator is provided for the admin to quickly upload webpages for their dream website.

How to use this package

1. Directly upload to your directory which is running on the php server. 
2. Two sample webpages are created (Computer Science and Question Papers), you can edit or delete them. 
3. If you have modified the above two pages make sure you make necessary changes in their parent files present in the phpindex folder.
4. You can create your webpages using the pagecreator webpage.
5. Follow the instructions in the webcreator webpage and while uploading body, just copy the source code (without the <body> </body> tags.
6. The dependencies folder contains a file companyname.php. Modify this file content with your company name.
7. Each webpage has a masterformat which is present in the phpindex directory. Modify the head, format and the footer part to reflect      changes to all of your pages. 
8. The admin can change his password by clicking forgot password in the login menu and typing "baldelephanteagle" in the security question.
9. The admin can change the background images for the login webpage, company logo and user webpage by deleting and uploading images with same name and resolution in the images folder.
10. In the pagecreator menu, clearing logs will create a new log file with date and register all logs till that moment.
11. Modify the encryption key 'SECURE_KEYssssss' in login.php, logout.php in login folder and index_login_status, login_status in the phpindex folder to a secret key not known to the outside world.
12. Lock folders (inaccesible to outside world) phpindex, logs, dependencies, userlinking(or your dynamic page directory), login directory except login.php, register.php, index.php, and forgotpassword.php.

Limitations of this package

1. This package may not be suitable for websites having millions of user accounts.
2. May cause server to slow down if thousands of users are online at once.
3. Uses cookies and php sessions for tracking user activity.
4. Limited page area for hosting ads. But can support wide range of ads when the masterformat file is edited.

Advantages of this package

1. Provide security features like blocking sql and html injections.
2. Restricts simultaneous loggings.
3. Has a bulit in comment box which can be disabled or removed.
4. Uses encryptions to prevent attacks even if ssl is not present.
5. Easy database maintainance due to excel.

Other packages used

1. SimpleXLXS
2. XLXSWriter

Images are taken from Unsplash.

After your dream website is build, please credit the developer "Ajay Biswas" for providing this wonderful website builder.
