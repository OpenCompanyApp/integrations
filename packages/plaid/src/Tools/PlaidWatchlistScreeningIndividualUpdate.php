<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Update individual watchlist screening.
 *
 * Maps to the official Plaid endpoint post /watchlist_screening/individual/update.
 */
class PlaidWatchlistScreeningIndividualUpdate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_watchlist_screening_individual_update';
    protected const DESCRIPTION = 'Update individual watchlist screening

Official Plaid endpoint: POST /watchlist_screening/individual/update

Update a specific individual watchlist screening. This endpoint can be used to add additional customer information, correct outdated information, add a reference id, assign the individual to a reviewer, and update which program it is associated with. Please note that you may not update `search_terms` and `status` at the same time since editing `search_terms` may trigger an automatic `status` change.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/watchlist_screening/individual/update';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}