<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** Add an Attio record to a list. */
class AttioCreateEntry extends AbstractAttioTool
{
    protected const NAME = 'attio_create_entry';
    protected const DESCRIPTION = 'Add a record to an Attio list as a new list entry.';
    protected const METHOD = 'POST';
    protected const PATH = '/v2/lists/{list_id}/entries';
    protected const REQUIRED = ['list_id', 'parent_record_id', 'parent_object'];
    protected const BODY_KEYS = ['parent_record_id', 'parent_object', 'entry_values'];
    protected const WRAP_DATA = true;
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'list_id' => ['type' => 'string', 'required' => true, 'description' => 'List slug or UUID.'],
        'parent_record_id' => ['type' => 'string', 'required' => true, 'description' => 'Parent record UUID.'],
        'parent_object' => ['type' => 'string', 'required' => true, 'description' => 'Parent object slug or UUID.'],
        'entry_values' => ['type' => 'object', 'description' => 'List-specific entry values keyed by attribute slug or ID.'],
        'body' => ['type' => 'object', 'description' => 'Raw entry body. If data is omitted, fields are wrapped as data.'],
    ];
}
