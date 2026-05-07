<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

/**
 * List Vimeo categories.
 */
class VimeoListCategories extends AbstractVimeoTool
{
    public const NAME = 'vimeo_list_categories';
    public const DESCRIPTION = 'List Vimeo categories.';
    public const PARAMETERS = [
        'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];

    /**
     * List categories.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listCategories($this->arrayArg($args, 'params'));
    }
}
