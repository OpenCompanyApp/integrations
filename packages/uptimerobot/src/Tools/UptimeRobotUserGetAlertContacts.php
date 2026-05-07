<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Get alert contacts.
 *
 * Maps to the official UptimeRobot endpoint GET /user/alert-contacts.
 */
class UptimeRobotUserGetAlertContacts extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_user_get_alert_contacts';
    protected const DESCRIPTION = 'Get alert contacts

Official UptimeRobot endpoint: GET /user/alert-contacts.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/user/alert-contacts';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
