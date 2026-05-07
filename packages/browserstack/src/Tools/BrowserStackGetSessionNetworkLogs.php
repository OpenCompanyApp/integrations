<?php

namespace OpenCompany\Integrations\BrowserStack\Tools;

/** Get BrowserStack Automate session network logs. */
class BrowserStackGetSessionNetworkLogs extends AbstractBrowserStackTool { protected const NAME = 'browserstack_get_session_network_logs'; protected const DESCRIPTION = 'Get HAR network logs for one BrowserStack Automate session.'; protected const METHOD = 'getSessionNetworkLogs'; protected const ARGUMENTS = ['session_id']; }
