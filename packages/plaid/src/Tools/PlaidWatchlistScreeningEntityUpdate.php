<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Update an entity screening.
 *
 * Maps to the official Plaid endpoint post /watchlist_screening/entity/update.
 */
class PlaidWatchlistScreeningEntityUpdate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_watchlist_screening_entity_update';
    protected const DESCRIPTION = 'Update an entity screening

Official Plaid endpoint: POST /watchlist_screening/entity/update

Update an entity watchlist screening.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/watchlist_screening/entity/update';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}