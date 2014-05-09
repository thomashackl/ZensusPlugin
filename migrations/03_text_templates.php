<?php
class TextTemplates extends DBMigration
{
    function up(){
        DBManager::get()->exec("CREATE TABLE IF NOT EXISTS `unizensus_text_templates` (
            `template_id` VARCHAR(32) NOT NULL,
            `name` VARCHAR(255)  NOT NULL,
            `subject` VARCHAR(255) NOT NULL,
            `message` TEXT NOT NULL,
            `mkdate` INT NOT NULL,
            `chdate` INT NOT NULL,
            PRIMARY KEY (`template_id`)
        )");
        $tpl = new UnizensusTextTemplate();
        $tpl->name = 'Einladung zur Evaluation';
        $tpl->subject = 'Evaluation ###COURSENUMBER### ###COURSENAME###';
        $tpl->message = 'Liebe Teilnehmerinnen und Teilnehmer der Veranstaltung ###COURSENAME###,

im Zeitraum vom ###EVALUATION_START### bis ###EVALUATION_END### wird diese Veranstaltung evaluiert. Sie finden den Fragebogen direkt über den folgenden Link.

Link: [Fragebogen]###COURSELINK###

Wir hoffen auf rege Beteilung!
 
Das Evaluationsteam
Ulrich Zukowski';
        $tpl->store();
    }

    function down()
    {
        DBManager::get()->exec("DROP TABLE `unizensus_text_templates`");
    }

}