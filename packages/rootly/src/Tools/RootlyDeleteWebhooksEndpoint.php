<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a webhook endpoint.
 *
 * Maps to the official Rootly endpoint delete /v1/webhooks/endpoints/{id}.
 */
class RootlyDeleteWebhooksEndpoint extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_webhooks_endpoint';
    protected const DESCRIPTION = 'Delete a webhook endpoint

Official Rootly endpoint: DELETE /v1/webhooks/endpoints/{id}

Delete a specific webhook endpoint by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
