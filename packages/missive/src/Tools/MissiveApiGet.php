<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Call a documented Missive API GET endpoint.
 */
class MissiveApiGet extends AbstractMissiveTool
{
    public const NAME = 'missive_api_get';
    public const DESCRIPTION = 'Call a documented Missive API GET endpoint relative to /v1.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /contacts or /shared_labels.'],
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
