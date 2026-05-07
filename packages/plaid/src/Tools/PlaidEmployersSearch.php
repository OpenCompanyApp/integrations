<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Search employer database.
 *
 * Maps to the official Plaid endpoint post /employers/search.
 */
class PlaidEmployersSearch extends AbstractPlaidTool
{
    protected const NAME = 'plaid_employers_search';
    protected const DESCRIPTION = 'Search employer database

Official Plaid endpoint: POST /employers/search

`/employers/search` allows you the ability to search Plaid’s database of known employers, for use with Deposit Switch. You can use this endpoint to look up a user\'s employer in order to confirm that they are supported. Users with non-supported employers can then be routed out of the Deposit Switch flow. The data in the employer database is currently limited. As the Deposit Switch and Income products progress through their respective beta periods, more employers are being regularly added. Because the employer database is frequently updated, we recommend that you do not cache or store data from this endpoint for more than a day.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/employers/search';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}