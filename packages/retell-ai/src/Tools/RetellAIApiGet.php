<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

/**
 * Call a documented Retell AI GET endpoint.
 */
class RetellAIApiGet extends AbstractRetellAITool
{
    public const NAME = 'retell_ai_api_get';
    public const DESCRIPTION = 'Call a documented Retell AI GET endpoint relative to the configured API base URL.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /list-voices.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];

    /**
     * Call the endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiGet($this->requiredString($args, 'path'), $this->arrayArg($args, 'params'));
    }
}
