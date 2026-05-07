<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

/**
 * Update a Retell AI voice agent.
 */
class RetellAIUpdateAgent extends AbstractRetellAITool
{
    public const NAME = 'retell_ai_update_agent';
    public const DESCRIPTION = 'Update a Retell AI voice agent.';
    public const PARAMETERS = [
        'agent_id' => ['type' => 'string', 'required' => true, 'description' => 'Agent ID.'],
        'data' => ['type' => 'object', 'required' => true, 'description' => 'Agent update payload.'],
    ];

    /**
     * Update the agent.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->updateAgent(
            $this->requiredString($args, 'agent_id'),
            $this->requiredArray($args, 'data')
        );
    }
}
