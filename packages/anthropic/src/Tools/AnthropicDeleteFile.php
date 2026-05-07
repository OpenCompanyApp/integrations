<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

/**
 * Delete a file from the Anthropic API key workspace.
 */
class AnthropicDeleteFile extends AbstractAnthropicTool
{
    protected const NAME = 'anthropic_delete_file';
    protected const DESCRIPTION = 'Delete one file from the Anthropic Files API workspace.';
    protected const METHOD = 'deleteFile';
    protected const ARGUMENTS = ['id'];
    protected const REQUIRED = ['id'];
}
