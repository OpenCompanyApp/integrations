<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

/**
 * Get a Retell AI phone number.
 */
class RetellAIGetPhoneNumber extends AbstractRetellAITool
{
    public const NAME = 'retell_ai_get_phone_number';
    public const DESCRIPTION = 'Get a Retell AI phone number by E.164 value.';
    public const PARAMETERS = [
        'phone_number' => ['type' => 'string', 'required' => true, 'description' => 'Phone number such as +14155550100.'],
    ];

    /**
     * Get the phone number.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getPhoneNumber($this->requiredString($args, 'phone_number'));
    }
}
