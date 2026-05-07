<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Change Payment Plan.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/orgs/current/plan.
 */
class LangSmithChangePaymentPlan extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_change_payment_plan';
    protected const DESCRIPTION = 'Change Payment Plan

Official endpoint: POST /api/v1/orgs/current/plan
Change Payment Plan.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/orgs/current/plan';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
