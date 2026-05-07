<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Submit an OpenRouter video generation request. */
class OpenrouterCreateVideo extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_create_video';
    protected const DESCRIPTION = 'Submit a video generation request through OpenRouter.';
    protected const METHOD = 'createVideo';
    protected const REQUIRED = ['payload'];
    protected const USE_PAYLOAD = true;
}
