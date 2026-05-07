<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Archive a Budget.
 *
 * Maps to the official Brex endpoint post /v2/budgets/{id}/archive.
 */
class BrexBudgetsArchiveSpendBudget extends AbstractBrexTool
{
    protected const NAME = 'brex_budgets_archive_spend_budget';
    protected const DESCRIPTION = 'Archive a Budget

Official Brex endpoint: POST /v2/budgets/{id}/archive

Archives a Budget, making any Spend Limits beneath it unusable for future expenses and removing it from the UI';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Brex OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v2/budgets/{id}/archive';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
