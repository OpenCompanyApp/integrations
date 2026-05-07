<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Call a documented Missive API POST endpoint.
 */
class MissiveApiPost extends AbstractMissiveTool
{
    public const NAME = 'missive_api_post';
    public const DESCRIPTION = 'Call a documented Missive API POST endpoint relative to /v1.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /drafts.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];

    /**
     * Call a POST endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiPost($this->requiredString($args, 'path', 'path'), $this->arrayArg($args, 'body'));
    }
}
