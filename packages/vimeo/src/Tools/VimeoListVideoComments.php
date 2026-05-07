<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

/**
 * List comments for a Vimeo video.
 */
class VimeoListVideoComments extends AbstractVimeoTool
{
    public const NAME = 'vimeo_list_video_comments';
    public const DESCRIPTION = 'List comments for a Vimeo video.';
    public const PARAMETERS = [
        'video_id' => ['type' => 'string', 'required' => true, 'description' => 'Vimeo video ID.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters such as page, per_page, and direction.'],
    ];

    /**
     * List comments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listVideoComments($this->requiredString($args, 'video_id'), $this->arrayArg($args, 'params'));
    }
}
