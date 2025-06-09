VoteSug Project:

----
Instructions:
    1. Do not forget to write your names and your student ids.
    2. This is a group-based project; a maximum of four members per group is allowed. 
    3. Plagiarism is not tolerated. Students submitting cheated or improperly cited code will obtain zero grade in the assignment.
    4. Upload your code on Moodle. You need to upload all required files.

In this project, you will develop a small website to be used by a team to vote on suggestions by the team lead. The following use case diagram represents the main functions to be implemented:

The Team Lead should be able to view his/her proposed suggestions, including the creation date and the current voting results: number of members who voted yes, number who voted no, and number who is still undecided. A suggestion is a brief text (does not exceed 300 characters).

We will assume that the website will be used specifically by the following team:
User Role	Username	Password
Team Lead	Ahmed19	h7d0sds
Team Member	Nora812	#ui321r
Team Member	Nasir723	Esa312p
Team Member	Mike832	hewq023#
Team Member	John999	Q23FF9#a
Team Member	Rola100	H3a##Mbu

Note: The style and presentation of the site will be considered when evaluating the project. Ensure the correct implementation of user sign-in and the proper use of sessions.

Each team must deliver a 10-minute demonstration of the site. The instructor will quiz the students during the demonstration. The grades for individual students may vary depending on the student performance during the demonstration.

Your team must submit the following items:
1-	All files including html, css, JavaScript, PhP, and MySql related files.
2-	Screenshots presenting several use scenarios of the website.

You are required to use HTML, CSS, Bootstrap, JavaScript, PhP, and MySQL. Only use the features of the languages and tools that are covered in the class, e.g., do not use jQuery. 










Screenshots presenting several use scenarios of the website.
Home page:

This is the home page that welcome the visitors to the website and it contain sign in button.

After user click on sign in button, this popup form for sign in will appear, which require username and password for signing in, and the user can close the popup window.
Team Lead page:

This is the team lead page, it welcomes the team leader with his name, it contains the suggestions with the number, description, and the creation date of each suggestion, besides, it contains 4 buttons:
    1- Sign out
    2- Create suggestion
    3- Delete: this button to delete suggestion from the database.
    4- Votes: when click this button, it will show the current voting results: number of members who voted Yes, No, and Undecided.


After the team lead press Create suggestion button, this window will appear and it contain 3 buttons:
    1-  X: to close the window.
    2- Cancel: it is just a reset button; it deletes what the team lead wrote.
    3- Submit: It send the suggestion to the database.

After the team lead press Votes button, this window will appear, and he will be able to see the suggestions information (Suggestion number, Suggestion Description) including the current voting results of votes (Yes, No, Undecided).
Team Member page:

When the team member sign in, there will be a welcome message with the name of the member. The user can sign out using the sign out button. The team member can see the suggestions that were written by the team lead including the information of each suggestion (Suggestion number, Suggestion Description, Creation Date), in addition to vote column that have drop-down menu includes 3 options (Yes, No, Undecided).
After the team member choose one of the vote options, the vote will be submitted by pressing the submit button next to the suggestion, which will be directly sent to the database, and this eventually leads the team lead to see the result of the suggestion that has been voted on.
