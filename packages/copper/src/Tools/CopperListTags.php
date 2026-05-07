<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * List all Copper tags.
 */
class CopperListTags extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_list_tags';

    protected string $toolDescription = 'List all tags configured in Copper.';

    protected string $path = '/tags';

    /** @var list<string> */
    protected array $queryParams = ['sort_by', 'tag_names_only', 'last_tag_value'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'sort_by' => ['type' => 'string', 'description' => 'Sort by name or count.'],
        'tag_names_only' => ['type' => 'boolean', 'description' => 'Return only tag names.'],
        'last_tag_value' => ['type' => 'string', 'description' => 'Pagination cursor when tag_names_only is true.'],
    ];
}
