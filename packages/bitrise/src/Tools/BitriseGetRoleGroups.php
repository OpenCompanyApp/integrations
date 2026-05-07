<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** List Workspace groups assigned to an app role. */
class BitriseGetRoleGroups extends AbstractBitriseTool { protected const NAME = 'bitrise_get_role_groups'; protected const DESCRIPTION = 'List Workspace groups assigned to admin, manager, or member role on an app.'; protected const METHOD = 'getRoleGroups'; protected const ARGUMENTS = ['app_slug', 'role_name']; }
