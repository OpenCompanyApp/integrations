<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** List Bitrise apps for a Workspace. */
class BitriseListOrganizationApps extends AbstractBitriseTool { protected const NAME = 'bitrise_list_organization_apps'; protected const DESCRIPTION = 'List Bitrise apps for a Workspace by organization slug.'; protected const METHOD = 'listOrganizationApps'; protected const ARGUMENTS = ['organization_slug']; protected const USE_QUERY = true; }
