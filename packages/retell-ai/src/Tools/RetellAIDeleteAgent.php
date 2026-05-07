<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

/**
 * Delete a Retell AI voice agent.
 */
class RetellAIDeleteAgent extends AbstractRetellAITool
{
    public const NAME = 'retell_ai_delete_agent';
    public const DESCRIPTION = 'Delete a Retell AI voice agent.';
    public const PARAMETERS = [
        'agent_id' => ['type' => 'string', 'required' => true, 'description' => 'Agent ID.'],
    ];

    /**
     * Delete the agent.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function call(array $args): string
    {
        $agentId = $this->requiredString($args, 'agent_id');
        $this->service->deleteAgent($agentId);

        return "Agent {$agentId} has been deleted.";
    }
}
