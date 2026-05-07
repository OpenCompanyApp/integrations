<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Moderate text with Mistral.
 */
class MistralModerations extends AbstractMistralTool
{
    protected const NAME = 'mistral_moderations';
    protected const DESCRIPTION = 'Run Mistral moderation over input text.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/moderations';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Moderation body with model and input.']];
}
