<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Update an OpenRouter API key by hash. */
class OpenrouterUpdateApiKey extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_update_api_key';
    protected const DESCRIPTION = 'Update an OpenRouter API key by hash.';
    protected const METHOD = 'updateApiKey';
    protected const ARGUMENTS = ['hash'];
    protected const REQUIRED = ['hash', 'payload'];
    protected const USE_PAYLOAD = true;
}
