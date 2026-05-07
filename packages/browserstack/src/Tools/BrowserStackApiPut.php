<?php

namespace OpenCompany\Integrations\BrowserStack\Tools;

/** Execute a safe relative BrowserStack API PUT call. */
class BrowserStackApiPut extends AbstractBrowserStackTool { protected const NAME = 'browserstack_api_put'; protected const DESCRIPTION = 'Call a safe relative BrowserStack PUT path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiPut'; protected const ARGUMENTS = ['path']; protected const USE_PAYLOAD = true; }
