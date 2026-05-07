<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Create a Mistral library.
 */
class MistralCreateLibrary extends AbstractMistralTool
{
    protected const NAME = 'mistral_create_library';
    protected const DESCRIPTION = 'Create a Mistral library.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/libraries';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Library create body matching the Mistral API schema.']];
}
