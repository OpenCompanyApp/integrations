<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List status page subscribers.
 *
 * Maps to the official FireHydrant endpoint get /v1/nunc_connections/{nunc_connection_id}/subscribers.
 */
class FireHydrantListEmailSubscribers extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_email_subscribers';
    protected const DESCRIPTION = 'List status page subscribers

Official FireHydrant endpoint: GET /v1/nunc_connections/{nunc_connection_id}/subscribers

Retrieves the list of subscribers for a status page.';
    protected const PARAMETERS = array (
  'nunc_connection_id' =>
  array (
    'type' => 'string',
    'description' => 'nunc_connection_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/nunc_connections/{nunc_connection_id}/subscribers';
    protected const PATH_PARAMS = array (
  'nunc_connection_id' => 'nunc_connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
