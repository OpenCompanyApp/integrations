<?php

namespace OpenCompany\Integrations\Xata\Tools;

/**
 * Create a branch for a Xata database.
 */
class XataCreateBranch extends AbstractXataTool
{
    protected const NAME = 'xata_create_branch';
    protected const DESCRIPTION = 'Create a branch for a Xata database.';
    protected const PARAMETERS = [
        'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'Xata workspace id.'],
        'database' => ['type' => 'string', 'required' => true, 'description' => 'Database name.'],
        'branch' => ['type' => 'string', 'required' => true, 'description' => 'New branch name.'],
        'body' => ['type' => 'object', 'description' => 'Optional branch creation body, such as from branch settings.'],
    ];
    protected const OPERATION = [
        'method' => 'POST',
        'scope' => 'management',
        'path' => '/workspaces/{workspace_id}/dbs/{database}/branches/{branch}',
        'path_params' => ['workspace_id', 'database', 'branch'],
        'required' => ['workspace_id', 'database', 'branch'],
    ];
}
