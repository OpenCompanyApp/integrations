<?php

namespace OpenCompany\Integrations\Droplr\Tools;

/**
 * Call a Droplr PUT endpoint.
 */
class DroplrApiPut extends AbstractDroplrTool
{
    public const NAME = 'droplr_api_put';
    public const DESCRIPTION = 'Call a documented Droplr PUT endpoint relative to the configured API base URL.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /v2/user or /account.json.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];

    /**
     * Call a PUT endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiPut($this->requiredString($args, 'path', 'path'), $this->arrayArg($args, 'body'));
    }
}
