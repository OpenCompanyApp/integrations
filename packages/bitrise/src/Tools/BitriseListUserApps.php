<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** List Bitrise apps for a user. */
class BitriseListUserApps extends AbstractBitriseTool { protected const NAME = 'bitrise_list_user_apps'; protected const DESCRIPTION = 'List Bitrise apps for a user by user slug.'; protected const METHOD = 'listUserApps'; protected const ARGUMENTS = ['user_slug']; protected const USE_QUERY = true; }
