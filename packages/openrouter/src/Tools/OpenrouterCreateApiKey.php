<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Create an OpenRouter API key. */
class OpenrouterCreateApiKey extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_create_api_key';
    protected const DESCRIPTION = 'Create a new OpenRouter API key.';
    protected const METHOD = 'createApiKey';
    protected const REQUIRED = ['payload'];
    protected const USE_PAYLOAD = true;
}
