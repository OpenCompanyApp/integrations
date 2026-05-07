<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Unlock card.
 *
 * Maps to the official Brex endpoint post /v2/cards/{id}/unlock.
 */
class BrexTeamUnlockCard extends AbstractBrexTool
{
    protected const NAME = 'brex_team_unlock_card';
    protected const DESCRIPTION = 'Unlock card

Official Brex endpoint: POST /v2/cards/{id}/unlock

Unlocks an existing card.';
    protected const PARAMETERS = array (
  'idempotency_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Idempotency-Key` from the official Brex API operation.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Brex OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v2/cards/{id}/unlock';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = false;
}
