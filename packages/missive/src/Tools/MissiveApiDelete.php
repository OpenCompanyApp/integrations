<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Call a documented Missive API DELETE endpoint.
 */
class MissiveApiDelete extends AbstractMissiveTool
{
    public const NAME = 'missive_api_delete';
    public const DESCRIPTION = 'Call a documented Missive API DELETE endpoint relative to /v1.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /drafts/{id}.'],
        'params' => ['type' => 'object', 'description' => 'Optional request parameters.'],
    ];

    /**
     * Call a DELETE endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiDelete($this->requiredString($args, 'path', 'path'), $this->arrayArg($args, 'params'));
    }
}
