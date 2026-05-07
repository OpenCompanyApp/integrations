<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** List attributes for an Attio object or list. */
class AttioListAttributes extends AbstractAttioTool
{
    protected const NAME = 'attio_list_attributes';
    protected const DESCRIPTION = 'List attributes on an Attio object or list.';
    protected const METHOD = 'GET';
    protected const PATH = '/v2/{target}/{identifier}/attributes';
    protected const REQUIRED = ['target', 'identifier'];
    protected const PARAMETERS = [
        'target' => ['type' => 'string', 'required' => true, 'enum' => ['objects', 'lists'], 'description' => 'Whether to inspect object or list attributes.'],
        'identifier' => ['type' => 'string', 'required' => true, 'description' => 'Object/list slug or UUID.'],
    ];
}
