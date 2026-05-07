<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve Identity data.
 *
 * Maps to the official Plaid endpoint post /processor/identity/get.
 */
class PlaidProcessorIdentityGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_processor_identity_get';
    protected const DESCRIPTION = 'Retrieve Identity data

Official Plaid endpoint: POST /processor/identity/get

The `/processor/identity/get` endpoint allows you to retrieve various account holder information on file with the financial institution, including names, emails, phone numbers, and addresses.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/processor/identity/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}