<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a webhook endpoint.
 *
 * Maps to the official Rootly endpoint put /v1/webhooks/endpoints/{id}.
 */
class RootlyUpdateWebhooksEndpoint extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_webhooks_endpoint';
    protected const DESCRIPTION = 'Update a webhook endpoint

Official Rootly endpoint: PUT /v1/webhooks/endpoints/{id}

Update a specific webhook endpoint by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/webhooks/endpoints/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
