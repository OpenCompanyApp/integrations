<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

/**
 * Retrieve Anthropic file metadata.
 */
class AnthropicGetFile extends AbstractAnthropicTool
{
    protected const NAME = 'anthropic_get_file';
    protected const DESCRIPTION = 'Get metadata for one Anthropic Files API file.';
    protected const METHOD = 'getFile';
    protected const ARGUMENTS = ['id'];
    protected const REQUIRED = ['id'];
}
