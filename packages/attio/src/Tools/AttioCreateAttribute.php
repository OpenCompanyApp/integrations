<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** Create an Attio object or list attribute. */
class AttioCreateAttribute extends AbstractAttioTool
{
    protected const NAME = 'attio_create_attribute';
    protected const DESCRIPTION = 'Create a new attribute on an Attio object or list.';
    protected const METHOD = 'POST';
    protected const PATH = '/v2/{target}/{identifier}/attributes';
    protected const REQUIRED = ['target', 'identifier', 'title', 'api_slug', 'type'];
    protected const BODY_KEYS = ['title', 'description', 'api_slug', 'type', 'is_required', 'is_unique', 'is_multiselect', 'config', 'default_value', 'relationship'];
    protected const WRAP_DATA = true;
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'target' => ['type' => 'string', 'required' => true, 'enum' => ['objects', 'lists'], 'description' => 'Create on objects or lists.'],
        'identifier' => ['type' => 'string', 'required' => true, 'description' => 'Object/list slug or UUID.'],
        'title' => ['type' => 'string', 'required' => true, 'description' => 'Human-readable title.'],
        'api_slug' => ['type' => 'string', 'required' => true, 'description' => 'API slug.'],
        'type' => ['type' => 'string', 'required' => true, 'description' => 'Attio attribute type, such as text or status.'],
        'body' => ['type' => 'object', 'description' => 'Raw attribute body. If data is omitted, fields are wrapped as data.'],
    ];
}
