<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Create a Webhook. Requires 'Administer' permission on the specified project, or global 'Administer' permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/webhooks/create.
 */
class SonarQubeWebhooksCreate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_webhooks_create';
    protected const DESCRIPTION = 'Create a Webhook. Requires \'Administer\' permission on the specified project, or global \'Administer\' permission.

Official SonarQube Web API endpoint: POST /api/webhooks/create.';
    protected const PARAMETERS = array (
      'name' => array (
        'type' => 'string',
        'description' => 'Name displayed in the administration console of webhooks',
        'required' => true,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'The key of the project that will own the webhook',
        'required' => false,
      ),
      'secret' => array (
        'type' => 'string',
        'description' => 'If provided, secret will be used as the key to generate the HMAC hex (lowercase) digest value in the \'X-Sonar-Webhook-HMAC-SHA256\' header',
        'required' => false,
      ),
      'url' => array (
        'type' => 'string',
        'description' => 'Server endpoint that will receive the webhook payload, for example \'http://my_server/foo\'. If HTTP Basic authentication is used, HTTPS is recommended to avoid man in the middle attacks. Example: \'https://myLogin:myPassword@my_server/foo\'',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/webhooks/create';
    protected const PARAM_MAP = array (
      'name' => 'name',
      'project' => 'project',
      'secret' => 'secret',
      'url' => 'url',
    );
}
