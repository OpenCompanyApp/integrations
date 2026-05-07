<?php

namespace OpenCompany\Integrations\BrowserStack\Tools;

/** List BrowserStack Automate browsers and devices. */
class BrowserStackListBrowsers extends AbstractBrowserStackTool { protected const NAME = 'browserstack_list_browsers'; protected const DESCRIPTION = 'List available BrowserStack Automate OS, browsers, and real mobile devices.'; protected const METHOD = 'listBrowsers'; protected const USE_QUERY = true; }
