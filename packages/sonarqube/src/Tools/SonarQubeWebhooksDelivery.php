<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Get a webhook delivery by its id. Require 'Administer System' permission. Note that additional information are returned by api/webhooks/delivery..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/webhooks/delivery.
 */
class SonarQubeWebhooksDelivery extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_webhooks_delivery';
    protected const DESCRIPTION = 'Get a webhook delivery by its id. Require \'Administer System\' permission. Note that additional information are returned by api/webhooks/delivery.

Official SonarQube Web API endpoint: GET /api/webhooks/delivery.';
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
