<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List Individual Watchlist Screenings.
 *
 * Maps to the official Plaid endpoint post /watchlist_screening/individual/list.
 */
class PlaidWatchlistScreeningIndividualList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_watchlist_screening_individual_list';
    protected const DESCRIPTION = 'List Individual Watchlist Screenings

Official Plaid endpoint: POST /watchlist_screening/individual/list

List previously created watchlist screenings for individuals';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/watchlist_screening/individual/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}