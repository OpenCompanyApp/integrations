<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List Mistral workflow events.
 */
class MistralListWorkflowEvents extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_workflow_events';
    protected const DESCRIPTION = 'List Mistral workflow events.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/workflows/events/list';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
