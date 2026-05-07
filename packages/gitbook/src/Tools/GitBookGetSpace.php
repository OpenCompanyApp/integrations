<?php

namespace OpenCompany\Integrations\GitBook\Tools;

/**
 * Get one GitBook space.
 */
class GitBookGetSpace extends AbstractGitBookTool
{
    protected const NAME = 'gitbook_get_space';
    protected const DESCRIPTION = 'Get one GitBook space by ID.';
    protected const METHOD = 'getSpace';

    public function parameters(): array
    {
        return GitBookParameters::space();
    }
}
