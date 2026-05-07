<?php

namespace OpenCompany\Integrations\Xata\Tools;

/**
 * Get one record by table and id.
 */
class XataGetRecord extends AbstractXataTool
{
    protected const NAME = 'xata_get_record';
    protected const DESCRIPTION = 'Get one record by table and id.';
    protected const PARAMETERS = [
        'database' => ['type' => 'string', 'required' => true, 'description' => 'Database name.'],
        'branch' => ['type' => 'string', 'required' => true, 'description' => 'Branch name.'],
        'table' => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
        'record_id' => ['type' => 'string', 'required' => true, 'description' => 'Record id.'],
        'columns' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Optional selected columns.'],
    ];
    protected const OPERATION = [
        'method' => 'GET',
        'path' => '/db/{database}:{branch}/tables/{table}/data/{record_id}',
        'path_params' => ['database', 'branch', 'table', 'record_id'],
        'query_params' => ['columns'],
        'required' => ['database', 'branch', 'table', 'record_id'],
    ];
}
