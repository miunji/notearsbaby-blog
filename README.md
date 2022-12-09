# A small CRUD application that implements authorization (with JWT token generation) and blog management.

## The application uses PHP, MySQL, ORM (RedBeanPHP).

## Endpoint documentation:

### Signup

#### POST /signup

>{<br>
	'login': 'testLogin',<br>
	'email': 'test@mail.com',<br>
	'password': '12345'<br>
}<br>

#### Response if status OK:<br>
You have successfully registered! You can login to your account.<br>

#### Response if errors:<br>
Enter username!<br>
Enter email!<br>
Enter password!<br>
User with this login exists!<br>
User with this email exists!<br>

### Login

#### POST /login

>{<br>
	'login': 'testLogin',<br>
	'password': '12345'<br>
}<br>

#### Response if status OK:<br>
You are logged in!<br>
Click to return to the main page<br>

#### Response if errors:<br>
User is not found!<br>
Password entered incorrectly!<br>

### Create post

#### POST /add

>{<br>
	'date': default current date,<br>
	'message': 'test message',<br>
	'author': default authorized user<br>
}<br>

#### Response if status OK: <br>
Successfully added<br>

#### Response if errors:<br>
Log in to add a new post!<br>

### Update post

#### POST /edit.php?id=1

>{<br>
	'message': 'message test',<br>
	'author': default authorized user<br>
}<br>

#### Response if status OK: <br>
Successfully updated<br>

#### Response if errors:<br>
Log in to perform this action!<br>
Only the author of a post can edit it!<br>

### Detail post

#### GET /detail.php?id=1

### Delete post

D#### ELETE /delete.php?id=1

#### Response if errors:<br>
Log in to perform this action!<br>
Only the author of a post can delete it!<br>
