<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a ticketing priority.
 *
 * Maps to the official FireHydrant endpoint patch /v1/ticketing/priorities/{id}.
 */
class FireHydrantUpdateTicketingPriority extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_ticketing_priority';
    protected const DESCRIPTION = 'Update a ticketing priority

Official FireHydrant endpoint: PATCH /v1/ticketing/priorities/{id}

Update a single ticketing priority\'s attributes';
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
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/ticketing/priorities/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
