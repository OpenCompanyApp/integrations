<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * Create a Cerebras text completion.
 */
class CerebrasCompletions extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_completions';
    protected const DESCRIPTION = 'Create a Cerebras text completion.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/completions';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'description' => 'Request body or multipart fields matching the Cerebras API schema.']];
}
