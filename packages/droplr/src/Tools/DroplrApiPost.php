<?php

namespace OpenCompany\Integrations\Droplr\Tools;

/**
 * Call a Droplr POST endpoint.
 */
class DroplrApiPost extends AbstractDroplrTool
{
    public const NAME = 'droplr_api_post';
    public const DESCRIPTION = 'Call a documented Droplr POST endpoint relative to the configured API base URL.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /v2/drops or /notes.json.'],
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
