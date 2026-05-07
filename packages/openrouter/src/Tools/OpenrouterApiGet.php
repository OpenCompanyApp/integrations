<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Call a safe relative OpenRouter GET path. */
class OpenrouterApiGet extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_api_get';
    protected const DESCRIPTION = 'Call a safe relative OpenRouter GET path for endpoints not covered by first-class tools.';
    protected const METHOD = 'apiGet';
    protected const ARGUMENTS = ['path'];
    protected const REQUIRED = ['path'];
    protected const USE_QUERY = true;
}
