<?php
class TextTemplates extends DBMigration
{
    function up(){
        DBManager::get()->exec("CREATE TABLE IF NOT EXISTS `unizensus_text_templates (
            `template_id` VARCHAR(32) NOT NULL,
            `name` VARCHAR(255)  NOT NULL,
            `template` TEXT NOT NULL,
            `mkdate` INT NOT NULL,
            `chdate` INT NOT NULL,
            PRIMARY KEY `template_id`
        )");
        $tpl = new UnizensusTextTemplate();
        $tpl->setName('Einladung zur Evaluation');
        $tpl->setTemplate('###SUBJECT###
Evaluation ###COURSENUMBER### ###COURSENAME###
###SUBJECT###
###MESSAGE###
Liebe Teilnehmerinnen und Teilnehmer der Veranstaltung ###COURSENAME###,

im Zeitraum vom ###EVALUATION_START### bis ###EVALUATION_END### wird diese Veranstaltung evaluiert. Sie finden den Fragebogen direkt über den folgenden Link.

Link: [Fragebogen]###COURSELINK###

Wir hoffen auf rege Beteilung!
 
Das Evaluationsteam
Ulrich Zukowski
###MESSAGE###');
        $tpl->store();
    }

    function down()
    {
        DBManager::get()->exec("DROP TABLE `unizensus_text_templates`");
    }

}