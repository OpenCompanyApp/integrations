<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get card.
 *
 * Maps to the official Brex endpoint get /v2/cards/{id}.
 */
class BrexTeamGetCardById extends AbstractBrexTool
{
    protected const NAME = 'brex_team_get_card_by_id';
    protected const DESCRIPTION = 'Get card

Official Brex endpoint: GET /v2/cards/{id}

Retrieves a card by ID. Only cards with `limit_type = CARD` have `spend_controls`';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/cards/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
