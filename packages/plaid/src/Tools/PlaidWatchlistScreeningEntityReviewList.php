<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List reviews for entity watchlist screenings.
 *
 * Maps to the official Plaid endpoint post /watchlist_screening/entity/review/list.
 */
class PlaidWatchlistScreeningEntityReviewList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_watchlist_screening_entity_review_list';
    protected const DESCRIPTION = 'List reviews for entity watchlist screenings

Official Plaid endpoint: POST /watchlist_screening/entity/review/list

List all reviews for a particular entity watchlist screening. Reviews are compliance reports created by users in your organization regarding the relevance of potential hits found by Plaid.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/watchlist_screening/entity/review/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}