<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Classify text with Mistral.
 */
class MistralClassifications extends AbstractMistralTool
{
    protected const NAME = 'mistral_classifications';
    protected const DESCRIPTION = 'Run Mistral classifications over text input.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/classifications';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Classification body matching the Mistral API schema.']];
}
