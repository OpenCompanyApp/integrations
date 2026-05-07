<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

/**
 * Create a text track for a Vimeo video.
 */
class VimeoCreateVideoTextTrack extends AbstractVimeoTool
{
    public const NAME = 'vimeo_create_video_text_track';
    public const DESCRIPTION = 'Create a text track for a Vimeo video.';
    public const PARAMETERS = [
        'video_id' => ['type' => 'string', 'required' => true, 'description' => 'Vimeo video ID.'],
        'data' => ['type' => 'object', 'required' => true, 'description' => 'Text track payload with type, language, name, and related fields.'],
    ];

    /**
     * Create the text track.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->createVideoTextTrack($this->requiredString($args, 'video_id'), $this->requiredArray($args, 'data'));
    }
}
