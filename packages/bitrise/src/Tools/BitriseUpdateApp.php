<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Update Bitrise app settings. */
class BitriseUpdateApp extends AbstractBitriseTool { protected const NAME = 'bitrise_update_app'; protected const DESCRIPTION = 'Update Bitrise app settings such as title and default branch.'; protected const METHOD = 'updateApp'; protected const ARGUMENTS = ['app_slug']; protected const REQUIRED = ['app_slug', 'payload']; protected const USE_PAYLOAD = true; }
