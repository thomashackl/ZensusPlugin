<?php
/**
 * UnizensusTextTemplate.class.php
 * model class for table unizensus_text_templates
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as
 * published by the Free Software Foundation; either version 2 of
 * the License, or (at your option) any later version.
 *
 * @author      Thomas Hackl <thomas.hackl@uni-passau.de>
 * @copyright   2014Stud.IP Core-Group
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GPL version 2
 * @category    Stud.IP
 *
 */
class UnizensusTextTemplate extends SimpleORMap
{

    public static function configure($config = array()) {
        $config['db_table'] = 'unizensus_text_templates';
        parent::configure($config);
    }

    public function getAll() {
        $templates = array();
        $templates = DBManager::get()->fetchAll("SELECT * FROM `unizensus_text_templates` ORDER BY `name`");
        return $templates;
    }

    public function createText($courseId, $tplId) {
        $course = Course::find($courseId);
        $tpl = new UnizensusTextTemplate($tplId);
        $timeframe = self::calculateTimeFrame($courseId);
        $pm = PluginManager::getInstance();
        $unizensus = $pm->getPlugin('UniZensusPlugin');
        $unizensusid = $unizensus->getPluginId();
        $link = $GLOBALS['ABSOLUTE_URI_STUDIP'].'seminar_main.php?auswahl='.$course->id;
        if ($unizensusid) {
            if ($unizensus->isActivated($course->id, 'sem')) {
                $link = $GLOBALS['ABSOLUTE_URI_STUDIP'].'plugins.php/unizensusplugin/show?cid='.$course->id;
            }
        }
        $markers = array(
            'EVALUATION_START' => array(
                'description' => _('Beginn des Evaluationszeitraums'),
                'replace' => date('d.m.Y', $timeframe['start'])
            ),
            'EVALUATION_END' => array(
                'description' => _('Ende des Evaluationszeitraums'),
                'replace' => date('d.m.Y', $timeframe['end'])
            ),
            'COURSENUMBER' => array(
                'description' => _('Veranstaltungsnummer'),
                'replace' => $course->veranstaltungsnummer
            ),
            'COURSETYPE' => array(
                'description' => _('Veranstaltungstyp'),
                'replace' => $GLOBALS['SEM_TYPE'][$course->status]['name']
            ),
            'COURSENAME' => array(
                'description' => _('Titel der Veranstaltung'),
                'replace' => $course->name
            ),
            'COURSELINK' => array(
                'description' => _('Stud.IP-Link zur Veranstaltung'),
                'replace' => $link
            )
        );
        $subject = $tpl->subject;
        $text = $tpl->message;
        foreach ($markers as $marker => $data) {
            $subject = str_replace('###'.$marker.'###', $data['replace'], $subject);
            $text = str_replace('###'.$marker.'###', $data['replace'], $text);
        }
        return array('subject' => $subject, 'text' => $text, 'timeframe' => $timeframe);
    }

    public static function calculateTimeFrame($courseId) {
        $info = PluginManager::getInstance()->getPluginInfo('unizensusplugin');
        $plugin = PluginManager::getInstance()->getPluginById($info['id']);
        $plugin->setId($courseId);
        $timeFrame = $plugin->getCourseEvaluationTimeframe();

        return array('start' => $timeFrame[0], 'end' => $timeFrame[1]);
    }

}
