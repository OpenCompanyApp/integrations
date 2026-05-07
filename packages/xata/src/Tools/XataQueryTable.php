<?php

namespace OpenCompany\Integrations\Xata\Tools;

/**
 * Query records from a table.
 */
class XataQueryTable extends AbstractXataTool
{
    protected const NAME = 'xata_query_table';
    protected const DESCRIPTION = 'Query records from a table.';
    protected const PARAMETERS = [
        'database' => ['type' => 'string', 'required' => true, 'description' => 'Database name.'],
        'branch' => ['type' => 'string', 'required' => true, 'description' => 'Branch name.'],
        'table' => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
        'body' => ['type' => 'object', 'description' => 'Query body including columns, filter, sort, page, or page size.'],
    ];
    protected const OPERATION = [
        'method' => 'POST',
        'path' => '/db/{database}:{branch}/tables/{table}/query',
        'path_params' => ['database', 'branch', 'table'],
        'required' => ['database', 'branch', 'table'],
        'body_from_loose_args' => true,
    ];
}
