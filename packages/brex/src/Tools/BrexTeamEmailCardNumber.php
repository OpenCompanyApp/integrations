<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Create secure email to send card number.
 *
 * Maps to the official Brex endpoint post /v2/cards/{id}/secure_email.
 */
class BrexTeamEmailCardNumber extends AbstractBrexTool
{
    protected const NAME = 'brex_team_email_card_number';
    protected const DESCRIPTION = 'Create secure email to send card number

Official Brex endpoint: POST /v2/cards/{id}/secure_email

Creates a secure email to send card number, CVV, and expiration date of a card by ID to the specified email. This endpoint is currently gated. If you would like to request access, please reach out to developer-support@brex.com';
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
    protected const PATH = '/v2/cards/{id}/secure_email';
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
