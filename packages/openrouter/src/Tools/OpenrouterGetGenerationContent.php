<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Get stored prompt and completion content for a generation. */
class OpenrouterGetGenerationContent extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_get_generation_content';
    protected const DESCRIPTION = 'Get stored prompt and completion content for a generation.';
    protected const METHOD = 'getGenerationContent';
    protected const ARGUMENTS = ['id'];
    protected const REQUIRED = ['id'];
}
