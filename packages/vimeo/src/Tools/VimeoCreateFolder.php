<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

/**
 * Create a Vimeo folder/project.
 */
class VimeoCreateFolder extends AbstractVimeoTool
{
    public const NAME = 'vimeo_create_folder';
    public const DESCRIPTION = 'Create a Vimeo folder/project.';
    public const PARAMETERS = [
        'data' => ['type' => 'object', 'required' => true, 'description' => 'Folder creation payload, usually including name.'],
    ];

    /**
     * Create the folder.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->createFolder($this->requiredArray($args, 'data'));
    }
}
