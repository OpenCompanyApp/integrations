<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * Retrieve Cerebras file content.
 */
class CerebrasRetrieveFileContent extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_retrieve_file_content';
    protected const DESCRIPTION = 'Retrieve Cerebras file content.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/files/{file_id}/content';
    protected const PATH_PARAMS = ['file_id'];
    protected const PARAMETERS = ['file_id' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras file_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
