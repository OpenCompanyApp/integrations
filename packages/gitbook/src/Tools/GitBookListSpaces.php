<?php

namespace OpenCompany\Integrations\GitBook\Tools;

/**
 * List spaces in a GitBook organization.
 */
class GitBookListSpaces extends AbstractGitBookTool
{
    protected const NAME = 'gitbook_list_spaces';
    protected const DESCRIPTION = 'List GitBook spaces in an organization.';
    protected const METHOD = 'listSpaces';

    public function parameters(): array
    {
        return GitBookParameters::organization() + GitBookParameters::pagination();
    }
}
