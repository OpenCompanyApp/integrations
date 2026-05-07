<?php

namespace OpenCompany\Integrations\Xata\Tools;

/**
 * Read schema for a database branch.
 */
class XataGetSchema extends AbstractXataTool
{
    protected const NAME = 'xata_get_schema';
    protected const DESCRIPTION = 'Read schema for a database branch.';
    protected const PARAMETERS = [
        'database' => ['type' => 'string', 'required' => true, 'description' => 'Database name.'],
        'branch' => ['type' => 'string', 'required' => true, 'description' => 'Branch name.'],
    ];
    protected const OPERATION = [
        'method' => 'GET',
        'path' => '/db/{database}:{branch}/schema',
        'path_params' => ['database', 'branch'],
        'required' => ['database', 'branch'],
    ];
}
