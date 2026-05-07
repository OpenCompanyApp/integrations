<?php

namespace OpenCompany\Integrations\Xata\Tools;

/**
 * Run aggregation queries for a table.
 */
class XataAggregateTable extends AbstractXataTool
{
    protected const NAME = 'xata_aggregate_table';
    protected const DESCRIPTION = 'Run table aggregation queries.';
    protected const PARAMETERS = [
        'database' => ['type' => 'string', 'required' => true, 'description' => 'Database name.'],
        'branch' => ['type' => 'string', 'required' => true, 'description' => 'Branch name.'],
        'table' => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Aggregate request body.'],
    ];
    protected const OPERATION = [
        'method' => 'POST',
        'path' => '/db/{database}:{branch}/tables/{table}/aggregate',
        'path_params' => ['database', 'branch', 'table'],
        'required' => ['database', 'branch', 'table', 'body'],
    ];
}
