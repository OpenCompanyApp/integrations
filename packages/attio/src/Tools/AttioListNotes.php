<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** List Attio notes. */
class AttioListNotes extends AbstractAttioTool
{
    protected const NAME = 'attio_list_notes';
    protected const DESCRIPTION = 'List Attio notes globally or for a specific parent record.';
    protected const METHOD = 'GET';
    protected const PATH = '/v2/notes';
    protected const QUERY_KEYS = ['limit', 'offset', 'parent_object', 'parent_record_id'];
    protected const PARAMETERS = [
        'limit' => ['type' => 'integer', 'description' => 'Maximum notes to return.'],
        'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
        'parent_object' => ['type' => 'string', 'description' => 'Parent object slug or ID.'],
        'parent_record_id' => ['type' => 'string', 'description' => 'Parent record UUID.'],
    ];
}
