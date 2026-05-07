<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

/**
 * List videos in a Vimeo album/showcase.
 */
class VimeoListAlbumVideos extends AbstractVimeoTool
{
    public const NAME = 'vimeo_list_album_videos';
    public const DESCRIPTION = 'List videos in a Vimeo album/showcase.';
    public const PARAMETERS = [
        'album_id' => ['type' => 'string', 'required' => true, 'description' => 'Album ID.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];

    /**
     * List album videos.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listAlbumVideos($this->requiredString($args, 'album_id'), $this->arrayArg($args, 'params'));
    }
}
