<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a watchlist screening for an entity.
 *
 * Maps to the official Plaid endpoint post /watchlist_screening/entity/create.
 */
class PlaidWatchlistScreeningEntityCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_watchlist_screening_entity_create';
    protected const DESCRIPTION = 'Create a watchlist screening for an entity

Official Plaid endpoint: POST /watchlist_screening/entity/create

Create a new entity watchlist screening to check your customer against watchlists defined in the associated entity watchlist program. If your associated program has ongoing screening enabled, this is the profile information that will be used to monitor your customer over time.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/watchlist_screening/entity/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}