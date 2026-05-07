<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List hits for individual watchlist screening.
 *
 * Maps to the official Plaid endpoint post /watchlist_screening/individual/hit/list.
 */
class PlaidWatchlistScreeningIndividualHitList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_watchlist_screening_individual_hit_list';
    protected const DESCRIPTION = 'List hits for individual watchlist screening

Official Plaid endpoint: POST /watchlist_screening/individual/hit/list

List all hits found by Plaid for a particular individual watchlist screening.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/watchlist_screening/individual/hit/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}