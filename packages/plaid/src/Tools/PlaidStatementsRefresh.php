<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Refresh statements data..
 *
 * Maps to the official Plaid endpoint post /statements/refresh.
 */
class PlaidStatementsRefresh extends AbstractPlaidTool
{
    protected const NAME = 'plaid_statements_refresh';
    protected const DESCRIPTION = 'Refresh statements data.

Official Plaid endpoint: POST /statements/refresh

`/statements/refresh` initiates an on-demand extraction to fetch the statements for the provided dates.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/statements/refresh';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}