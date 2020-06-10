<script>
    function validateForm() {

        var comment = document.forms["reply"]["comment"];
        var errs = "";

        if ((comment.value.length <= 0)) {
            errs += "  *Comment must not be empty!\n";
        }

        if ((comment.value.length > 1500)) {
            errs += "  *Comment must be less than 1500 characters! \n";
        }

        if (errs != "") {
            alert("Sorry. The following errors need to be corrected: \n\n" + errs);
        }

        return (errs == "");
    }

    function validateForm2() {
        var topic = document.forms["newtopic"]["topic"];
        var content = document.forms["newtopic"]["content"];

        var errs = "";


        if ((topic.value.length <= 0)) {
            errs += "  *Please fill in the topic field!\n";
        }

        if ((topic.value.length > 50)) {
            errs += "  *Topic length must not be greater than 50 characters!\n";
        }

        if ((content.value.length <= 0)) {
            errs += "  *Please fill in the content field!\n";
        }

        if ((content.value.length > 1500)) {
            errs += "  *Content field must be no greater than 1500 characters!\n";
        }

        if (errs != "") {
            alert("Sorry. The following errors need to be corrected: \n\n" + errs);
        }

        return (errs == "");
    }
</script>
<?php

include ('dbconn.php');

function showCategories() {
    include ('dbconn.php');
    $select = mysqli_query($conn, "SELECT * FROM categories");

    while ($row = mysqli_fetch_assoc($select)) {
        echo "<table class='category-table'>";
        echo "<tr><td class='parent-category' colspan='2'>".$row['category_title']."</td></tr>";
        showSubCategories($row['cat_id']);
        echo "</table>";
    }
}

function showSubCategories($parent_id) {
    include ('dbconn.php');
    $select = mysqli_query($conn, "SELECT cat_id, subcat_id, subcategory_title, subcategory_desc FROM categories, subcategories 
									  WHERE ($parent_id = categories.cat_id) AND ($parent_id = subcategories.parent_id)");
    echo "<tr><th width='90%'>Subcategories</th><th width='10%'>Topics</th></tr>";
    while ($row = mysqli_fetch_assoc($select)) {
        echo "<tr><td class='category_title'><a href='topics.php?cid=".$row['cat_id']."&scid=".$row['subcat_id']."'>
			".$row['subcategory_title'].":<br />";
        echo $row['subcategory_desc']."</a></td>";
        echo "<td class='num-topics'>".getNoTopics($parent_id, $row['subcat_id'])."</td></tr>";
    }
}

function showTopic($cid, $scid, $tid) {
    include ('dbconn.php');

    $select = mysqli_query($conn, "SELECT cat_id, subcat_id, topic_id, author, title, content, date_posted FROM 
									  categories, subcategories, topics WHERE ($cid = categories.cat_id) AND
									  ($scid = subcategories.subcat_id) AND ($tid = topics.topic_id)");
    $row = mysqli_fetch_assoc($select);

    echo nl2br("<div class='content'><h3 class='title'>".$row['title']."</h3><strong style = 'padding-right: 22px;'>Posted By:</strong><a href='viewuser.php?usr=".$row['author']."&page=1'>
					 ".$row['author']."</a>\n<strong>Date Posted: </strong>".$row['date_posted']."</div>");
    echo "<div class='content'><h3><b>Post content:</b></h3><p>".$row['content']."</p></div>";
}

function showTopics($cid, $scid) {
    include ('dbconn.php');

    $select = mysqli_query($conn, "SELECT topic_id, author, title, date_posted, replies FROM categories, subcategories, topics 
									  WHERE ($cid = topics.category_id) AND ($scid = topics.subcategory_id) AND ($cid = categories.cat_id)
									  AND ($scid = subcategories.subcat_id) ORDER BY replies DESC");
    if (mysqli_num_rows($select) != 0) {

        echo "<table class='topic-table'>";
        echo "<tr><th>Topic Title</th><th>Posted By</th><th>Date Posted</th><th>Replies</th></tr>";
        while ($row = mysqli_fetch_assoc($select)) {


            echo "<tr><td><a href='readtopic.php?cid=".$cid."&scid=".$scid."&tid=".$row['topic_id']."'>
					 ".$row['title']."</a></td><td><a href='viewuser.php?usr=".$row['author']."&page=1'>
					 ".$row['author']."</a></td><td>".$row['date_posted']."</td><td>".$row['replies']."</td></tr>";

        }
        echo "</table>";
    } else {
        echo "<p>No topics on this category yet!  <a href='newtopic.php?cid=".$cid."&scid=".$scid."'>
				 Add a new topic?</a></p>";
    }
}

function repPost($cid, $scid, $tid) {
    echo "

			<div class='content'><form name = 'reply' action='addreply.php?cid=".$cid."&scid=".$scid."&tid=".$tid."'method='POST' onsubmit='return validateForm();'>
			  <label><strong>Your Comment:</strong></label><br><p><b>Note:</b> Comment must be less than 1500 characters!</p>
			  <textarea cols='80' rows='5' id='comment' name='comment'></textarea><br />
			  <input type='submit' value='Add Comment' />
			  </form></div>";
}

function submitReply($tid){
    include ('dbconn.php');

    $replies = 0;
    $sql = "SELECT * FROM `topics` WHERE `topic_id` = '$tid'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        if($row = $result->fetch_assoc()){
            $replies = $row['replies'];
        }
    }
    $replies += 1;
    $sql = "UPDATE `topics` SET `replies` = '$replies' WHERE `topics`.`topic_id` = '$tid'";
    if($conn->query($sql)===TRUE){
        echo "<p>This works for now</p>";
    }else{
        echo "<p class='fixme'>There's something wrong with the addReply function</p>";
    }
}

function showReplies($cid, $scid, $tid) {
    include ('dbconn.php');

    $select = mysqli_query($conn, "SELECT replies.author, comment, replies.date_posted FROM categories, subcategories, 
									  topics, replies WHERE ($cid = replies.category_id) AND ($scid = replies.subcategory_id)
									  AND ($tid = replies.topic_id) AND ($cid = categories.cat_id) AND 
									  ($scid = subcategories.subcat_id) AND ($tid = topics.topic_id) ORDER BY reply_id DESC");
    if (mysqli_num_rows($select) != 0) {
        echo "<table class='reply-table'>";
        while ($row = mysqli_fetch_assoc($select)) {
            echo nl2br("<tr><td><strong><a href='viewuser.php?usr=".$row['author']."&page=1'>
					 ".$row['author']."</a></strong>\n".$row['date_posted']."\n".$row['comment']."\n\n<hr/></td></tr>");

            // 				echo nl2br("<tr><th width='150px'>".$row['author']."</th><td>".$row['date_posted']."\n".$row['comment']."\n\n<hr/></td></tr>");
        }
        echo "</table>";
    }
}


function getNoTopics($cat_id, $subcat_id) {
    include ('dbconn.php');

    $select = mysqli_query($conn, "SELECT category_id, subcategory_id FROM topics WHERE ".$cat_id." = category_id 
									  AND ".$subcat_id." = subcategory_id");
    return mysqli_num_rows($select);
}



function repLink($cid, $scid, $tid) {
    echo "<button onclick = \"location.href='replyto.php?cid=".$cid."&scid=".$scid."&tid=".$tid."'\" type  =  \"button\"> Reply to Post </button>";

}


function countReplies($cid, $scid, $tid) {
    include ('dbconn.php');

    $select = mysqli_query($conn, "SELECT category_id, subcategory_id, topic_id FROM replies WHERE ".$cid." = category_id AND 
									  ".$scid." = subcategory_id AND ".$tid." = topic_id");
    $replies = mysqli_num_rows($select);
    $sql = "UPDATE `topics` SET `replies` = '$replies' WHERE `topics`.`topic_id` = '$tid'";
    if($conn->query($sql)===TRUE){
        return $replies;
    }else{
        echo "<p class='fixme'>There's something wrong with the addReply function</p>";
    }
    return $replies;
}


function showCatSub($cid, $scid)
{
    include ('dbconn.php');

    if (isset($_GET['cid']) && isset($_GET['scid'])) {
        $cid = $_GET['cid'];
        $scid = $_GET['scid'];
        $cat_title = "error";
        $scat_title = "error";
        $sql = "SELECT * FROM `categories` WHERE `cat_id` = '$cid'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                $cat_title = $row["category_title"];
            }
        } else {
            echo "<p class='fixme'>//FIXME an error occurred while accessing table 'categories'</p>";
        }

        $sql = "SELECT * FROM `subcategories` WHERE `subcat_id` = '$scid'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                $scat_title = $row["subcategory_title"];
            }
        } else {
            echo "<p class='fixme'>//FIXME an error occurred while accessing table 'subcategories'</p>";
        }

        echo "<p><b>Category:</b> $cat_title <br>
        <b>Subcategory:</b> $scat_title</p>";

    }

    else
        echo "<p>An error occurred, click <a onclick='goBack()'>here</a> to go back.</p>";
}


?>



































