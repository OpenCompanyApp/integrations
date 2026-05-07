<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get card number.
 *
 * Maps to the official Brex endpoint get /v2/cards/{id}/pan.
 */
class BrexTeamGetCardNumber extends AbstractBrexTool
{
    protected const NAME = 'brex_team_get_card_number';
    protected const DESCRIPTION = 'Get card number

Official Brex endpoint: GET /v2/cards/{id}/pan

Retrieves card number, CVV, and expiration date of a card by ID.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/cards/{id}/pan';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
