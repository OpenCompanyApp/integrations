<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve identity data.
 *
 * Maps to the official Plaid endpoint post /identity/get.
 */
class PlaidIdentityGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_identity_get';
    protected const DESCRIPTION = 'Retrieve identity data

Official Plaid endpoint: POST /identity/get

The `/identity/get` endpoint allows you to retrieve various account holder information on file with the financial institution, including names, emails, phone numbers, and addresses. Only name data is guaranteed to be returned; other fields will be empty arrays if not provided by the institution. Note: In API versions 2018-05-22 and earlier, the `owners` object is not returned, and instead identity information is returned in the top level `identity` object. For more details, see [Plaid API versioning](https://plaid.com/docs/api/versioning/#version-2019-05-29).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/identity/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}