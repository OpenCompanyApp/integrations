<?php

namespace OpenCompany\Integrations\GitBook\Tools;

/**
 * Get the current content revision for a GitBook space.
 */
class GitBookGetSpaceContent extends AbstractGitBookTool
{
    protected const NAME = 'gitbook_get_space_content';
    protected const DESCRIPTION = 'Get the current content revision for a GitBook space.';
    protected const METHOD = 'getSpaceContent';

    public function parameters(): array
    {
        return GitBookParameters::content();
    }
}
