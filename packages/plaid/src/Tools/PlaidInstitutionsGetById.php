<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get details of an institution.
 *
 * Maps to the official Plaid endpoint post /institutions/get_by_id.
 */
class PlaidInstitutionsGetById extends AbstractPlaidTool
{
    protected const NAME = 'plaid_institutions_get_by_id';
    protected const DESCRIPTION = 'Get details of an institution

Official Plaid endpoint: POST /institutions/get_by_id

Returns a JSON response containing details on a specified financial institution currently supported by Plaid. Versioning note: API versions 2019-05-29 and earlier allow use of the `public_key` parameter instead of the `client_id` and `secret` to authenticate to this endpoint. The `public_key` has been deprecated; all customers are encouraged to use `client_id` and `secret` instead.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/institutions/get_by_id';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}