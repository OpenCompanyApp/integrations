<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** Query entries in an Attio list. */
class AttioListEntries extends AbstractAttioTool
{
    protected const NAME = 'attio_list_entries';
    protected const DESCRIPTION = 'Query entries in an Attio list with filters, sorts, limit, and offset.';
    protected const METHOD = 'POST';
    protected const PATH = '/v2/lists/{list_id}/entries/query';
    protected const REQUIRED = ['list_id'];
    protected const BODY_KEYS = ['filter', 'filter_view_id', 'sorts', 'limit', 'offset'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'list_id' => ['type' => 'string', 'required' => true, 'description' => 'List slug or UUID.'],
        'filter' => ['type' => 'object', 'description' => 'Attio filter object.'],
        'filter_view_id' => ['type' => 'string', 'description' => 'Saved view UUID.'],
        'sorts' => ['type' => 'array', 'description' => 'Sort definitions.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum entries to return.'],
        'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
        'body' => ['type' => 'object', 'description' => 'Raw query body.'],
    ];
}
