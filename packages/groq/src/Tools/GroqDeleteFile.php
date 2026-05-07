<?php

namespace OpenCompany\Integrations\Groq\Tools;

/**
 * Delete a Groq file.
 */
class GroqDeleteFile extends AbstractGroqTool
{
    protected const NAME = 'groq_delete_file';
    protected const DESCRIPTION = 'Delete an uploaded Groq file by ID.';
    protected const METHOD = 'deleteFile';
    protected const ARGUMENTS = ['file_id'];
    protected const REQUIRED = ['file_id'];
}
