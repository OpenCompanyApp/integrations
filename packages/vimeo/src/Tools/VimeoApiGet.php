<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

/**
 * Call a documented Vimeo GET endpoint.
 */
class VimeoApiGet extends AbstractVimeoTool
{
    public const NAME = 'vimeo_api_get';
    public const DESCRIPTION = 'Call a documented Vimeo GET endpoint relative to the configured API base URL.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /me/videos.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];

    /**
     * Call the endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiGet($this->requiredString($args, 'path'), $this->arrayArg($args, 'params'));
    }
}
