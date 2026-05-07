<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List Mistral workflow runs.
 */
class MistralListWorkflowRuns extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_workflow_runs';
    protected const DESCRIPTION = 'List Mistral workflow runs.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/workflows/runs';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
