<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a runbook execution.
 *
 * Maps to the official FireHydrant endpoint post /v1/runbooks/executions.
 */
class FireHydrantCreateRunbookExecution extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_runbook_execution';
    protected const DESCRIPTION = 'Create a runbook execution

Official FireHydrant endpoint: POST /v1/runbooks/executions

Attaches a runbook to an incident and executes it';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/runbooks/executions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
