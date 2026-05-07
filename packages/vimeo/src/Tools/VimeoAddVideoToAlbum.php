<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

/**
 * Add a video to a Vimeo album/showcase.
 */
class VimeoAddVideoToAlbum extends AbstractVimeoTool
{
    public const NAME = 'vimeo_add_video_to_album';
    public const DESCRIPTION = 'Add a video to a Vimeo album/showcase.';
    public const PARAMETERS = [
        'album_id' => ['type' => 'string', 'required' => true, 'description' => 'Album ID.'],
        'video_id' => ['type' => 'string', 'required' => true, 'description' => 'Video ID.'],
    ];

    /**
     * Add the video.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->addVideoToAlbum($this->requiredString($args, 'album_id'), $this->requiredString($args, 'video_id'));
    }
}
