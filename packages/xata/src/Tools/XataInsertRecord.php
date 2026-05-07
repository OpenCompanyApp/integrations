<?php

namespace OpenCompany\Integrations\Xata\Tools;

/**
 * Insert a record into a table.
 */
class XataInsertRecord extends AbstractXataTool
{
    protected const NAME = 'xata_insert_record';
    protected const DESCRIPTION = 'Insert a record into a table.';
    protected const PARAMETERS = [
        'database' => ['type' => 'string', 'required' => true, 'description' => 'Database name.'],
        'branch' => ['type' => 'string', 'required' => true, 'description' => 'Branch name.'],
        'table' => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Record fields to insert.'],
    ];
    protected const OPERATION = [
        'method' => 'POST',
        'path' => '/db/{database}:{branch}/tables/{table}/data',
        'path_params' => ['database', 'branch', 'table'],
        'required' => ['database', 'branch', 'table', 'body'],
    ];
}
