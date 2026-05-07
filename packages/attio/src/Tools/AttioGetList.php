<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** Get one Attio list by slug or ID. */
class AttioGetList extends AbstractAttioTool
{
    protected const NAME = 'attio_get_list';
    protected const DESCRIPTION = 'Get one Attio list by list slug or UUID.';
    protected const METHOD = 'GET';
    protected const PATH = '/v2/lists/{list_id}';
    protected const REQUIRED = ['list_id'];
    protected const PARAMETERS = [
        'list_id' => ['type' => 'string', 'required' => true, 'description' => 'List slug or UUID.'],
    ];
}
