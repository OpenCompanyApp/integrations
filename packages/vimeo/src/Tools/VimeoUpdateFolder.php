<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

/**
 * Update a Vimeo folder/project.
 */
class VimeoUpdateFolder extends AbstractVimeoTool
{
    public const NAME = 'vimeo_update_folder';
    public const DESCRIPTION = 'Update a Vimeo folder/project.';
    public const PARAMETERS = [
        'folder_id' => ['type' => 'string', 'required' => true, 'description' => 'Folder/project ID.'],
        'data' => ['type' => 'object', 'required' => true, 'description' => 'Folder update payload.'],
    ];

    /**
     * Update the folder.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->updateFolder($this->requiredString($args, 'folder_id'), $this->requiredArray($args, 'data'));
    }
}
