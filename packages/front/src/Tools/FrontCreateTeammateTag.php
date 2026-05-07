<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Create a tag scoped to a Front teammate.
 */
class FrontCreateTeammateTag extends AbstractFrontTool
{
    protected const NAME = 'front_create_teammate_tag';
    protected const DESCRIPTION = 'Create a tag for a Front teammate.';
    protected const METHOD = 'POST';
    protected const PATH = '/teammates/{teammate_id}/tags';
    protected const REQUIRED = ['teammate_id'];
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['name', 'description', 'highlight', 'is_visible_in_conversation_lists'];
    protected const PARAMETERS = [
        'teammate_id' => ['type' => 'string', 'required' => true, 'description' => 'Teammate ID or email alias.'],
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Tag name, up to 64 characters.'],
        'description' => ['type' => 'string', 'description' => 'Tag description.'],
        'highlight' => ['type' => 'string', 'description' => 'Front tag highlight color.'],
        'is_visible_in_conversation_lists' => ['type' => 'boolean', 'description' => 'Whether the tag is visible in conversation lists.'],
    ];
}
