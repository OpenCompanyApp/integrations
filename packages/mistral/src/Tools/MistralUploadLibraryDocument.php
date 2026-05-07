<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Upload a document to a Mistral library.
 */
class MistralUploadLibraryDocument extends AbstractMistralTool
{
    protected const NAME = 'mistral_upload_library_document';
    protected const DESCRIPTION = 'Upload a document to a Mistral library.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/libraries/{library_id}/documents';
    protected const PATH_PARAMS = ['library_id'];
    protected const FILE_UPLOAD = true;
    protected const PARAMETERS = ['library_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral library ID.'], 'file_path' => ['type' => 'string', 'required' => true, 'description' => 'Local document path to upload.'], 'body' => ['type' => 'object', 'description' => 'Multipart metadata fields supported by Mistral.']];
}
