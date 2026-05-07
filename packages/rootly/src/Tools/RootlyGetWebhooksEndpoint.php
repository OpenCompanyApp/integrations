<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a webhook endpoint.
 *
 * Maps to the official Rootly endpoint get /v1/webhooks/endpoints/{id}.
 */
class RootlyGetWebhooksEndpoint extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_webhooks_endpoint';
    protected const DESCRIPTION = 'Retrieves a webhook endpoint

Official Rootly endpoint: GET /v1/webhooks/endpoints/{id}

Retrieves a specific webhook endpoint by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/webhooks/endpoints/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
