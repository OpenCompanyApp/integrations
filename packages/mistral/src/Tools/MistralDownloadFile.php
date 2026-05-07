<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Download Mistral file content.
 */
class MistralDownloadFile extends AbstractMistralTool
{
    protected const NAME = 'mistral_download_file';
    protected const DESCRIPTION = 'Download content for a Mistral file.';
    protected const PATH = '/v1/files/{file_id}/content';
    protected const PATH_PARAMS = ['file_id'];
    protected const PARAMETERS = ['file_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral file ID.']];
}
