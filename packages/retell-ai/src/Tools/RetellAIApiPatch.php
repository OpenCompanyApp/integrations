<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

/**
 * Call a documented Retell AI PATCH endpoint.
 */
class RetellAIApiPatch extends AbstractRetellAITool
{
    public const NAME = 'retell_ai_api_patch';
    public const DESCRIPTION = 'Call a documented Retell AI PATCH endpoint relative to the configured API base URL.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /update-agent/{agent_id}.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];

    /**
     * Call the endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiPatch($this->requiredString($args, 'path'), $this->arrayArg($args, 'body'));
    }
}
