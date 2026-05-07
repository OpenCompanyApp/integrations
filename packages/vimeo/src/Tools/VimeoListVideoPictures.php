<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

/**
 * List pictures for a Vimeo video.
 */
class VimeoListVideoPictures extends AbstractVimeoTool
{
    public const NAME = 'vimeo_list_video_pictures';
    public const DESCRIPTION = 'List pictures and thumbnails for a Vimeo video.';
    public const PARAMETERS = [
        'video_id' => ['type' => 'string', 'required' => true, 'description' => 'Vimeo video ID.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];

    /**
     * List pictures.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listVideoPictures($this->requiredString($args, 'video_id'), $this->arrayArg($args, 'params'));
    }
}
