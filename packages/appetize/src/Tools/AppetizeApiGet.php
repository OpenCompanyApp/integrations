<?php

namespace OpenCompany\Integrations\Appetize\Tools;

/** Execute a safe relative Appetize GET call. */
class AppetizeApiGet extends AbstractAppetizeTool { protected const NAME = 'appetize_api_get'; protected const DESCRIPTION = 'Call a safe relative Appetize GET path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiGet'; protected const ARGUMENTS = ['path']; protected const USE_QUERY = true; }
