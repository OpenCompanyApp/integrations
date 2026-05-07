<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Replace Workspace groups assigned to an app role. */
class BitriseSetRoleGroups extends AbstractBitriseTool { protected const NAME = 'bitrise_set_role_groups'; protected const DESCRIPTION = 'Replace all Workspace groups assigned to admin, manager, or member role on an app.'; protected const METHOD = 'setRoleGroups'; protected const ARGUMENTS = ['app_slug', 'role_name']; protected const REQUIRED = ['app_slug', 'role_name', 'payload']; protected const USE_PAYLOAD = true; }
