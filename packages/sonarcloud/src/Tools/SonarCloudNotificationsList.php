<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * List notifications of the authenticated user.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/notifications/list.
 */
class SonarCloudNotificationsList extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_notifications_list';
    protected const DESCRIPTION = 'List notifications of the authenticated user

Official SonarCloud Web API endpoint: GET /api/notifications/list.';
    protected const PARAMETERS = array (
      'login' => array (
        'type' => 'string',
        'description' => 'User login',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/notifications/list';
    protected const PARAM_MAP = array (
      'login' => 'login',
    );
}
