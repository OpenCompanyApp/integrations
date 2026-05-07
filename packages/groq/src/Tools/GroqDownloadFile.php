<?php

namespace OpenCompany\Integrations\Groq\Tools;

/**
 * Download Groq file content.
 */
class GroqDownloadFile extends AbstractGroqTool
{
    protected const NAME = 'groq_download_file';
    protected const DESCRIPTION = 'Download the content of a Groq file. Non-JSON bodies are returned as base64.';
    protected const METHOD = 'downloadFile';
    protected const ARGUMENTS = ['file_id'];
    protected const REQUIRED = ['file_id'];
}
