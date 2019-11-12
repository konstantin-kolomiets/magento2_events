<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-12
 * Time: 09:31
 */

namespace Vaimo\Events\Api\Data;

interface EventSubscriptionsInterface
{
    const TABLE_NAME          = 'subscriptions_events';
    const FIELD_ID            = 'sub_id';
    const FIELD_EVENTS_ID     = 'vaimo_events_event_id';
    const FIELD_PHONE         = 'phone';
    const FIELD_NAME          = 'name';
    const FIELD_STATUS        = 'status';

    public function getId();
    public function getEventsId();
    public function getPhone();
    public function getName();
    public function getStatus();

    public function setEventsId($id);
    public function setPhone($phone);
    public function setName($name);
    public function setStatus($status);
}