<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

/**
 * Get a Retell LLM configuration.
 */
class RetellAIGetRetellLlm extends AbstractRetellAITool
{
    public const NAME = 'retell_ai_get_retell_llm';
    public const DESCRIPTION = 'Get a Retell LLM configuration by ID.';
    public const PARAMETERS = [
        'llm_id' => ['type' => 'string', 'required' => true, 'description' => 'Retell LLM ID.'],
    ];

    /**
     * Get the LLM.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getRetellLlm($this->requiredString($args, 'llm_id'));
    }
}
