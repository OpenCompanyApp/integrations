<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get Mistral workflow worker identity.
 */
class MistralGetWorkflowWorkerInfo extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_workflow_worker_info';
    protected const DESCRIPTION = 'Get Mistral workflow worker identity.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/workflows/workers/whoami';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
