<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

/**
 * Download content for a downloadable Anthropic code-execution file.
 */
class AnthropicDownloadFile extends AbstractAnthropicTool
{
    protected const NAME = 'anthropic_download_file';
    protected const DESCRIPTION = 'Download content for a file created by Anthropic code execution.';
    protected const METHOD = 'downloadFile';
    protected const ARGUMENTS = ['id'];
    protected const REQUIRED = ['id'];
}
