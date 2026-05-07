<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a review for an entity watchlist screening.
 *
 * Maps to the official Plaid endpoint post /watchlist_screening/entity/review/create.
 */
class PlaidWatchlistScreeningEntityReviewCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_watchlist_screening_entity_review_create';
    protected const DESCRIPTION = 'Create a review for an entity watchlist screening

Official Plaid endpoint: POST /watchlist_screening/entity/review/create

Create a review for an entity watchlist screening. Reviews are compliance reports created by users in your organization regarding the relevance of potential hits found by Plaid.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/watchlist_screening/entity/review/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}