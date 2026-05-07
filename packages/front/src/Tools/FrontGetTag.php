<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Fetch a Front tag by ID.
 */
class FrontGetTag extends AbstractFrontTool
{
    protected const NAME = 'front_get_tag';
    protected const DESCRIPTION = 'Get a Front tag by ID.';
    protected const METHOD = 'GET';
    protected const PATH = '/tags/{tag_id}';
    protected const REQUIRED = ['tag_id'];
    protected const PARAMETERS = [
        'tag_id' => ['type' => 'string', 'required' => true, 'description' => 'Tag ID.'],
    ];
}
