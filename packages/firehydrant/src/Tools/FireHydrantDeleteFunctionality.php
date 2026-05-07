<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Archive a functionality.
 *
 * Maps to the official FireHydrant endpoint delete /v1/functionalities/{functionality_id}.
 */
class FireHydrantDeleteFunctionality extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_functionality';
    protected const DESCRIPTION = 'Archive a functionality

Official FireHydrant endpoint: DELETE /v1/functionalities/{functionality_id}

Archive a functionality';
    protected const PARAMETERS = array (
  'functionality_id' =>
  array (
    'type' => 'string',
    'description' => 'functionality_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/functionalities/{functionality_id}';
    protected const PATH_PARAMS = array (
  'functionality_id' => 'functionality_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
