<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List a historical log of user consent events.
 *
 * Maps to the official Plaid endpoint post /item/activity/list.
 */
class PlaidItemActivityList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_item_activity_list';
    protected const DESCRIPTION = 'List a historical log of user consent events

Official Plaid endpoint: POST /item/activity/list

List a historical log of user consent events';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/item/activity/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}