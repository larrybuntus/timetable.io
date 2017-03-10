Project Description
- Very simple timetable webapp to manage your personal timetable
- Ability to chat with friends that belong to the same course and year
- Add files to class repository

Setting up the project for view

Setting up database:
	- Create MySQL database with any name eg. timetable
	- Export the file timetable.sql from the project root directory to that database
	- After exporting, go into the metadata table and change the url field to the root directory of the project from which its being served {
		Mine is: http://localhost/timetable
		Yours might be http://localhost:8080
	}

Settng up app:
	- Go into the root directory of the project and into the core directory
	- Open the db.php file in any editor
	- Add your hostname, username, password, and the database name you used above.

--
If the above doesn't work for you, you can view a live preview on http://143promo.com/timetable.io
