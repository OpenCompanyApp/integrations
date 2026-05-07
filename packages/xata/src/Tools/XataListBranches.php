<?php

namespace OpenCompany\Integrations\Xata\Tools;

/**
 * List branches for a Xata database.
 */
class XataListBranches extends AbstractXataTool
{
    protected const NAME = 'xata_list_branches';
    protected const DESCRIPTION = 'List branches for a Xata database.';
    protected const PARAMETERS = [
        'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'Xata workspace id.'],
        'database' => ['type' => 'string', 'required' => true, 'description' => 'Database name.'],
    ];
    protected const OPERATION = [
        'method' => 'GET',
        'scope' => 'management',
        'path' => '/workspaces/{workspace_id}/dbs/{database}/branches',
        'path_params' => ['workspace_id', 'database'],
        'required' => ['workspace_id', 'database'],
    ];
}
