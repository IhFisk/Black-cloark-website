<?php
session_start();

$titre = "Forum - Black Cloark";
include("includes/identifiant.php");
include("includes/debut.php");
include("includes/menu.php");

//Initialisation de deux variables
$totaldesmessages = 0;
$categorie = NULL;

//Cette requête permet d'obtenir tout sur le forum
$query=$db->prepare('SELECT forum_topic.topic_id, forum_topic.topic_post, post_id, post_time, post_createur, membre_pseudo,
membre_id
FROM forum_categorie
LEFT JOIN forum_forum ON forum_categorie.cat_id = forum_forum.forum_cat_id
LEFT JOIN forum_post ON forum_post.post_id = forum_forum.forum_last_post_id
LEFT JOIN forum_topic ON forum_topic.topic_id = forum_post.topic_id
LEFT JOIN forum_membres ON forum_membres.membre_id = forum_post.post_createur
WHERE auth_view <= :lvl
ORDER BY cat_ordre, forum_ordre DESC');
$query->bindValue(':lvl',$lvl,PDO::PARAM_INT);
$query->execute();
?>

<?php
    // description, nombre de réponses etc...
    // Deux cas possibles :
    // Soit il y a un nouveau message, soit le forum est vide
    if (!empty($data['forum_post']))
    {
         //Selection dernier message
	 $nombreDeMessagesParPage = 15;
         $nbr_post = $data['topic_post'] +1;
	 $page = ceil($nbr_post / $nombreDeMessagesParPage);

         echo'<td class="derniermessage">
         '.date('H\hi \l\e d/M/Y',$data['post_time']).'<br />
         <a href="./voirprofil.php?m='.stripslashes(htmlspecialchars($data['membre_id'])).'&amp;action=consulter">'.$data['membre_pseudo'].'  </a>
         <a href="./voirtopic.php?t='.$data['topic_id'].'&amp;page='.$page.'#p_'.$data['post_id'].'">
         <img src="./images/go.gif" alt="go" /></a></td></tr>';

     }
     else
     {
         echo'<td class="nombremessages">Pas de message</td></tr>';
     }

     //Cette variable stock le nombre de messages, on la met à jour
     $totaldesmessages += $data['forum_post'];

$query->CloseCursor();
echo '</table></div>';
?>