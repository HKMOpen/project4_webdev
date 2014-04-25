<?php
class Querries
{
	public $CREATE_USER = "insert into users values ('%s','%s','%s','%s', '%s','%s','%s','%s','%s');";
	
	public $UPDATE_USER = "update users set password='%s',name='%s',gender='%s', phone='%s',email='%s',admin='%s',pictureLocation='%s', bio='%s' where username='%s';";
	public $GET_USER = "Select * from users where username='%s';";
	
	public $GET_ALL_USER_NAMES = "Select username from users;";
	
	public $GET_USER_PASSWORD="Select password from users where username='%s';";
	public $GET_USER_SUMMARY="Select bio from users where username='%s'";
	public $WRITE_USER_SUMMARY="Update users set bio='%s' where username='%s';";
	public $GET_USER_FRIENDS="Select friend from friends where user='%s';";
	
	public $IS_FRIEND="SELECT CASE WHEN EXISTS (SELECT * FROM friends WHERE user='%s' and friend='%s') THEN CAST(1 AS BIT) ELSE CAST(0 AS BIT) END;";
	
	public $GET_PENDING_REQUESTS="Select user from friendRequests where requestedFriend='%s';";
	
	public $GET_PENDING_USERS="select username from pendingUsers where authenticated='FALSE';";
	
	public $GET_USER_WALL_COMMENTS="select * from communications where sender='%s';";
	
	public $GET_COMMENTS_ON_USER_WALL="select * from communications where reciever='%s' ORDER BY repliedToID DESC, time ASC;";

	public $GET_AUTHENTICATED_PANDING="select username from pendingUsers where authenticated='TRUE';";
	
	public $ADD_PENDING_USER="INSERT INTO pendingUsers values ('%s','%s','%s','%s');";
	
	public $AUTH_PENDING_USER="UPDATE pendingUsers set authenticated='TRUE' where username='%s';";
	
	public $REMOVE_PENDING_USER="DELETE from pendingUsers where username='%s';";
	
	public $REMOVE_FRIEND_REQUEST="DELETE from friendRequests where user='%s';";
	
	public $ADD_FRIEND = "insert into friends values ('%s','%s');";
	
	public $REMOVE_ALL_FRIENDS ="DELETE from friends where user='%s';";
	
	public $REMOVE_ALL_PENDING ="DELETE from friendRequests where requestedFriend='%s';";

	public $ADD_REQUEST = "insert into friendRequests values ('%s','%s');";
	
	public $GET_REPLIES = "select * from communications where id in (select replyId from commentReplies where repliedTo='%s');";
	
	public $SAVE_POST = "insert into communications (messageType, sender, reciever, time, message) values ('%s', '%s', '%s', datetime(current_timestamp,'localtime'), '%s');";

	public $NEW_COMMENT_ADD_REPLIED_TO = "UPDATE communications SET repliedToID=(SELECT MAX(id) FROM communications) WHERE id=(SELECT MAX(id) FROM communications);";
	
	public $SAVE_REPLY = "insert into communications (messageType, sender, reciever, time, message, repliedToID) values ('%s', '%s', '%s', datetime(current_timestamp,'localtime'), '%s', %s);";
	
	public $SAVE_POST_REPLY = "insert into commentReplies values ((select id from communications where sender='%s' and timestamp='%s'), '%s');";

	public $GET_POST_REPLY = "select replyId from commentReplies where repliedTo='%s';";	

	
	public $CREATE_DATABASE = "CREATE TABLE users (username varchar(255) unique primary key, password varchar(255), name varchar(255), gender varchar(6), phone varchar(20), email varchar(255), admin boolean, pictureLocation varchar(255) , bio varchar(255));CREATE TABLE friends (user varchar(255), friend varchar(255), FOREIGN KEY (user) references users(username), FOREIGN KEY (friend) REFERENCES users(username) );CREATE TABLE friendRequests (user varchar(255), requestedFriend varchar(255), FOREIGN KEY (user) references users(username), FOREIGN KEY (requestedFriend) REFERENCES users(username) );CREATE TABLE communications (id INTEGER PRIMARY KEY autoincrement, messageType varchar(8), sender varchar(255), reciever varchar(255), time timestamp, message varchar(500), repliedToID INTEGER,FOREIGN KEY (sender) references users(username), FOREIGN key (reciever) references users(username), FOREIGN KEY (repliedToID) references communications(id));CREATE TABLE commentReplies (id INTEGER PRIMARY KEY autoincrement, replyId int, repliedTo int, FOREIGN KEY (replyId) references communications(id), FOREIGN KEY (repliedTo) references communication(id));CREATE TABLE pendingUsers (username nvarchar(255), hash varchar(32), ipaddress varchar(50), authenticated varchar(5), FOREIGN KEY (username) REFERENCES users(username));CREATE TABLE passwordChange (username varchar(255), hash varchar(32), ipaddress varchar(50), FOREIGN KEY (username) REFERENCES user(username));";

	public $AUTHENTICATE_NEW_USER = "Select * from pendingUsers where hash='%s' and ipaddress='%s' and username='%s';";	
	
	public $IS_PENDING_USER = "SELECT username FROM pendingUsers WHERE username='%s';";
	
	public $CHANGE_PASSWORD = "update users set password='%s' where username='%s';";
	
	public $GET_PW_CHANGE_IP = "SELECT ipaddress FROM passwordChange WHERE username='%s';";

	public $REMOVE_CHANGE_REQUEST = "delete from passwordChange where username='%s';";

	public $ADD_CHANGE_REQUEST="insert into passwordChange values ('%s','%s','%s');";

	public $REMOVE_USER = "delete from users where username='%s';";

	public $NAME_TAKEN = "select username from users where username='%s';";
	
	public $COUNT_TO_BE_APPROVED = "SELECT COUNT(*) FROM pendingUsers WHERE authenticated='TRUE';";

	function getDB()
	{
		return new SQLite3("./project3.db");
	}
	
}
?>
