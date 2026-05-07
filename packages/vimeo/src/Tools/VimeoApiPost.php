<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

/**
 * Call a documented Vimeo POST endpoint.
 */
class VimeoApiPost extends AbstractVimeoTool
{
    public const NAME = 'vimeo_api_post';
    public const DESCRIPTION = 'Call a documented Vimeo POST endpoint relative to the configured API base URL.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /me/albums.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];

    /**
     * Call the endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiPost($this->requiredString($args, 'path'), $this->arrayArg($args, 'body'));
    }
}
