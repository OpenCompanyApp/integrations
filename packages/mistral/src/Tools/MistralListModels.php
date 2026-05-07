<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List available Mistral models.
 */
class MistralListModels extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_models';
    protected const DESCRIPTION = 'List available Mistral models.';
    protected const PATH = '/v1/models';
}
