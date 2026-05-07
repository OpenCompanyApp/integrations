<?php

namespace OpenCompany\Integrations\Droplr\Tools;

/**
 * Call a Droplr DELETE endpoint.
 */
class DroplrApiDelete extends AbstractDroplrTool
{
    public const NAME = 'droplr_api_delete';
    public const DESCRIPTION = 'Call a documented Droplr DELETE endpoint relative to the configured API base URL.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /v2/drops/abc123 or /drops/abc123.'],
        'body' => ['type' => 'object', 'description' => 'Optional JSON request body.'],
    ];

    /**
     * Call a DELETE endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiDelete($this->requiredString($args, 'path', 'path'), $this->arrayArg($args, 'body'));
    }
}
