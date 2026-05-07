<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get a Mistral workflow run.
 */
class MistralGetWorkflowRun extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_workflow_run';
    protected const DESCRIPTION = 'Get a Mistral workflow run.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/workflows/runs/{run_id}';
    protected const PATH_PARAMS = ['run_id'];
    protected const PARAMETERS = ['run_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral run_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
