<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get Mistral workflow metrics.
 */
class MistralGetWorkflowMetrics extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_workflow_metrics';
    protected const DESCRIPTION = 'Get Mistral workflow metrics.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/workflows/{workflow_name}/metrics';
    protected const PATH_PARAMS = ['workflow_name'];
    protected const PARAMETERS = ['workflow_name' => ['type' => 'string', 'required' => true, 'description' => 'Mistral workflow_name.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
