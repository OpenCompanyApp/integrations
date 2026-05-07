<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Create a Webhook. Requires 'Administer' permission on the specified project..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/webhooks/create.
 */
class SonarCloudWebhooksCreate extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_webhooks_create';
    protected const DESCRIPTION = 'Create a Webhook. Requires \'Administer\' permission on the specified project.

Official SonarCloud Web API endpoint: POST /api/webhooks/create.';
    protected const PARAMETERS = array (
      'name' => array (
        'type' => 'string',
        'description' => 'Name displayed in the administration console of webhooks',
        'required' => true,
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'The key of the organization that will own the webhook',
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
      'organization' => 'organization',
      'project' => 'project',
      'secret' => 'secret',
      'url' => 'url',
    );
}
