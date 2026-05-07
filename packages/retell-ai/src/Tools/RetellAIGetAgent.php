<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

/**
 * Get a Retell AI voice agent.
 */
class RetellAIGetAgent extends AbstractRetellAITool
{
    public const NAME = 'retell_ai_get_agent';
    public const DESCRIPTION = 'Get a Retell AI voice agent by ID.';
    public const PARAMETERS = [
        'agent_id' => ['type' => 'string', 'required' => true, 'description' => 'Agent ID.'],
    ];

    /**
     * Get the agent.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getAgent($this->requiredString($args, 'agent_id'));
    }
}
