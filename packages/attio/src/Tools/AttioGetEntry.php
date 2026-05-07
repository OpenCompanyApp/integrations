<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** Get one Attio list entry. */
class AttioGetEntry extends AbstractAttioTool
{
    protected const NAME = 'attio_get_entry';
    protected const DESCRIPTION = 'Get a single Attio list entry by list and entry ID.';
    protected const METHOD = 'GET';
    protected const PATH = '/v2/lists/{list_id}/entries/{entry_id}';
    protected const REQUIRED = ['list_id', 'entry_id'];
    protected const PARAMETERS = [
        'list_id' => ['type' => 'string', 'required' => true, 'description' => 'List slug or UUID.'],
        'entry_id' => ['type' => 'string', 'required' => true, 'description' => 'Entry UUID.'],
    ];
}
