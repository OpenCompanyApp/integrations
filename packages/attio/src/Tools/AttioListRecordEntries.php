<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** List list entries associated with an Attio record. */
class AttioListRecordEntries extends AbstractAttioTool
{
    protected const NAME = 'attio_list_record_entries';
    protected const DESCRIPTION = 'List all list entries for which an Attio record is the parent.';
    protected const METHOD = 'GET';
    protected const PATH = '/v2/objects/{object_id}/records/{record_id}/entries';
    protected const REQUIRED = ['object_id', 'record_id'];
    protected const QUERY_KEYS = ['limit', 'offset'];
    protected const PARAMETERS = [
        'object_id' => ['type' => 'string', 'required' => true, 'description' => 'Object slug or UUID.'],
        'record_id' => ['type' => 'string', 'required' => true, 'description' => 'Record UUID.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum entries to return.'],
        'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
    ];
}
