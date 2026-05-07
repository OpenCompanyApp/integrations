<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Call a documented Missive API PATCH endpoint.
 */
class MissiveApiPatch extends AbstractMissiveTool
{
    public const NAME = 'missive_api_patch';
    public const DESCRIPTION = 'Call a documented Missive API PATCH endpoint relative to /v1.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /contacts/{id}.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];

    /**
     * Call a PATCH endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiPatch($this->requiredString($args, 'path', 'path'), $this->arrayArg($args, 'body'));
    }
}
