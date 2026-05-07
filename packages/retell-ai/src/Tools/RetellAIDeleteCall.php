<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

/**
 * Delete a Retell AI call record.
 */
class RetellAIDeleteCall extends AbstractRetellAITool
{
    public const NAME = 'retell_ai_delete_call';
    public const DESCRIPTION = 'Delete a Retell AI call record.';
    public const PARAMETERS = [
        'call_id' => ['type' => 'string', 'required' => true, 'description' => 'Call ID.'],
    ];

    /**
     * Delete the call.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function call(array $args): string
    {
        $callId = $this->requiredString($args, 'call_id');
        $this->service->deleteCall($callId);

        return "Call {$callId} has been deleted.";
    }
}
