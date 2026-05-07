<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List share records for a Mistral library.
 */
class MistralListLibraryShares extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_library_shares';
    protected const DESCRIPTION = 'List share records for a Mistral library.';
    protected const PATH = '/v1/libraries/{library_id}/share';
    protected const PATH_PARAMS = ['library_id'];
    protected const PARAMETERS = ['library_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral library ID.']];
}
