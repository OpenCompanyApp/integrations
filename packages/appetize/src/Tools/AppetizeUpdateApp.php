<?php

namespace OpenCompany\Integrations\Appetize\Tools;

/** Update an existing Appetize app. */
class AppetizeUpdateApp extends AbstractAppetizeTool { protected const NAME = 'appetize_update_app'; protected const DESCRIPTION = 'Update an existing Appetize app with a new build or settings.'; protected const METHOD = 'updateApp'; protected const ARGUMENTS = ['public_key']; protected const REQUIRED = ['public_key', 'payload']; protected const USE_PAYLOAD = true; }
