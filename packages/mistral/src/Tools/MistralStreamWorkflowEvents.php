<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Read Mistral workflow event stream response.
 */
class MistralStreamWorkflowEvents extends AbstractMistralTool
{
    protected const NAME = 'mistral_stream_workflow_events';
    protected const DESCRIPTION = 'Read Mistral workflow event stream response.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/workflows/events/stream';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
