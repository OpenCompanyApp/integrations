<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve Auth data.
 *
 * Maps to the official Plaid endpoint post /processor/auth/get.
 */
class PlaidProcessorAuthGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_processor_auth_get';
    protected const DESCRIPTION = 'Retrieve Auth data

Official Plaid endpoint: POST /processor/auth/get

The `/processor/auth/get` endpoint returns the bank account and bank identification number (such as the routing number, for US accounts), for a checking, savings, or cash management account that\'\'s associated with a given `processor_token`. The endpoint also returns high-level account data and balances when available. Versioning note: API versions 2019-05-29 and earlier use a different schema for the `numbers` object returned by this endpoint. For details, see [Plaid API versioning](https://plaid.com/docs/api/versioning/#version-2020-09-14).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/processor/auth/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}