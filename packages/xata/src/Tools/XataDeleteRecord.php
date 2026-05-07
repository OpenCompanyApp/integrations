<?php

namespace OpenCompany\Integrations\Xata\Tools;

/**
 * Delete a record by table and id.
 */
class XataDeleteRecord extends AbstractXataTool
{
    protected const NAME = 'xata_delete_record';
    protected const DESCRIPTION = 'Delete a record by table and id.';
    protected const PARAMETERS = [
        'database' => ['type' => 'string', 'required' => true, 'description' => 'Database name.'],
        'branch' => ['type' => 'string', 'required' => true, 'description' => 'Branch name.'],
        'table' => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
        'record_id' => ['type' => 'string', 'required' => true, 'description' => 'Record id.'],
    ];
    protected const OPERATION = [
        'method' => 'DELETE',
        'path' => '/db/{database}:{branch}/tables/{table}/data/{record_id}',
        'path_params' => ['database', 'branch', 'table', 'record_id'],
        'required' => ['database', 'branch', 'table', 'record_id'],
    ];
}
