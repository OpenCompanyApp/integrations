<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Get a webhook delivery by its id. Note that additional information are returned by api/webhooks/delivery..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/webhooks/delivery.
 */
class SonarCloudWebhooksDelivery extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_webhooks_delivery';
    protected const DESCRIPTION = 'Get a webhook delivery by its id. Note that additional information are returned by api/webhooks/delivery.

Official SonarCloud Web API endpoint: GET /api/webhooks/delivery.';
    protected const PARAMETERS = array (
      'delivery_id' => array (
        'type' => 'string',
        'description' => 'Id of delivery',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/webhooks/delivery';
    protected const PARAM_MAP = array (
      'deliveryId' => 'delivery_id',
    );
}
