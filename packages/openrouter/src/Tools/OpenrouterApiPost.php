<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Call a safe relative OpenRouter POST path. */
class OpenrouterApiPost extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_api_post';
    protected const DESCRIPTION = 'Call a safe relative OpenRouter POST path for endpoints not covered by first-class tools.';
    protected const METHOD = 'apiPost';
    protected const ARGUMENTS = ['path'];
    protected const REQUIRED = ['path'];
    protected const USE_PAYLOAD = true;
}
