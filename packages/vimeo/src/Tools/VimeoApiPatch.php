<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

/**
 * Call a documented Vimeo PATCH endpoint.
 */
class VimeoApiPatch extends AbstractVimeoTool
{
    public const NAME = 'vimeo_api_patch';
    public const DESCRIPTION = 'Call a documented Vimeo PATCH endpoint relative to the configured API base URL.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /videos/{video_id}.'],
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
        return $this->service->apiPatch($this->requiredString($args, 'path'), $this->arrayArg($args, 'body'));
    }
}
