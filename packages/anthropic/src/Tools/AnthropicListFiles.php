<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

/**
 * List files available to the Anthropic API key workspace.
 */
class AnthropicListFiles extends AbstractAnthropicTool
{
    protected const NAME = 'anthropic_list_files';
    protected const DESCRIPTION = 'List files in the workspace using the Anthropic Files API beta.';
    protected const METHOD = 'listFiles';
    protected const USE_QUERY = true;
}
