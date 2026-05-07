<?php

namespace OpenCompany\Integrations\ReadMe\Tools;

/**
 * List pages within a ReadMe category.
 */
class ReadMeListCategoryPages extends AbstractReadMeTool
{
    protected const NAME = 'readme_list_category_pages';
    protected const DESCRIPTION = 'List pages within a ReadMe category.';
    protected const METHOD = 'listCategoryPages';

    public function parameters(): array
    {
        return ReadMeParameters::category() + ReadMeParameters::pagination();
    }
}
