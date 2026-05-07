<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * Call a documented Quickbase REST API POST endpoint.
 */
class QuickBaseApiPost extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_api_post';
    public const DESCRIPTION = 'Call a documented Quickbase REST API POST endpoint relative to /v1.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /records.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
        'query' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];

    /**
     * Call a POST endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiPost($this->requiredString($args, 'path', 'path'), $this->arrayArg($args, 'body'), $this->arrayArg($args, 'query'));
    }
}
