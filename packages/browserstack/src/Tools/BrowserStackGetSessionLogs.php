<?php

namespace OpenCompany\Integrations\BrowserStack\Tools;

/** Get BrowserStack Automate session text logs. */
class BrowserStackGetSessionLogs extends AbstractBrowserStackTool { protected const NAME = 'browserstack_get_session_logs'; protected const DESCRIPTION = 'Get text logs for one BrowserStack Automate session.'; protected const METHOD = 'getSessionLogs'; protected const ARGUMENTS = ['session_id']; }
