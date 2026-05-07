<?php

namespace OpenCompany\Integrations\Xata\Tools;

/**
 * Update schema for a database branch.
 */
class XataUpdateSchema extends AbstractXataTool
{
    protected const NAME = 'xata_update_schema';
    protected const DESCRIPTION = 'Update schema for a database branch.';
    protected const PARAMETERS = [
        'database' => ['type' => 'string', 'required' => true, 'description' => 'Database name.'],
        'branch' => ['type' => 'string', 'required' => true, 'description' => 'Branch name.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Schema migration or schema update body.'],
    ];
    protected const OPERATION = [
        'method' => 'PUT',
        'path' => '/db/{database}:{branch}/schema',
        'path_params' => ['database', 'branch'],
        'required' => ['database', 'branch', 'body'],
    ];
}
