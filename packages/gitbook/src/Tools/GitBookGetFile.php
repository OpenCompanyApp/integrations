<?php

namespace OpenCompany\Integrations\GitBook\Tools;

/**
 * Get one GitBook file by ID.
 */
class GitBookGetFile extends AbstractGitBookTool
{
    protected const NAME = 'gitbook_get_file';
    protected const DESCRIPTION = 'Get one GitBook file by ID.';
    protected const METHOD = 'getFile';

    public function parameters(): array
    {
        return GitBookParameters::file();
    }
}
