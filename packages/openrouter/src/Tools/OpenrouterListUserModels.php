<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** List models filtered by user preferences and guardrails. */
class OpenrouterListUserModels extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_list_user_models';
    protected const DESCRIPTION = 'List models filtered by user provider preferences, privacy settings, and guardrails.';
    protected const METHOD = 'listUserModels';
    protected const USE_QUERY = true;
}
