<?php
class TextTemplates extends DBMigration
{
    function up(){
        DBManager::get()->exec("CREATE TABLE IF NOT EXISTS `unizensus_text_templates` (
            `template_id` VARCHAR(32) NOT NULL,
            `name` VARCHAR(255)  NOT NULL UNIQUE,
            `subject` VARCHAR(255) NOT NULL,
            `message` TEXT NOT NULL,
            `mkdate` INT NOT NULL,
            `chdate` INT NOT NULL,
            PRIMARY KEY (`template_id`)
        )");
        // Insert two already used templates.
        $tpl = new UnizensusTextTemplate();
        $tpl->name = 'Einladung zur Evaluation';
        $tpl->subject = 'Evaluation ###COURSENUMBER### ###COURSENAME###';
        $tpl->message = 'Liebe Teilnehmerinnen und Teilnehmer der Veranstaltung ###COURSENAME###,

im Zeitraum vom ###EVALUATION_START### bis ###EVALUATION_END### wird diese Veranstaltung evaluiert. Sie finden den Fragebogen direkt über den folgenden Link.

Link: [Fragebogen]###COURSELINK###

Wir hoffen auf rege Beteiligung!
 
Das Evaluationsteam
Ulrich Zukowski';
        $tpl->store();
$tpl = new UnizensusTextTemplate();
        $tpl->name = 'Erinnerung zur Evaluation';
        $tpl->subject = 'Erinnerung: Evaluation ###COURSENUMBER### ###COURSENAME###';
        $tpl->message = 'Liebe Teilnehmerinnen und Teilnehmer der Veranstaltung ###COURSENAME###,

wir möchten uns zunächst bedanken für die bereits abgegebenen Bewertungen im Rahmen der Lehrevaluation. 

Die Evaluation dieser Veranstaltung läuft noch bis zum ###EVALUATION_END###. Wir möchten Sie motivieren, diese Gelegenheit zu nutzen und sich noch zu beteiligen, falls Sie bis jetzt noch nicht abgestimmt haben. Die Bewertungen werden vom Dozenten ernst genommen und Sie können so aktiv an der Verbesserung der Qualität der Lehre mitwirken!

Link: [Fragebogen]###COURSELINK###

Das Evaluationsteam
Ulrich Zukowski';
        $tpl->store();
    }

    function down()
    {
        DBManager::get()->exec("DROP TABLE `unizensus_text_templates`");
    }

}
