<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get details of all supported institutions.
 *
 * Maps to the official Plaid endpoint post /institutions/get.
 */
class PlaidInstitutionsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_institutions_get';
    protected const DESCRIPTION = 'Get details of all supported institutions

Official Plaid endpoint: POST /institutions/get

Returns a JSON response containing details on all financial institutions currently supported by Plaid. Because Plaid supports thousands of institutions, results are paginated. If there is no overlap between an institution’s enabled products and a client’s enabled products, then the institution will be filtered out from the response. As a result, the number of institutions returned may not match the count specified in the call.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/institutions/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}