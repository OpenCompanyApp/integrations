<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Set limit for the user.
 *
 * Maps to the official Brex endpoint post /v2/users/{id}/limit.
 */
class BrexTeamSetUserLimit extends AbstractBrexTool
{
    protected const NAME = 'brex_team_set_user_limit';
    protected const DESCRIPTION = 'Set limit for the user

Official Brex endpoint: POST /v2/users/{id}/limit

This endpoint sets the monthly limit for a user. The limit amount must be non-negative. To unset the monthly limit of the user, just set `monthly_limit` to null.';
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
    protected const PATH = '/v2/users/{id}/limit';
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
