<?php

namespace OpenCompany\Integrations\Appetize\Tools;

/** Execute a safe relative Appetize POST call. */
class AppetizeApiPost extends AbstractAppetizeTool { protected const NAME = 'appetize_api_post'; protected const DESCRIPTION = 'Call a safe relative Appetize POST path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiPost'; protected const ARGUMENTS = ['path']; protected const USE_PAYLOAD = true; }
