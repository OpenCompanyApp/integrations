<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

/**
 * Update Retell AI call metadata.
 */
class RetellAIUpdateCall extends AbstractRetellAITool
{
    public const NAME = 'retell_ai_update_call';
    public const DESCRIPTION = 'Update metadata for a Retell AI call.';
    public const PARAMETERS = [
        'call_id' => ['type' => 'string', 'required' => true, 'description' => 'Call ID.'],
        'metadata' => ['type' => 'object', 'required' => true, 'description' => 'Metadata payload.'],
    ];

    /**
     * Update the call.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->updateCall(
            $this->requiredString($args, 'call_id'),
            $this->requiredArray($args, 'metadata')
        );
    }
}
