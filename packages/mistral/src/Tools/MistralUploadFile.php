<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Upload a file to Mistral.
 */
class MistralUploadFile extends AbstractMistralTool
{
    protected const NAME = 'mistral_upload_file';
    protected const DESCRIPTION = 'Upload a file to Mistral for fine-tuning, batch, or OCR workflows.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/files';
    protected const FILE_UPLOAD = true;
    protected const PARAMETERS = ['file_path' => ['type' => 'string', 'required' => true, 'description' => 'Local path to the file to upload.'], 'body' => ['type' => 'object', 'description' => 'Multipart fields such as purpose.']];
}
