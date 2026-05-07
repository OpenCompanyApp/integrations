<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get Mistral workflow run history.
 */
class MistralGetWorkflowRunHistory extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_workflow_run_history';
    protected const DESCRIPTION = 'Get Mistral workflow run history.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/workflows/runs/{run_id}/history';
    protected const PATH_PARAMS = ['run_id'];
    protected const PARAMETERS = ['run_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral run_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
