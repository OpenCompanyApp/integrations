<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a ticketing priority.
 *
 * Maps to the official FireHydrant endpoint get /v1/ticketing/priorities/{id}.
 */
class FireHydrantGetTicketingPriority extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_ticketing_priority';
    protected const DESCRIPTION = 'Get a ticketing priority

Official FireHydrant endpoint: GET /v1/ticketing/priorities/{id}

Retrieve a single ticketing priority by ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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
