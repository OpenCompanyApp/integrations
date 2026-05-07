<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** Get one Attio object or list attribute. */
class AttioGetAttribute extends AbstractAttioTool
{
    protected const NAME = 'attio_get_attribute';
    protected const DESCRIPTION = 'Get an attribute on an Attio object or list by attribute slug or ID.';
    protected const METHOD = 'GET';
    protected const PATH = '/v2/{target}/{identifier}/attributes/{attribute}';
    protected const REQUIRED = ['target', 'identifier', 'attribute'];
    protected const PARAMETERS = [
        'target' => ['type' => 'string', 'required' => true, 'enum' => ['objects', 'lists'], 'description' => 'Whether to inspect object or list attributes.'],
        'identifier' => ['type' => 'string', 'required' => true, 'description' => 'Object/list slug or UUID.'],
        'attribute' => ['type' => 'string', 'required' => true, 'description' => 'Attribute slug or UUID.'],
    ];
}
