<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Create card.
 *
 * Maps to the official Brex endpoint post /v2/cards.
 */
class BrexTeamCreateCard extends AbstractBrexTool
{
    protected const NAME = 'brex_team_create_card';
    protected const DESCRIPTION = 'Create card

Official Brex endpoint: POST /v2/cards

Creates a new card. The `spend_controls` field is required when `limit_type` = `CARD`. The `mailing_address` field is required for physical cards and is the shipping address used to send the card; it is not the same as the billing and mailing address used for online purchases. The first 2 lines of this address must be under 60 characters long. Each user can only have up to 10 active physical cards. For Empower accounts, this endpoint requires budget management. If your account does not have access to budget management features, a 403 response status will be returned. If this is the case and you want to gain access to this endpoint, please contact Brex support.';
    protected const PARAMETERS = array (
  'idempotency_key' =>
  array (
    'type' => 'string',
    'required' => true,
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
    protected const PATH = '/v2/cards';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = true;
}
