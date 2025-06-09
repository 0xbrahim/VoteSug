💻🕸️ Web Development course project from my Bachelor's degree journey.

----
Instructions:
1. Do not forget to write your names and your student ids.
2. This is a group-based project; a maximum of four members per group is allowed. 
3. Plagiarism is not tolerated. Students submitting cheated or improperly cited code will obtain zero grade in the assignment.
4. Upload your code on Moodle. You need to upload all required files.

In this project, you will develop a small website to be used by a team to vote on suggestions by the team lead. The following use case diagram represents the main functions to be implemented:

![image](https://github.com/user-attachments/assets/ef51378d-a1d8-457d-a019-dd315a55e1f8)


The Team Lead should be able to view his/her proposed suggestions, including the creation date and the current voting results: number of members who voted yes, number who voted no, and number who is still undecided. A suggestion is a brief text (does not exceed 300 characters).

We will assume that the website will be used specifically by the following team:

![Screenshot from 2025-06-09 18-28-40](https://github.com/user-attachments/assets/b8194a52-125f-4d55-a9e2-343dd84ea3ce)

Note: The style and presentation of the site will be considered when evaluating the project. Ensure the correct implementation of user sign-in and the proper use of sessions.

Each team must deliver a 10-minute demonstration of the site. The instructor will quiz the students during the demonstration. The grades for individual students may vary depending on the student performance during the demonstration.

Your team must submit the following items:
1-	All files including html, css, JavaScript, PhP, and MySql related files.
2-	Screenshots presenting several use scenarios of the website.

You are required to use HTML, CSS, Bootstrap, JavaScript, PhP, and MySQL. Only use the features of the languages and tools that are covered in the class, e.g., do not use jQuery. 

----

Screenshots presenting several use scenarios of the website.
Home page:
![image](https://github.com/user-attachments/assets/caa51e1e-52ae-43e6-872f-7ecd7d26b631)

This is the home page that welcome the visitors to the website and it contain sign in button.
![image](https://github.com/user-attachments/assets/e659216f-4d86-4189-8fa0-aa364d768b12)


After user click on sign in button, this popup form for sign in will appear, which require username and password for signing in, and the user can close the popup window.
Team Lead page:
![image](https://github.com/user-attachments/assets/e5becb77-08c1-45b1-aa7b-b9772a9595f8)


This is the team lead page, it welcomes the team leader with his name, it contains the suggestions with the number, description, and the creation date of each suggestion, besides, it contains 4 buttons:
1- Sign out
2- Create suggestion
3- Delete: this button to delete suggestion from the database.
4- Votes: when click this button, it will show the current voting results: number of members who voted Yes, No, and Undecided.
![image](https://github.com/user-attachments/assets/2c071b86-a100-4989-b4c2-75e64d7c3191)


After the team lead press Create suggestion button, this window will appear and it contain 3 buttons:
1-  X: to close the window.
2- Cancel: it is just a reset button; it deletes what the team lead wrote.
3- Submit: It send the suggestion to the database.
![image](https://github.com/user-attachments/assets/d7d8eab3-a5d8-43e2-be24-1bc331b5be72)


After the team lead press Votes button, this window will appear, and he will be able to see the suggestions information (Suggestion number, Suggestion Description) including the current voting results of votes (Yes, No, Undecided).
Team Member page:
![image](https://github.com/user-attachments/assets/c94d0c4e-6aef-419c-b1fd-b6500779bdee)


When the team member sign in, there will be a welcome message with the name of the member. The user can sign out using the sign out button. The team member can see the suggestions that were written by the team lead including the information of each suggestion (Suggestion number, Suggestion Description, Creation Date), in addition to vote column that have drop-down menu includes 3 options (Yes, No, Undecided).
After the team member choose one of the vote options, the vote will be submitted by pressing the submit button next to the suggestion, which will be directly sent to the database, and this eventually leads the team lead to see the result of the suggestion that has been voted on.
