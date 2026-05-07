<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * Upload a file to Cerebras.
 */
class CerebrasUploadFile extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_upload_file';
    protected const DESCRIPTION = 'Upload a file to Cerebras.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/files';
    protected const FILE_UPLOAD = true;
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'description' => 'Request body or multipart fields matching the Cerebras API schema.'], 'file_path' => ['type' => 'string', 'required' => true, 'description' => 'Local file path to upload.']];
}
