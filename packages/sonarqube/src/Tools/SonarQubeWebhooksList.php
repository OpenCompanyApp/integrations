<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Search for global webhooks or project webhooks. Webhooks are ordered by name. Requires 'Administer' permission on the specified project, or global 'Administer' permission..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/webhooks/list.
 */
class SonarQubeWebhooksList extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_webhooks_list';
    protected const DESCRIPTION = 'Search for global webhooks or project webhooks. Webhooks are ordered by name. Requires \'Administer\' permission on the specified project, or global \'Administer\' permission.

Official SonarQube Web API endpoint: GET /api/webhooks/list.';
    protected const PARAMETERS = array (
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/webhooks/list';
    protected const PARAM_MAP = array (
      'project' => 'project',
    );
}
