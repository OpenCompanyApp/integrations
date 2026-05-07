<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Update a Webhook. Requires 'Administer' permission on the specified project, or global 'Administer' permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/webhooks/update.
 */
class SonarQubeWebhooksUpdate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_webhooks_update';
    protected const DESCRIPTION = 'Update a Webhook. Requires \'Administer\' permission on the specified project, or global \'Administer\' permission.

Official SonarQube Web API endpoint: POST /api/webhooks/update.';
    protected const PARAMETERS = array (
      'name' => array (
        'type' => 'string',
        'description' => 'new name of the webhook',
        'required' => true,
      ),
      'secret' => array (
        'type' => 'string',
        'description' => 'If provided, secret will be used as the key to generate the HMAC hex (lowercase) digest value in the \'X-Sonar-Webhook-HMAC-SHA256\' header. If blank, any secret previously configured will be removed. If not set, the secret will remain unchanged.',
        'required' => false,
      ),
      'url' => array (
        'type' => 'string',
        'description' => 'new url to be called by the webhook',
        'required' => true,
      ),
      'webhook' => array (
        'type' => 'string',
        'description' => 'The key of the webhook to be updated, auto-generated value can be obtained through api/webhooks/create or api/webhooks/list',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/webhooks/update';
    protected const PARAM_MAP = array (
      'name' => 'name',
      'secret' => 'secret',
      'url' => 'url',
      'webhook' => 'webhook',
    );
}
