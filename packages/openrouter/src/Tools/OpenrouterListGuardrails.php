<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** List OpenRouter guardrails. */
class OpenrouterListGuardrails extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_list_guardrails';
    protected const DESCRIPTION = 'List OpenRouter guardrails.';
    protected const METHOD = 'listGuardrails';
    protected const USE_QUERY = true;
}
