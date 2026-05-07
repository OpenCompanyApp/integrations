<?php

namespace OpenCompany\Integrations\Xata\Tools;

/**
 * Execute a database branch transaction.
 */
class XataTransaction extends AbstractXataTool
{
    protected const NAME = 'xata_transaction';
    protected const DESCRIPTION = 'Execute a branch transaction.';
    protected const PARAMETERS = [
        'database' => ['type' => 'string', 'required' => true, 'description' => 'Database name.'],
        'branch' => ['type' => 'string', 'required' => true, 'description' => 'Branch name.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Transaction operations body.'],
    ];
    protected const OPERATION = [
        'method' => 'POST',
        'path' => '/db/{database}:{branch}/transaction',
        'path_params' => ['database', 'branch'],
        'required' => ['database', 'branch', 'body'],
    ];
}
