<?php

namespace OpenCompany\Integrations\ReadMe\Tools;

/**
 * List categories in a ReadMe branch section.
 */
class ReadMeListCategories extends AbstractReadMeTool
{
    protected const NAME = 'readme_list_categories';
    protected const DESCRIPTION = 'List categories in a ReadMe branch section.';
    protected const METHOD = 'listCategories';

    public function parameters(): array
    {
        return ReadMeParameters::section();
    }
}
