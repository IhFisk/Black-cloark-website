DROP TABLE forum_membres;
DROP TABLE forum_post;
DROP TABLE forum_topic;

CREATE TABLE forum_membres (
membre_id int(11) AUTO_INCREMENT,
membre_pseudo varchar(30),
membre_mdp varchar(32),
membre_email varchar(32),
membre_rang tinyint (4) DEFAULT 2,
membre_post int(11) DEFAULT 0,
PRIMARY KEY  (membre_id)
);



CREATE TABLE forum_post (
post_id int(11) AUTO_INCREMENT,
post_createur int(11),
post_texte text,
topic_id int(11),
PRIMARY KEY  (post_id)
);


CREATE TABLE forum_topic (
topic_id int(11) AUTO_INCREMENT,
topic_titre varchar(60),
topic_createur int(11),
topic_time int(11),
topic_post mediumint(8),
PRIMARY KEY  (topic_id)
);
