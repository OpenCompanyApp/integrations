<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

/**
 * Stop an in-progress Retell AI call.
 */
class RetellAIStopCall extends AbstractRetellAITool
{
    public const NAME = 'retell_ai_stop_call';
    public const DESCRIPTION = 'Stop an in-progress Retell AI call.';
    public const PARAMETERS = [
        'call_id' => ['type' => 'string', 'required' => true, 'description' => 'Call ID.'],
    ];

    /**
     * Stop the call.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->stopCall($this->requiredString($args, 'call_id'));
    }
}
