<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Retrieve Mistral file metadata.
 */
class MistralRetrieveFile extends AbstractMistralTool
{
    protected const NAME = 'mistral_retrieve_file';
    protected const DESCRIPTION = 'Retrieve metadata for a Mistral file.';
    protected const PATH = '/v1/files/{file_id}';
    protected const PATH_PARAMS = ['file_id'];
    protected const PARAMETERS = ['file_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral file ID.']];
}
