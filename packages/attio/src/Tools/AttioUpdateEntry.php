<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** Update an Attio list entry. */
class AttioUpdateEntry extends AbstractAttioTool
{
    protected const NAME = 'attio_update_entry';
    protected const DESCRIPTION = 'Update list entry values. Use PUT to overwrite multiselect values, matching Attio endpoint behavior.';
    protected const METHOD = 'PUT';
    protected const PATH = '/v2/lists/{list_id}/entries/{entry_id}';
    protected const REQUIRED = ['list_id', 'entry_id'];
    protected const BODY_KEYS = ['entry_values'];
    protected const WRAP_DATA = true;
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'list_id' => ['type' => 'string', 'required' => true, 'description' => 'List slug or UUID.'],
        'entry_id' => ['type' => 'string', 'required' => true, 'description' => 'Entry UUID.'],
        'entry_values' => ['type' => 'object', 'description' => 'Entry values keyed by attribute slug or ID.'],
        'body' => ['type' => 'object', 'description' => 'Raw entry body. If data is omitted, fields are wrapped as data.'],
    ];
}
