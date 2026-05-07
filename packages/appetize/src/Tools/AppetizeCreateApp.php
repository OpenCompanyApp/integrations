<?php

namespace OpenCompany\Integrations\Appetize\Tools;

/** Create a new Appetize app. */
class AppetizeCreateApp extends AbstractAppetizeTool { protected const NAME = 'appetize_create_app'; protected const DESCRIPTION = 'Create a new Appetize app from a public app file URL and platform settings.'; protected const METHOD = 'createApp'; protected const REQUIRED = ['payload']; protected const USE_PAYLOAD = true; }
