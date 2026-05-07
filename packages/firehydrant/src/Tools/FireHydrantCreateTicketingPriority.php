<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a ticketing priority.
 *
 * Maps to the official FireHydrant endpoint post /v1/ticketing/priorities.
 */
class FireHydrantCreateTicketingPriority extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_ticketing_priority';
    protected const DESCRIPTION = 'Create a ticketing priority

Official FireHydrant endpoint: POST /v1/ticketing/priorities

Create a single ticketing priority';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/ticketing/priorities';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
