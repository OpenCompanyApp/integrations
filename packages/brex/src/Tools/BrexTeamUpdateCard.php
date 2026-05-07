<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Update card.
 *
 * Maps to the official Brex endpoint put /v2/cards/{id}.
 */
class BrexTeamUpdateCard extends AbstractBrexTool
{
    protected const NAME = 'brex_team_update_card';
    protected const DESCRIPTION = 'Update card

Official Brex endpoint: PUT /v2/cards/{id}

Update an existing vendor card';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
  'idempotency_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Idempotency-Key` from the official Brex API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Brex OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v2/cards/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = true;
}
