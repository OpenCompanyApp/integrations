<?php

namespace OpenCompany\Integrations\Xata\Tools;

/**
 * Patch a record by table and id.
 */
class XataUpdateRecord extends AbstractXataTool
{
    protected const NAME = 'xata_update_record';
    protected const DESCRIPTION = 'Patch a record by table and id.';
    protected const PARAMETERS = [
        'database' => ['type' => 'string', 'required' => true, 'description' => 'Database name.'],
        'branch' => ['type' => 'string', 'required' => true, 'description' => 'Branch name.'],
        'table' => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
        'record_id' => ['type' => 'string', 'required' => true, 'description' => 'Record id.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Record fields to patch.'],
    ];
    protected const OPERATION = [
        'method' => 'PATCH',
        'path' => '/db/{database}:{branch}/tables/{table}/data/{record_id}',
        'path_params' => ['database', 'branch', 'table', 'record_id'],
        'required' => ['database', 'branch', 'table', 'record_id', 'body'],
    ];
}
