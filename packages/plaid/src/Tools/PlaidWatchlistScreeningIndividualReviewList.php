<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List reviews for individual watchlist screenings.
 *
 * Maps to the official Plaid endpoint post /watchlist_screening/individual/review/list.
 */
class PlaidWatchlistScreeningIndividualReviewList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_watchlist_screening_individual_review_list';
    protected const DESCRIPTION = 'List reviews for individual watchlist screenings

Official Plaid endpoint: POST /watchlist_screening/individual/review/list

List all reviews for the individual watchlist screening.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/watchlist_screening/individual/review/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}