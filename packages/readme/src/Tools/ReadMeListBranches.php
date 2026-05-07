<?php

namespace OpenCompany\Integrations\ReadMe\Tools;

/**
 * List branches in a ReadMe project.
 */
class ReadMeListBranches extends AbstractReadMeTool
{
    protected const NAME = 'readme_list_branches';
    protected const DESCRIPTION = 'List branches in the current ReadMe project.';
    protected const METHOD = 'listBranches';

    public function parameters(): array
    {
        return ReadMeParameters::pagination();
    }
}
