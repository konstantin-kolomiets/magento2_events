<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 2019-11-07
 * Time: 10:21
 */

namespace Vaimo\Events\Api\Data;

interface BaseEventsInterface
{
    const TABLE_NAME          = 'vaimo_events_event';
    const FIELD_ID            = 'vaimo_events_event_id';
    const FIELD_CURRENT_TITLE = 'title';
    const FIELD_DESCRIPTION   = 'description';
    const FIELD_EVENT_TIME    = 'event_time';
    const FIELD_IMAGE         = 'image';
    const FIELD_ACTIVE        = 'is_active';


    public function getId();

    public function getCurrentTitle();

    public function setCurrentTitle($title);

    public function getDescription();

    public function setDescription($description);

    public function getEventTime();
    public function setEventTime($eventTime);

    public function getImage();
    public function setImage($icon);

    public function getActive();
    public function setActive($yesno);
}