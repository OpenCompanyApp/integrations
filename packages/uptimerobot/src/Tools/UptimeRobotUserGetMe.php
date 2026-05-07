<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Get current user.
 *
 * Maps to the official UptimeRobot endpoint GET /user/me.
 */
class UptimeRobotUserGetMe extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_user_get_me';
    protected const DESCRIPTION = 'Get current user

Official UptimeRobot endpoint: GET /user/me.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/user/me';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
