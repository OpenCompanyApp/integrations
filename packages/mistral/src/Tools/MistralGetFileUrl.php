<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get a signed URL for a Mistral file.
 */
class MistralGetFileUrl extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_file_url';
    protected const DESCRIPTION = 'Get a signed URL for a Mistral file.';
    protected const PATH = '/v1/files/{file_id}/url';
    protected const PATH_PARAMS = ['file_id'];
    protected const PARAMETERS = ['file_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral file ID.'], 'query' => ['type' => 'object', 'description' => 'Optional signed URL query parameters.']];
}
