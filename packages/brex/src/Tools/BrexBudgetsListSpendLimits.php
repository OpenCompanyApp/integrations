<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List Spend Limits.
 *
 * Maps to the official Brex endpoint get /v2/spend_limits.
 */
class BrexBudgetsListSpendLimits extends AbstractBrexTool
{
    protected const NAME = 'brex_budgets_list_spend_limits';
    protected const DESCRIPTION = 'List Spend Limits

Official Brex endpoint: GET /v2/spend_limits

Retrieves a list of Spend Limits';
    protected const PARAMETERS = array (
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Brex API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Brex API operation.',
  ),
  'member_user_id' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `member_user_id[]` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/spend_limits';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
  'member_user_id[]' => 'member_user_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
