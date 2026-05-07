<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Delete a Front tag by ID.
 */
class FrontDeleteTag extends AbstractFrontTool
{
    protected const NAME = 'front_delete_tag';
    protected const DESCRIPTION = 'Delete a Front tag by ID.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/tags/{tag_id}';
    protected const REQUIRED = ['tag_id'];
    protected const PARAMETERS = [
        'tag_id' => ['type' => 'string', 'required' => true, 'description' => 'Tag ID.'],
    ];
}
