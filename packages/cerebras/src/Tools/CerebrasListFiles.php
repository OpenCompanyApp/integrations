<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * List Cerebras files.
 */
class CerebrasListFiles extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_list_files';
    protected const DESCRIPTION = 'List Cerebras files.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/files';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
