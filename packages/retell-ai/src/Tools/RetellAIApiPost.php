<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

/**
 * Call a documented Retell AI POST endpoint.
 */
class RetellAIApiPost extends AbstractRetellAITool
{
    public const NAME = 'retell_ai_api_post';
    public const DESCRIPTION = 'Call a documented Retell AI POST endpoint relative to the configured API base URL.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /create-retell-llm.'],
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
        return $this->service->apiPost($this->requiredString($args, 'path'), $this->arrayArg($args, 'body'));
    }
}
