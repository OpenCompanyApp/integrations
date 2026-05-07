<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List hits for entity watchlist screenings.
 *
 * Maps to the official Plaid endpoint post /watchlist_screening/entity/hit/list.
 */
class PlaidWatchlistScreeningEntityHitList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_watchlist_screening_entity_hit_list';
    protected const DESCRIPTION = 'List hits for entity watchlist screenings

Official Plaid endpoint: POST /watchlist_screening/entity/hit/list

List all hits for the entity watchlist screening.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/watchlist_screening/entity/hit/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}