<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Get all alert contacts.
 *
 * Maps to the official UptimeRobot endpoint GET /user/all-alert-contacts.
 */
class UptimeRobotUserGetAllAlertContacts extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_user_get_all_alert_contacts';
    protected const DESCRIPTION = 'Get all alert contacts

Official UptimeRobot endpoint: GET /user/all-alert-contacts.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/user/all-alert-contacts';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
