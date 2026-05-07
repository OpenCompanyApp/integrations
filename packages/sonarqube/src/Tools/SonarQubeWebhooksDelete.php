<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Delete a Webhook. Requires 'Administer' permission on the specified project, or global 'Administer' permission..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/webhooks/delete.
 */
class SonarQubeWebhooksDelete extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_webhooks_delete';
    protected const DESCRIPTION = 'Delete a Webhook. Requires \'Administer\' permission on the specified project, or global \'Administer\' permission.

Official SonarQube Web API endpoint: POST /api/webhooks/delete.';
    protected const PARAMETERS = array (
      'webhook' => array (
        'type' => 'string',
        'description' => 'The key of the webhook to be deleted, auto-generated value can be obtained through api/webhooks/create or api/webhooks/list',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/webhooks/delete';
    protected const PARAM_MAP = array (
      'webhook' => 'webhook',
    );
}
