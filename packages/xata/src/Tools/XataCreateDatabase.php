<?php

namespace OpenCompany\Integrations\Xata\Tools;

/**
 * Create a database in a Xata workspace.
 */
class XataCreateDatabase extends AbstractXataTool
{
    protected const NAME = 'xata_create_database';
    protected const DESCRIPTION = 'Create a Xata database in a workspace.';
    protected const PARAMETERS = [
        'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'Xata workspace id.'],
        'database' => ['type' => 'string', 'required' => true, 'description' => 'Database name.'],
        'body' => ['type' => 'object', 'description' => 'Optional database creation body.'],
    ];
    protected const OPERATION = [
        'method' => 'POST',
        'scope' => 'management',
        'path' => '/workspaces/{workspace_id}/dbs/{database}',
        'path_params' => ['workspace_id', 'database'],
        'required' => ['workspace_id', 'database'],
    ];
}
