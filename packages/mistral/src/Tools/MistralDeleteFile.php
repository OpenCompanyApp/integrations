<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Delete a Mistral file.
 */
class MistralDeleteFile extends AbstractMistralTool
{
    protected const NAME = 'mistral_delete_file';
    protected const DESCRIPTION = 'Delete a file from Mistral.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/files/{file_id}';
    protected const PATH_PARAMS = ['file_id'];
    protected const PARAMETERS = ['file_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral file ID.']];
}
