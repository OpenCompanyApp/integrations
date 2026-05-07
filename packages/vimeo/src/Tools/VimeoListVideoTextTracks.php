<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

/**
 * List text tracks for a Vimeo video.
 */
class VimeoListVideoTextTracks extends AbstractVimeoTool
{
    public const NAME = 'vimeo_list_video_text_tracks';
    public const DESCRIPTION = 'List text tracks for a Vimeo video.';
    public const PARAMETERS = [
        'video_id' => ['type' => 'string', 'required' => true, 'description' => 'Vimeo video ID.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];

    /**
     * List text tracks.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listVideoTextTracks($this->requiredString($args, 'video_id'), $this->arrayArg($args, 'params'));
    }
}
