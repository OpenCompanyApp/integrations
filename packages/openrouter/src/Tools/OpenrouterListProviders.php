<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** List all OpenRouter providers. */
class OpenrouterListProviders extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_list_providers';
    protected const DESCRIPTION = 'List all OpenRouter model providers.';
    protected const METHOD = 'listProviders';
}
