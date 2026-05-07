<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** Update an Attio record by object and record ID. */
class AttioUpdateRecord extends AbstractAttioTool
{
    protected const NAME = 'attio_update_record';
    protected const DESCRIPTION = 'Update attribute values on an Attio record. Pass values keyed by attribute slug or ID.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/v2/objects/{object_id}/records/{record_id}';
    protected const REQUIRED = ['object_id', 'record_id'];
    protected const BODY_KEYS = ['values'];
    protected const WRAP_DATA = true;
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'object_id' => ['type' => 'string', 'required' => true, 'description' => 'Object slug or UUID, such as people or companies.'],
        'record_id' => ['type' => 'string', 'required' => true, 'description' => 'Record UUID.'],
        'values' => ['type' => 'object', 'description' => 'Attribute values keyed by attribute slug or ID.'],
        'body' => ['type' => 'object', 'description' => 'Raw request body. If data is omitted, fields are wrapped as data.'],
    ];
}
