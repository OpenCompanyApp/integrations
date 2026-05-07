<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

/**
 * Update a Retell AI phone number.
 */
class RetellAIUpdatePhoneNumber extends AbstractRetellAITool
{
    public const NAME = 'retell_ai_update_phone_number';
    public const DESCRIPTION = 'Update Retell AI phone number routing or configuration.';
    public const PARAMETERS = [
        'phone_number' => ['type' => 'string', 'required' => true, 'description' => 'Phone number such as +14155550100.'],
        'data' => ['type' => 'object', 'required' => true, 'description' => 'Phone number update payload.'],
    ];

    /**
     * Update the phone number.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->updatePhoneNumber(
            $this->requiredString($args, 'phone_number'),
            $this->requiredArray($args, 'data')
        );
    }
}
