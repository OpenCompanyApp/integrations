<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

/**
 * Update a Vimeo album/showcase.
 */
class VimeoUpdateAlbum extends AbstractVimeoTool
{
    public const NAME = 'vimeo_update_album';
    public const DESCRIPTION = 'Update a Vimeo album/showcase.';
    public const PARAMETERS = [
        'album_id' => ['type' => 'string', 'required' => true, 'description' => 'Album ID.'],
        'data' => ['type' => 'object', 'required' => true, 'description' => 'Album update payload.'],
    ];

    /**
     * Update the album.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->updateAlbum($this->requiredString($args, 'album_id'), $this->requiredArray($args, 'data'));
    }
}
