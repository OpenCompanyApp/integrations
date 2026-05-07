<?php

namespace OpenCompany\Integrations\Xata\Tools;

/**
 * List databases in a Xata workspace.
 */
class XataListDatabases extends AbstractXataTool
{
    protected const NAME = 'xata_list_databases';
    protected const DESCRIPTION = 'List databases in a Xata workspace.';
    protected const PARAMETERS = [
        'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'Xata workspace id.'],
    ];
    protected const OPERATION = [
        'method' => 'GET',
        'scope' => 'management',
        'path' => '/workspaces/{workspace_id}/dbs',
        'path_params' => ['workspace_id'],
        'required' => ['workspace_id'],
    ];
}
