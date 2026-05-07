<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Search institutions.
 *
 * Maps to the official Plaid endpoint post /institutions/search.
 */
class PlaidInstitutionsSearch extends AbstractPlaidTool
{
    protected const NAME = 'plaid_institutions_search';
    protected const DESCRIPTION = 'Search institutions

Official Plaid endpoint: POST /institutions/search

Returns a JSON response containing details for institutions that match the query parameters, up to a maximum of ten institutions per query. Versioning note: API versions 2019-05-29 and earlier allow use of the `public_key` parameter instead of the `client_id` and `secret` parameters to authenticate to this endpoint. The `public_key` parameter has since been deprecated; all customers are encouraged to use `client_id` and `secret` instead.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/institutions/search';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}