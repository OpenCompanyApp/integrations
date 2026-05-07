<?php

namespace OpenCompany\Integrations\Droplr\Tools;

/**
 * Call a Droplr GET endpoint.
 */
class DroplrApiGet extends AbstractDroplrTool
{
    public const NAME = 'droplr_api_get';
    public const DESCRIPTION = 'Call a documented Droplr GET endpoint relative to the configured API base URL.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /v2/drops or /drops.json.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];

    /**
     * Call a GET endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiGet($this->requiredString($args, 'path', 'path'), $this->arrayArg($args, 'params'));
    }
}
