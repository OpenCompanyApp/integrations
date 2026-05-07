<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Get the recent deliveries for a specified project or Compute Engine task. Require 'Administer' permission on the related project. Note that additional information are returned by api/webhooks/delivery..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/webhooks/deliveries.
 */
class SonarCloudWebhooksDeliveries extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_webhooks_deliveries';
    protected const DESCRIPTION = 'Get the recent deliveries for a specified project or Compute Engine task. Require \'Administer\' permission on the related project. Note that additional information are returned by api/webhooks/delivery.

Official SonarCloud Web API endpoint: GET /api/webhooks/deliveries.';
    protected const PARAMETERS = array (
      'ce_task_id' => array (
        'type' => 'string',
        'description' => 'Id of the Compute Engine task',
        'required' => false,
      ),
      'component_key' => array (
        'type' => 'string',
        'description' => 'Key of the project',
        'required' => false,
      ),
      'p' => array (
        'type' => 'string',
        'description' => '1-based page number',
        'required' => false,
      ),
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0 and less than 500',
        'required' => false,
      ),
      'webhook' => array (
        'type' => 'string',
        'description' => 'Key of the webhook that triggered those deliveries, auto-generated value that can be obtained through api/webhooks/create or api/webhooks/list',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/webhooks/deliveries';
    protected const PARAM_MAP = array (
      'ceTaskId' => 'ce_task_id',
      'componentKey' => 'component_key',
      'p' => 'p',
      'ps' => 'ps',
      'webhook' => 'webhook',
    );
}
