<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve information about a Plaid application.
 *
 * Maps to the official Plaid endpoint post /application/get.
 */
class PlaidApplicationGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_application_get';
    protected const DESCRIPTION = 'Retrieve information about a Plaid application

Official Plaid endpoint: POST /application/get

Allows financial institutions to retrieve information about Plaid clients for the purpose of building control-tower experiences';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/application/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}