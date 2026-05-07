<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Get remaining OpenRouter credits. */
class OpenrouterGetCredits extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_get_credits';
    protected const DESCRIPTION = 'Get remaining credits for the OpenRouter account.';
    protected const METHOD = 'getCredits';
}
