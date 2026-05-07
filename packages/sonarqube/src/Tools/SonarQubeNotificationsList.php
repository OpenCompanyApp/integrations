<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List notifications of the authenticated user. Requires one of the following permissions: - Authentication if no login is provided; - System administration if a login is provided;.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/notifications/list.
 */
class SonarQubeNotificationsList extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_notifications_list';
    protected const DESCRIPTION = 'List notifications of the authenticated user. Requires one of the following permissions: - Authentication if no login is provided; - System administration if a login is provided;

Official SonarQube Web API endpoint: GET /api/notifications/list.';
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
