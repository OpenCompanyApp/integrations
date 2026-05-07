<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Update the scopes of access for a particular application.
 *
 * Maps to the official Plaid endpoint post /item/application/scopes/update.
 */
class PlaidItemApplicationScopesUpdate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_item_application_scopes_update';
    protected const DESCRIPTION = 'Update the scopes of access for a particular application

Official Plaid endpoint: POST /item/application/scopes/update

Enable consumers to update product access on selected accounts for an application.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/item/application/scopes/update';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}