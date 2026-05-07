<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

/**
 * Create a Vimeo album/showcase.
 */
class VimeoCreateAlbum extends AbstractVimeoTool
{
    public const NAME = 'vimeo_create_album';
    public const DESCRIPTION = 'Create a Vimeo album/showcase for the authenticated user.';
    public const PARAMETERS = [
        'data' => ['type' => 'object', 'required' => true, 'description' => 'Album creation payload, usually including name.'],
    ];

    /**
     * Create the album.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->createAlbum($this->requiredArray($args, 'data'));
    }
}
