<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List a user’s connected applications.
 *
 * Maps to the official Plaid endpoint post /item/application/list.
 */
class PlaidItemApplicationList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_item_application_list';
    protected const DESCRIPTION = 'List a user’s connected applications

Official Plaid endpoint: POST /item/application/list

List a user’s connected applications';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/item/application/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}