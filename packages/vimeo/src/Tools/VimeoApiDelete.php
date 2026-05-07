<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

/**
 * Call a documented Vimeo DELETE endpoint.
 */
class VimeoApiDelete extends AbstractVimeoTool
{
    public const NAME = 'vimeo_api_delete';
    public const DESCRIPTION = 'Call a documented Vimeo DELETE endpoint relative to the configured API base URL.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /videos/{video_id}.'],
        'body' => ['type' => 'object', 'description' => 'Optional JSON request body.'],
    ];

    /**
     * Call the endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiDelete($this->requiredString($args, 'path'), $this->arrayArg($args, 'body'));
    }
}
