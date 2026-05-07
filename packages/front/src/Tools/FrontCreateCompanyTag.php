<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Create a company-level Front tag.
 */
class FrontCreateCompanyTag extends AbstractFrontTool
{
    protected const NAME = 'front_create_company_tag';
    protected const DESCRIPTION = 'Create a company-level Front tag.';
    protected const METHOD = 'POST';
    protected const PATH = '/company/tags';
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['name', 'description', 'highlight', 'is_visible_in_conversation_lists'];
    protected const PARAMETERS = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Tag name, up to 64 characters.'],
        'description' => ['type' => 'string', 'description' => 'Tag description.'],
        'highlight' => ['type' => 'string', 'description' => 'Front tag highlight color.'],
        'is_visible_in_conversation_lists' => ['type' => 'boolean', 'description' => 'Whether the tag is visible in conversation lists.'],
    ];
}
