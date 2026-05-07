<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Get Mattermost file metadata.
 *
 * Retrieves metadata for one uploaded file by file ID.
 */
class MattermostGetFileInfo extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_get_file_info';
    protected const DESCRIPTION = 'Get Mattermost file metadata by file_id.';
    protected const PARAMETERS = [
        'file_id' => ['type' => 'string', 'required' => true, 'description' => 'File ID.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/files/{file_id}/info';
    protected const REQUIRED = ['file_id'];
}
