<?php

namespace OpenCompany\Integrations\BrowserStack\Tools;

/** Execute a safe relative BrowserStack API POST call. */
class BrowserStackApiPost extends AbstractBrowserStackTool { protected const NAME = 'browserstack_api_post'; protected const DESCRIPTION = 'Call a safe relative BrowserStack POST path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiPost'; protected const ARGUMENTS = ['path']; protected const USE_PAYLOAD = true; }
