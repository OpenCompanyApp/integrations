<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List Mistral libraries.
 */
class MistralListLibraries extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_libraries';
    protected const DESCRIPTION = 'List Mistral libraries.';
    protected const PATH = '/v1/libraries';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional library list query parameters.']];
}
