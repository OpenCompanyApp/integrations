<?php

namespace OpenCompany\Integrations\Xata\Tools;

/**
 * Run vector similarity search for a table.
 */
class XataVectorSearch extends AbstractXataTool
{
    protected const NAME = 'xata_vector_search';
    protected const DESCRIPTION = 'Run vector similarity search for a table.';
    protected const PARAMETERS = [
        'database' => ['type' => 'string', 'required' => true, 'description' => 'Database name.'],
        'branch' => ['type' => 'string', 'required' => true, 'description' => 'Branch name.'],
        'table' => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Vector search request body with query vector, column, and size.'],
    ];
    protected const OPERATION = [
        'method' => 'POST',
        'path' => '/db/{database}:{branch}/tables/{table}/vectorSearch',
        'path_params' => ['database', 'branch', 'table'],
        'required' => ['database', 'branch', 'table', 'body'],
    ];
}
