<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * Delete a Cerebras file.
 */
class CerebrasDeleteFile extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_delete_file';
    protected const DESCRIPTION = 'Delete a Cerebras file.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/files/{file_id}';
    protected const PATH_PARAMS = ['file_id'];
    protected const PARAMETERS = ['file_id' => ['type' => 'string', 'required' => true, 'description' => 'Cerebras file_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
