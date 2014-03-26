<?php
    // Prevent running directly:
    if (!defined('PERCH_DB_PREFIX')) exit;


    $API = new PerchAPI(1.0, 'perch_events');

    $Settings = $API->get('Settings');

    if ($Settings->get('perch_events_update')->val()!='1.8') {

        $db = $API->get('DB');

        $sql = "ALTER TABLE `".PERCH_DB_PREFIX."events` ADD FULLTEXT idx_search (`eventTitle`, `eventDescRaw`)";
        $db->execute($sql);

        $sql = "ALTER TABLE `".PERCH_DB_PREFIX."events_categories` ADD `categoryEventCount` INT(0)  UNSIGNED  NOT NULL  DEFAULT '0'  AFTER `categorySlug`";
        $db->execute($sql);        

        $sql = "ALTER TABLE `".PERCH_DB_PREFIX."events_categories` ADD `categoryFutureEventCount` INT  UNSIGNED  NOT NULL  DEFAULT '0'  AFTER `categoryEventCount`";
        $db->execute($sql);        

        $sql = "ALTER TABLE `".PERCH_DB_PREFIX."events_categories` ADD `categoryDynamicFields` TEXT  NULL  AFTER `categoryFutureEventCount`";
        $db->execute($sql);



        $Cats = new PerchEvents_Categories($API);
        $Cats->update_event_counts();

        $Settings->set('perch_events_update', '1.8');

    }

?>