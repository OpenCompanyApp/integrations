<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Create a legacy Front tag.
 */
class FrontCreateTag extends AbstractFrontTool
{
    protected const NAME = 'front_create_tag';
    protected const DESCRIPTION = 'Create a Front tag in the oldest team. Prefer front_create_company_tag or scoped team/teammate tag tools when possible.';
    protected const METHOD = 'POST';
    protected const PATH = '/tags';
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['name', 'description', 'highlight', 'is_visible_in_conversation_lists'];
    protected const PARAMETERS = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Tag name, up to 64 characters.'],
        'description' => ['type' => 'string', 'description' => 'Tag description.'],
        'highlight' => ['type' => 'string', 'description' => 'Front tag highlight color.'],
        'is_visible_in_conversation_lists' => ['type' => 'boolean', 'description' => 'Whether the tag is visible in conversation lists.'],
    ];
}
