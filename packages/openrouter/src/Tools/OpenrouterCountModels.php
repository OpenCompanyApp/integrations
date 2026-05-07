<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Count OpenRouter models. */
class OpenrouterCountModels extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_count_models';
    protected const DESCRIPTION = 'Get total count of available OpenRouter models.';
    protected const METHOD = 'countModels';
    protected const USE_QUERY = true;
}
