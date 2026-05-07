<?php

namespace OpenCompany\Integrations\ReadMe\Tools;

/**
 * Get one ReadMe branch by name.
 */
class ReadMeGetBranch extends AbstractReadMeTool
{
    protected const NAME = 'readme_get_branch';
    protected const DESCRIPTION = 'Get one ReadMe branch by name. Use stable for the default branch.';
    protected const METHOD = 'getBranch';

    public function parameters(): array
    {
        return ReadMeParameters::branch();
    }
}
