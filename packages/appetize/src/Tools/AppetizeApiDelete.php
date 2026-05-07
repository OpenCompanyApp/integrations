<?php

namespace OpenCompany\Integrations\Appetize\Tools;

/** Execute a safe relative Appetize DELETE call. */
class AppetizeApiDelete extends AbstractAppetizeTool { protected const NAME = 'appetize_api_delete'; protected const DESCRIPTION = 'Call a safe relative Appetize DELETE path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiDelete'; protected const ARGUMENTS = ['path']; protected const USE_QUERY = true; }
