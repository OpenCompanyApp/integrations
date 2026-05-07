<?php

namespace OpenCompany\Integrations\Xata\Tools;

/**
 * Search records across a database branch.
 */
class XataSearchBranch extends AbstractXataTool
{
    protected const NAME = 'xata_search_branch';
    protected const DESCRIPTION = 'Search records across a branch.';
    protected const PARAMETERS = [
        'database' => ['type' => 'string', 'required' => true, 'description' => 'Database name.'],
        'branch' => ['type' => 'string', 'required' => true, 'description' => 'Branch name.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Search body with query, tables, fuzziness, or target options.'],
    ];
    protected const OPERATION = [
        'method' => 'POST',
        'path' => '/db/{database}:{branch}/search',
        'path_params' => ['database', 'branch'],
        'required' => ['database', 'branch', 'body'],
    ];
}
