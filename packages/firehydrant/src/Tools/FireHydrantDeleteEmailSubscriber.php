<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Remove subscribers from a status page.
 *
 * Maps to the official FireHydrant endpoint delete /v1/nunc_connections/{nunc_connection_id}/subscribers.
 */
class FireHydrantDeleteEmailSubscriber extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_email_subscriber';
    protected const DESCRIPTION = 'Remove subscribers from a status page

Official FireHydrant endpoint: DELETE /v1/nunc_connections/{nunc_connection_id}/subscribers

Unsubscribes one or more status page subscribers.';
    protected const PARAMETERS = array (
  'nunc_connection_id' =>
  array (
    'type' => 'string',
    'description' => 'nunc_connection_id parameter.',
    'required' => true,
  ),
  'subscriber_ids' =>
  array (
    'type' => 'string',
    'description' => 'A list of subscriber IDs to unsubscribe.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/nunc_connections/{nunc_connection_id}/subscribers';
    protected const PATH_PARAMS = array (
  'nunc_connection_id' => 'nunc_connection_id',
);
    protected const QUERY_PARAMS = array (
  'subscriber_ids' => 'subscriber_ids',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
