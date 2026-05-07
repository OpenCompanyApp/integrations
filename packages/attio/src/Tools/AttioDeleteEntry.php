<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** Delete an Attio list entry. */
class AttioDeleteEntry extends AbstractAttioTool
{
    protected const NAME = 'attio_delete_entry';
    protected const DESCRIPTION = 'Delete an Attio list entry by list and entry ID.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v2/lists/{list_id}/entries/{entry_id}';
    protected const REQUIRED = ['list_id', 'entry_id'];
    protected const PARAMETERS = [
        'list_id' => ['type' => 'string', 'required' => true, 'description' => 'List slug or UUID.'],
        'entry_id' => ['type' => 'string', 'required' => true, 'description' => 'Entry UUID.'],
    ];
}
