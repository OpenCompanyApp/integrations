<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a ticketing priority.
 *
 * Maps to the official FireHydrant endpoint delete /v1/ticketing/priorities/{id}.
 */
class FireHydrantDeleteTicketingPriority extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_ticketing_priority';
    protected const DESCRIPTION = 'Delete a ticketing priority

Official FireHydrant endpoint: DELETE /v1/ticketing/priorities/{id}

Delete a single ticketing priority by ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/ticketing/priorities/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
