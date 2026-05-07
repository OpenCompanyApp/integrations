<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Archive a Spend Limit.
 *
 * Maps to the official Brex endpoint post /v1/budgets/{id}/archive.
 */
class BrexBudgetsArchiveBudget extends AbstractBrexTool
{
    protected const NAME = 'brex_budgets_archive_budget';
    protected const DESCRIPTION = 'Archive a Spend Limit

Official Brex endpoint: POST /v1/budgets/{id}/archive

Archives a Spend Limit, making it unusable for future expenses and removing it from the UI';
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
    protected const PATH = '/v1/budgets/{id}/archive';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
