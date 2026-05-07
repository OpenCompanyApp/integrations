<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

/**
 * List Retell LLM configurations.
 */
class RetellAIListRetellLlms extends AbstractRetellAITool
{
    public const NAME = 'retell_ai_list_retell_llms';
    public const DESCRIPTION = 'List Retell LLM configurations.';
    public const PARAMETERS = [
        'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];

    /**
     * List LLMs.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listRetellLlms($this->arrayArg($args, 'params'));
    }
}
