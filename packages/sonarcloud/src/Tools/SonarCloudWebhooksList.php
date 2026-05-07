<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Search for global webhooks or project webhooks. Webhooks are ordered by name. Requires 'Administer' permission on the specified project, or global 'Administer' permission..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/webhooks/list.
 */
class SonarCloudWebhooksList extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_webhooks_list';
    protected const DESCRIPTION = 'Search for global webhooks or project webhooks. Webhooks are ordered by name. Requires \'Administer\' permission on the specified project, or global \'Administer\' permission.

Official SonarCloud Web API endpoint: GET /api/webhooks/list.';
    protected const PARAMETERS = array (
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key',
        'required' => true,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/webhooks/list';
    protected const PARAM_MAP = array (
      'organization' => 'organization',
      'project' => 'project',
    );
}
