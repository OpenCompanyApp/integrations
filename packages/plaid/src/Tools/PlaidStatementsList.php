<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve a list of all statements associated with an item..
 *
 * Maps to the official Plaid endpoint post /statements/list.
 */
class PlaidStatementsList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_statements_list';
    protected const DESCRIPTION = 'Retrieve a list of all statements associated with an item.

Official Plaid endpoint: POST /statements/list

The `/statements/list` endpoint retrieves a list of all statements associated with an item.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/statements/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}