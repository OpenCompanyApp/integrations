<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve an individual watchlist screening.
 *
 * Maps to the official Plaid endpoint post /watchlist_screening/individual/get.
 */
class PlaidWatchlistScreeningIndividualGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_watchlist_screening_individual_get';
    protected const DESCRIPTION = 'Retrieve an individual watchlist screening

Official Plaid endpoint: POST /watchlist_screening/individual/get

Retrieve a previously created individual watchlist screening';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/watchlist_screening/individual/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}