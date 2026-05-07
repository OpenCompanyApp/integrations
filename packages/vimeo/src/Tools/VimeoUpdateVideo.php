<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

/**
 * Update Vimeo video metadata and settings.
 */
class VimeoUpdateVideo extends AbstractVimeoTool
{
    public const NAME = 'vimeo_update_video';
    public const DESCRIPTION = 'Update a Vimeo video by ID.';
    public const PARAMETERS = [
        'video_id' => ['type' => 'string', 'required' => true, 'description' => 'Vimeo video ID.'],
        'data' => ['type' => 'object', 'required' => true, 'description' => 'Video update payload.'],
    ];

    /**
     * Update the video.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->updateVideo(
            $this->requiredString($args, 'video_id'),
            $this->requiredArray($args, 'data')
        );
    }
}
