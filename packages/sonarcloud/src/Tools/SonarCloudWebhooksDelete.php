<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Delete a Webhook. Requires 'Administer' permission on the specified project, or global 'Administer' permission..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/webhooks/delete.
 */
class SonarCloudWebhooksDelete extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_webhooks_delete';
    protected const DESCRIPTION = 'Delete a Webhook. Requires \'Administer\' permission on the specified project, or global \'Administer\' permission.

Official SonarCloud Web API endpoint: POST /api/webhooks/delete.';
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
