<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** Delete an Attio record by object and record ID. */
class AttioDeleteRecord extends AbstractAttioTool
{
    protected const NAME = 'attio_delete_record';
    protected const DESCRIPTION = 'Delete an Attio record by object slug/ID and record ID.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v2/objects/{object_id}/records/{record_id}';
    protected const REQUIRED = ['object_id', 'record_id'];
    protected const PARAMETERS = [
        'object_id' => ['type' => 'string', 'required' => true, 'description' => 'Object slug or UUID.'],
        'record_id' => ['type' => 'string', 'required' => true, 'description' => 'Record UUID.'],
    ];
}
