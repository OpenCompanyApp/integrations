<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** List OpenRouter organization members. */
class OpenrouterListOrganizationMembers extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_list_organization_members';
    protected const DESCRIPTION = 'List OpenRouter organization members.';
    protected const METHOD = 'listOrganizationMembers';
    protected const USE_QUERY = true;
}
