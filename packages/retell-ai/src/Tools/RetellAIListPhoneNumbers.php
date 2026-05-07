<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

/**
 * List Retell AI phone numbers.
 */
class RetellAIListPhoneNumbers extends AbstractRetellAITool
{
    public const NAME = 'retell_ai_list_phone_numbers';
    public const DESCRIPTION = 'List Retell AI phone numbers.';
    public const PARAMETERS = [
        'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];

    /**
     * List phone numbers.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listPhoneNumbers($this->arrayArg($args, 'params'));
    }
}
