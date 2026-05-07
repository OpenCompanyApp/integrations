<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

/**
 * List Retell AI voices.
 */
class RetellAIListVoices extends AbstractRetellAITool
{
    public const NAME = 'retell_ai_list_voices';
    public const DESCRIPTION = 'List voices available to the Retell AI account.';
    public const PARAMETERS = [
        'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];

    /**
     * List voices.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listVoices($this->arrayArg($args, 'params'));
    }
}
