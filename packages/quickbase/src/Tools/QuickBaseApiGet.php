<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * Call a documented Quickbase REST API GET endpoint.
 */
class QuickBaseApiGet extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_api_get';
    public const DESCRIPTION = 'Call a documented Quickbase REST API GET endpoint relative to /v1.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /apps or /fields.'],
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
