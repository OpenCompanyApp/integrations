<?php

namespace OpenCompany\Integrations\GitBook\Tools;

/**
 * Get one GitBook organization.
 */
class GitBookGetOrganization extends AbstractGitBookTool
{
    protected const NAME = 'gitbook_get_organization';
    protected const DESCRIPTION = 'Get one GitBook organization by ID.';
    protected const METHOD = 'getOrganization';

    public function parameters(): array
    {
        return GitBookParameters::organization();
    }
}
