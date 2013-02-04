<?php
	$selectedstudentanswerqry = "
    SELECT
    sa.StudentId, StudentAlias, StudentForename, StudentSurname, q.SessionId, 
    QuestionNo, QuestionContent, o.OptionType, q.NoofAnswers, 
    GROUP_CONCAT( DISTINCT Answer ORDER BY Answer SEPARATOR ',' ) AS Answer, r.ReplyType, QuestionMarks, 
    GROUP_CONCAT(DISTINCT StudentAnswer ORDER BY StudentAnswer SEPARATOR ',') AS StudentAnswer, ResponseTime, MouseClick, StudentMark
    FROM Student st
    INNER JOIN Student_Answer sa ON (st.StudentId = sa.StudentId)
    INNER JOIN Student_Response sr ON (sa.StudentId = sr.StudentId)
    INNER JOIN Question q ON (sa.QuestionId = q.QuestionId)
    INNER JOIN Answer an ON q.QuestionId = an.QuestionId
    LEFT JOIN Reply r ON q.ReplyId = r.ReplyId
    LEFT JOIN Option_Table o ON q.OptionId = o.OptionId
    ";

    // Initially empty
    $where = array('q.SessionId = ?');
    $parameters = array($_POST["session"]);
    $parameterTypes = 'i';

    // Check whether a specific student was selected
    if($_POST["student"] != '0') {
        $where[] = 'sa.StudentId = ?';
        $parameters[] .= $_POST["student"];
        $parameterTypes .= 'i';
    }

    // Check whether a specific question was selected
    // NB: This is not an else if!
    if($_POST["question"] != '0') {
        $where[] = 'q.QuestionId = ?';
        $parameters[] .= $_POST["question"];
        $parameterTypes .= 'i';
    }

    // If we added to $where in any of the conditionals, we need a WHERE clause in
    // our query
    if(!empty($where)) {
        $selectedstudentanswerqry .= ' WHERE ' . implode(' AND ', $where);
        global $mysqli;
        $selectedstudentanswerstmt=$mysqli->prepare($selectedstudentanswerqry);
        // You only need to call bind_param once

        if (count($where) == 1) {
        $selectedstudentanswerstmt->bind_param($parameterTypes, $parameters[0]);
    }
    else if (count($where) == 2) {
        $selectedstudentanswerstmt->bind_param($parameterTypes, $parameters[0], $parameters[1]);
    }
    else if (count($where) == 3) {
        $selectedstudentanswerstmt->bind_param($parameterTypes, $parameters[0], $parameters[1], $parameters[2]);
    }

    }

    $selectedstudentanswerqry .= "
      GROUP BY sa.StudentId, q.QuestionId
      ORDER BY StudentAlias, q.SessionId, QuestionNo
    ";

.......................................................................................

    $arrStudentId = array();
    $arrStudentAlias = array();
    $arrStudentForename = array();
    $arrStudentSurname = array();
    $arrQuestionNo = array();
    $arrQuestionContent = array();


    while ($selectedstudentanswerstmt->fetch()) {
    $arrStudentId[ $detailsStudentId ] = $detailsStudentId;
    $arrStudentAlias[ $detailsStudentId ] = $detailsStudentAlias;
    $arrStudentForename[ $detailsStudentId ] = $detailsStudentForename;
    $arrStudentSurname[ $detailsStudentId ] = $detailsStudentSurname;
    $arrQuestionNo[ $detailsStudentId ] = $detailsQuestionNo;
    $arrQuestionContent[ $detailsStudentId ] = $detailsQuestonContent;

}

          foreach ($arrStudentId as $key=>$student) {

echo '<p><strong>Question:</strong> ' .htmlspecialchars($arrQuestionNo[$key]). ': ' .htmlspecialchars($arrQuestionContent[$key]). '</p>' . PHP_EOL;


?>

<form name="" method="POST">
	<select name="question" id="questionsDrop">
<option value="0">All</option>
<option value="2">What is 2+2</option>
<option value="34">What is 3+3</option>
<option value="42">What is 4+4</option>
<option value="51">What is 5+5/option>

</select>  


 <select name="student" id="studentsDrop">
    <option value="0">All</option>
    <option value="23">Jay Hart</option>
    <option value="32">Bubba Wright</option>
    <option value="43">Tim Grey</option>
    <option value="52">Mary Pine</option>
    </select>
	
	
	<input type="submit" value="GO" />
</form>