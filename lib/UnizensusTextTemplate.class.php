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

    function __construct($id = null)
    {
        $this->db_table = 'unizensus_text_templates';
        parent::__construct($id);
    }

    public function getAll() {
        $templates = array();
        $templates = DBManager::get()->fetchAll("SELECT * FROM `unizensus_text_templates` ORDER BY `name`");
        return $templates;
    }

    public function getMarkers() {
        return array(
            'EVALUATION_START' => array(
                'description' => _('Beginn des Evaluationszeitraums'),
                'replace' => 'date("d.m.Y", $timeframe[0])'
            ),
            'EVALUATION_END' => array(
                'description' => _('Ende des Evaluationszeitraums'),
                'replace' => 'date("d.m.Y", $timeframe[1])'
            ),
            'COURSENUMBER' => array(
                'description' => _('Veranstaltungsnummer'),
                'replace' => '$course->number'
            ),
            'COURSETYPE' => array(
                'description' => _('Veranstaltungstyp'),
                'replace' => '$GLOBALS["SEM_TYPE"][$course->status]["name"]'
            ),
            'COURSENAME' => array(
                'description' => _('Titel der Veranstaltung'),
                'replace' => '$course->name'
            ),
            'COURSELINK' => array(
                'description' => _('Stud.IP-Link zur Veranstaltung'),
                'replace' => 'URLHelper::getLink("seminar_main.php", array("auswahl" => $course->id)'
            )
        );

    }

    public function createText($courseId, $tplId) {
        $course = Course::find($courseId);
        $tpl = new UnizensusTextTemplate($tplId);
        $timeframe = self::calculateTimeFrame($courseId);
        $markers = array(
            'EVALUATION_START' => array(
                'description' => _('Beginn des Evaluationszeitraums'),
                'replace' => $timeframe['start']
            ),
            'EVALUATION_END' => array(
                'description' => _('Ende des Evaluationszeitraums'),
                'replace' => $timeframe['end']
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
                'replace' => $GLOBALS['ABSOLUTE_URI_STUDIP'].'seminar_main.php?auswahl='.$course->id
            )
        );
        $subject = $tpl->subject;
        $text = $tpl->message;
        foreach ($markers as $marker => $data) {
            $subject = str_replace('###'.$marker.'###', $data['replace'], $subject);
            $text = str_replace('###'.$marker.'###', $data['replace'], $text);
        }
        return array('subject' => $subject, 'text' => $text);
    }

    public static function calculateTimeFrame($courseId) {
        $globalStart = get_config('UNIZENSUSPLUGIN_BEGIN_EVALUATION');
        $globalEnd = get_config('UNIZENSUSPLUGIN_END_EVALUATION');
        $stmt = DBManager::get()->prepare("SELECT `content` FROM `datafields_entries` WHERE `range_id`=? AND `datafield_id`=?");
        $stmt->execute(array($courseId, md5('UNIZENSUSPLUGIN_BEGIN_EVALUATION')));
        $localStart = $stmt->fetch();
        if ($localStart) {
            $localStart = strtotime($localStart['content']);
        } else if ($globalStart) {
            $localStart = strtotime($globalStart);
        } else {
            $localStart = DBManager::get()->fetchFirst("SELECT MIN(`date`) AS start_time FROM `termine` WHERE `range_id`=?");
            $localStart = $localStart[0];
        }
        $stmt->execute(array($courseId, md5('UNIZENSUSPLUGIN_END_EVALUATION')));
        $localEnd = $stmt->fetch();
        if ($localEnd) {
            $localEnd = strtotime($localEnd['content']);
        } else if ($globalEnd) {
            $localEnd = strtotime($globalEnd);
        } else {
            $localEnd = DBManager::get()->fetchFirst("SELECT MAX(`end_time`) AS end_time FROM `termine` WHERE `range_id`=?");
            $localEnd = $localEnd[0];
        }
        return array('start' => $localStart, 'end' => $localEnd);
    }

}
