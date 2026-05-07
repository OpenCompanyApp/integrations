<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List cards.
 *
 * Maps to the official Brex endpoint get /v2/cards.
 */
class BrexTeamListCardsByUserId extends AbstractBrexTool
{
    protected const NAME = 'brex_team_list_cards_by_user_id';
    protected const DESCRIPTION = 'List cards

Official Brex endpoint: GET /v2/cards

Lists all cards by a `user_id`. Only cards with `limit_type = CARD` have `spend_controls`';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `user_id` from the official Brex API operation.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Brex API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/cards';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'user_id' => 'user_id',
  'cursor' => 'cursor',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
