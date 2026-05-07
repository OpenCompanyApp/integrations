<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Update a Front tag by ID.
 */
class FrontUpdateTag extends AbstractFrontTool
{
    protected const NAME = 'front_update_tag';
    protected const DESCRIPTION = 'Update a Front tag by ID.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/tags/{tag_id}';
    protected const REQUIRED = ['tag_id'];
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['name', 'description', 'highlight', 'parent_tag_id', 'is_visible_in_conversation_lists'];
    protected const PARAMETERS = [
        'tag_id' => ['type' => 'string', 'required' => true, 'description' => 'Tag ID.'],
        'name' => ['type' => 'string', 'description' => 'Tag name, up to 64 characters.'],
        'description' => ['type' => 'string', 'description' => 'Tag description.'],
        'highlight' => ['type' => 'string', 'description' => 'Front tag highlight color.'],
        'parent_tag_id' => ['type' => 'string', 'description' => 'Parent tag ID. Use raw body to send null and remove the parent.'],
        'is_visible_in_conversation_lists' => ['type' => 'boolean', 'description' => 'Whether the tag is visible in conversation lists.'],
        'body' => ['type' => 'object', 'description' => 'Optional raw update payload. Use this to send null values.'],
    ];
}
