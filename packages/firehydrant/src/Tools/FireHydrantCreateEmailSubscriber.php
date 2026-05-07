<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Add subscribers to a status page.
 *
 * Maps to the official FireHydrant endpoint post /v1/nunc_connections/{nunc_connection_id}/subscribers.
 */
class FireHydrantCreateEmailSubscriber extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_email_subscriber';
    protected const DESCRIPTION = 'Add subscribers to a status page

Official FireHydrant endpoint: POST /v1/nunc_connections/{nunc_connection_id}/subscribers

Subscribes a comma-separated string of emails to status page updates';
    protected const PARAMETERS = array (
  'nunc_connection_id' =>
  array (
    'type' => 'string',
    'description' => 'nunc_connection_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/nunc_connections/{nunc_connection_id}/subscribers';
    protected const PATH_PARAMS = array (
  'nunc_connection_id' => 'nunc_connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
