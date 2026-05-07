<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Create title.
 *
 * Maps to the official Brex endpoint post /v2/titles.
 */
class BrexTeamCreateTitle extends AbstractBrexTool
{
    protected const NAME = 'brex_team_create_title';
    protected const DESCRIPTION = 'Create title

Official Brex endpoint: POST /v2/titles

This endpoint creates a new title';
    protected const PARAMETERS = array (
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
    protected const PATH = '/v2/titles';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = true;
}
