<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Lock card.
 *
 * Maps to the official Brex endpoint post /v2/cards/{id}/lock.
 */
class BrexTeamLockCard extends AbstractBrexTool
{
    protected const NAME = 'brex_team_lock_card';
    protected const DESCRIPTION = 'Lock card

Official Brex endpoint: POST /v2/cards/{id}/lock

Locks an existing, unlocked card. And the card owner will receive a notification about it.';
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
    protected const METHOD = 'post';
    protected const PATH = '/v2/cards/{id}/lock';
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
