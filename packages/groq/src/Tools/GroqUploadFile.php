<?php

namespace OpenCompany\Integrations\Groq\Tools;

/**
 * Upload a file to Groq.
 */
class GroqUploadFile extends AbstractGroqTool
{
    protected const NAME = 'groq_upload_file';
    protected const DESCRIPTION = 'Upload a local JSONL file for Groq batch processing.';
    protected const METHOD = 'uploadFile';
    protected const ARGUMENTS = ['file_path', 'purpose'];
    protected const REQUIRED = ['file_path'];
}
