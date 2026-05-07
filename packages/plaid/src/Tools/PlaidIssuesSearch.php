<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Search for an Issue.
 *
 * Maps to the official Plaid endpoint post /issues/search.
 */
class PlaidIssuesSearch extends AbstractPlaidTool
{
    protected const NAME = 'plaid_issues_search';
    protected const DESCRIPTION = 'Search for an Issue

Official Plaid endpoint: POST /issues/search

Search for an issue associated with one of the following identifiers: `item_id`, `link_session_id` or Link session `request_id`. This endpoint returns a list of `Issue` objects, with an empty list indicating that no issues are associated with the provided identifier. At least one of the identifiers must be provided to perform the search.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/issues/search';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}